<?php
include '../db/config.php';

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;

require '../mailclass/src/Exception.php';
require '../mailclass/src/PHPMailer.php';
require '../mailclass/src/SMTP.php'; 


if(isset($_POST['case_list_update']))
{
        $client_id = $_POST['client_user_id_edit']; //client id from tbl_client_list

        $lawyer_select = $_POST['select_lawyer_id_update'];
       // $client_type = $_GET['editclientType'];  
        $caseType =  $_POST['case_type_list']; 
        $caseSubType =  $_POST['case_type_sublist'];   

        if (isset($_POST['editclientType'])) {
            
            $clientType = $_POST['editclientType'];
            
        } else {
            // Handle the case when "editclientType" is not selected
            $result = [
                'status' => 404,
                'message' => 'Client Type not selected.'
            ];
            echo json_encode($result);
           return false;
        } 

        if(empty($caseType) || empty($caseSubType)){
          
                    $result = [
                        'status' => 404,
                        'message' => 'Empty Fields Need to fill up.' 
                           ];
                        echo json_encode($result);
                        return false;
         }
        
    
        $client_information = $conn->prepare(" UPDATE tbl_case_list SET lawyer_user_id = ?,case_type = ? ,case_sub_type =? ,client_type = ? WHERE id = ? ");
        $client_information->bind_param("isssi",$lawyer_select,$caseType,$caseSubType, $clientType,$client_id);
       
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

if($_POST['update_lawyer_cases']){
       
    $lawyer_id = $_POST['select_lawyer_id'];
    $remarks =$_POST['lawyer_remarks'];   
    $case_id = $_SESSION['lawyer_id_session']; 
    $caseStats = 'Ongoing';

    $editAccount = $conn->prepare("UPDATE tbl_case_list AS cases SET cases.lawyer_user_id = ? ,cases.remarks =? ,cases.case_status =? WHERE cases.id =?"); 
    $editAccount->bind_param("issi",$lawyer_id,$remarks,$caseStats,$case_id);
    $result = $editAccount->execute();
        if ($result) {
            $res = [
                'status' => 200,
                'message' => 'Assign lawyer successfully.'
            ];

           
            // $mail = new PHPMailer(true);
            // $mail->isSMTP();
            // $mail->Host = 'smtp.gmail.com';
            // $mail->SMTPAuth = true;
            // $mail->Username = 'edocusaveit@gmail.com';
            // $mail->Password = 'qkahgpdybirjotmt';
            
            // $mail->SMTPSecure = 'ssl';
            // $mail->Port = 465;
            
            // $mail->setFrom('edocusaveit@gmail.com');
    
            //  $sampleEmail ="rufinorodmark7@gmail.com"; 
            //  $sampleSubject = "New Case Assign";

            //  $mail->addAddress($sampleEmail);
            //  $mail->isHTML(true);
            //  $mail->Subject = $sampleSubject;
            
            //  $message =  $case_id .'<br>'.$remarks;
        
            //  $mail->Body = $message ; 
            //  $mail->send();

        }

        else {
            $res = [
                'status' => 500,
                'message' => 'Not Assign successfully.'
            ];
        }
        echo json_encode($res);
        return false;
}
  



?>