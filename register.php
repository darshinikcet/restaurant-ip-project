<?php

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($password)) {

        $message = "Please fill in all fields.";

    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password)
                VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sss",
            $name,
            $email,
            $hashed_password
        );

        if ($stmt->execute()) {

            $message = "Registration successful! You can now login.";

        } else {

            $message = "Email already exists or registration failed.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Tasty Bites</title>

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
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="cart.php"> Cart</a>

    </nav>

</header>


<section class="auth-section">

    <div class="auth-container">

        <p class="welcome">JOIN TASTY BITES</p>

        <h1>Create your account </h1>

        <p class="auth-subtitle">
            Register now and enjoy easy online food ordering.
        </p>


        <?php if (!empty($message)) { ?>

            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <form method="POST" class="auth-form">

            <label>Name</label>

            <input
                type="text"
                name="name"
                placeholder="Enter your name"
                required
            >


            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >


            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Create a password"
                required
            >


            <button type="submit" class="btn">
                Create Account
            </button>

        </form>


        <p class="auth-link">
            Already have an account?
            <a href="login.php">Login here</a>
        </p>

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