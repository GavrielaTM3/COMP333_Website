<?php
session_start();

// Check if user is logged in
$is_logged_in = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Website that teaches you how to code based on your interests." />
    <title>BlossomTech</title>
    <link rel="stylesheet" href="style.css?v=1">
</head>

<body>
    <!-- Navigation Bar -->
    <div id="navbar" class="navbar">
        <ul>
            <?php if ($is_logged_in): ?>
                <li><a href="view_suggestions.php">Suggestions</a></li>
            <?php endif; ?>

            <li><a href="#our-mission">Our Mission</a></li>
            <li><a href="#testimonials">Testimonials</a></li>
            <li><a href="#start-coding">Start Coding</a></li>

            <?php if ($is_logged_in): ?>
                <li style="color: #BED8D4;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="login.php" class="login-button">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Mission Section -->
    <div class="mission-text" id="our-mission">
        <h1>Welcome to BlossomTech</h1>
        <p>Our mission is to teach you how to code based on your interests! You will have a lot of fun coding and see that it is not that hard. Best of all, it's completely FREE because we believe everyone, regardless of background, should have the opportunity to learn how to code.</p>
    </div>

    <!-- Grid Container for Lessons -->
    <div class="grid-container" id="start-coding">
        <a href="biology_lesson.php" class="box">
            <img src="https://cdn.pixabay.com/photo/2013/07/18/10/55/dna-163466_1280.jpg" alt="Biology Image">
            <h3>Biology</h3>
        </a>

        <a href="fashion_lesson.php" class="box">
            <img src="https://cdn.pixabay.com/photo/2022/08/25/23/06/woman-7411414_1280.png" alt="Fashion Image">
            <h3>Fashion</h3>
        </a>

        <a href="sports_lesson.php" class="box">
            <img src="https://cdn.pixabay.com/photo/2025/01/28/09/32/rocket-9365225_1280.jpg" alt="Sports Image">
            <h3>Sports</h3>
        </a>

        <a href="photography_lesson.php" class="box">
            <img src="https://cdn.pixabay.com/photo/2014/12/29/08/29/lens-582605_1280.jpg" alt="Photography Image">
            <h3>Photography</h3>
        </a>
    </div>

    <!-- Testimonials Section -->
    <h2 class="testimonials-title" id="testimonials">What people are saying...</h2>

    <div class="testimonials">
        <div class="testimonial-card">
            <img src="https://images.pexels.com/photos/6248443/pexels-photo-6248443.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Diana">
            <div class="name">Diana Spenser</div>
            <div class="role">Grandmother</div>
            <p>"I am retired and wanted to learn how to code to help my grandkids with their homework."</p>
        </div>

        <div class="testimonial-card">
            <img src="https://images.pexels.com/photos/8421989/pexels-photo-8421989.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Richard">
            <div class="name">Richard Montero</div>
            <div class="role">Kindergarten Student</div>
            <p>"I learned to code to make video games that I now play with my friends."</p>
        </div>

        <div class="testimonial-card">
            <img src="https://images.pexels.com/photos/8124235/pexels-photo-8124235.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Sonia">
            <div class="name">Sonia Ramirez</div>
            <div class="role">CEO</div>
            <p>"After launching my startup, I wanted to learn to code so I could help out my web development team."</p>
        </div>
    </div>

    <!-- Sample Coding Challenge Section -->
    <div class="coding-section">
        <h2>Try a Sample Coding Challenge!</h2>
        <iframe src="sample_lesson.html" title="Sample Coding Challenge"></iframe>
    </div>

    <!-- Footer -->
    <footer>
        <p>This website was created for COMP333: Software Engineering at Wesleyan University as an exercise.</p>
    </footer>
</body>
</html>
