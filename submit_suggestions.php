<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './db.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; 
    $coding_concept = $_POST['coding_concept'];
    $theme = $_POST['theme'];

    $sql = "INSERT INTO learning_preferences (username, coding_concept, theme) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $username, $coding_concept, $theme);
        if ($stmt->execute()) {
            header("Location: view_suggestions.php"); // Redirect after successful submission
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Learning Preferences</title>
    <link rel="stylesheet" href="style.css?v=1">
    <style>
     
    /* Add this custom CSS */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .form-box {
        background-color: #ffffff; /* true white */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        color: #222222; /* DARK text */
    }

    .form-box h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #222222;
    }

    .form-box form {
        display: flex;
        flex-direction: column;
    }

    .form-box label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #222222;
    }

    .form-box input,
    .form-box textarea {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #222;
        background-color: #fff;
    }

    .form-box input::placeholder,
    .form-box textarea::placeholder {
        color: #888;
    }

    .form-box button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-box button:hover {
        background-color: #45a049;
    }

    .form-box a {
        text-decoration: none;
        color: #333;
        margin-bottom: 20px;
        display: block;
        text-align: center;
        font-weight: bold;
    }
</style>

</head>

<body>
    <!-- Navigation Bar -->
    <div id="navbar" class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="view_suggestions.php">Suggestions</a></li>
            <li style="color: #BED8D4;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

    <!-- Centered Form Section -->
    <div class="form-container">
        <div class="form-box">
            <h2>Submit Your Learning Preferences</h2>

            <a href="index.php">Back to Home</a>

            <form action="submit_suggestions.php" method="POST">
                <label for="coding_concept">Coding Concept:</label>
                <input type="text" id="coding_concept" name="coding_concept" required>

                <label for="theme">Theme:</label>
                <textarea id="theme" name="theme" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>This website was created for COMP333: Software Engineering at Wesleyan University as an exercise.</p>
    </footer>
</body>
</html>
