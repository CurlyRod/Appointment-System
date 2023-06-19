<?php
include '../db/config.php';

if (isset($_GET['view_cases_info'])) {
    $userId = 51;

    $selectID = "SELECT task.case_number, task.task_description  
    FROM tbl_task_list AS task
    INNER JOIN tbl_case_list ON tbl_case_list.case_number = task.case_number WHERE task.lawyer_id = '$userId'";

    $execute_query = mysqli_query($conn, $selectID);

    // CHECK RETURNING VALUE 
    if (mysqli_num_rows($execute_query) == 1) {
        $user_record = mysqli_fetch_array($execute_query);

        $result = [
            'status' => 200,
            'message' => 'Record Found.',
            'data' => $user_record
        ];
        echo json_encode($result);
        return false;
    } else {
        $result = [
            'status' => 404,
            'message' => 'No record found.'
        ];
        echo json_encode($result);
        return false;
    }
}
?>
