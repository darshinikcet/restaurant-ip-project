<?php

session_start();

$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Your Cart | Tasty Bites</title>

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

        <a href="cart.php"> Cart</a>

        <a href="login.php">Login</a>

    </nav>

</header>


<section class="cart-section">

    <div class="cart-container">

        <p class="welcome">YOUR CART</p>

        <h1>Ready to order? </h1>


        <?php if (empty($cart)) { ?>

            <div class="empty-cart">

                <div class="empty-icon"></div>

                <h2>Your cart is empty</h2>

                <p>
                    Looks like you haven't added anything yet.
                </p>

                <a href="menu.php" class="btn">
                    Explore Menu 
                </a>

            </div>

        <?php } else { ?>


            <div class="cart-items">

                <?php foreach ($cart as $id => $item) {

                    $subtotal =
                        $item['price'] * $item['quantity'];

                    $total += $subtotal;

                ?>

                    <div class="cart-item">

                        <div class="cart-food-icon">
                            
                        </div>

                        <div class="cart-food-info">

                            <h3>
                                <?php echo htmlspecialchars($item['name']); ?>
                            </h3>

                            <p>
                                ₹<?php echo number_format($item['price'], 2); ?>
                                ×
                                <?php echo $item['quantity']; ?>
                            </p>

                        </div>

                        <strong>

                            ₹<?php echo number_format($subtotal, 2); ?>

                        </strong>

                    </div>

                <?php } ?>

            </div>


            <div class="cart-total">

                <span>Total</span>

                <strong>
                    ₹<?php echo number_format($total, 2); ?>
                </strong>

            </div>


            <div class="cart-actions">

                <a href="menu.php" class="continue-btn">
                    ← Continue Shopping
                </a>

                <a href="checkout.php" class="btn">
                    Checkout →
                </a>

            </div>


        <?php } ?>

    </div>

</section>


<footer>

    <h3>Tasty Bites</h3>

    <p>
        Delicious food, happy moments.
    </p>

</footer>

</body>

</html>