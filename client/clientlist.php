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
                  require './db_connection.php';
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
             
                    <div class="col"><button class="btn btn-sm btn-primary" id="view_user"  value=<?php echo $row['id']?>'><img src="./src/img/view (1).png"alt=""></button></div>   
                    <div class="col"><button class="btn btn-sm btn-danger"id="delete_user"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div>
                    <!-- <div class="col"><button class="btn btn-sm btn-success" id="edit_userbtn"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div>    -->
                    <div class="col"><button class="btn btn-sm btn-success"id="edit_userbtn"  value="<?php echo $row['id']?>"><img src="./src/img/pen.png" alt=""></button></div>
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

       