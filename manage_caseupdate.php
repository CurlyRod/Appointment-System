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
$(document).ready(function()
{ 
 // Destroy the existing DataTable instance (if it exists)
if ($.fn.DataTable.isDataTable('#taskList')) {
    $('#taskLists').DataTable().destroy();
}
// Reinitialize the DataTable
$('#taskLists').DataTable({});
});
</script>  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="sample_ids"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="Reassign_lawyer_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Assign Lawyer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" id="Reassign_lawyer_Forms"> 
            <div class="col"> 
                <input type="hidden"name="client_user_id_update" id="client_user_id_update">
                <p id="view_case_information"></p>
            </div>
            <div class="row mb-3">
            <?php   
                    include './db/config.php';
                    $query = "SELECT * from tbl_user_list"; 
                    $result = mysqli_query($conn,$query); 
        ?> 
            
            <div class="col">
          
                 <select class="form-select" aria-label="Default select example" id="reassign_lawyer_id" name="reassign_lawyer_id">
                 <option disabled selected>Select Lawyer Name</option>
                 <?php   while($row = mysqli_fetch_array($result)):;?>
                <option name="lawyer_id" id="lawyer_id"value="<?php echo $row['id']?>"><?php  echo $row['user_fullname'] ?>
                </option>  
            
             
                <?php   endwhile; ?>
            </select>
          
            </div> 
           
            </div>
          
            <div class="row">
            <div class="input-group">
            <span class="input-group-text">Remarks</span>
            <textarea class="form-control" name="lawyer_remarks" id="lawyer_remarks" aria-label="With textarea"></textarea>
            </div>
    
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Save changes</button>
            </div> 
       
        </div>

            </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
 <div class="col">
        <div class="card">
            <div class="card-header" style="border-bottom:5px solid #C6A984 ">
               <div class="row">
                <div class="col-2 fw-bold mt-1">
                CASE UPDATE
                </div>
                <div class="col">
                    <button class="btn btn-sm btn-primary">TEAM MEMBER</button>
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
                        <table id="taskList" class="table table-hover" style="width:100%;font-size:12px;">
                                  <thead>
                                    <tr>
                                    <th class="text-center" style="width:20px;">#</th>
                                    <th class="text-center " >Case Number</th>
                                    <th class="text-center">Client Name</th>
                                    <th class="text-center" >Laywer</th>
                                    <th class="text-center">Case type</th>
                                    <th class="text-center">Case Sub type</th>

                                    <!-- <th class="text-center">Remarks</th> -->
                                    <th class="text-center" >ACTION</th>
                                  </tr>
                                  </thead> 
                              <tbody class="table-warning">
                              <?php
                                require './db/config.php';  

                                $client_list = "SELECT user.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
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
                            
                                    <td class="text-center"><?php echo $row['case_type'];?></td>
                                    <td class="text-center"><?php echo $row['case_sub_type'];?></td>
                                    <!-- <td class="text-center"><?php echo $row['remarks'];?></td> -->
                                    <td>      
                                    <div class="container d-flex justify-content-end ">                                             
                                        <div class="col-md-4 "><button class="btn btn-sm btn-primary" id="view_task_info"  value="<?php echo $row['id']?>" style="font-size:10px;">View Task</button></div>   
                                        <!-- <div class="col-md-3"><button class="btn btn-sm btn-danger"id="delete_client_info"  value="<?php echo $row['id']?>"><img src="./src/img/trash-can.png" alt=""></button></div> -->
                                        <div class="col-md-4"><button class="btn btn-sm btn-success"id="reassign_client_info"  value="<?php echo $row['id']?>" style="font-size:10px;">Re-Assign</button></div> 
                                        <div class="col-md-4"><button class="btn btn-sm btn-warning"id="addtask_client_info"  value="<?php echo $row['id']?>" style="font-size:10px;">Add Task</button></div> 
                                  
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

 $(document).on('click','#reassign_client_info',function(){ 

var user_id = $(this).val();
console.log(user_id);

$.ajax({
    type:'GET', 
    url:"./php/cases_ajax.php?view_case_info="+user_id,
    success:function(response){ 
        var result = jQuery.parseJSON(response);
        if(result.status == 404)
        {
             alertify.set('notifier', 'position', 'top-right');
              alertify.set('notifier', 'delay', 1);
               alertify.success(result.message);  
        }else if(result.status == 200){ 
            // $('#viewlastname').text("Name: "+  result.data.firstname+ " "+ result.data.middlename+ " "+  result.data.lastname);
            $('#view_case_information').html("Name: <span class='name'>" + result.data.firstname + " "+ result.data.middlename +" "+ result.data.lastname
                +"</span><br>"
                +"Casetype: <span class='name'>" + result.data.case_type +"</span><br>"
                +"Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>"
                +"Case number: <span class='name'>" + result.data.case_number+"</span><br>"
                ) 
                $("#client_user_id_update").val(result.data.id);

            $('#Reassign_lawyer_Modal').modal('show');  
           
        } 

    }


});

});
}); 



