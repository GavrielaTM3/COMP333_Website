<!-- 
 login.php file which allows the user to login to BlossomTech
-->

<!DOCTYPE HTML>
<html lang="en">
<head>
  <h1>Welcome to BlossomTech!</h1>

  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <title>Login</title>
</head>

<body>
  <?php
     
    // running MySQL server with default setting (user 'root' with no password).
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
    // `isset` — Function to determine if a variable is declared and is different than null.
  
    if(isset($_REQUEST["submit"])){
      // Variables for the output and the web form below.
      $out_value = "";
      $s_user = $_REQUEST['username'];
      $s_pass = $_REQUEST['password'];
      $hashed_password = password_hash($s_pass, PASSWORD_DEFAULT);

      echo $s_user;
      echo $s_pass;
      echo $hashed_password;
      // The following is the core part of this script where we connect PHP
      // and SQL.
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
        // mysqli_fetch_assoc returns an associative array that corresponds to the 
        // fetched row or NULL if there are no more rows.
        // It does not make much of a difference here, but, e.g., if there are
        // multiple rows returned, you can iterate over those with a loop.
        $row = mysqli_fetch_assoc($result);
        $out_value = "The grade is: " . $row['grade'];
      }
      else {
        $out_value = "No grade available!";
      }
    }

    // Close SQL connection.
    $conn->close();
  ?>

  <!-- 
    HTML code for the form by which the user can query data.
    Note that we are using names (to pass values around in PHP) and not ids
    (which are for CSS styling or JavaScript functionality).
    You can leave the action in the form open 
    (https://stackoverflow.com/questions/1131781/is-it-a-good-practice-to-use-an-empty-url-for-a-html-forms-action-attribute-a)
  -->
  <form method="GET" action="">
  Username: <input type="text" name="username" placeholder="Enter username" /><br>
  Password: <input type="text" name="password" placeholder="Enter password" /><br>
  <input type="submit" name="submit" value="Submit"/>
 
  <p><?php 
    if(!empty($out_value)){
      echo $out_value;
    }
  ?></p>
  </form>
  <p>Don't have an account? <a href="register.php">Sign up</a></p>
  
</body>
</html>