<?php
header('Content-Type: application/json');
session_start();

// Checks if user is signed in 
if (isset($_SESSION['username'])) {
    echo json_encode([
        'success' => true,
        'username' => $_SESSION['username']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
}
