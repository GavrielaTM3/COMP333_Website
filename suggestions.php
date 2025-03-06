<?php
session_start();
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
    <h2>What lesson would you like to see on our website?</h2>
        <label for="name">Name (Optional):</label>
        <input type="text" id="name" name="name">

        <label for="suggestion">Your Suggestion:</label>
        <textarea id="suggestion" name="suggestion" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>


/* line 16: < form action="process_suggestions.php" method="POST">*/