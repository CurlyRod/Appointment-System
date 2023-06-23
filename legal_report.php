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
