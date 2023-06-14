
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap/bootstrap.min.css"> 
    <link rel="stylesheet" href="./src/css/login.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <title>BONGALON LAW OFFICE</title> 

</head>
<body>      

    
        <!-- SECTION START HERE -->
      
                <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; ">
                    <div class="row "style="width:50%" >
                        <div class="col"> 
                            <div class="card"id="login-card">
                                <div class="card-body ">
                                    <form action="" id="loginForm"> 
                                    <div class="banner mb-2" ><img src="./src/img/banner.png" alt="banner" class="rounded" style="width:100%"></div>
                                        <!-- <h6 class="text-center text-secondary mb-0">Login to your account</h6> -->
                                   <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="emailInput"  aria-describedby="emailHelp">

                                    </div>

                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="userPassword">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                        </div>

                                        <div class="col">
                                    <div class="mb-3 d-flex justify-content-end">
                                      
                                        <a href=""class="text-dark">Forgot Password</a>
                                    </div>
                                        </div>
                                    </div>
                                   
                                   <div class="col text-center"> <button type="submit" class="btn" style="background:#22170B;color:white;">Login</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SCRIPT FOR DEPENDENDENCIES --> 

      <script src="./vendor/js/jquery-3.6.1.js" type="text/javascript"> </script>   
      <script src="./vendor/js/bootstrap.bundle.min.js"></script>
      <script src="./vendor/sweetalert/sweetalert2@11.js" type="text/javascript"> </script>   
        
     
     <!-- START LOGIN SCRIPT HERE -->    
     <script>
     $("#loginForm").submit( (e) => {
    e.preventDefault();
    
    var form_login = $("#loginForm").serialize();
    $.ajax({
       url : "./php/login_ajax.php",
       method: 'POST',
       data: form_login,
       success: function(res) {
          var data = $.parseJSON(res);
         // alert(data.message);  
             
          if (data.status == 'success') {        
         Swal.fire({
          title: 'Successfully Login!',
          icon: 'success', 
          width:'500px' ,
       }).then((result) => {
          if (result['isConfirmed']){
             
               window.location = './bongalon.php'; 

          } 
         
       })     
             
          }else{  
             
             Swal.fire({
          title: data.message,
          icon: 'error', 
          width:'500px' ,
        
        
        
       }).then((result) => {
          if (result['isConfirmed']){
             // Put your function here
             window.location = 'index.php';
          } 
         
       })      

          }
       }
    })
 });
     </script>
    </body>
   
    </html>