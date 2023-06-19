<?php
include '../db/config.php';
if(isset($_POST['reassign_lawyer_update']))
{
        $client_id = $_POST['client_user_id_update']; //client id from tbl_client_list

        $lawyer_select = $_POST['reassign_lawyer_id'];
        
        $client_information = $conn->prepare(" UPDATE tbl_case_list SET lawyer_user_id = ? WHERE id = ? ");
        $client_information->bind_param("ii",$lawyer_select,$client_id);
       
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

?>