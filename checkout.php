<?php

session_start();

include "db.php";


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}


$cart = $_SESSION["cart"] ?? [];


if (empty($cart)) {

    header("Location: cart.php");
    exit();

}


$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout | Tasty Bites</title>

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

        <a href="cart.php">🛒 Cart</a>

        <span class="user-welcome">
            Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?> 
        </span>

        <a href="logout.php">Logout</a>

    </nav>

</header>


<section class="checkout-section">

    <div class="checkout-container">

        <p class="welcome">CHECKOUT</p>

        <h1>Review your order </h1>


        <div class="checkout-card">

            <h2>Your Order</h2>


            <?php foreach ($cart as $id => $item) {

                $subtotal =
                    $item["price"] * $item["quantity"];

                $total += $subtotal;

            ?>

                <div class="checkout-item">

                    <div>

                        <h3>
                            <?php echo htmlspecialchars($item["name"]); ?>
                        </h3>

                        <p>
                            ₹<?php echo number_format($item["price"], 2); ?>
                            ×
                            <?php echo $item["quantity"]; ?>
                        </p>

                    </div>

                    <strong>
                        ₹<?php echo number_format($subtotal, 2); ?>
                    </strong>

                </div>

            <?php } ?>


            <div class="checkout-total">

                <span>Total Amount</span>

                <strong>
                    ₹<?php echo number_format($total, 2); ?>
                </strong>

            </div>


            <form action="place_order.php" method="POST">

                <input
                    type="hidden"
                    name="total_amount"
                    value="<?php echo $total; ?>"
                >

                <button type="submit" class="btn order-btn">
                    Place Order 
                </button>

            </form>

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