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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "app-db";
    // Create server connection.
    

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check server connection.

    if ($conn->connect_error) {
      // Exit with the error message.
      // . is used to concatenate strings.
      die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_REQUEST["submit"])){
      // Variables for the output and the web form below.
      $out_value = "";
      $s_user = $_REQUEST['username'];
      $s_pass = $_REQUEST['password'];
      $hashed_password = password_hash($s_pass, PASSWORD_DEFAULT);
     
      // Check that the user entered data in the form.
      if(!empty($s_user) && !empty($hashed_password)){
        // If so, prepare SQL query with the data to query the database.
        $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("ss", $s_user, $hashed_password);
        $stmt->execute();
        header("Location: login.php");
        exit(); // Important to prevent further execution
      }
      else {
        $out_value = "No information inputted!";
      }
    }

    // Close SQL connection.
    $conn->close();
  ?>

  <!-- 
    HTML code for the form by which the user can query data.
  -->
  
      <form method='GET' id="registerForm">
      <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="input-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
      </div>
      <p id="error-message"></p>
      <input type="submit" name="submit" value="Submit"/>
    </form>


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