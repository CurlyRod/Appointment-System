<div class="row ">
    <div class="col-6">
    <div class="card">
            <div class="card-header fw-bold"style="border-bottom:5px solid #ADA06D;">TIMELINE</div>
            <div class="card-body">
            <div class="table-responsive " style="height:400px;">
			<table class="table" style="font-size:11px;">
                     
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
                                <div class="col text-center"><?php echo $row['priority']?></div>
								<!-- <div class="col"><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];?></div> -->
								<!-- <div class="col"><?php echo $row['case_type']?></div> -->
                                <div class="col text-center"><?php echo $row['status']?></div>
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
            <div class="card-header fw-bold"style="border-bottom:5px solid #ADA06D;">CALENDAR</div>
            <div class="card-body">
               CALENDAR
            </div>
        </div>
    </div>
</div>