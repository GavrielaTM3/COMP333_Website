<?php
session_start(); // Ensure session is started

require_once './db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; 
    $coding_concept = $_POST['coding_concept']; // Updated field name
    $theme = $_POST['theme']; // Updated field name

    $sql = "INSERT INTO learning_preferences (username, coding_concept, theme) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $coding_concept, $theme);

    if ($stmt->execute()) {
        header("Location: view_suggestions.php"); // Redirect after submission
        exit();
    } else {
        echo "Error: " . $conn->error;
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
    <link rel="stylesheet" href="style.css">
    <p style="color: black;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        
</head>
<body>

    <div class="suggest">  
        <h2>Submit Your Learning Preferences</h2>
        <form action="submit_suggestions.php" method="POST">
            <label for="username">Username:</label>
            <p style="color: black;"> <?php echo htmlspecialchars($_SESSION['username']); ?></p>

            <label for="coding_concept">Coding Concept:</label> <!-- Updated field -->
            <input type="text" id="coding_concept" name="coding_concept" required>

            <label for="theme">Theme:</label> <!-- Updated field -->
            <textarea id="theme" name="theme" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
