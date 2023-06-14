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
          }
      }
      $stmt->close()?> 


<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #212529;">
    <a class="navbar-brand" href="#"><img src="./vendor/img/logo-transparent.png" alt="Logo" width="100%" height="45"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link font-color" href="#" style="color:#ADA06D;">DASHBOARD</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" style="color:#ADA06D;">
                CLIENTS
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Individual Client List</a>
            <a class="dropdown-item" href="#">Legal Entity List</a>
          </div>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" style="color:#ADA06D;">
                CASES
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">All Products</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color:#ADA06D;">USER</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" style="color:#ADA06D;">
            TASK
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">All Products</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color:#ADA06D;">REPORTS</a>
        </li>
      </ul>
    </div>
    <div class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAccount" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img src="./vendor/img/users.jpg" id="profilePicture" name="profilePicture"> 
        <span style="font-size:12px;color:#ADA06D;"><?php echo  $user_fullname ?></span> | <span style="font-size:12px;color:black; color:#ADA06D;"><?php echo $user_role;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownAccount">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="#">Privacy</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" onclick="confirmLogout()">Log-out</a>
        </div>
      </li>
    </div>
  </nav>