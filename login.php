<?php
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Require config file
  require_once "config.php";

  // Build the login statement
  $sql = "SELECT * FROM tblaccounts WHERE username = ? AND password = ?;";

  // Check if statement runs
  if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind the data from login page
    mysqli_stmt_bind_param($stmt, "ss", $_POST['txtusername'], $_POST['txtpassword']);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);

      // Check if a row was returned
      if (mysqli_num_rows($result) > 0) {
        $account = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
        // Start session
        session_start();
    
        // Store username, usertype, and first name in session
        $_SESSION['username'] = $_POST['txtusername'];
        $_SESSION['usertype'] = $account['usertype'];
        $_SESSION['firstname'] = $account['firstname']; // Assuming 'firstname' is a column in your database
    
        // Redirect to home.php
        header("location: home.php");
        exit();
      } 
      else {
        $error_message = "Incorrect Username or Password.";
      }
    } else {
      $error_message = "Error executing login statement.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
  } else {
    $error_message = "Error preparing login statement.";
  }

  // Close the database connection
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeNexus - Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="background-overlay"></div>
  <div class="container">
    <div class="left">
      <h2>New Here?</h2>
      <p>Enter your details and come join us!</p>
      <a href="registration.html"><button type="button">Sign Up</button></a>
    </div>
    <div class="right">
      <h2><img src="./images/Icon.png" alt="Logo" class="logo"> Login to Your Account</h2>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="text" name="txtusername" placeholder="Username" required value="<?php echo isset($_POST['txtusername']) ? htmlspecialchars($_POST['txtusername']) : ''; ?>"><br>
        <input type="password" name="txtpassword" placeholder="Password" required><br>
        <div class="error-message"><?php if (!empty($error_message)) echo $error_message; ?></div>
        <a href="forgot.html" class="forgot-password">Forgot password?</a><br>
        <button type="submit" name="btnlogin">Sign In</button>
      </form>
    </div>
  </div>
</body>
</html>
