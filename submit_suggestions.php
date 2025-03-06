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
    $username = $_POST['username']; 
    $lesson_title = $_POST['lesson_title'];
    $lesson_description = $_POST['lesson_description'];
    $name = $_POST['name'];

    $sql = "INSERT INTO suggestions (username, lesson_title, lesson_description, name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $lesson_title, $lesson_description, $name);

    if ($stmt->execute()) {
        header("Location: suggestions.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions</title>
    <!-- Link to css file -->
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <!-- For css file -->
    <div class="suggest">  
        <h2>Submit Your Suggestions</h2>
        <form action="process_suggestions.php" method="POST">
     <!-- form -->        
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="lesson_title">Lesson Title:</label>
    <input type="text" id="lesson_title" name="lesson_title">

    <label for="lesson_description">Lesson Description:</label>
    <textarea id="lesson_description" name="lesson_description"></textarea>

    <label for="name">Name (Optional):</label>
    <input type="text" id="name" name="name">

    <button type="submit">Submit</button>
</form>
    </div>

</body>
</html>
