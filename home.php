
<div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog ">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Task Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <!-- <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl> --> 

                        <div class="row">
                            <div class="col-12 form-control"><label for="title"  style="font-weight:500;"class="text-dark">DESCRIPTION:</label> <label id="title" class=""></label></div>    
                            <div class="col-12 form-control"><label for="title"  style="font-weight:500;"class="text-dark">REMARKS:</label> <label id="remarks" class=""></label></div>    
                            <div class="col-12 form-control"><label for="description"  style="font-weight:500;"class="text-dark">CASE NUMBER:</label> <label id="description" class=""></label></div>
                           <div class="col-12 form-control"><label for="start"  style="font-weight:500;"class="text-dark">START DATE:</label> <label id="start" class=""></label></div>
                            <div class="col-12 form-control"><label for="end"  style="font-weight:500;"class="text-dark">END DATE:</label> <label id="end" class=""></label></div>
                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger " id="delete" data-id="">Delete</button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row ">
    <div class="col-4">
    <div class="card">
            <div class="card-header fw-bold"style="border-bottom:5px solid #ADA06D;">TIMELINE</div>
            <div class="card-body">
            <div class="table-responsive " style="height:600px;">
			<table class="table" style="font-size:10px;">
                     
 					<tbody class="table-warning">
                    
					 <?php
                                require './db/config.php'; 
                                $client_list = "SELECT task.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                                task.task_description,task.remarks,task.priority,task.status,task.end_date
                                FROM tbl_case_list as cases
                                INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                                INNER JOIN tbl_task_list as task ON cases.case_number = task.case_number
                                INNER JOIN tbl_client_list AS client WHERE  cases.client_user_id = client.id";
                                $query = $conn->query($client_list);
                                $i = 1; 
                                while($row= $query->fetch_assoc()):           
								
									$date = new DateTime($row['end_date']);
									$formattedDate = $date->format('F j, Y');
					?>      
        			   <tr>    
                            <td id="case_modal"class="text-start">
							<div class="row">
								<div class="col text-center"><b><?php echo $formattedDate;?></b></div>
								<div class="col text-center"><b><?php echo $row['case_number'];?></b></div>
                                <!-- <div class="col text-center"><?php echo $row['']?></div> -->
								<!-- <div class="col"><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];?></div> -->
								<!-- <div class="col"><?php echo $row['case_type']?></div> -->

                                <div class="col text-center"><?php echo $row['task_description']?></div>
                                <div class="col text-center"><?php echo $row['remarks']?></div>
                                <div class="col text-center"><?php echo $row['priority']?></div>
							</div>
                       	   </td>
                            </tr>
                            <?php endwhile;?>
					</tbody>
					</table>
					</div>
            </div>
        </div>
    </div> 
    
    <div class="col">
    <div class="card">
            <div class="card-header fw-bold"style="border-bottom:5px solid #ADA06D;"><div class="row">
                <div class="col-2">CALENDAR</div>
                <div class="col"><button class="btn btn-sm btn-warning">Add Task</button:btn></div>
            </div></div>
            <div class="card-body">
              <div id="calendar"></div>            
            </div>
        </div>
    </div>
    
</div> 


<?php 
    require './db/config.php';
    $schedules = $conn->query("SELECT task.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
    task.task_description,task.remarks,task.priority,task.status,task.end_date,task.start_date
    FROM tbl_case_list as cases
    INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
    INNER JOIN tbl_task_list as task ON cases.case_number = task.case_number
    INNER JOIN tbl_client_list AS client WHERE  cases.client_user_id = client.id");
    $sched_res = [];
    foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
        $row['sdate'] = date('Y-m-d', strtotime($row['start_date']));
        $row['edate'] = date('Y-m-d',strtotime($row['end_date']));
        $sched_res[$row['id']] = $row;
    }
    ?>
     <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>
<script src="./src/js/script.js"></script>