<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

require_once '../db.php'; // Make sure this is clean, which you now have ✅

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
    exit;
}

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$username = $_SESSION['username'];

// Read the raw POST data
$input = json_decode(file_get_contents('php://input'), true);
$lesson = $input['lesson'] ?? '';

$allowed_lessons = ['sports1', 'sports2', 'fashion'];
if (!in_array($lesson, $allowed_lessons)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid lesson']);
    exit;
}

// Check if the lesson is already completed
$sql = "SELECT $lesson FROM points WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'User record not found']);
    exit;
}

if ($row[$lesson]) {
    // Lesson already completed
    echo json_encode(['success' => false, 'message' => 'Lesson already completed']);
    exit;
}

// Update the lesson to TRUE and add 50 points
$update_sql = "UPDATE points SET $lesson = TRUE, points = points + 50 WHERE username = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("s", $username);

if ($update_stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '✅ 50 points added and lesson marked complete!']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Update failed']);
}
?>
