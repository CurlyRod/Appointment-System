<?php  
include '../db/config.php';

//SAVE THE CLIENT INFORMATION
if(isset($_POST['save_client']))
{   
 
    $lastName = $_POST['lastName']; 
    $firstName = $_POST['firstName']; 
    $middleName = $_POST['middleName']; 
    $gender = $_POST['gender']; 
    $emailone = $_POST['emailOne']; 
    $emailtwo = $_POST['emailTwo']; 
    $contactONE = $_POST['contactOne'];
    $contactTWO = $_POST['contactTwo'];
    $addOne =$_POST['address_one'];
    $addTwo =$_POST['address_two'];
    
    $prefix= date('Y');
    $id = uniqid();
    $numericId = preg_replace("/[^0-9]/", "", $id);
    $shortUniqueIs = substr($numericId, 0, 8);
   
    $caseId = $prefix . '-' . $shortUniqueIs; //case_number
        
    

if (empty($lastName) || empty($firstName) || empty($middleName) ||empty($emailone) || empty($contactONE) || empty($addOne)) {
    $response = [
        'status' => 422,
        'message' => 'Please fill all fields.'
    ];
    echo json_encode($response);
    return false;
} 


$validEmails = true;

if (!filter_var($emailone, FILTER_VALIDATE_EMAIL)) {
    $response = [
        'status' => 423,
        'message' => 'Email not valid.'
    ];
    echo json_encode($response);
    return false;
    $validEmails =false;
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = [
        'status' => 423,
        'message' => 'Email not valid.'
    ];
    echo json_encode($response);
    return false;
    $validEmails =false;
}




$stmt = $conn->prepare("INSERT INTO tbl_client_list (client_id,firstname , middlename , lastname , gender , first_email, second_email, first_contact,
second_contact, first_address, second_address) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssss", $caseId, $firstName, $middleName, $lastName, $gender, $emailone, $emailtwo, $contactONE,$contactTWO,$addOne,$addTwo); 


if ($stmt->execute()) {
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

// VIEW INFORMATION OF CLIENT
if(isset($_GET['view_client'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_GET['view_client']); 

    $selectID = "SELECT * FROM tbl_client_list WHERE id='$userId' "; 
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

//  DELETING THE CLIENT

if(isset($_POST['delete_client']))
{ 
    $user_id = $_POST['client_id']; 
    $query_delete = "DELETE FROM  tbl_client_list WHERE id=?"; 
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


// FIND THE ID OF CLIENT INFORMATION


if (isset($_GET['client_id'])) {
    $userId = $_GET['client_id'];
    
    $selectID = "SELECT * FROM tbl_client_list WHERE id=?";
    $stmt = $conn->prepare($selectID);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_record = $result->fetch_assoc();
        
        $res = [    
            'status' =>  200,
            'message' => 'Record Found.',
            'data' => $user_record
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [    
            'status' =>  404,
            'message' => 'No record found.'
        ];
        echo json_encode($res);
        return false;
    }
}


// UPDATING THE CLIENT INFORMATION 
if(isset($_POST['update_client']))
{   
    //// Validate and sanitize inputs 
    $user_id = $_POST['client_id_input'];    

    $firstName = $_POST['editfirstName'];
    $middleName = $_POST['editmiddleName'];
    $lastName = $_POST['editlastName'];  
    $gender = $_POST['editGender'];  
    $emailOne = $_POST['editemailOne'];  
    $emailTwo = $_POST['editemailTwo'];        
    $contactOne = $_POST['editcontactOne']; 
    $contactTwo = $_POST['editcontactTwo']; 
    $addressOne = $_POST['editaddress_one']; 
    $addressTwo = $_POST['editaddress_two']; 

  


 $editUser = $conn->prepare("UPDATE tbl_client_list SET
     firstname =?,
     middlename=?,
     lastname=?,
     gender=?,
     first_email=?,
     second_email=?,
     first_contact=?,
     second_contact=?, 
     first_address=?,
     second_address=? WHERE id = ?"); 

     $editUser->bind_param("ssssssssssi",

     $firstName,
     $middleName,
     $lastName,
     $gender, 
     $emailOne,
     $emailTwo,
     $contactOne,
     $contactTwo,
     $addressOne,
     $addressTwo,
     $user_id); 

     $result = $editUser->execute();

     if ($result) {
        $res = [
            'status' => 200,
            'message' => 'Update successfully.'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Not updated successfully.'
        ];
    }

    echo json_encode($res);
    return false;
} 

// ---- START LEGAL ENTITY HERE ----///

if(isset($_GET['view_legal_entity']))  { 
    $userId = mysqli_real_escape_string($conn,$_GET['view_legal_entity']); 

    $selectID = "SELECT * FROM tbl_entity_list WHERE id='$userId' "; 
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


    if(isset($_GET['legal_client_id'])) 
    { 
    $userId = mysqli_real_escape_string($conn,$_GET['legal_client_id']); 

    $selectID = "SELECT * FROM tbl_entity_list WHERE id='$userId' "; 
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
    
    if(isset($_POST['delete_legal']))
    { 
        $user_id = $_POST['legal_user_id']; 
        $query_delete = "DELETE FROM  tbl_entity_list WHERE id=?"; 
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

 // ADDING LEGAL INFORMATION
 if(isset($_POST['save_legal_information']))
 {
    
     $companyName =$_POST['company_names'];
     $companyAddress =$_POST['company_address'];
     $lastName = $_POST['legal_lastname']; 
     $firstName = $_POST['legal_firstname']; 
     $middleName = $_POST['legal_middlename'];    
     $emailone = $_POST['legal_email_one']; 
     $emailtwo = $_POST['legal_email_two']; 
     $contactONE = $_POST['legal_contact_one'];
     $contactTWO = $_POST['legal_contact_two'];

     $prefix=  date('Y');
     $id = uniqid();
     $numericId = preg_replace("/[^0-9]/", "", $id);
     $shortUniqueIs = substr($numericId, 0, 8);
     
  
     $caseId = $prefix . '-' . $shortUniqueIs; //case_number
         

     if (empty($lastName) || empty($firstName) || empty($middleName) ||empty($emailone) || empty($contactONE) || empty($companyName) || empty($companyAddress)) {
         $response = [
             'status' => 422,
             'message' => 'Please fill all fields.'
         ];
         echo json_encode($response);
         return false;
     } 
    
     
     $validEmails = true;
     
     if (!filter_var($emailone, FILTER_VALIDATE_EMAIL)) {
         $response = [
             'status' => 423,
             'message' => 'Email not valid.'
         ];
         echo json_encode($response);
         return false;
         $validEmails =false;
     }
     
     if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $response = [
             'status' => 423,
             'message' => 'Email not valid.'
         ];
         echo json_encode($response);
         return false;
         $validEmails =false;
     } 


            $stmt = $conn->prepare("INSERT INTO tbl_entity_list (firstname , middlename , lastname , first_email, second_email, first_contact,
            second_contact,company_name,company_address,case_id) VALUES (?,?,?,?,?,?,?,?,?,?)");
            
            $stmt->bind_param("ssssssssss", $firstName, $middleName, $lastName, $emailone, $emailtwo, $contactONE,$contactTWO,$companyName,$companyAddress,$caseId); 
        
        
            if ($stmt->execute()) {
                $response = [
                    'status' => 200,
                    'message' => 'Legal Entity created successfully.'
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

            // UPDATE LEGAL INFORMATION
        
        if($_POST['legal_update_client']){
       
            $user_id = $_POST['legal_client_id_edit']; 
            $company_name =$_POST['company_name_edit']; 
            $company_address =$_POST['company_address_edit']; 
            $firstname =$_POST['legal_firstname_edit']; 
            $middlename =$_POST['legal_middlename_edit'];   
            $lastname =$_POST['legal_lastname_edit']; 
            $email_One =$_POST['legal_email_one_edit']; 
            $email_Two =$_POST['legal_email_two_edit']; 
            $contactOne = $_POST['legal_contact_one_edit'];
            $contactTwo = $_POST['legal_contact_two_edit']; 
        
        
            
        
            $validEmails = true;
            if (!filter_var($email_One,FILTER_VALIDATE_EMAIL)) {
                $response = [
                    'status' => 423,
                    'message' => 'Email not valid.'
                ];
                echo json_encode($response);
                return false;
                $validEmails =false;
            }  
        
        
            $editAccount = $conn->prepare("UPDATE tbl_entity_list SET company_name = ?, company_address = ?, firstname = ? , middlename = ?, lastname = ? , first_email = ?,
            second_email = ?,first_contact = ?, second_contact = ? WHERE  id=?"); 
            $editAccount->bind_param("sssssssssi",$company_name,$company_address,$firstname,$middlename,$lastname,$email_One,$email_Two, $contactOne,$contactTwo,$user_id);
            $result = $editAccount->execute();
        
           
                if ($result) {
                    $res = [
                        'status' => 200,
                        'message' => 'Update successfully.'
                    ];
                } else {
                    $res = [
                        'status' => 500,
                        'message' => 'Error not updated.'
                    ];
                }
            
                echo json_encode($res);
                return false;
            
        
        
        }


// ---- END LEGAL ENTITY HERE ----///
?>