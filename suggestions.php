<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app-db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch suggestions
$sql = "SELECT name, suggestion FROM suggestions ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions</title>
</head>
<body>
<div class="suggest">
    <h2>Submit Your Suggestions Here!!</h2>
    <form action="process_suggestions.php" method="POST">
        <label for="name">Name (Optional):</label>
        <input type="text" id="name" name="name">

        <label for="suggestion">Your Suggestion:</label>
        <textarea id="suggestion" name="suggestion" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

<!-- Display Submitted Suggestions -->
<div class="suggestions-list">
    <h2>Previous Suggestions</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Suggestion</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . (!empty($row["name"]) ? $row["name"] : "Anonymous") . "</td>";
                echo "<td>" . $row["suggestion"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No suggestions yet.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
