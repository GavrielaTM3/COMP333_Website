<?php
session_start(); // Start session

// Check if user is logged in
$is_logged_in = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<meta name="description" content="Website that teaches you how to code based on your interests.">
<html lang="en">
 
  <head>
   
    <meta charset="utf-8" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
   
    <title>Blossom Tech</title>
   
    <link rel="stylesheet" href="style.css" />
  </head>

 <!-- Nav bar --> 
<body>
<div id="navbar" class="navbar">
    <ul>
      <li><a href="#our-mission">Our Mission</a></li>
      <li><a href="#testimonials">Testimonials</a></li>
      <li><a href="#start-coding">Start Coding</a></li>
      <li><a href="suggestions.php">Suggestions</a></li> 
    </ul>
    <?php if ($is_logged_in): ?>
            <li style="color: #BED8D4;">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
            <li><a href="logout.php">Log Out</a></li>
        <?php else: ?>
            <li><a href="login.php" class="login-button">Login</a></li>
        <?php endif; ?>
  
  </div>
 

<!-- Mission box --> 
  <div class="mission-text"> 
    <section id="our-mission"> 
    <h1 id="welcome">Welcome to BlossomTech</h1>
    <p > Our mission is to teach you how to code based on your interests! You will have a lot of fun coding and see that it is not that hard. Best of all, our website is completely FREE because we believe everyone, regardless of their background, should have the opportunity to learn how to code</p>

  </div>

    <div class="main-content">
   
        <h1 class="start-coding">Start your first coding lesson for FREE!</h1>
        <div class="container">
            <a href="#" class="box">
                <img src="https://cdn.pixabay.com/photo/2013/07/18/10/55/dna-163466_1280.jpg" alt="DNA">
                <h3>Biology</h3>
            </a>
            
            <a href="#" class="box">
                <img src="https://cdn.pixabay.com/photo/2022/08/25/23/06/woman-7411414_1280.png" alt="Dress">
                <h3>Fashion</h3>
            </a>
            
            <a href="#" class="box">
                <img src="https://cdn.pixabay.com/photo/2025/01/28/09/32/rocket-9365225_1280.jpg" alt="Tennis">
                <h3>Sports</h3>
            </a>
            
            <a href="#" class="box">
                <img src="https://cdn.pixabay.com/photo/2014/12/29/08/29/lens-582605_1280.jpg" alt="Lens">
                <h3>Photography</h3>
            </a>
        </div>
    </div>
    <!-- Testimonials --> 
    <div> 
      <section id="testimonials"> 
      <h1 class="testimonials-title">What people are saying...</h1>
    
    
    </div>

    <div class="testimonials">
      <img src="https://images.pexels.com/photos/6248443/pexels-photo-6248443.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Avatar" >
      <div class="testimonial-text">
      <p><span>Diana Spenser</span> Grandmother</p>
      <p>"I am retired and wanted to learn how to code to help my grandkids with their homework."</p>
    </div>
  </div>

    <div class="testimonials">
      <img src=https://images.pexels.com/photos/8421989/pexels-photo-8421989.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Avatar" >
      <div class="testimonial-text">
      <p><span>Richard Montero</span> Kindergarten student</p>
      <p>"I learned to code to make video games that I now play with my friends."</p>
    </div>
  </div>

    <div class="testimonials">
      <img src="https://images.pexels.com/photos/8124235/pexels-photo-8124235.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Avatar">
      <div class="testimonial-text">
      <p><span>Sonia Ramirez</span> CEO</p>
      <p>"After launching my startup, I wanted to learn to code so I could help out my web development team."</p>
    </div>
  </div>

    <section id="start-coding"> 

    <div class="iframe-container">
      <div class="iframe-title">
        <p id="challenge_title">Check out this sample coding challenge:</p></div>
          <iframe src="sample_lesson.html" width="600" height="400" style="border:1px solid #ccc;" title="Sample Coding Challenge"></iframe>
    </div>

</body>

<footer>
  <p>This is a website created for COMP333: Software Engineering at Wesleyan University. This is an exercise.</p>
</footer>
