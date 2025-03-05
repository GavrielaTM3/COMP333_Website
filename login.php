<!-- 
 login.php file which allows the user to login to BlossomTech
-->

<!DOCTYPE HTML>
<html lang="en">
<head>
  <h1>Welcome to BlossomTech!</h1>
  <link rel="stylesheet" href="style.css" />

  <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
  <title>Login</title>
</head>

<body>
  <?php
    // Start session
     session_start(); 

    // running MySQL server with default setting (user 'root' with no password).
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "app-db";
    $error_msg = "";

    // Create server connection.
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check server connection.
    if ($conn->connect_error) {
      // Exit with the error message.
      // . is used to concatenate strings.
      die("Connection failed: " . $conn->connect_error);
    }
    // `isset` — Function to determine if a variable is declared and is different than null.
  
    if(isset($_POST["submit"])){
      // Variables for the output and the web form below.
      $out_value = "";
      $s_user = $_POST['username'];
      $s_pass = $_POST['password'];
      //$hashed_password = password_hash($s_pass, PASSWORD_DEFAULT);

  
      // The following is the core part of this script where we connect PHP
      // and SQL.
      // Check that the user entered data in the form.
      if(!empty($s_user) && !empty($s_pass)){
        // If so, prepare SQL query with the data to query the database.
        $sql_query = "SELECT password FROM users WHERE username = (?)";
        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("s", $s_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $pass = $row['password'];
        // Send the query and obtain the result.
        // mysqli_query performs a query against the database.
        if(password_verify($s_pass, $pass)) {
          // If the password inputs matched the hashed password in the database
          //Log user in.
          $_SESSION['username'] = $s_user; // Store username in session
          header("Location: index.php"); // Redirect to home page
          exit();
        } 
        else{
          $error_msg = "Invalid login credientials - please try again";
        }
        // mysqli_fetch_assoc returns an associative array that corresponds to the 
        // fetched row or NULL if there are no more rows.
        // It does not make much of a difference here, but, e.g., if there are
        // multiple rows returned, you can iterate over those with a loop.
      }
      else {
       echo "Fill out the form";
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
  <form method="POST" action="">
  Username: <input type="text" name="username" placeholder="Enter username" required/><br>
  Password: <input type="password" name="password" placeholder="Enter password" required/><br>
  <input type="submit" name="submit" value="Submit"/>
  <?php if (!empty($error_msg)) : ?>
        <p style="color: red;"><?php echo $error_msg; ?></p>
  <?php endif; ?>

  </form>
  <p>Don't have an account? <a href="register.php">Sign up</a></p>
  
</body>
</html>