<?php
 include '../db/config.php'; 


 if(isset($_POST['view_cases_info'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_POST['view_cases_info']); 

    $selectID = "SELECT cases.id,cases.lawyer_user_id,lawyer.user_fullname,cases.case_number,cases.case_type,cases.case_sub_type,cases.client_type,client.firstname,client.middlename,client.lastname,
    cases.start_date,cases.end_date,cases.remarks,cases.case_status,cases.client_user_id
    FROM tbl_case_list as cases 
    INNER JOIN tbl_client_list as client ON client.id = cases.client_user_id 
    INNER JOIN tbl_task_list as task ON task.lawyer_id = cases.lawyer_user_id
    INNER JOIN tbl_user_list as lawyer  WHERE task.lawyer_id = '$userId' GROUP BY cases.case_number ORDER BY cases.id DESC;"; 
  
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