$(document).on('submit',"#Reassign_lawyer_Forms",function(e){
    e.preventDefault();
   
    var formData = new FormData(this);
    formData.append("reassign_lawyer_update",true);
    $.ajax({ 
      type:"POST",url:"./php/caseupdate_ajax.php",data:formData,
      processData:false,contentType:false,
    
      success:function(response)
      {
          var result = jQuery.parseJSON(response); 
          if(result.status == 500)
          {
            alertify.set('notifier','positions','top-right'); 
            alertify.success(result.message); 
          }
          else if(result.status == 200)
          {
         
            alertify.set('notifier','positions','top-right'); 
            alertify.success(result.message); 
          
            $('#Reassign_lawyer_Modal').modal('hide');
           $('#Reassign_lawyer_Forms')[0].reset();
            //  $('#userList').load(location.href+ " #userList");;
            loadContent('manage_caseupdate'); 
            } 
       
         // abortController.abort();
       $(document).off('submit', '#Reassign_lawyer_Forms');
      } 
  
  
    });
  //  xhr.abort(); 
  }); 


  // $(document).on('click','#view_task_info',function(e){
  //   e.preventDefault();
  //     var view_entity_info = $(this).val(); 
  //      $.ajax({
  //          type:'GET',url:'./php/cases_ajax.php?view_case_info='+view_entity_info,
  //          success:function(response)
  //          { 
  //              var result = jQuery.parseJSON(response);
  //              if(result.status == 404)
  //              {
  //               alertify.set('notifier', 'delay', 1); 
  //               alertify.set('notifier', 'position', 'top-right');  
  //               alertify.success(result.message);
  //              }else if(result.status == 200)
  //              { 
  //                  $('#sample_ids').html("Case Number: <span class='name fw-bold'>" + result.data.case_number+"</span><br>"+"Client Name: <span class='name'>" + result.data.firstname +" "+ result.data.middlename  +" "+  result.data.lastname+ "</span><br>" 
  //                  +"Case Type: <span class='name'>" + result.data.case_type+"</span><br>" 
  //                  +"Case Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>" 
  //                  +"Case Number: <span class='name'>" + result.data.user_fullname+"</span><br>" 
  //                  +"Client Type: <span class='name'>" + result.data.client_type+"</span><br>"); 
                 
  //                  $('#exampleModal').modal('show'); 
  //                  console.log(result.data.case_number);
  //              }
  //          }
   
  //      });
  //   }); 

