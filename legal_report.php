<?php
    include './db/config.php'
?>
<script>
    $(document).ready(function()
{ 
 // Destroy the existing DataTable instance (if it exists)
if ($.fn.DataTable.isDataTable('#entityList')) {
    $('#entityList').DataTable().destroy();
}
// Reinitialize the DataTable
$('#entityList').DataTable({});
}); 

</script> 
<!-- MODAL START HERE --> 
<!-- EDIT ENTITY HERE -->
<!-- EDIT LEGAL ENTITY --> 
<div class="modal fade" id="editentityUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title ">Edit Legal Entity </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
      <form action="" id="update_entity_Forms">
            <div class="row">
            <div class="col">
            <input type="hidden" id="legal_client_id_edit"name="legal_client_id_edit">
                <label for="company_name" class="form-label">Company Name</label>    
                <input type="text" id="company_name_edit" name="company_name_edit" class="form-control">
            </div>
            <div class="col">
            <label for="company_address" class="form-label">Company address</label>    
                <input type="text" id="company_address_edit" name="company_address_edit" class="form-control">
            </div>
            </div> 
            <div class="row">
                <h6 class="mt-3">REPRENSENTATTIVE</h6>
                <div class="col">
                <label for="legal_firstname" class="form-label">Firstname:</label>    
                <input type="text" id="legal_firstname_edit" name="legal_firstname_edit"  class="form-control">
                </div>
                <div class="col">
                <label for="legal_middlename" class="form-label">Middle Name:</label>    
                <input type="text" id="legal_middlename_edit"  name="legal_middlename_edit"class="form-control">
                </div>
                <div class="col">
                <label for="legal_lastname" class="form-label">LastName:</label>    
                <input type="text" id="legal_lastname_edit" name="legal_lastname_edit" class="form-control">
                </div>
            </div>
            <div class="row">
               <div class="col">
                <label for="legal_email_one" class="form-label">Email address</label>    
                <input type="email" id="legal_email_one_edit" name="legal_email_one_edit" class="form-control">
               </div>
               <div class="col">
                <label for="legal_email_two" class="form-label">Email address</label>    
                <input type="email" id="legal_email_two_edit" name="legal_email_two_edit" class="form-control">
               </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="legal_contact_one" class="form-label">Contact</label>    
                <input type="text" id="legal_contact_one_edit" name="legal_contact_one_edit"  class="form-control">
                </div>
                <div class="col">
                <label for="legal_email_two" class="form-label">Contact</label>    
                <input type="text" id="legal_contact_two_edit"  name="legal_contact_two_edit" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="updateEntityBtn"class="btn btn-warning">Save changes</button>
      </div>
            </div>
       
           
      </form>

      </div>
    </div>
  </div>
</div>


<!-- END ENTITY HERE -->
<!-- ADD LEGAL ENTITY -->
<div class="modal fade" id="addEntityUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title ">Add Legal Entity </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
      <form action="" id="save_client_Form">
        <div class="row">
            <div class="col">
                <label for="company_name" class="form-label">Company Name</label>    
                <input type="text" id="company_name" name="company_name" class="form-control">
            </div>
            <div class="col">
            <label for="company_address" class="form-label">Company address</label>    
                <input type="text" id="company_address" name="company_address" class="form-control">
            </div>
            </div> 
            <div class="row">
                <h6 class="mt-3">REPRENSENTATTIVE</h6>
                <div class="col">
                <label for="legal_firstname" class="form-label">Firstname:</label>    
                <input type="text" id="legal_firstname" name="legal_firstname"  class="form-control">
                </div>
                <div class="col">
                <label for="legal_middlename" class="form-label">Middle Name:</label>    
                <input type="text" id="legal_middlename"  name="legal_middlename"class="form-control">
                </div>
                <div class="col">
                <label for="legal_lastname" class="form-label">LastName:</label>    
                <input type="text" id="legal_lastname" name="legal_lastname" class="form-control">
                </div>
            </div>
            <div class="row">
               <div class="col">
                <label for="legal_email_one" class="form-label">Email address</label>    
                <input type="email" id="legal_email_one" name="legal_email_one" class="form-control">
               </div>
               <div class="col">
                <label for="legal_email_two" class="form-label">Email address</label>    
                <input type="email" id="legal_email_two" name="legal_email_two" class="form-control">
               </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="legal_contact_one" class="form-label">Contact</label>    
                <input type="text" id="legal_contact_one" name="legal_contact_one"  class="form-control">
                </div>
                <div class="col">
                <label for="legal_email_two" class="form-label">Contact</label>    
                <input type="email" id="legal_contact_two"  name="legal_contact_two" class="form-control">
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="save_legal_client"class="btn btn-warning">Save changes</button>
      </div>
      </form>

      </div>
    </div>
  </div>
