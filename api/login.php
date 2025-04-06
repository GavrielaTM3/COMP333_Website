<?php
header('Content-Type: application/json');
session_start();
require_once '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Only POST method is allowed']);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['username'], $input['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing username or password']);
    exit;
}

$username = $input['username'];
$password = $input['password'];

$sql = "SELECT password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $username;
    echo json_encode(['success' => true, 'username' => $username]);
} else {
    http_response_code(401); // Unauthorized
    echo json_encode(['success' => false, 'error' => 'Invalid login credentials']);
}

$conn->close();
