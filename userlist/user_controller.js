//VIEW DATA IN MODAL 

$(document).on('click','#view_user_entity',function(e){
   e.preventDefault();
    var view_entity_user = $(this).val();
   console.log(view_entity_user);

    $.ajax({

        type:'GET',url:'./php/users_ajax.php?view_entity_user='+view_entity_user,
        success:function(response)
        { 
            var result = jQuery.parseJSON(response);
            if(result.status == 404)
            {
                Swal.Fire(result.message);

            }else if(result.status == 200)
            { 
                $('#view_entity_modal').html("Name: <span class='name'>" + result.data.user_fullname+
                "</span><br>"
                +"Email: <span class='name'>" + result.data.user_email +"</span><br>"
                +"Role: <span class='name'>" + result.data.user_role+"</span><br>"
                +"Access Level: <span class='name'>" + result.data.user_access+"</span><br>"
                ) 

                $('#view_userModal').modal('show');
            }
        }

    });

});  

// DELETE USER ACCOUNT HERE 
$(document).on('click','#delete_user_entity',function(e){
    e.preventDefault();
    var entity_id = $(this).val();

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
             url:"./php/users_ajax.php",
             data:{'delete_account':true,'account_id':entity_id},

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
                     loadContent('users');
                 }
                 else if(result.status ==423)
                 {   alertify.set('notifier', 'delay', 1);
                     alertify.set('notifier','positions','top-right'); 
                     alertify.success(result.message); 
                   
                 }
             }
         });
     }
});

});
// SUBMIT USER ACCOUNT DETAILS 
$('#submit_entity').on('click',function(e){
    e.preventDefault();
 
    var formData =  new FormData($('#add_entity_form')[0]); 
    formData.append('save_account',true); 
   // var serializedData = new URLSearchParams(formData).toString();
    
    $.ajax({
        type:'POST',url:"./php/users_ajax.php",data:formData,
        processData:false,contentType:false,
        success:function(response)
        { 
            var result = jQuery.parseJSON(response);
            if(result.status == 404)
            {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1); 
                alertify.success(result.message);
            }else if(result.status == 500)
            {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1); 
                alertify.success(result.message);
                }else if(result.status == 423){
                
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1); 
                alertify.success(result.message)
            }
            else if(result.status == 400)
            {  
                alertify.set('notifier', 'delay', 1); 
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(result.message);

                $('#addEntityModal').modal('hide');
                $('#add_entity_form')[0].reset();
              
                loadContent('users');
                //$('#userList').DataTable().ajax.reload();
            }
       //  $(document).off('submit', '#add_entity_form'); 
        }
    })
}); 


//UPDATE THE USER INFORMATION

$(document).on('click','#edit_user_entity',function(e){
    e.preventDefault();
    var entity_user_id = $(this).val(); 
    //console.log(user);  
    
    $.ajax({
        type:"GET",url:"./php/users_ajax.php?view_information_user="+entity_user_id,
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
              $("#edit_entity_id").val(result.data.id);    
              
              $("#edit_entity_fullname").val(result.data.user_fullname); 
              $("#edit_entity_email").val(result.data.user_email);  
              $("#edit_entity_role").val(result.data.user_role);  
              $("#editAccountModal").modal("show");
            }

        }
    });
  });

