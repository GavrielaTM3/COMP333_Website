<!-- 
 register.php file which allows the user tp register for BlossomTech
-->

<!DOCTYPE HTML>
<html lang="en">
<head>
  <h1>BlossomTech Signup</h1>

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
    
    if(isset($_REQUEST["register"])){
      // Variables for the output and the web form below.
      $out_value = "";
      $s_user = $_REQUEST['username'];
      $s_pass = $_REQUEST['password'];
      $hashed_password = password_hash($s_pass, PASSWORD_DEFAULT);

     
      // Check that the user entered data in the form.
      if(!empty($s_user) && !empty($hashed_password)){
        // If so, prepare SQL query with the data to query the database.
        $sql_query = "SELECT password FROM users WHERE username = ('$s_user')";
        // Send the query and obtain the result.
        // mysqli_query performs a query against the database.
        $password = mysqli_query($conn, $sql_query);
        if(password_verify($password, $hashed_password)) {
          // If the password inputs matched the hashed password in the database
          // Do something, you know... log them in.
        } 
        else{
        // Else, Redirect them back to the login page.
        }
       
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

  <div class="container">
    <h2>Register</h2>
    <form id="registerForm">
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
      <button type="submit">Register</button>
    </form>
  </div>


  <script>
    document.getElementById("registerForm").addEventListener("submit", function(event) {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const errorMessage = document.getElementById("error-message");

      if (password !== confirmPassword) {
        event.preventDefault(); // Prevent form submission
        errorMessage.textContent = "Passwords do not match!";
      } else {
        errorMessage.textContent = ""; // Clear the error message
      }
    });
  </script>
  
</body>
</html>