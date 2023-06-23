<style>
.cardTimeline {
  height: 200px;
  transition: height 0.3s ease;
  overflow: hidden;
}

.card.expanded {
  height: auto;


}
.event-one-day {
  color: red;
}
.fc .fc-bg-event .fc-event-title{

}


</style> 


<div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog ">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Task Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
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
<div class="row " >
    <div class="col-5"id="cardTimeline" >
    <div class="card">
            <div class="card-header fw-bold mt-2"style="border-bottom:5px solid #ADA06D;">TIMELINE</div>
            <div class="card-body">
            <div class="table-responsive " style="height:500px;">
		<table class="table" style="font-size:12px;">
         <thead >
            <tr > 
          
                <th class="text-center"style="width:100px;">DATE</th>
                <th class="text-center">CASE #</th>
                <th class="text-center">DESCRIPTION</th>
                <th class="text-center">REMARKS</th>
                <th class="text-center">PRIORITY</th>
            </tr>
            </thead>
 					<tbody class="table-warning">
                    
					 <?php
                                require './db/config.php'; 
                                $client_list = "SELECT task.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                                task.task_description,task.remarks,task.priority,task.status,task.end_date
                                FROM tbl_case_list as cases
                                INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                                INNER JOIN tbl_task_list as task ON cases.case_number = task.case_number
                                INNER JOIN tbl_client_list AS client WHERE  cases.client_user_id = client.id and task.end_date >= CURDATE() ORDER BY task.end_date ASC";
                             
                                $query = $conn->query($client_list);
                                $i = 1; 
                                while($row= $query->fetch_assoc()):           
								
                                    $edate = new DateTime($row['end_date']);
                                    $formattedDate = $edate->format('Y-m-d');
                                    ?>      
                                    <tr>              
                                        <?php
                                        $currentDate = new DateTime(); // Current date and time
                                        
                                        // Set time to the end of the current day
                                        $currentDate->setTime(23, 59, 59);
                                        
                                        $interval = $currentDate->diff($edate);
                                        $days = $interval->days + 1;  // Add 1 to include the current day
                                        
                                        if ($days == 1) {
                                            ?> 
                                            <td class="text-center" style="color:#FFCA2C;"><button class="btn btn-sm btn-danger" style="font-size:10px;"><b><?php echo $formattedDate;?></b></button>
                                            <td class="text-center text-danger" style="background:white;"><b><?php echo $row['case_number'];?></td>  
                                            </td><?php  
                                        } else if ($days <=3) {
                                            ?><td class="text-center" style="color:#FFCA2C;"><button class="btn btn-sm btn-warning" style="font-size:10px;"><b><?php echo $formattedDate;?></b></button></td>
                                             <td class="text-center text-warning" style="background:white;"><b><?php echo $row['case_number'];?></td>  
                                            <?php
                                      
                                        } else {
                                            ?><td class="text-center"style="background:white;"><b><?php echo $formattedDate;?></b></td><?php
                                        }
                                        ?>
                                 
                                     
                                   <td class="text-center"><?php echo $row['task_description']?></td>
                                   <td class="text-center"><?php echo $row['remarks']?></td>
                                   <td class="text-center"><?php
                                   if($row['priority'] == 'High')
                                   {
                                    ?><button class="btn btn-sm btn-danger" style="font-size:10px;"><?php echo $row['priority']?></button><?php
                                   }else if($row['priority'] == 'Medium')
                                   {
                                    ?><button class="btn btn-sm btn-info" style="font-size:10px;"><?php echo $row['priority']?></button><?php
                                   }else if($row['priority'] == 'Low')
                                   {
                                    ?><button class="btn btn-sm btn-success" style="font-size:10px;"><?php echo $row['priority']?></button><?php
                                   }
                                   ?></td>
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
                <div class="col"><button class="btn btn-sm btn-warning" id="hideTimelines">Add Task</button:btn></div>
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

        $('.fc').css('background-color','red');
    </script>
<script src="./src/js/script.js"></script>  



