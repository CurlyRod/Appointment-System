<?php 
    include '../db/config.php';

if (isset($_POST['emailInput']) && isset($_POST['userPassword'])) {
    $username = $_POST['emailInput'];
    $password = $_POST['userPassword'];

    // Prepare the statement with parameter placeholders
    $stmt = $conn->prepare("SELECT * FROM tbl_user_list WHERE user_email = ?");
    
    // Bind the email parameter
    $stmt->bind_param('s', $username);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['user_password'];

        // Verify the password
        if (password_verify($password, $storedHashedPassword)) {
            $_SESSION['id'] = $row['id'];
            $arr = array("status" => 'success', 'message' => 'Logged Successfully');
        } else {
            $arr = array("status" => 'error', 'message' => 'Check username or password');
        }
    } else {
        $arr = array("status" => 'error', 'message' => 'Check username or password');
    }

    echo json_encode($arr);
}


?>