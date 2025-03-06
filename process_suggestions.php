<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $suggestion = $_POST['suggestion'];

    $sql = "INSERT INTO suggestions (name, suggestion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $suggestion);

    if ($stmt->execute()) {
        header("Location: suggestions.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>