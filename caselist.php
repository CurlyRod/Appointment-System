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
</script> 
<!-- MODAL START HERE --> 

<!-- MODAL VIEW START HERE -->
<div class="modal fade" id="viewCasetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="staticBackdropLabel">View Client Information</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="viewCaseInfo"></p>
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
                                require './db_connection.php';
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

<script>
$(document).on('click','#view_client_info',function(e){
    e.preventDefault();
      var view_entity_info = $(this).val();
      console.log(view_entity_info);
       $.ajax({
   
           type:'GET',url:'./cases/caselist_action.php?view_id_info='+view_entity_info,
           success:function(response)
           { 
               var result = jQuery.parseJSON(response);
               if(result.status == 404)
               {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1); 
                alertify.success(result.message);
               }else if(result.status == 200)
               { 
                   $('#viewCaseinfo').html("Client Name: <span class='name'>" + result.data.firstname +" "+ result.data.middlename  +" "+  result.data.lastname+ "</span><br>" 
                   +"Case Number: <span class='name'>" + result.data.case_number+"</span><br>"
                   +"Case Type: <span class='name'>" + result.data.case_type+"</span><br>" 
                   +"Case Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>" 
                   +"Case Number: <span class='name'>" + result.data.user_fullname+"</span><br>" 
                   +"Client Type: <span class='name'>" + result.data.client_type+"</span><br>"); 
                   $('#viewCasetModal').modal('show');
               }
           }
   
       });
    });
  //END EDIT CLIENT DATA
</script>
