<?php

session_start();

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["role"] = $user["role"];

            header("Location: index.php");
            exit();

        } else {

            $message = "Incorrect password.";

        }

    } else {

        $message = "Account not found. Please register first.";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Tasty Bites</title>

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

        <p class="welcome">WELCOME BACK</p>

        <h1>Login to Tasty Bites </h1>

        <p class="auth-subtitle">
            Login to continue ordering your favourite food.
        </p>


        <?php if (!empty($message)) { ?>

            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <form method="POST" class="auth-form">

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
                placeholder="Enter your password"
                required
            >


            <button type="submit" class="btn">
                Login
            </button>

        </form>


        <p class="auth-link">

            Don't have an account?

            <a href="register.php">
                Register here
            </a>

        </p>

    </div>

</section>


<footer>

    <h3> Tasty Bites</h3>

    <p>
        Delicious food, happy moments.
    </p>

    <p>
        © 2026 Tasty Bites. All rights reserved.
    </p>

</footer>

</body>

</html>