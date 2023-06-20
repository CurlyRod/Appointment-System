// VIEW THE CASE INFORMATION 
$(document).on('click','#view_client_info',function(e){
    e.preventDefault();
      var view_entity_info = $(this).val(); 
       $.ajax({
           type:'GET',url:'./php/cases_ajax.php?view_case_info='+view_entity_info,
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
                   $('#viewCaseinformation').html("Case Number: <span class='name fw-bold'>" + result.data.case_number+"</span><br>"+"Client Name: <span class='name'>" + result.data.firstname +" "+ result.data.middlename  +" "+  result.data.lastname+ "</span><br>" 
                   +"Case Type: <span class='name'>" + result.data.case_type+"</span><br>" 
                   +"Case Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>" 
                   +"Case Number: <span class='name'>" + result.data.user_fullname+"</span><br>" 
                   +"Client Type: <span class='name'>" + result.data.client_type+"</span><br>"); 
                 
                   $('#viewCasetModal').modal('show'); 
                   console.log(result.data.case_number);
               }
           }
   
       });
    }); 

// ADD CASE INFORMATION

$('#save_case_btn').on('click', function(e) {
    e.preventDefault();

    var formData = new FormData($('#save_case_Form')[0]);
    formData.append("save_case_information", true);
    

    $.ajax({
        type: "POST",
        url: "./php/cases_ajax.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var res = jQuery.parseJSON(response);

            if (res.status == 500) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1); 
                alertify.success(res.message);
            } else if (res.status == 200) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 1);
                alertify.success(res.message);

                $('#addCaseModal').modal('hide');
                $('#save_case_Form')[0].reset();

                loadContent('case_caselist');
            } 
        }
    });
});  

// DELETING CASE INFORMATION

$(document).on('click','#delete_client_info',function(e){
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
                url:"./php/cases_ajax.php",
                data:{'delete_case':true,'delete_case':legal_id_user},
   
                success: function(response)
                {
                    var result = jQuery.parseJSON(response); 
                    if(result.status == 500)
                    {
                        Swal.fire(result.message);
   
                    }else if(result.status ==200)
                    {  
                        alertify.set('notifier', 'delay', 1);
                        alertify.set('notifier','positions','top-right'); 
                        alertify.success(result.message); 
                        loadContent('case_caselist');
                    }
                   
                }
            });
        }
   });
});

//TEAM MEMBER VIEW SET LAWYER

$(document).on('click','#assign_lawyer_Btn',function(){ 

    var user_id = $(this).val();
   
    $.ajax({
        type:'GET', 
        url:"./php/cases_ajax.php?view_case_information="+user_id,
        success:function(response){ 
            var result = jQuery.parseJSON(response);
            if(result.status == 404)
            {
                Swal.Fire(result.message);
           
            }else if(result.status == 200){ 
                // $('#viewlastname').text("Name: "+  result.data.firstname+ " "+ result.data.middlename+ " "+  result.data.lastname);
                $('#view_case_information').html("Name: <span class='name'>" + result.data.firstname + " "+ result.data.middlename +" "+ result.data.lastname
                    +"</span><br>"
                    +"Casetype: <span class='name'>" + result.data.case_type +"</span><br>"
                    +"Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>"
                    +"Case number: <span class='name'>" + result.data.case_number+"</span><br>"
                    ) 
    
                $('#assign_lawyer_Modal').modal('show');  
               
            } 
    
        }
    
    
    });
    
    });
 

// SUBMITTING THE LAWYER SET 


  // UPDATE CASELIST INFORMATION 
  $(document).on('click','#edit_client_info',function(e){ 
    e.preventDefault();
    var clientId =  $(this).val(); 
    
    $.ajax({
      type:"GET",url:"./php/cases_ajax.php?view_case_info="+clientId,
        success:function(response)
        {
          var result = jQuery.parseJSON(response);
              if(result.status == 404)
              {
                  alertify.set('notifier', 'position', 'top-right');
                  alertify.set('notifier', 'delay', 1);
                  alertify.success(result.message); 
              }else if(result.status ==200)
              {
                  $("#client_user_id_edit").val(result.data.id);  
              
                  var client = result.data.client_user_id;
                 
                  $("#edit_select_client_list option").each(function() {
                    if ($(this).val() == client) {
                      $(this).prop("selected", true);
                      $(this).prop("disabled", true); // add disabled attribute
                      return false; // exit the loop if found
                    }
                  });
                  
                  $('#edit_client_case_number').html("Case Number: <span class='name'>" + result.data.case_number+"</span><br>"
                  );
                
                  $("#editClientModal").modal("show"); 
              }
        }
  
    });
  });  


  //UPDATING THE CASE LIST

 

  


