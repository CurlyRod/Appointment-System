<?php  include './db/config.php';  ?>
<script> 
$(document).ready(function()
{ 
 // Destroy the existing DataTable instance (if it exists)
if ($.fn.DataTable.isDataTable('#clientList')) {
    $('#clientList').DataTable().destroy();
}
// Reinitialize the DataTable
$('#clientList').DataTable({});
});
</script>  
<script>
     $(document).ready(function() {
    $('#client_btn').addClass('selected');
});
</script>   

<!-- MODAL HERE START HERE  --> 
<!--  ADD CLIENT MODAL -->

<div class="modal fade" id="addIndividual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Add Individual </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" id="saveClientForm">
                <div class="row mb-2 ">
                  <div class="col">
                  <label class="form-label">Lastname:</label>
                 <input type="text" class="form-control" name="lastName"  placeholder="LastName">
                   </div>

                  <div class="col">
                  <label class="form-label">FirstName:</label>
                 <input type="text" class="form-control" name="firstName" placeholder="Firstname">
                   </div>

                  <div class="col">
                  <label class="form-label">Middlename:</label>
                 <input type="text" class="form-control" name="middleName" placeholder="MiddleName">
                   </div>
                </div>

                <div class="row">
                    <div class="col">
                    <label class="form-label">Gender:</label>
                    <select class="form-select form-select-md mb-2" aria-label=".form-select-lg example"name="gender">
                    <option value="0">SELECT</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
                  </div>

                  <div class="col">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                 <input type="email" class="form-control" id="exampleInputEmail1"name="emailOne" aria-describedby="emailHelp">
                  </div>

                  <div class="col">
                  <label for="exampleInputEmail1" class="form-label">Alternate Email</label>
                 <input type="email" class="form-control" id="exampleInputEmail1"name ="emailTwo" aria-describedby="emailHelp">
                  </div>
                </div>

                <div class="row mb-2">
                        <div class="col">
                    <label class="form-label">Contact No:</label>
                    <input type="text" name="contactOne" class="form-control" id="contact" placeholder="Contact no">

                    </div>

                    <div class="col">
                    <label class="form-label">Alternate No:</label>
                    <input type="text" name="contactTwo" class="form-control" id="altername" placeholder="Altername no">
                    </div>
                </div>


                <div class="row">
                        <div class="col">
                    <label class="form-label">Address 1:</label>
                    <input type="text" name="address_one" class="form-control" placeholder="Address 1">

                    </div>

                    <div class="col">
                    <label class="form-label">Address 2:</label>
                    <input type="text" name="address_two"  class="form-control"  placeholder="Address 2">
                    </div>
                </div>

                         <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-warning">Save changes</button> -->
                    <button type="submit" id="saveClientBtn"class="btn btn-warning">Save changes</button>
                </div>

            </form>
      </div>

    </div>
  </div>
</div> 
<!-- ADD MODAL CLIENT -->

<!-- VIEW CLIENT MODAL -->
<div class="modal fade" id="viewClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="staticBackdropLabel">View Client Information</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="viewlastname"></p>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- VIEW CLIENT END --> 


<!-- EDIT CLIENT INFORMATION HERE -->
<div class="modal fade" id="editindividual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Edit Information </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" id="updateClientForm"> 
            <div class="row mb-2 ">
                          
                 <div id ="errorMessage"class="alert alert-warning d-none"></div> 
                  <div class="col"> 
                  <input type="hidden" name="client_id_input" id="client_id_input">  

                   <label class="form-label">Lastname:</label>
                 <input type="text" class="form-control" id="editlastName" name="editlastName"  placeholder="LastName">
                   </div>

                  <div class="col">
                  <label class="form-label">FirstName:</label>
                 <input type="text" class="form-control" name="editfirstName" id="editfirstName" placeholder="Firstname">
                   </div>

                  <div class="col">
                  <label class="form-label">Middlename:</label>
                 <input type="text" class="form-control" id="editmiddleName" name="editmiddleName" placeholder="MiddleName">
                   </div>
                </div>

                <div class="row">
                    <div class="col">
                    <label class="form-label">Gender:</label>
                    <select class="form-select form-select-md mb-2" aria-label=".form-select-lg example" name="editGender" id="editGender">
                   
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
                  </div>

                  <div class="col">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                 <input type="email" class="form-control"  id="editemailOne"  name="editemailOne" >
                  </div>

                  <div class="col">
                  <label for="exampleInputEmail1" class="form-label">Alternate Email</label>
                 <input type="email" class="form-control" id="editemailTwo" name ="editemailTwo" aria-describedby="emailHelp">
                  </div>
                </div>

                <div class="row mb-2">
                        <div class="col">
                    <label class="form-label">Contact No:</label>
                    <input type="text" name="editcontactOne" class="form-control" id="editcontactOne" placeholder="Contact no">

                    </div>

                    <div class="col">
                    <label class="form-label">Alternate No:</label>
                    <input type="text" name="editcontactTwo" class="form-control" id="editcontactTwo" placeholder="Altername no">
                    </div>
                </div>


                <div class="row">
                        <div class="col">
                    <label class="form-label">Address 1:</label>
                    <input type="text" id="editaddress_one" name="editaddress_one" class="form-control" placeholder="Address 1">

                    </div>

                    <div class="col">
                    <label class="form-label">Address 2:</label>
                    <input type="text" id="editaddress_two" name="editaddress_two"  class="form-control"  placeholder="Address 2">
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-warning">Save changes</button> -->
                    <button type="submit" class="btn btn-warning">Save changes</button>
                </div>
                 
                
                  </div>
            </form>
      </div>

    </div>
  </div>
