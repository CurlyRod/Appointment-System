<div class="row">
    <div class="col" style="width:40%;"> 
        <div class="card">
            <div class="card-header fw-bold"style="border-bottom:5px solid #ADA06D;">TIMELINE</div>
            <div class="card-body">
            <div class="table-responsive " style="height:400px;">
			<table class="table" style="font-size:11px;">
                     
 					<tbody class="table-warning">
                    
					 <?php
                                require './db/config.php'; 
                                $client_list = "SELECT cases.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                                cases.end_date, cases.task, cases.remarks
                                FROM tbl_case_list as cases
                                INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                                INNER JOIN tbl_client_list AS client WHERE  cases.case_status !='Completed' GROUP BY cases.case_number";
                                $query = $conn->query($client_list);
                                $i = 1; 
                                while($row= $query->fetch_assoc()):           
								
									$date = new DateTime($row['end_date']);
									$formattedDate = $date->format('F j, Y');
					?>      
        			   <tr>    
                         
                            <td id="case_modal"class="text-start">
							<div class="row">
								<div class="col"><b><?php echo $formattedDate;?></b></div>
								<div class="col"><b><?php echo $row['case_number'];?></b></div>
								<div class="col"><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];?></div>
								<div class="col"><?php echo $row['case_type']?></div>
								<div class="col"><?php echo $row['remarks']?></div>
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
                sample
            </div>
        </div>
    </div>
</div>