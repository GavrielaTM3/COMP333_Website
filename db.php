<?php
// db.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500); // optional: send a 500 response to client
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}
?>
