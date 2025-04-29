<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './db.php';

// Get all suggestions
$sql = "SELECT id, username, coding_concept, theme FROM learning_preferences";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css?v=1">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Preferences</title>
    <style>
        .page-container {
            padding: 40px;
            max-width: 1000px;
            margin: 0 auto;
            color: #222;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff; /* Make heading visible on dark background */
            font-size: 28px;
}


        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .action-buttons button {
            margin: 5px;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            border: none;
        }

        .home-btn {
            background-color: #007bff;
            color: white;
        }

        .submit-btn {
            background-color: #28a745;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #BED8D4;
        }

        td a {
            color: #007bff;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .no-data {
            text-align: center;
            color: #666;
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div id="navbar" class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="submit_suggestions.php"> Submit New Preference</a></li>
            <li style="color: #BED8D4;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

    <div class="page-container">
        <h2>Learning Preferences</h2>

        <div class="action-buttons">


            <a href="submit_suggestions.php">
                <button class="submit-btn">Submit New Preference</button>
            </a>
        </div>

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
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars($row['coding_concept']) . "</td>
                        <td>" . htmlspecialchars($row['theme']) . "</td>
                        <td>
                            <a href='view_ind_suggestion.php?id={$row['id']}'>View</a>";
                    if ($_SESSION['username'] === $row['username']) {
                        echo " | <a href='update_suggestions.php?id={$row['id']}'>Update</a> 
                               | <a href='delete_suggestion.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this?\")'>Delete</a>";
                    }
                    echo "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-data'>No learning preferences submitted yet.</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>This website was created for COMP333: Software Engineering at Wesleyan University as an exercise.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
