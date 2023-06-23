<?php
    include '../db/config.php';


    if(isset($_POST['save_task_information'])){

    
    $case_number = $_POST['add_select_task']; 
    $start_date =  $_POST['start_date'];
    $end_date = $_POST['end_date']; 
    $remarks = $_POST['add_task_remarks']; 
    $priority = $_POST['priority_select']; 
    $status = "On-going"; 
    $task_description =$_POST['add_task_description'];
    


    $insertQuery = $conn->prepare("INSERT INTO tbl_task_list(case_number,start_date,end_date,remarks,status,priority,task_description)
    VALUES (?,?,?,?,?,?,?)");
    $insertQuery->bind_param("sssssss",$case_number,$start_date,$end_date,$remarks,$status,$priority,$task_description); 

        if ($insertQuery->execute()) {
            $response = [
                'status' => 200,
                'message' => 'Task created successfully.'
            ];
        } else {
            $response = [
                'status' => 500,
                'message' => 'Failed to create user.'
            ];
        }

        echo json_encode($response);
        return false;
}



if(isset($_POST['delete_task']))
{ 
    $user_id = $_POST['delete_task']; 
    $query_delete = "DELETE FROM  tbl_task_list WHERE id=?"; 
    $stmt = $conn->prepare($query_delete); 
    $stmt->bind_param('i',$user_id); 
    $query_delete = $stmt->execute(); 
    $stmt->close(); 

    if ($query_delete) {
        $res = [
            'status' => 200,
            'message' => 'Deleted successfully.'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Not Deleted.'
        ];
    }
    echo json_encode($res);
    return false;
}  




if(isset($_GET['view_task_info'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_GET['view_task_info']); 

    $selectID = "SELECT task.id,cases.lawyer_user_id,user.user_fullname,client.firstname,client.middlename,client.lastname,cases.case_status,cases.case_number,cases.case_sub_type,cases.case_type,
    task.task_description,task.remarks,task.priority,task.status,task.end_date,cases.client_type
    FROM tbl_case_list as cases
    INNER JOIN tbl_user_list AS user ON cases.lawyer_user_id = user.id
    INNER JOIN tbl_task_list as task ON cases.case_number = task.case_number
    INNER JOIN tbl_client_list AS client ON cases.client_user_id = client.id WHERE task.id='$userId'"; 
  
    $execute_query = mysqli_query($conn,$selectID); 

    //CHECK RETURNING VALUE 
    
        if(mysqli_num_rows($execute_query)== 1) 
        {   

            $user_record = mysqli_fetch_array($execute_query); 


            $result=[    
                'status' =>  200,
                'message' => 'Record Found.',
                'data' => $user_record
                    ];
                echo json_encode($result) ;
                return false;
        }
        else 
        { 
            $result=[    
                'status' =>  404,
                'message' => 'No record found.',
                    ];
                echo json_encode($result) ;
                return false;
        } 

}  


?>