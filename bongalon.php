
<?php
session_start(); // Start the session

include './db/config.php';

if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit; // Terminate the script to prevent further execution
}

$id = $_SESSION['id'];

$sql = "SELECT * FROM tbl_user_list WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./vendor/fontawesome/fontawesome.css">
  <link rel="stylesheet" href="./vendor/datatable/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./vendor/alertify/alertify.min.css"> 
  <link rel="stylesheet" href="./vendor/fullcalendar/lib/main.min.css">
  
  <link rel="stylesheet" href="./src/css/style.css">  
  <script src="./vendor/js/jquery-3.6.1.js" type="text/javascript"> </script>   
  <link rel="stylesheet" href="./select2/select2.min.css">
  <script src="./select2/select2.min.js"></script> 
  <script src="./vendor/fullcalendar/lib/main.min.js"></script>
 
  <title>BONGALON LAW FIRM</title>
</head>

<body>  
<?php 
      include('./db/config.php');

      $sql = "SELECT user_fullname,user_role FROM tbl_user_list  WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $_SESSION['id']);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
              $user_fullname = $row["user_fullname"]; 
              $user_role = $row["user_role"];  
              $encodedUserRole = base64_encode($user_role);
              echo '<script>var userRole = atob("' . $encodedUserRole . '");</script>';
          } 
        
      }
      $stmt->close()?> 


  <?php
    if($user_role == 'Chief Lawyer'){
      include 'navbar.php'; 
    }else if($user_role == 'Admin'){
      include 'adminavbar.php'; 
    }

  
  
  ?>
  
  <style>
    .name{
    color: #0D0D0D;
    font-size: 16px;
    font-weight:500;
    } 
    #cardTask {
  display: block;
  /* Other card styles */
}


        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
          td {
            border-color:#ECE1BE!important;
            border-style: solid;
            border-width: 0.1px !important;
        }
    
</style>
   
 
    <div class="row p-5  "id="loadContent">

    </div>

  
 

  <script src="./vendor/js/jquery.dataTables.min.js"></script>
  <script src="./vendor/js/bootstrap.bundle.min.js"  type="text/javascript"></script>
  <script src="./vendor/sweetalert/sweetalert2@11.js" type="text/javascript"> </script>  
  <script src="./vendor/alertify/alertify.min.js" type="text/javascript"></script>  
  <script src="./vendor/fontawesome/all.min.js" type="text/javascript"></script>
  <script src="./src/js/routing.js"></script>  
 

 
 
<script>
  $(document).ready(function() {
    var currentUrl = window.location.href; // Get the current page URL

    $('nav a').each(function() {
        var linkUrl = $(this).attr('href');
        if (currentUrl.indexOf(linkUrl) > -1) {
            $(this).addClass('selected');
        }
    });

    // Set the default page and add 'selected' class
   // Change 'home' to the desired default page 

   <?php
   if($user_role =='Chief Lawyer'){
   ?> var defaultPage = 'home'; <?php
   }else if($user_role == 'Admin')
   {
    ?> var defaultPage = 'admin_casetype';<?php
   }
   ?>
    $('nav a[data-page="' + defaultPage + '"]').addClass('selected');
    loadContent(defaultPage);

    $('nav li a').click(function(e) {
        e.preventDefault();
        $('nav li a').removeClass('selected');
        $(this).addClass('selected');
        var page = $(this).data('page');
        loadContent(page);
    });

    function loadContent(page) {
        $.ajax({
            url: page + '.php',
            type: 'GET',
            success: function(response) {
                $('#loadContent').html(response);
               
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
 });




function timedRefresh(timeoutPeriod) {
    setTimeout("location.reload(true);",timeoutPeriod);   
      }

    </script> 
 
   
<script>
        function confirmLogout() {
           
                // window.location.href = "logout.php?logout=true"; 
                Swal.fire({
                title: 'Do you want to log-out?',
                showDenyButton: true, confirmButtonText: 'Yes',
            
                }).then((result) => {
                
                if (result.isConfirmed) {
                 window.location.href = "logout.php?logout=true"; 
                } 
                }) 
            }
    </script> 
<script>
// Get the user's role (assuming you have retrieved it and stored it in a variable)
// var userRole = "Admin"; // Replace with the actual user role retrieved from your authentication system

// // Get the select element
// var selectElement = document.getElementById("#admin_option");

// // Loop through the options and hide them based on the user's role
// for (var i = 0; i < selectElement.options.length; i++) {
//   var option = selectElement.options[i];
  
//   if (option.value === userRole) {
//     // Show the option for the user's role
//     option.style.display = "block";
//   } else {
//     // Hide the option for other roles
//     option.style.display = "none";
//   }
// } 



  </script>

</body>

</html>
