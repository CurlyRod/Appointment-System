<?php
    include './db/config.php'
?>
<script> 
$(document).ready(function()
{ 
 // Destroy the existing DataTable instance (if it exists)
if ($.fn.DataTable.isDataTable('#taskList')) {
    $('#taskList').DataTable().destroy();
}
// Reinitialize the DataTable
$('#taskList').DataTable({});
});
</script>  
   

<div class="row">
 <div class="col">
        <div class="card">
            <div class="card-header" style="border-bottom:5px solid #C6A984 ">
               <div class="row">
                <div class="col-3 fw-bold mt-1">
                  MANAGE TASK
                </div>
              
               </div>
            </div> 
            <div class="card-body p-1">
            <span class="text-center">
            <img src="./vendor/img/bullet-list.png" alt="Logo" width="30" height="30" >
          TASK LIST
            </span>
                <div class="row mt-2 m-4">
                    <div class="table-responsive">
                        <table id="taskList" class="table table-hover" style="width:100%;font-size:13px;">
                                  <thead>
                                    <tr>
                                    <th class="text-center" style="width:20px;">#</th>
                                    <th class="text-center " >Case Number</th>
                                    <th class="text-center">Client Name</th>
                                     <th class="text-center" >Laywer</th>
                                    <th class="text-center">Task</th> 
                                    <th class="text-center" >Due Date</th>
                                    <th class="text-center">Remarks</th>
                                    <th class="text-center" >ACTION</th>
                                  </tr>
                                  </thead> 
                              <tbody class="table-warning">
                              <?php
                                require './db/config.php'; 
                                $client_list = "SELECT cases.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                                cases.end_date, cases.task, cases.remarks
                                FROM tbl_case_list as cases
                                INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                                INNER JOIN tbl_client_list AS client WHERE  cases.client_user_id = client.id";
                                $query = $conn->query($client_list);
                                $i = 1; 
                                while($row= $query->fetch_assoc()):           
				                    ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++?></td>
                                    <td class="text-center" ><b><?php echo $row['case_number'];?></b></td>
                                    <td class="text-center"><?php echo $row['firstname'].' '.$row['middlename'] .' '. $row['lastname']?></td>                      
                                    <td class="text-center"><?php if( $row['lawyer_user_id']== 0){ echo  $row['lawyer_user_id'] = 'none';  }else echo $row['user_fullname'];?> </td>
                                    <td class="text-center"><?php echo $row['task'];?></td>
                                    <td class="text-center"><?php  if($row['end_date'] == null){ echo "Not set"; }else { echo date('Y-m-d', strtotime($row['end_date']));}  ?></td>
                                    <td class="text-center"><?php echo $row['remarks'];?></td>
                                    <td>      
                                    <div class="container d-flex justify-content-end ">                                             
                                        <div class="col-md-3 "><button class="btn btn-sm btn-primary" id="view_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/view (1).png"alt=""></button></div>   
                                        <div class="col-md-3"><button class="btn btn-sm btn-danger"id="delete_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div>
                                        <div class="col-md-3"><button class="btn btn-sm btn-success"id="edit_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div> 
                                        <div class="col-md-3"><button class="btn btn-sm btn-secondary"id="addtask_client_info"  value="<?php echo $row['id']?>" style="font-size:10px;">Add Task</button></div> 
                                  
                                  </
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
    </div>
</div> 

<script>
     $(document).ready(function() {
    $('#manage_task').addClass('selected'); 
});
</script>