<?php
header('Content-Type: application/json');
session_start();
// Connect to backend DB
require_once '../db.php';

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$input = json_decode(file_get_contents("php://input"), true);

// GET
if ($method === 'GET') {
    if ($id) {
        $stmt = $conn->prepare("SELECT * FROM learning_preferences WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pref = $result->fetch_assoc();
        echo json_encode($pref);
    } else {
        $result = $conn->query("SELECT * FROM learning_preferences");
        $prefs = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($prefs);
    }
}

// POST
elseif ($method === 'POST') {
    if (!isset($input['username'], $input['coding_concept'], $input['theme'])) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "Missing required fields"]);
        exit;
    }

    $username = $input['username'];
    $concept = $input['coding_concept'];
    $theme = $input['theme'];

    $stmt = $conn->prepare("INSERT INTO learning_preferences (username, coding_concept, theme) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $concept, $theme);
    $stmt->execute();
    echo json_encode(["success" => true, "id" => $stmt->insert_id]);
}

// PUT
elseif ($method === 'PUT' && $id) {
    if (!isset($input['username'], $input['coding_concept'], $input['theme'])) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "Missing required fields"]);
        exit;
    }

    $username = $input['username'];
    $concept = $input['coding_concept'];
    $theme = $input['theme'];

    $stmt = $conn->prepare("UPDATE learning_preferences SET username = ?, coding_concept = ?, theme = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $concept, $theme, $id);
    $stmt->execute();
    echo json_encode(["success" => true]);
}

// DELETE
elseif ($method === 'DELETE' && $id) {
    $stmt = $conn->prepare("DELETE FROM learning_preferences WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo json_encode(["success" => true]);
}

else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed or missing ID"]);
}

$conn->close();
