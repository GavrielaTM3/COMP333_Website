<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

// Make sure you have database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get  entries from the learning_preferences table
$sql = "SELECT id, username, coding_concept, theme FROM learning_preferences";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Preferences</title>
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

<h2>Learning Preferences</h2>
<a href="submit_suggestions.php">Submit New Preference</a>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Coding Concept</th>
        <th>Theme</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['coding_concept']}</td>
                <td>{$row['theme']}</td>
                <td>
                    <a href='view_suggestion.php?id={$row['id']}'>View</a> | 
                    <a href='update_suggestion.php?id={$row['id']}'>Update</a> | 
                    <a href='delete_suggestion.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this?\")'>Delete</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No learning preferences submitted yet.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
