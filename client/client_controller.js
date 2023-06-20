
//SAVE THE CLIENT INFORMATION 
// Declare a flag variable outside the click event handler


$('#saveClientBtn').on('click', function(e) {
    e.preventDefault();

    var formData = new FormData($('#saveClientForm')[0]);
    formData.append("save_client", true);
    

    $.ajax({
        type: "POST",
        url: "./php/client_ajax.php",
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

            
                $('#addIndividual').modal('hide');
                $('#saveClientForm')[0].reset();

                loadContent('individual_clientlist');
            } else if(res.status == 423)
            {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1);
                alertify.success(res.message);
            }
        }
    });
});

//VIEW THE CLIENT INFORMATION

$(document).on('click','#view_client_individual',function(){ 
    var user_id = $(this).val();
    $.ajax({
        type:'GET', 
        url:"./php/client_ajax.php?view_client="+user_id,
        success:function(response){ 
            var result = jQuery.parseJSON(response);
            if(result.status == 404)
            {
                Swal.Fire(result.message);

            }else if(result.status == 200){ 
                // $('#viewlastname').text("Name: "+  result.data.firstname+ " "+ result.data.middlename+ " "+  result.data.lastname);
                $('#viewlastname').html("Name: <span class='name'>" + result.data.firstname + " "+ result.data.middlename+" "+ result.data.lastname+
                "</span><br>" +"Gender: <span class='name'>" + result.data.gender + "</span><br>"+
                "Email: <span class='name'>" + result.data.first_email + 
                "</span><br>"+"Alternate Email: <span class='name'>" + result.data.second_email + "</span><br>"
                +"</span>"+"Contact: <span class='name'>" + result.data.first_contact + "</span><br>"+
                "</span>"+"Contact: <span class='name'>" + result.data.second_contact + "</span><br>" 
                +"</span>"+"Address: <span class='name'>" + result.data.first_address + "</span><br>"
                +"</span>"+"Address: <span class='name'>" + result.data.second_address + "</span><br>");

                $('#viewClientModal').modal('show');  
               
            } 

        }


    });
    
});    


// DELETING THE CLIENT INFORMATION

$(document).on('click','#delete_client_individual',function(e){
    e.preventDefault();
    var btnValue = $(this).val();
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
             url:"./php/client_ajax.php",
             data:{'delete_client': true,'client_id':btnValue},

             success: function(response)
             {
                 var result = jQuery.parseJSON(response); 
                 if(result.status == 500)
                 {
                     Swal.fire(result.message);
                 }else
                 {
                     alertify.set('notifier','positions','top-right'); 
                     alertify.success(result.message); 
                     loadContent('individual_clientlist');
                 }
             }
         });
     }
});
}); 


//EDIT CLIENT INFORMATION
$(document).on('click','#edit_client_information',function(){ 
    var user_id = $(this).val();
     $.ajax({
           type:"GET",url:"./php/client_ajax.php?client_id="+user_id,
           success: function(response)
           {
              var result = jQuery.parseJSON(response); 
               if(result.status == 500)
               {
                 alertify.set('notifier', 'delay', 1);
                 alertify.set('notifier', 'position', 'top-right');
                  alertify.success(result.message);
               }
               
               else if(result.status == 200)
               {
                   $("#client_id_input").val(result.data.id);  
                   $("#editfirstName").val(result.data.firstname);    
                   $("#editmiddleName").val(result.data.middlename);    
                   $("#editlastName").val(result.data.lastname);               
                   $("#editGender").val(result.data.gender);   
                                                             
                   $("#editemailOne").val(result.data.first_email);   
                   $("#editemailTwo").val(result.data.second_email);   
                 
                   $("#editcontactOne").val(result.data.first_contact);   
                   $("#editcontactTwo").val(result.data.second_contact);   
                 
                   $("#editaddress_one").val(result.data.first_address);   
                   $("#editaddress_two").val(result.data.second_address);   
                  
                 $("#editindividual").modal("show"); 

               }
           } 
     });
         
   });


   // SUBMIT INFORMATION IN THE DATABASE CLIENT INFORMATION

//    $(document).on('submit',"#updateClientForm",function(e){
//     e.preventDefault();
   
//     var formData = new FormData(this);
//     formData.append("update_client",true);
//     $.ajax({ 
//       type:"POST",url:"./php/client_ajax.php",data:formData,
//       processData:false,contentType:false,
    
//       success:function(response)
//       {
//           var result = jQuery.parseJSON(response); 
//           if(result.status == 422)
//           {
//               $('#errorMessage').removeClass('d-none');   
//               $('#errorMessage').text(result.message);
//           }
//           else if(result.status == 200)
//           {
//            $('#errorMessage').removeClass('d-none'); 
           
//            $('#editIndividual').modal('hide');
//            $('#updateClientForm')[0].reset();

//               alertify.set('notifier','positions','top-right'); 
//               alertify.success(result.message); 
           
//               $("#editindividual").modal("hide"); 
//               console.log(result.message);
//               loadContent('individual_clientlist'); 
//           } 
        
//          // abortController.abort();
//        $(document).off('submit', '#updateClientForm');
//       } 


//     });
//   //  xhr.abort(); 
// }); 

// START LEGAL ENTITY HERE///
// $(document).on('submit', "#updateClientForm", function(e) {
//     e.preventDefault();
  
//     var formData = new FormData(this);
//     formData.append("update_client", true);
  
//     $.ajax({
//       type: "POST",
//       url: "./php/client_ajax.php",
//       data: formData,
//       processData: false,
//       contentType: false,
  
//       success: function(response) {
//         var result = jQuery.parseJSON(response);
//         if (result.status == 422) {
//           $('#errorMessage').removeClass('d-none');
//           $('#errorMessage').text(result.message);
//         } else if (result.status == 200) {
//           $('#errorMessage').removeClass('d-none');
  
//           $('#editIndividual').modal('hide');
//           $('#updateClientForm')[0].reset();
  
//           if (!result.notificationShown) {
//             alertify.set('notifier', 'positions', 'top-right');
//             alertify.success(result.message);
//             result.notificationShown = true; // Update the flag variable
//           }
  
//           $("#editindividual").modal("hide");
       
//           loadContent('individual_clientlist');
//         }
  
//         $(document).off('submit', '#updateClientForm');
//       }
//     });
//   });
  

  


// END LEGAL ENTITY HERE // 