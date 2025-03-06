<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all entries from the learning_preferences table
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
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['coding_concept']}</td>
                <td>{$row['theme']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No learning preferences submitted yet.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
