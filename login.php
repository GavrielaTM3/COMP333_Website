<?php
session_start();
require_once './db.php';

// Handle form submission
if (isset($_POST["submit"])) {
    $s_user = $_POST['username'];
    $s_pass = $_POST['password'];

    if (!empty($s_user) && !empty($s_pass)) {
        $sql_query = "SELECT password FROM users WHERE username = ?";
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
            $error_msg = "Invalid login credentials - please try again.";
        }
    } else {
        $error_msg = "Please fill out the form.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Website that teaches you how to code based on your interests." />
    <title>Login | BlossomTech</title>
    <link rel="stylesheet" href="style.css?v=1">
</head>

<body>
    <!-- Navbar -->
    <div id="navbar" class="navbar">
        <ul>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="view_suggestions.php">Suggestions</a></li>
            <?php endif; ?>
            <li><a href="index.php#our-mission">Our Mission</a></li>
            <li><a href="index.php#testimonials">Testimonials</a></li>
            <li><a href="index.php#start-coding">Start Coding</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <li style="color: #BED8D4;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="login.php" class="login-button">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Login Form Container -->
    <div class="login-container">
        <h1>Login to BlossomTech</h1>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter username" required />

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter password" required />

            <input type="submit" name="submit" value="Submit" />

            <?php if (!empty($error_msg)): ?>
                <p class="error-msg"><?php echo $error_msg; ?></p>
            <?php endif; ?>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>This website was created for COMP333: Software Engineering at Wesleyan University as an exercise.</p>
    </footer>
</body>
</html>
