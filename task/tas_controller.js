$('#addTaskBtns').on('click', function(e) {
    e.preventDefault();

    var formData = new FormData($('#add_casetask_Form')[0]);
    formData.append("save_task_information", true);
    

    $.ajax({
        type: "POST",
        url: "./php/managetask._ajax.php",
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

               
                $('#add_casetask_Form')[0].reset();

                loadContent('manage_task');
            } 
        }
    });
});  
 


$(document).on('click','#view_task_info',function(e){
    e.preventDefault();
      var view_task_info = $(this).val(); 
       $.ajax({
           type:'GET',url:'./php/managetask._ajax.php?view_task_info='+view_task_info,
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
                   $('#viewTaskinformation').html("Case Number: <span class='name fw-bold'>" + result.data.case_number+"</span><br>"+"Client Name: <span class='name'>" + result.data.firstname +" "+ result.data.middlename  +" "+  result.data.lastname+ "</span><br>" 
                   +"Case Type: <span class='name'>" + result.data.case_type+"</span><br>" 
                   +"Case Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>" 
                   +"Case Number: <span class='name'>" + result.data.user_fullname+"</span><br>" 
                   +"Client Type: <span class='name'>" + result.data.client_type+"</span><br>" 
                   +"Remarks: <span class='name'>" + result.data.remarks+"</span><br>"
                   +"Priority: <span class='name'>" + result.data.priority+"</span><br>" 
                   +"Status: <span class='name'>" + result.data.status+"</span><br>"); 
                 
                   $('#viewTaskModal').modal('show'); 
                   console.log(result.data.case_number);
               }
           }
   
       });
    }); 


    