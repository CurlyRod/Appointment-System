<?php 
//VIEW CASE INFO
include '../db/config.php';

if(isset($_GET['view_id_info'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_GET['view_id_info']); 

    $selectID = "SELECT cases.id,cases.lawyer_user_id,lawyer.user_fullname,cases.case_number,cases.case_type,cases.case_sub_type,cases.client_type,client.firstname,client.middlename,client.lastname,
    cases.start_date,cases.end_date,cases.remarks,cases.case_status,cases.client_user_id
    FROM tbl_case_list as cases 
    INNER JOIN tbl_client_list as client ON client.id = cases.client_user_id
    INNER JOIN tbl_user_list as lawyer  WHERE cases.id ='$userId' GROUP BY cases.case_number ORDER BY cases.id DESC";
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

if(isset($_POST['delete_client']))
{ 
    $user_id = $_POST['delete_client_id']; 
    $query_delete = "DELETE FROM  tbl_case_list WHERE id=?"; 
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



?>


