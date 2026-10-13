<?php

session_start();
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tasty Bites | Online Restaurant</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="navbar">

        <div class="logo">
            Tasty Bites
        </div>

        <nav>

    <a href="index.php">Home</a>

    <a href="menu.php">Menu</a>

    <a href="cart.php">Cart</a>

    <?php if (isset($_SESSION["user_id"])) { ?>

        <span class="user-welcome">
            Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?> 
        </span>


    <?php } else { ?>

        <a href="login.php">Login</a>

        <a href="register.php">Register</a>

    <?php } ?>

</nav>

    </header>



    <section class="hero">

        <div class="hero-content">

            <p class="welcome">WELCOME TO TASTY BITES</p>

            <h1>
                Good Food.
                <br>
                Good Mood. 
            </h1>

            <p>
                Freshly prepared meals, delicious flavours
                and a little happiness delivered to your door.
            </p>

            <a href="menu.php" class="btn">
                Explore Our Menu 
            </a>

        </div>

    </section>


    <section class="about">

        <h2>Why Choose Tasty Bites?</h2>

        <p>
            We believe good food should be simple, fresh and enjoyable.
            Choose your favourite dishes and order them easily online.
        </p>

        <div class="features">

            <div class="feature-card">
                <div class="icon"></div>
                <h3>Fresh Ingredients</h3>
                <p>We prepare our dishes using fresh ingredients.</p>
            </div>

            <div class="feature-card">
                <div class="icon"></div>
                <h3>Made With Care</h3>
                <p>Every meal is prepared with care and attention.</p>
            </div>

            <div class="feature-card">
                <div class="icon"></div>
                <h3>Easy Ordering</h3>
                <p>Choose your food and place your order easily.</p>
            </div>

        </div>

    </section>


    <footer>

        <h3>Tasty Bites</h3>

        <p>
            Delicious food, happy moments.
        </p>

        <p>
            © 2026 Tasty Bites. All rights reserved.
        </p>

    </footer>

</body>

</html>