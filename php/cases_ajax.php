<?php
include '../db/config.php';
if(isset($_GET['view_case_info'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_GET['view_case_info']); 

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
// ADD CASE INFORMATION
if(isset($_POST['save_case_information']))
{
    $prefix= "CN";
    $id = uniqid();
    $numericId = preg_replace("/[^0-9]/", "", $id);
    $shortUniqueIs = substr($numericId, 0, 8);
   
    $caseId = $prefix . '-' . $shortUniqueIs; //case_number

    $client_user_id = $_POST['select_client_list']; //client_user_id int
    $clientType = $_POST['clientType'];  
    $caseType =  $_POST['case_type_list']; 
    $caseSubType =  $_POST['case_type_sublist']; 



    $insertQuery = $conn->prepare("INSERT INTO tbl_case_list(case_number,client_user_id,case_type,case_sub_type,client_type)
    VALUES (?,?,?,?,?)");
    $insertQuery->bind_param("sisss",$caseId,$client_user_id,$caseType,$caseSubType,$clientType); 

        if ($insertQuery->execute()) {
            $response = [
                'status' => 200,
                'message' => 'User created successfully.'
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

// DELETING THE CASE INFORMATION 

if(isset($_POST['delete_case']))
{ 
    $user_id = $_POST['delete_case']; 
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


// SET LAWYER CASE 

if(isset($_GET['view_case_information'])) { 
    $userId = mysqli_real_escape_string($conn,$_GET['view_case_information']); 

    $selectID = "SELECT  cases.id,cases.lawyer_user_id,lawyer.user_fullname,cases.case_number,cases.case_type,cases.case_sub_type,cases.client_type,client.firstname,client.middlename,client.lastname
    FROM tbl_case_list as cases 
    INNER JOIN tbl_client_list as client ON client.id = cases.client_user_id
    INNER JOIN tbl_user_list as lawyer on cases.lawyer_user_id = 0 WHERE cases.id ='$userId' GROUP BY cases.case_number" ; 
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
//CASELIST UPDATE

if(isset($_POST['case_list_update']))
{
        $client_id = $_POST['client_user_id_edit']; //client id from tbl_client_list

        $lawyer_select = $_POST['select_lawyer_id_update'];
        $client_type = $_POST['clientType'];  
        $caseType =  $_POST['case_type_list']; 
        $caseSubType =  $_POST['case_type_sublist'];   

        $client_information = $conn->prepare(" UPDATE tbl_case_list SET lawyer_user_id = ?,case_type = ? ,case_sub_type =? ,client_type = ? WHERE id = ? ");
        $client_information->bind_param("isssi",$lawyer_select,$caseType,$caseSubType,$client_type,$client_id);
       
        $result = $client_information->execute();
       
        if ($result) {
            $res = [
                'status' => 200,
                'message' => 'Update successfully.'
            ];
        } else {
            $res = [
                'status' => 500,
                'message' => 'Not Update Error.'
            ];
        }
        echo json_encode($res);
        return false;

}

// VIEW TASK

 

?>