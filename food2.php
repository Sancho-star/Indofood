<?php
echo"begins";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indofood - Indian Food Delights</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        /* Styles for the authentication links */
        .auth-links a {
    display: flex;
    align-items: center; /* Centers icons/text vertically */
    gap: 8px; /* Adds space between icon and text */
    text-decoration: none;
    background-color: #c94d20; /* Cool teal color */
    color: rgb(255, 255, 255);
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold; /* Bold text */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds slight shadow */
}

.auth-links a:hover {
    background-color: #17a5a0; /* Slightly darker teal on hover */
    transform: translateY(-3px); /* Lifts button slightly */
    box-shadow: 0 6px 12px rgba(62, 9, 207, 0.2); /* Enhanced shadow on hover */
}

.auth-links a:active {
    transform: translateY(0); /* Resets button position on click */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Resets shadow */
}

.auth-links a i {
    font-size: 16px; /* Adjust icon size */
}

.tooltip {
    position: absolute;
    background-color: rgba(255, 255, 255, 0.9); /* Light semi-transparent white background */
    color: #333; /* Dark gray text for contrast */
    padding: 5px;
    border-radius: 4px;
    font-size: 12px;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s;
}

.auth-links a:hover .tooltip {
    visibility: visible;
    opacity: 1;
    transform: translateY(-5px); /* Tooltip appears slightly above */
}
</style>
</head>
<body>
    <!-- Include header -->
    <h1>Welcome to My INDOFOOD</h1>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Signup/Login Links (top-right corner) -->

<header>
    <nav>
        <ul>
            <li><a href="index.php">
            <a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#feedback">Feedback</a></li>
            <li> <a href="#recipes">Recipes</a></li> 

       <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<section id="home">
    <h2>Welcome to our foodworld</h2>
    <iframe src="ongoing.html" width="100%" height="320px" frameborder="0"></iframe> <!-- Embed the ongoing.php page here -->
</section>
<!-- Include home section -->
<section id="home"></section>
    <h2>Discover the Flavors of India</h2>
    <p>
        Indian cuisine is known for its rich flavors, diverse spices, and vibrant dishes. From the tangy street food of Delhi to the spicy curries of Kerala, each dish tells a story of culture, tradition, and passion for food. Welcome to Indofood, where we bring the essence of India’s culinary delights to your table. Whether you’re a foodie or just looking to explore new tastes, our recipes and stories will take you on a flavorful journey across India.
    </p>
    <p>"Welcome to the vibrant world of Indofood! Explore the rich and diverse flavors of Indian cuisine, from aromatic curries to tantalizing street food. Get ready to embark on a culinary journey that will delight your senses and leave you craving for more. Join us in celebrating the exquisite tastes of India at Indofood!"</p>
</section>
<section id="recipes">
     <iframe src="recipefinder.html" width="100%" height="400px" frameborder="0"></iframe> <!-- Embed the ongoing.php page here -->
</section>
<!-- Include recipes section -->
<section id="home">
    <h2>Featured Recipes</h2>
    <div class="recipe-grid">
        <!-- Recipe Card 1 -->
        <div class="recipe-card">
            <img src="samosa.png" alt="Samosa">
            <h3>SAMOSA</h3>
            <p>A crispy pastry filled with spicy potatoes and peas.</p>
            <a href="#">Read More</a>
        </div>

        <!-- Recipe Card 2 -->
        <div class="recipe-card">
            <img src="dosa.png" alt="Dosa">
            <h3>DOSA</h3>
            <p>A crispy South Indian crepe made with fermented rice batter.</p>
            <a href="#">Read More</a>
        </div>

        <!-- Recipe Card 3 -->
        <div class="recipe-card">
            <img src="panipuri.jpg" alt="Panipuri">
            <h3>PANIPURI</h3>
            <p>Popular street food filled with tangy tamarind water and peas.</p>
            <a href="#">Read More</a>
        </div>
    </div>
</section>

<!-- Include feedback section -->
<section id="feedback"></section>
    <h2>Leave Your Feedback</h2>
    <form action="submit_feedback.php" method="post">
        <textarea name="feedback" rows="5" placeholder="Enter your feedback..."></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
</section>

<!-- Include about section -->
<section id="about"></section>
    <h2>About Indofood</h2>
    <p>
        Hi, I’m Sancho-star, and I created Indofood to share my love for Indian cuisine with the world. I chose this topic because Indian food is more than just a meal—it's an experience that brings people together through its variety of flavors, spices, and history. Cooking is my passion, and through this website, I hope to inspire you to try these unique recipes and learn more about Indian culture through its food.
    </p>
</section>


</body>
</html>
