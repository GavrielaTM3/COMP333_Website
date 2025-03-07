<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. No suggestion ID provided.");
}

$id = $_GET['id'];

// Prepare delete statement
$sql = "DELETE FROM learning_preferences WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view_suggestions.php?message=Deleted successfully");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
