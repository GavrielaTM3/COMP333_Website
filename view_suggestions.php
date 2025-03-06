<?php
$servername = "localhost";
$username = "root"; // Default XAMPP user
$password = ""; // Default XAMPP password (leave empty)
$dbname = "app-db"; // Your database name

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all suggestions from the database
$sql = "SELECT id, username, lesson_title, lesson_description FROM suggestions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Suggestions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Lesson Suggestions</h2>
<a href="suggest_form.html">Suggest a New Lesson</a>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Lesson Title</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['lesson_title']}</td>
                <td>{$row['lesson_description']}</td>
                <td>
                    <a href='view_suggestion.php?id={$row['id']}'>View</a>
                    <a href='update_suggestion.php?id={$row['id']}'>Update</a>
                    <a href='delete_suggestion.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No suggestions yet.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