</div> 
<!-- EDIT CLIENT END HERE -->
<!-- MODAL END HERE -->

<div class="row " >
  <div class="col">
       <div class="card "style="width:100%;">
            <div class="card-header bg-transparent fw-bold"style="border-bottom:5px solid #C6A984;">
                <div class="row">
                    <div class="col-1 mt-1">
                        CLIENT
                    </div>

                    <div class="col d-flex justify-content-start">
                    <div class="dropdown">
                    <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"style="font-size:14px;background:#ADA06D;">
                      ADD
                    </button> 
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addIndividual">Individual</a></li>
                    <!-- <li><a class="dropdown-item"  data-toggle="modal" data-target="#exampleModal">Legal Entity</a></li> -->
                        
                    </ul>
                    </div>
                    </div>
                  
                   
                  </div>
            </div>

            <div class="card-body p-1">    
            <span class="text-center">
            <img src="./vendor/img/bullet-list.png" alt="Logo" width="30" height="30" >
              INDIVIDUAL CLIENT LIST
            </span>
            <div class="row mt-2 m-4">
                <div class="table-responsive " style="overflow:auto;">
                <table id="clientList" class="table table-hover  "style="width:100%;font-size:11px; ">
        <thead >
            <tr > 
                <th class="text-center" >#</th>
                <th class="text-center"style="width:80px;">Client No.</th>
                <th class="text-center">LastName</th>
                <th class="text-center">FirstName</th>
                <th class="text-center">MiddleName</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Email 1</th>
                <th class="text-center">Email 2</th>
                <th class="text-center" >Contact 1</th>
                <th class="text-center">Contact 2</th>
                <th class="text-center">Address 1</th>
                <th class="text-center">Address 2</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>

        <tbody class="table-warning">

                <?php
                  require './db/config.php';
                  $client_list = "SELECT *  FROM tbl_client_list ORDER BY firstname ASC";
                  $query = $conn->query($client_list);
                  $i = 1; 
                  while($row= $query->fetch_assoc()):
                 ?>
               <tr>

               
                <td   class="text-center">
                 <b><?php echo $i++ ?></b>
                </td>  
                <td  class="text-center" ><b><?php echo $row['client_id'] ?></b></td>
                  <td  class="text-center" >
                  <?php echo $row['lastname'] ?>
                 </td>


                 <td  class="text-center" ><?php echo $row['firstname'] ?></td>
                 <td  class="text-center" ><?php echo $row['middlename'] ?></td>
                 <td  class="text-center" ><?php if($row['gender'] == 0){
                  echo 'Not Assigned';
                 }else{  echo $row['gender']; }?>
                 
               </td>
                 <td  class="text-center" ><?php echo $row['first_email'] ?></td>
                 <td  class="text-center" ><?php echo $row['second_email'] ?></td>
                 <td  class="text-center" ><?php echo $row['first_contact'] ?></td>
                 <td  class="text-center" ><?php echo $row['second_contact'] ?></td> 
                 <td  class="text-center" ><?php echo $row['first_address'] ?></td> 
                 <td  class="text-center" ><?php echo $row['second_address'] ?></td>                   
                   
               
                  <td> 
                   
                    <div class="d-flex justify-content-end ">
             
                    <div class="col"><button class="btn btn-sm btn-primary" id="view_client_individual"  value=<?php echo $row['id']?>'><img src="./src/img/view (1).png"alt=""></button></div>   
                    <div class="col"><button class="btn btn-sm btn-danger"id="delete_client_individual"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div>
                    <div class="col"><button class="btn btn-sm btn-success"id="edit_client_information"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div>
                    </div>
                  </td>
               
                 <?php endwhile; ?>
                 </tr>
        </tbody>
    </table>
  
                </div>
            </div>
            </div>
        </div>
       </div>
       </div> 
   <!-- SCRIPT HERE  -->
<script src="./client/client_controller.js"></script>

       