</div>
<!-- END LEGAL ENTITY -->
<!-- VIEW INFORMATION LEGAL ENTITY -->

<div class="modal fade" id="viewEntityUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title " id="exampleModalLabel">View Information </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p id="view_entity_information"></p>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
       
      </div>
     
    </div>
    </div>
  </div>
</div>
<!-- END VIEW INFORMATION LEGAL ENTITY -->

<!-- MODAL END HERE -->
<div class="row">
    <div class="col" style="width:100%;">
        <div class="card">
            <div class="card-header" style="border-bottom:5px solid #C6A984;">
            <div class="col fw-bold"> 
                REPORT LIST
              <button class="btn btn-info">Download</button>
              </div>
            </div>
            <div class="card-body P-1">
            <span class="text-center">
            <img src="./vendor/img/bullet-list.png" alt="Logo" width="30" height="30" >
            LEGAL ENTITY REPORT
            </span> 
            <div class="row mt-2 m-4">
                <div class="table-responsive">
                    <table id="entityList" class="table table-hover" style="width:100%;font-size:13px;">
                           
                          <thead>
                          <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Case No</th>
                                    <th class="text-center">Company Name</th>
                                    <th class="text-center">Company Address</th>
                                    <th class="text-center">Representative</th>
                                    <th class="text-center">Email 1</th>
                                    <th class="text-center">Email 2</th>
                                    <th class="text-center">Contact 1</th>
                                    <th class="text-center">Contact 2</th>
                                    <th class="text-center">ACTION</th>
                            </tr>
                          </thead> 

                        
                  <tbody class="table-warning">

                    <?php   
                         require './db/config.php';
                         $client_list = "SELECT *  FROM tbl_entity_list ORDER BY company_name ASC";
                         $query = $conn->query($client_list);
                         $i = 1; 
                         while($row= $query->fetch_assoc()):
                        ?>

                    <tr>
                            <?php  $names =  $row["firstname"].' '.$row['middlename'].' '.$row["lastname"]; ?>
                            <td class="text-center"><?php echo  $i++;?></td>
                            <td class="text-center"><b><?php echo $row['case_id'];?></b></td>
                            <td class="text-center"><?php echo $row['company_name'];?></td>
                            <td class="text-center"><?php echo $row['company_address'];?></td>
                            <td class="text-center"><?php echo $names?></td>
                            <td class="text-center"><?php echo $row['first_email'];?></td>
                            <td class="text-center"><?php echo $row['second_email'];?></td>
                            <td class="text-center"><?php echo $row['first_contact'];?></td>
                            <td class="text-center"><?php echo $row['second_contact'];?></td>
                          
                            <td>
                                
                               <div class="d-flex justify-content-end ">
             
                                <div class="col text-center"><button class="btn btn-sm btn-info" value=<?php echo $row['id']?>'><img src="./src/img/download-to-storage-drive.png"alt=""></button></div>   
                                </div>
                              

                            </td>
                            <?php  endwhile;?>
                   </tr>
              
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
    $('#report_btn').addClass('selected');
}); 
</script>
