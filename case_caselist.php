<?php  include './db/config.php';  ?>
<script> 
$(document).ready(function()
{ 
 // Destroy the existing DataTable instance (if it exists)
if ($.fn.DataTable.isDataTable('#caseLists')) {
    $('#caseLists').DataTable().destroy();
}
// Reinitialize the DataTable
$('#caseLists').DataTable({});
});   
$('#edit_select_client_list').selectpicker();
</script> 
 
<!-- MODAL START HERE --> 
 <!--EDIT CASE MODAL-->
 <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Case Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
      <form action="" id="update_client_Forms">
        <div class="row">
                       <?php   
                            include './db/config.php';
                          $query = "SELECT id,firstname,middlename,lastname from tbl_client_list"; 
                          $result = mysqli_query($conn,$query); 
                       ?>   
              <div class="col-12">
             <p id="edit_client_case_number"></p>
              </div>
              <div class="col mb-2"> 
                 <input type="hidden" id="client_user_id_edit"name="client_user_id_edit">
                Client name:
                 <select class="form-select" aria-label="Default select example" id="edit_select_client_list" name="edit_select_client_list">
                 <?php   while($row = mysqli_fetch_array($result)):;?>
                 <option disabled id="caseId"value="<?php echo $row[0]?>"><?php  echo $row[1] ?>
                 <?php  echo $row[2]?>   <?php  echo $row[3]?>
                </option> 
                <?php   endwhile; ?>
                </select>
                </div> 

                <div class="col-12 mb-2"> 
                  Client Type:
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="clientType" id="clientType" value="Petitioner">
                <label class="form-check-label" for="flexRadioDefault1">
                  Petitioner
                </label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="clientType" id="clientType" value="Respondents">
                <label class="form-check-label" for="flexRadioDefault2">
                  Repondents
                </label>
                </div>
                </div> 
                <div class="col mb-2">
                <select class="form-select" aria-label="Default select example"id="case_type_list" name="case_type_list">
                <option selected>Case Type</option>
                <option value="Corporate">Corporate</option>
                <option value="Litigation">Litigation</option>
                <option value="Special Project">Special Project</option>
                </select>
                </div>

                <div class="col-12 mb-2">
                <select class="form-select" aria-label="Default select example" id="case_type_sublist" name="case_type_sublist">
                <option selected>Case Sub type</option>
                <option value="Criminal">Criminal</option>
                <option value="Family">Family</option>
                <option value="Property">Property</option>
                <option value="Labor">Labor</option>
                <option value="Administrative">Administrative</option>
                <option value="Injury">Injury</option>
                <option value="Collection">Collection</option>
                <option value="Special Proceedings">Special Proceedings</option>
                </select>
                </div> 

                <?php   
                    include './db/config.php';
                    $query = "SELECT * from tbl_user_list"; 
                    $result = mysqli_query($conn,$query); 
                  ?> 
            
            <div class="col mb-2">

                 <select class="form-select" aria-label="Default select example" id="select_lawyer_id_update" name="select_lawyer_id_update">
                 <option >Select Lawyer Name</option>
                 <?php   while($row = mysqli_fetch_array($result)):;?>
                <option name="lawyer_id" id="lawyer_id"value="<?php echo $row['id']?>"><?php  echo $row['user_fullname'] ?>
                </option>  
            
             
                <?php   endwhile; ?>
            </select>
          
            </div> 

            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="updateCaseBtn"class="btn btn-warning">Save changes</button>
      </div>

        </div>
     
      </form>
      </div>
    
    </div>
  </div>
</div>
 <!-- EDIT CASE MODAL END -->

<!--  ADD  CASE HERE-->
<div class="modal fade" id="addCaseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title " id="exampleModalLabel">Add Case</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
      <form action="" id="save_case_Form">

      <div class="row mb-3">
        <?php   
                include './db/config.php';
                $query = "SELECT id,firstname,middlename,lastname from tbl_client_list"; 
                $result = mysqli_query($conn,$query); 
       ?> 
         
            <div class="col">
                Client name:
                 <select class="form-select" aria-label="Default select example" id="select_client_list" name="select_client_list">
                 <option >Select Client Name</option>
                 <?php   while($row = mysqli_fetch_array($result)):;?>
                  <option id="caseId"value="<?php echo $row[0]?>"><?php  echo $row[1] ?>
                 <?php  echo $row[2]?>   <?php  echo $row[3]?>
                </option> 
                <?php   endwhile; ?>
            </select>
            </div>

            <div class="col mt-4">
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="clientType" id="flexRadioDefault1" value="Petitioner">
            <label class="form-check-label" for="flexRadioDefault1">
              Petitioner
            </label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="clientType" id="flexRadioDefault2" value="Respondents">
            <label class="form-check-label" for="flexRadioDefault2">
              Repondents
            </label>
            </div>

            </div>
            </div>
              <h6 class="text-center text-primary">CASE DETAILS</h6>
            <div class="row mt-2"> 
              
                <div class="col">
             
                <select class="form-select" aria-label="Default select example"id="case_type_list" name="case_type_list">
                <option selected>Case Type</option>
                <option value="Corporate">Corporate</option>
                <option value="Litigation">Litigation</option>
                <option value="Special Project">Special Project</option>
                </select>
                </div>

                <div class="col">
            
                <select class="form-select" aria-label="Default select example" id="case_type_sublist" name="case_type_sublist">
                <option selected>Case Sub type</option>
                <option value="Criminal">Criminal</option>
                <option value="Family">Family</option>
                <option value="Property">Property</option>
                <option value="Labor">Labor</option>
                <option value="Administrative">Administrative</option>
                <option value="Injury">Injury</option>
                <option value="Collection">Collection</option>
                <option value="Special Proceedings">Special Proceedings</option>
                </select>
                </div>
            </div>


      <div class="modal-footer mt-1">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save_case_btn" class="btn btn-warning">Save changes</button>
      </div>

      </form>
   
   
    </div>
    </div>
  </div>
