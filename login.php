<!-- login.php file for BlossomTech -->

<?php
session_start();
require_once './db.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <title>Login</title>
  <link rel="stylesheet" href="style.css?v=1">
</head>

<body>

<div class="login-container">
  <h1>Welcome to BlossomTech!</h1>

  <form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="Enter username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter password" required>

    <input type="submit" name="submit" value="Login">

    <?php
    if (isset($_POST["submit"])) {
      $out_value = "";
      $s_user = $_POST['username'];
      $s_pass = $_POST['password'];

      if (!empty($s_user) && !empty($s_pass)) {
          $sql_query = "SELECT password FROM users WHERE username = (?)";
          $stmt = $conn->prepare($sql_query);
          $stmt->bind_param("s", $s_user);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = mysqli_fetch_assoc($result);

          if ($row && password_verify($s_pass, $row['password'])) {
              $_SESSION['username'] = $s_user;
              header("Location: index.php");
              exit();
          } else {
              echo '<p class="error-msg">Invalid login credentials - please try again</p>';
          }
      } else {
          echo '<p class="error-msg">Please fill out the form completely.</p>';
      }

      $conn->close();
    }
    ?>
  </form>

  <div class="signup-link">
    Don't have an account? <a href="register.php">Sign up here</a>
  </div>
</div>

</body>
</html>


