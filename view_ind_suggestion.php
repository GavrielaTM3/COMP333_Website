<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";
session_start(); // Ensure session is started

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. No suggestion ID provided.");
}

$id = $_GET['id'];

// Fetch the specific learning preference
$sql = "SELECT id, username, coding_concept, theme FROM learning_preferences WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Suggestion not found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Learning Preference</title>
    <p style="color: black;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
            border: 1px solid black;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 2px 2px 10px gray;
        }
        h2 {
            text-align: center;
        }
        p {
            font-size: 18px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Learning Preference Details</h2>
    <p><strong>ID:</strong> <?php echo $row['id']; ?></p>
    <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
    <p><strong>Coding Concept:</strong> <?php echo $row['coding_concept']; ?></p>
    <p><strong>Theme:</strong> <?php echo $row['theme']; ?></p>
    
    <a href="view_suggestions.php">Back to List</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