</div>

<!-- END CASE HERE -->

<!-- MODAL VIEW START HERE -->
<div class="modal fade" id="viewCasetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="staticBackdropLabel">View Client Information</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="viewCaseinformation"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<!-- MODAL VIEW START HERE -->


<!-- MODAL END HERE  -->
<div class="row">
 <div class="col">
        <div class="card">
            <div class="card-header" style="border-bottom:5px solid #C6A984 ">
               <div class="row">
                <div class="col-1 fw-bold mt-1">
                    CASE
                </div>
                <div class="col d-flex justify-content-start">
                    <button class="btn btn-sm btn-dark "data-bs-toggle="modal" data-bs-target="#addCaseModal" style="font-size:14px;background:#ADA06D;">
                        Add
                    </button>
                    
                </div>
               </div>
            </div> 
            <div class="card-body p-1">
            <span class="text-center">
            <img src="./vendor/img/bullet-list.png" alt="Logo" width="30" height="30" >
             CASE LIST
            </span>
                <div class="row mt-2 m-4">
                    <div class="table-responsive">
                        <table id="caseLists" class="table table-hover" style="width:100%;font-size:13px;">
                                  <thead>
                                    <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Case Number</th>
                                    <th class="text-center">Client Name</th>
                                    <th class="text-center">Case Type</th>
                                    <th class="text-center">Case Sub type</th>
                                    <th class="text-center">Lawyer</th>
                                    <th class="text-center">Client Type</th>
                                    <th class="text-center">ACTION</th>
                                     </tr>
                                  </thead> 
                              <tbody class="table-warning">
                              <?php
                                require './db/config.php';
                                $client_list = "SELECT lawyer.user_fullname,cases.id,cases.lawyer_user_id,cases.case_number,cases.case_type,cases.case_sub_type,cases.client_type,client.firstname,client.middlename,client.lastname
                                FROM tbl_case_list as cases 
                                INNER JOIN tbl_client_list as client ON client.id = cases.client_user_id
                                INNER JOIN tbl_user_list as lawyer ON cases.lawyer_user_id = lawyer.id ORDER BY cases.id ASC  ";
                                $query = $conn->query($client_list);
                                $i = 1; 
                                while($row= $query->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++?></td>
                                    <td class="text-center"><b><?php echo $row['case_number'];?></b></td>
                                    <td class="text-center"><?php echo $row['firstname'].' '.$row['middlename'] .' '. $row['lastname']?></td>
                                    <td class="text-center"><?php echo $row['case_type'];?></td>
                                    <td class="text-center"><?php echo $row['case_sub_type'];?></td>
                                    <td class="text-center"><?php if( $row['lawyer_user_id']== 0){
                                         echo  $row['lawyer_user_id'] = 'none';
                                    }else echo $row['user_fullname'];
                                    ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['client_type']?></td> 

                                    <td> 
                   
                                    <div class="d-flex justify-content-end ">
                            
                                    <div class="col"><button class="btn btn-sm btn-primary" id="view_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/view (1).png"alt=""></button></div>   
                                    <div class="col"><button class="btn btn-sm btn-danger"id="delete_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div>
                                    <!-- <div class="col"><button class="btn btn-sm btn-success" id="edit_userbtn"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div>    -->
                                    <div class="col"><button class="btn btn-sm btn-success"id="edit_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div>
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

<script src="./cases/cases_controller.js"></script>
<script>
     $(document).ready(function() {
    $('#cases_btn').addClass('selected');
}); 

// $(document).off('submit', '#update_client_Forms').on('submit', '#update_client_Forms', function(e){
  
//     e.preventDefault();
   
//     var formData = new FormData(this);
//     formData.append("case_list_update",true);
//     $.ajax({ 
//       type:"POST",url:"./php/cases_ajax.php",data:formData,
//       processData:false,contentType:false,
    
//       success:function(response)
//       {
//           var result = jQuery.parseJSON(response); 
//           if(result.status == 500)
//           {
//             alertify.set('notifier','positions','top-right'); 
//             alertify.success(result.message); 
//           }
//           else if(result.status == 200)
//           {
         
//             alertify.set('notifier','positions','top-right'); 
//             alertify.success(result.message); 
          
//             $('#editClientModal').modal('hide');
//            $('#update_client_Forms')[0].reset();
//             //  $('#userList').load(location.href+ " #userList");;
//           //  loadContent('case_caselist'); 
//             } 
       
//          // abortController.abort();
//        $(document).off('submit', '#update_client_Forms');
//       } 
  
  
//     });
//   //  xhr.abort(); 
//   }); 




  
$('#updateCaseBtn').on('click', function(e) {
    e.preventDefault();

    var formData = new FormData($('#update_client_Forms')[0]);
    formData.append("case_list_update", true);
      $.ajax({
        type: "POST",
        url: "./php/caseupdate.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var res = jQuery.parseJSON(response);

            if (res.status == 422) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1); 
                alertify.success(res.message);
            } else if (res.status == 200) {
                alertify.set('notifier', 'delay', 1);
                alertify.set('notifier', 'position', 'top-right'); 
                alertify.success(res.message);

            
                $('#editClientModal').modal('hide');
                $('#update_client_Forms')[0].reset();
                 loadContent('case_caselist'); 
            } 
        }
    });
});


</script> 

