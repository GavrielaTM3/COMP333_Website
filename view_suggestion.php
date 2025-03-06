<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM suggestions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$suggestion = $result->fetch_assoc();

if (!$suggestion) {
    echo "Suggestion not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Suggestion</title>
</head>
<body>

<h2>Suggestion Details</h2>
<p><strong>Username:</strong> <?php echo htmlspecialchars($suggestion['username']); ?></p>
<p><strong>Lesson Title:</strong> <?php echo htmlspecialchars($suggestion['lesson_title']); ?></p>
<p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($suggestion['lesson_description'])); ?></p>

<a href="view_suggestions.php">Back to Suggestions</a>

</body>
</html>
