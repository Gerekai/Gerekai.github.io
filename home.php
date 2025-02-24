<?php
session_start(); // Start the session

// Check if the user is logged in and retrieve user details
if (isset($_SESSION['firstname'])) {
    $firstname = $_SESSION['firstname'];
} else {
    $firstname = "Guest"; // Default if no session is found
}

if(isset($_SESSION['usertype'])) {
  $usertype = $_SESSION['usertype'];
} else {
  // Default user type if not set
  $usertype = 'guest';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeNexus - Home</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>
  <div class="header">
    <div class="header-left">
      <div class="burger-menu" onclick="toggleSidebar()">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="logo">
        <img src="./images/Icon.png" alt="Logo">
        <span>HomeNexus</span>
      </div>
    </div>
    <a href="logout.php" class="logout">Logout</a>
  </div>
  <div class="container">
    <div class="sidebar" id="sidebar">
      <a href="javascript:void(0);" class="closebtn" onclick="toggleSidebar()">
        <img src="./images/close.png" alt="Close" class="close-icon">
      </a>
      <h2>WELCOME</h2>
      <h3><?php echo htmlspecialchars($firstname) . '!'; ?></h3><br>
      <ul>
        <li><a href="#">HOME</a></li>
        <li><a href="#">Dashboard and Schedule of Events</a></li>
        <li><a href="#">Downloadable Forms</a></li><br>

        <!-- Payments Section (Visible to all) -->
        <li class="dropdown">
          <a href="#" onclick="toggleDropdown('payment-dropdown')">Payments <img src="./images/downarrow.png" alt="Dropdown" class="dropdown-icon"></a>
          <ul class="dropdown-content" id="payment-dropdown">
            <li><a href="#">History</a></li>
            <li><a href="#">Pay Online</a></li>
          </ul>
        </li>

        <!-- Conditional Rendering Based on UserType -->
        <?php if($usertype != 'user'): ?>
          <li class="dropdown">
            <a href="#" onclick="toggleDropdown('reports-dropdown')">Reports <img src="./images/downarrow.png" alt="Dropdown" class="dropdown-icon"></a>
            <ul class="dropdown-content" id="reports-dropdown">
              <li><a href="#">Generate Report</a></li>
              <li><a href="#">Financial Records</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" onclick="toggleDropdown('approval-dropdown')">Approvals <img src="./images/downarrow.png" alt="Dropdown" class="dropdown-icon"></a>
            <ul class="dropdown-content" id="approval-dropdown">
              <li><a href="#">Registration</a></li>
              <li><a href="#">Payment</a></li>
              <li><a href="#">Password Reset</a></li>
            </ul><br>
          </li>
          <li><a href="#">Announcements</a></li>
          <li><a href="#">User Management</a></li>
          <?php if($usertype == 'admin'): ?>
            <li><a href="#">Logs</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </div>
    <div class="content">
      <!-- Main content goes here -->
    </div>
  </div>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
    }
    
    function toggleDropdown(id) {
      var element = document.getElementById(id);
      if (element.classList.contains('show')) {
        element.style.maxHeight = '0px'; // Set max-height to 0 to hide
      } else {
        element.style.maxHeight = element.scrollHeight + 'px'; // Set max-height to scrollHeight to show
      }
      element.classList.toggle('show');
    }
  </script>
</body>
</html>
