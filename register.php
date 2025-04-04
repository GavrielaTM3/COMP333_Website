<!-- 
 register.php file which allows the user tp register for BlossomTech
-->

<!DOCTYPE HTML>
<html lang="en">
<head>
  <h1>BlossomTech Signup</h1>
  <link rel="stylesheet" href="style.css" />

  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <title>Register</title>
  <p>Fill out this form to create an account:</p>
</head>

<body>
  <?php

    require_once './db.php';

    if(isset($_POST["submit"])){
      // Variables for the output and the web form below.
      $out_value = "";
      $s_user = $_POST['username'];
      $s_pass = $_POST['password'];
      $hashed_password = password_hash($s_pass, PASSWORD_DEFAULT);
     
      // Check that the user entered data in the form.
      if(!empty($s_user) && !empty($hashed_password)){
        // If so, prepare SQL query with the data to query the database.
        $sql_check = "SELECT username FROM users WHERE username = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $s_user);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows >0){
          $error_msg = "Error, username already taken. Please choose another";
        }
        else{
          $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
          $stmt = $conn->prepare($sql_insert);
          $stmt->bind_param("ss", $s_user, $hashed_password);
          $stmt->execute();
          echo "Registration succesful";
          header("Location: login.php");
          exit(); // Stop script execution after redirect
        }

      }
      else {
        $error_msg = "No information inputted!";
      }
    }

    // Close SQL connection.
    $conn->close();
  ?>

  <!-- 
    HTML code for the form by which the user can register.
  -->
  
      <form method='POST' id="registerForm">
      <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <div class="input-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
      </div>
      <p id="error-message"></p>
      <input type="submit" name="submit" value="Submit"/>
    </form>
    <p>Already have an account? <a href="login.php">Log in </a></p>
    <?php if (!empty($error_msg)) : ?>
        <p id="error-message" style="color: red;"><?php echo $error_msg; ?></p>
    <?php endif; ?>

  <script>
    document.getElementById("registerForm").addEventListener("submit", function(event) {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const errorMessage = document.getElementById("error-message");
    
      if (password !== confirmPassword ) {
        event.preventDefault(); // Prevent form submission
        errorMessage.textContent = "Passwords do not match!";
      } 
      else if (password.length <10){
        event.preventDefault(); // Prevent form submission
        errorMessage.textContent = "Passwords must be 10 characters!";
      }
      else {
        errorMessage.textContent = ""; // Clear the error message
      }
    });
  </script>
  
</body>
</html>