//   $(document).on('click', '#view_task_info', function(e) {
//     e.preventDefault();
//     var view_entity_info = $(this).val();
//     $.ajax({
//         type: 'GET',
//         url: './php/cases_ajax.php',
//         data: {
//             view_case_info: view_entity_info
//         },
//         dataType: 'json',
//         success: function(response) {
//             console.log(response); // Debugging: Log the response object
//             if (response.status == 404) {
//                 alertify.set('notifier', 'delay', 1);
//                 alertify.set('notifier', 'position', 'top-right');
//                 alertify.success(response.message);
//             } else if (response.status == 200) {
//                 var data = response.data;
//                 var tableBody = $('#modal-table-body');
//                 tableBody.empty();
//                 $.each(data, function(index, item) {
//                     console.log(item); // Debugging: Log the item object
//                     var row = $('<tr>');
//                     $('<td>').text(item.case_number || '').appendTo(row);
//                     $('<td>').text(item.firstname + ' ' + item.middlename + ' ' + item.lastname || '').appendTo(row);
//                     $('<td>').text(item.case_type || '').appendTo(row);
//                     $('<td>').text(item.case_sub_type || '').appendTo(row);
//                     $('<td>').text(item.user_fullname || '').appendTo(row);
//                     $('<td>').text(item.client_type || '').appendTo(row);
//                     tableBody.append(row);
//                 });
//                 $('#exampleModal').modal('show');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// });
// $(document).on('click', '#view_task_info', function(e) {
//     e.preventDefault();
//     var view_entity_info = $(this).val();
//     $.ajax({
//         type: 'GET',
//         url: './php/cases_ajax.php',
//         data: {
//             view_case_info: view_entity_info
//         },
//         dataType: 'json',
//         complete: function(response) {
//             console.log(response); // Debugging: Log the response object
//             if (response.status == 404) {
//                 alertify.set('notifier', 'delay', 1);
//                 alertify.set('notifier', 'position', 'top-right');
//                 alertify.success(response.responseJSON.message);
//             } else if (response.status == 200) {
//                 var data = response.responseJSON.data;
//                 var tableBody = $('#modal-table-body');
//                 tableBody.empty();
//                 $.each(data, function(index, item) {
//                     console.log("sample"+item); // Debugging: Log the item object
//                     var row = $('<tr>');
//                     $('<td>').text(item.case_number || '').appendTo(row);
//                     $('<td>').text(item.firstname + ' ' + item.middlename + ' ' + item.lastname || '').appendTo(row);
//                     $('<td>').text(item.case_type || '').appendTo(row);
//                     $('<td>').text(item.case_sub_type || '').appendTo(row);
//                     $('<td>').text(item.user_fullname || '').appendTo(row);
//                     $('<td>').text(item.client_type || '').appendTo(row);
//                     tableBody.append(row);
//                 });
//                 $('#exampleModal').modal('show');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// });

 $(document).on('click','#view_task_info',function(e){
    e.preventDefault();
      var view_entity_info = $(this).val();  
      console.log(view_entity_info);
       $.ajax({
           type:'GET',url:'./php/sampleview.php?view_cases_info='+view_entity_info,
           success:function(response)
           { 
               var result = jQuery.parseJSON(response);
               if(result.status == 404)
               {
                alertify.set('notifier', 'delay', 1); 
                alertify.set('notifier', 'position', 'top-right');  
                alertify.success(result.message);
               }else if(result.status == 200)
               { 
                   $('#sample_ids').html("Case Number: <span class='name fw-bold'>" + result.data.case_number+"</span><br>"+"Client Name: <span class='name'>" + result.data.firstname +" "+ result.data.middlename  +" "+  result.data.lastname+ "</span><br>" 
                  //  +"Case Type: <span class='name'>" + result.data.case_type+"</span><br>" 
                  //  +"Case Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>" 
                  //  +"Case Number: <span class='name'>" + result.data.user_fullname+"</span><br>" 
                  //  +"Client Type: <span class='name'>" + result.data.client_type+"</span><br>" 
                  ); 
                 
                   $('#exampleModal').modal('show'); 
                  
               }
           }
   
       });
    
  });


</script>