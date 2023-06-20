
$(document).on('click','#view_task_infos',function(e){
e.preventDefault();
    var user_id = $(this).val();
    console.log(user_id);
    $('#Reassign_lawyer_Modal').modal('show');
    // $.ajax({
    //     type:'GET',
    //     url:"./php/sampleview.php?view_cases_info="+user_id,
    //     success:function(response){
    //         var result = jQuery.parseJSON(response);
    //         if(result.status == 404)
    //         {
    //              alertify.set('notifier', 'position', 'top-right');
    //               alertify.set('notifier', 'delay', 1);
    //                alertify.success(result.message);
    //         }else if(result.status == 200){
    //             // $('#viewlastname').text("Name: "+  result.data.firstname+ " "+ result.data.middlename+ " "+  result.data.lastname);
    //             $('#view_case_information').html("Name: <span class='name'>" + result.data.firstname + " "+ result.data.middlename +" "+ result.data.lastname
    //                 +"</span><br>"
    //                 +"Casetype: <span class='name'>" + result.data.case_type +"</span><br>"
    //                 +"Sub Type: <span class='name'>" + result.data.case_sub_type+"</span><br>"
    //                 +"Case number: <span class='name'>" + result.data.case_number+"</span><br>"
    //                 )
    //                 $("#client_user_id_update").val(result.data.id);

    //             $('#Reassign_lawyer_Modal').modal('show');

    //         }

    //     }


    // });

    });