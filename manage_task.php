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

<div class="modal fade" id="viewTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="staticBackdropLabel">View Client Information</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="viewTaskinformation"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<!-- MODAL VIEW START HERE -->
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
                    <button class="btn btn-sm btn-warning" id="toggleButton">Hide Form</button>
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
                                $client_list = "SELECT task.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                                task.task_description,task.remarks,task.priority,task.status,task.end_date
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
                                    <td class="text-center"><?php
                                    if($row['priority'] == 'High'){
                                     ?><button class="btn-sm btn-danger" style="font-size:10px;"> <?php echo $row['priority']?></button><?php
                                    }else if($row['priority'] == 'Medium')
                                    {
                                      ?><button class="btn-sm btn-info" style="font-size:10px;"> <?php echo $row['priority']?></button><?php
                                    }
                                    ?></td>
                                    <td class="text-center"><?php echo $row['status'];?></td>
                                    <td>      
                                    <div class="container d-flex justify-content-end ">                                             
                                        <div class="col-md-4 "><button class="btn btn-sm btn-primary" id="view_task_info"  value="<?php echo $row['id']?>"><img src="./src/img/view (1).png"alt=""></button></div>   
                                        <div class="col-md-4"><button class="btn btn-sm btn-danger"id="delete_tasks_info"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div>
                                        <div class="col-md-4"><button class="btn btn-sm btn-success"id="edit_clien"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div> 
                                        <!-- <div class="col-md-3"><button class="btn btn-sm btn-secondary"id="addtask_client_info"  value="<?php echo $row['id']?>" style="font-size:10px;">Add Task</button></div>  -->
                                        <!-- <div class="col-md-4"><button class="btn btn-sm btn-success"id="edit_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div>  -->
                                      
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
  
    <div class="col" id="cardTask" style="background:#F5F5F5;">
        <div class="card " style="height:470px;";>
          <div class="card-header fw-bold mt-1" style="border-bottom:5px solid #C6A984;">Task Information</div>
             <div class="card-body">

                  <form action=""id="add_casetask_Form">
                  <select class="form-select select_client_task mt-3" aria-label="Default select example" id="add_select_task" name="add_select_task" style="width:100%;">
          <option disabled selected value="">Case Information</option>
       <?php 
                include './db/config.php';
                 $querys = "SELECT cases.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
                 cases.end_date
                 FROM tbl_case_list as cases
                 INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
                 INNER JOIN tbl_client_list AS client WHERE  cases.client_user_id = client.id GROUP BY cases.case_number";     
                 $query_runs = mysqli_query($conn,$querys);
             if(mysqli_num_rows($query_run) > 0)
                { 

                    foreach($query_runs as $row){ 
                    ?>
                    <option value="<?= $row['case_number']; ?>"> <?= $row['case_number'];?> ~ [<?= $row['user_fullname'];?>] </option>
                    <?php 
                    }
                } 
                ?>
              </select>
                <div class="col mt-1 p-3">
                  <div class="row">
                    <div class="col">
                      Start Date: 
                      <input type="date" id="start_date" name="start_date" class="form-control"> 
                    </div>
                    <div class="col">
                       End Date: 
                      <input type="date" id="end_date" name="end_date"  class="form-control">
                    </div>
                  </div>
                </div>
               
                <div class="col p-3">

                <div class="form-floating mb-3">
                <input type="email" class="form-control" id="add_task_description"name="add_task_description">
                <label for="add_task_description">Task Description</label>
               </div>
               <div class="form-floating mb-3">
                <input type="email" class="form-control" id="add_task_remarks"name="add_task_remarks">
                <label for="add_task_remarks">Remarks</label>
               </div>
                    <select class="form-select mb-4" aria-label="Default select example"id="priority_select" name="priority_select">
                    <option disabled selected>Status</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                      </select> 
              </form>
             <div class="col">
          
                <div class="col text-end">
                <button type="button" id="addTaskBtns" class="btn btn-warning">Save changes</button>
                </div>
              
                
             </div>
                </div>
               

             </div>
        </div>
    </div>
</div> 
<script src="./task/task_controller.js"></script>
<script>
     $(document).ready(function() {
    $('#manage_task').addClass('selected'); 
});

//deleting the task list
$(document).on('click','#delete_tasks_info',function(e){
    e.preventDefault();
    var task_id = $(this).val(); 

    Swal.fire({
        title: 'Are you sure to delete this user?',
        icon: 'warning', 
        width:'500px' ,  
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      
      
     }).then((result) => {
        if (result['isConfirmed']){
   
            $.ajax({
                type:"POST", 
                url:"./php/managetask._ajax.php",
                data:{'delete_task':true,'delete_task':task_id},
   
                success: function(response)
                {
                    var result = jQuery.parseJSON(response); 
                    if(result.status == 500)
                    {
                      alertify.set('notifier', 'position', 'top-right');
                      alertify.set('notifier', 'delay', 1);
                      alertify.success(result.message);
                    }else if(result.status ==200)
                    {  
                      alertify.set('notifier', 'position', 'top-right');
                      alertify.set('notifier', 'delay', 1);
                      alertify.success(result.message);

                        loadContent('manage_task');
                    }
                   
                }
            });
        }
   });
  
});
</script>

