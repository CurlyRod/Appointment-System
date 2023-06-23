$(document).on('click','#legal_view_user',function(){ 

    var legal_user_id = $(this).val();
    $.ajax({ 
        type:'GET', 
        url:"./php/client_ajax.php?view_legal_entity="+legal_user_id,
        success:function(response){ 
            var result = jQuery.parseJSON(response);
            if(result.status == 404)
            {
                Swal.Fire(result.message);
           
            }else if(result.status == 200){ 
                // $('#viewlastname').text("Name: "+  result.data.firstname+ " "+ result.data.middlename+ " "+  result.data.lastname);
                $('#view_entity_information').html("Representative Name: <span class='name'>" + result.data.firstname + " "+ result.data.middlename+" "+ result.data.lastname+
                "</span><br>"+
                "Email: <span class='name'>" + result.data.first_email + 
                "</span><br>"+"Alternate Email: <span class='name'>" + result.data.second_email + "</span><br>"
                +"</span>"+"Contact: <span class='name'>" + result.data.first_contact + "</span><br>"+
                "</span>"+"Contact: <span class='name'>" + result.data.second_contact + "</span><br>" 
                +"</span>"+"Company Name: <span class='name'>" + result.data.company_name + "</span><br>"
                +"</span>"+"Company Address: <span class='name'>" + result.data.company_address + "</span><br>");
               

                $('#viewEntityUserModal').modal('show');  
               
            } 

        }


    });
    
});  


//DELETING DATA  
$(document).on('click','#legal_delete_user',function(e){
    e.preventDefault();

    var legal_id_user = $(this).val();

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
                data:{'delete_legal':true,'legal_user_id':legal_id_user},
   
                success: function(response)
                {
                    var result = jQuery.parseJSON(response); 
                    if(result.status == 500)
                    {
                        Swal.fire(result.message);
   
                    }else if(result.status ==200)
                    {  
                    
                        alertify.set('notifier','positions','top-right'); 
                        alertify.set('notifier', 'delay', 1);
                        alertify.success(result.message); 
                        loadContent('legal_clientlist');
                    }
                   
                }
            });
        }
   });
}); 




//UPDATING LEGAL ENITITY HERE
$(document).on('click','#legal_edit_user',function(e){ 
    e.preventDefault();
var legal_user_ids = $(this).val();
//alert(legal_user_id);
  $.ajax({
        type:"GET",url:"./php/client_ajax.php?legal_client_id="+legal_user_ids,
        success: function(response)
        {
           var result = jQuery.parseJSON(response); 
            if(result.status == 404)
            {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1);
                alertify.success(result.message);
            }
            
            else if(result.status == 200)
            {
                $("#legal_client_id_edit").val(result.data.id);  

                $("#legal_firstname_edit").val(result.data.firstname);    
                $("#legal_middlename_edit").val(result.data.middlename);    
                $("#legal_lastname_edit").val(result.data.lastname);               
                $("#legal_contact_one_edit").val(result.data.first_contact);               
                $("#legal_contact_two_edit").val(result.data.second_contact);    
                $("#legal_email_one_edit") .val(result.data.first_email);       
                $("#legal_email_two_edit") .val(result.data.second_email);       
                $("#company_name_edit").val(result.data.company_name);
                $("#company_address_edit").val(result.data.company_address);

                $("#editentityUserModal").modal("show"); 

            }
        } 
  });
      
}); 


//UPDATE CLIENT INFORMATION
// $(document).on('submit',"#update_entity_Forms",function(e){
//     e.preventDefault();
   
//     var formData = new FormData(this);
//     formData.append("legal_update_client",true);
//     $.ajax({ 
//       type:"POST",url:"./php/client_ajax.php",data:formData,
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
          
//             $('#editentityUserModal').modal('hide');
//            $('#update_entity_Forms')[0].reset();
//             //  $('#userList').load(location.href+ " #userList");;
//             loadContent('legal_clientlist'); 
//             } 
       
//          // abortController.abort();
//        $(document).off('submit', '#update_entity_Forms');
//       } 
  
  
//     });
//   //  xhr.abort(); 
//   }); 
