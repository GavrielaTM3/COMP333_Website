<?php
session_start(); // Ensure session is started

require_once './db.php';


if (!isset($_GET['id'])) {
    die("Invalid request.");
}
// Sanitize input to prevent SQL injection
$id = intval($_GET['id']); 

// Fetch the existing suggestion
$sql = "SELECT * FROM learning_preferences WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("No suggestion found.");
}

$row = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; 
    $coding_concept = $_POST['coding_concept']; // Updated field name
    $theme = $_POST['theme']; // Updated field name
    $sql = "UPDATE learning_preferences SET coding_concept = ?, theme = ? WHERE id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $coding_concept, $theme, $id, $username); 


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
    <title>Update Learning Preferences</title>
    <link rel="stylesheet" href="style.css">
    <p style="color: black;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        
</head>
<body>

    <div class="suggest">  
        <h2>Update Your Learning Preferences</h2>
        <form action="update_suggestions.php?id=<?php echo $id; ?>" method="POST">
            <label for="username">Username:</label>
            <p style="color: black;"> <?php echo htmlspecialchars($_SESSION['username']); ?></p>

            <label for="coding_concept">Coding Concept:</label> <!-- Updated field -->
            <input type="text" id="coding_concept" name="coding_concept" value="<?php echo htmlspecialchars($row['coding_concept']); ?>" required>

            <label for="theme">Theme:</label> <!-- Updated field -->
            <textarea id="theme" name="theme" required><?php echo htmlspecialchars($row['theme']); ?></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
