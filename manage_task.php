<?php
    include './db/config.php'
?>

<script> 
$(document).ready(function()
{ 
  $('#add_select_client_list').select2();
 // Destroy the existing DataTable instance (if it exists)
if ($.fn.DataTable.isDataTable('#taskList')) {
    $('#taskList').DataTable().destroy();
}
// Reinitialize the DataTable
$('#taskList').DataTable({});
});

$(document).ready(function() {
     $('.select_client_task').select2({});
      
        $('#toggleButton').on('click', function(e) {
  e.preventDefault();
  console.log("sample");
  var cardTask = $('#cardTask');
  
  if (cardTask.is(':visible')) {
    cardTask.delay(100).fadeOut(200);
    $(this).text("Add Task");
  } else {
    cardTask.show().stop().fadeIn(400);
    $(this).text("Hide Form");
  }
  
});

      });   
        

</script>  



   
<!-- MODAL START HERE -->
<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php   
             include './db/config.php';
             $query = "SELECT c.id,c.firstname,cl.case_number
             FROM tbl_client_list as c 
             INNER JOIN tbl_case_list  as cl ON CL.client_user_id = c.id GROUP BY cl.case_number"; 
             $result = mysqli_query($conn,$query); 
        ?>  
        <div class="col"> 
               <select class="form-control" aria-label="Default select example" id="add_select_client_lists" name="add_select_client_list">
                 <?php   while($row = mysqli_fetch_array($result)):;?>
                 <?php echo 'Case No: ' .$row['case_number']; ?>
                 <option  id="caseId"value="<?php echo $row['id']?>">
                 <?php  echo $row['firstname']?> 
                </option> 
                <?php   endwhile; ?>
                </select> 

                <!-- <select class="form-select select_client_task" aria-label="Default select example" id="add_select_client_lists" name="add_select_client_lists">
                <?php 
                include './db/config.php';
                 $querys = "SELECT * FROM tbl_client_list";
                 $query_run = mysqli_query($conn,$querys);

                 if(mysqli_num_rows($query_run) > 0)
                 { 

                     foreach($query_run as $row){ 
                     ?>
                     <option value="<?= $row['id']; ?>"> <?=$row['firstname'];?> <?=$row['lastname'];?>  </option>
                     <?php 
                     }
                 } 
                ?>
              </select> -->

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL END HERE -->
<div class="row">
 <div class="col">
        <div class="card">
            <div class="card-header" style="border-bottom:5px solid #C6A984">
               <div class="row">
                <div class="col-2 fw-bold mt-1">
                  MANAGE TASK
                </div>
                <div class="col">
                    <button class="btn btn-sm btn-warning" id="toggleButton">Add task</button>
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
                        <table id="taskList" class="table table-hover" style="width:100%;font-size:11px;">
                                  <thead>
                                    <tr>
                                    <th class="text-center" style="width:20px;">#</th>
                                    <th class="text-center " >Case Number</th>
                                    <th class="text-center">Client Name</th>
                                     <th class="text-center" >Laywer</th>
                                    <th class="text-center">Task</th> 
                                    <th class="text-center" >Due Date</th>
                                    <th class="text-center">Remarks</th>
                                    <th class="text-center">Priority</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" >ACTION</th>
                                  </tr>
                                  </thead> 
                              <tbody class="table-warning">
                              <?php
                                require './db/config.php'; 
                                $client_list = "SELECT cases.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                                cases.end_date,task.task_description,task.remarks,task.priority,task.status
                                FROM tbl_case_list as cases
                                INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                                INNER JOIN tbl_task_list as task ON cases.case_number = task.case_number
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
                                    <td class="text-center"><?php echo $row['task_description'];?></td>
                                    <td class="text-center"><?php  if($row['end_date'] == null){ echo "Not set"; }else { echo date('Y-m-d', strtotime($row['end_date']));}  ?></td>
                                    <td class="text-center"><?php echo $row['remarks'];?></td>
                                    <td class="text-center"><?php echo $row['priority'];?></td>
                                    <td class="text-center"><?php echo $row['status'];?></td>
                                    <td>      
                                    <div class="container d-flex justify-content-end ">                                             
                                        <div class="col-md-4 "><button class="btn btn-sm btn-primary" id="view_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/view (1).png"alt=""></button></div>   
                                        <div class="col-md-4"><button class="btn btn-sm btn-danger"id="delete_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div>
                                        <div class="col-md-4"><button class="btn btn-sm btn-success"id="edit_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div> 
                                        <!-- <div class="col-md-3"><button class="btn btn-sm btn-secondary"id="addtask_client_info"  value="<?php echo $row['id']?>" style="font-size:10px;">Add Task</button></div>  -->
                                  
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
  
    <div class="col" id="cardTask">
    <div class="row">
      <div class="card" id="cardTasks" style="height:400px;">
      <div class="row">
      <div class="card-header mt-1" style="border-bottom:5px solid #C6A984">Add Task Information</div>
      </div>
        <div class="card-body">
       <div class="row">
      <div class="col"> 
        Client Information:
      <select class="form-select select_client_task mt-1" aria-label="Default select example" id="add_select_client_lists" name="add_select_client_lists" style="width:100%;">
          <?php 
                include './db/config.php';
                 $querys = "SELECT cases.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                 cases.end_date
                 FROM tbl_case_list as cases
                 INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                 INNER JOIN tbl_client_list AS client WHERE  cases.client_user_id = client.id GROUP BY cases.case_number";
                 $query_run = mysqli_query($conn,$querys);

                 if(mysqli_num_rows($query_run) > 0)
                 { 

                     foreach($query_run as $row){ 
                     ?>
                     <option value="<?= $row['id']; ?>"> <?=$row['case_number'];?> ~ <?=$row['firstname'];?> <?=$row['lastname'];?>   </option>
                     <?php 
                     }
                 } 
             ?>
              </select>
      </div>
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

