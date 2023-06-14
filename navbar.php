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


<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
      <span class="navbar-brand">  <img src="./vendor/img/logo-transparent.png" alt="Logo" width="100%" height="45" class="d-inline-block align-text-top"></span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-page="home" style="color:#ADA06D;">DASHBOARD</a>
          </li>
          <li class="nav-item dropdown" id="client_btn">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="color:#ADA06D;" >
            CLIENTS
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" data-page="individual_clientlist">INDIVIDUAL CLIENT LIST</a></li>
              <li><a class="dropdown-item" data-page="legal_clientlist">LEGAL ENTITY</a></li>
             
            </ul>
          </li>
          <li class="nav-item dropdown" id="client_btn">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false" style="color:#ADA06D;" >
              CASES
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" data-page="caselist">CASE LIST</a></li>
              <li><a class="dropdown-item" data-page="legal_clientlist">TEAM MEMBER</a></li>
              <li><a class="dropdown-item" data-page="legal_clientlist">CASES</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" style="color:#ADA06D;">Contact</a>
          </li>
        </ul>
      </div>
      <div class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAccount" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Account Settings
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownAccount">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Privacy</a></li>
            <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" onclick="confirmLogout()">Log-out</a>
          </ul>
        </li>
      </div>
    </div>
  </nav>