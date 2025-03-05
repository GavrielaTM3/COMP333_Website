<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h2>Submit Your Suggestions</h2>
    <form action="process_suggestions.php" method="POST">
        <label for="name">Name (Optional):</label>
        <input type="text" id="name" name="name">

        <label for="suggestion">Your Suggestion:</label>
        <textarea id="suggestion" name="suggestion" required></textarea>

        <button type="submit">Submit</button>
    </form>
</body>
</html>