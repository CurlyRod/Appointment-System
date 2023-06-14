<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vendor/bootstrap/bootstrap_4.0.0_css_bootstrap.min.css">
  <link rel="stylesheet" href="./src/css/style.css">  
  <title>BONGALON LAW FIRM</title>
</head>

<body>  
 
  <?php include 'navbar.php';  ?>
  <div class="row m-5 bg-warning "id="loadContent"style="height:100%;">  
  s
  </div>
  <script src="./vendor/js/jquery-3.2.1.slim.min.js"></script>
  <script src="./vendor/js/ajax_libs_popper.js_1.12.9_umd_popper.min.js"></script>
  <script src="./vendor/js/bootstrap_4.0.0_js_bootstrap.min.js"></script>
  <script src="./vendor/sweetalert/sweetalert2@11.js" type="text/javascript"> </script>   
 
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
      var defaultPage = 'home'; // Change 'home' to the desired default page
      $('nav a[data-page="' + defaultPage + '"]').addClass('selected');
      loadContent(defaultPage);

      $('nav a').click(function(e) {
          e.preventDefault();
          $('nav a').removeClass('selected');
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
//FOR  LOG OUT
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
</body>

</html>
