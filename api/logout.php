<?php
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo json_encode(['success' => false, 'error' => 'Only POST method allowed']);
    exit;
}

session_unset();
session_destroy();

http_response_code(201);
echo json_encode(['success' => true, 'message' => 'Logged out']);
