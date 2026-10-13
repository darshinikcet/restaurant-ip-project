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


$user_id = $_SESSION["user_id"];



$total = 0;

foreach ($cart as $item) {

    $total += $item["price"] * $item["quantity"];

}


// Start database transaction
$conn->begin_transaction();

try {

    // Insert order
    $sql = "INSERT INTO orders
            (user_id, total_amount, order_status)
            VALUES (?, ?, 'Pending')";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "id",
        $user_id,
        $total
    );

    $stmt->execute();


    // Get newly created order ID
    $order_id = $conn->insert_id;


    // Insert order items
    $item_sql = "INSERT INTO order_items
                 (order_id, food_id, quantity, price)
                 VALUES (?, ?, ?, ?)";

    $item_stmt = $conn->prepare($item_sql);


    foreach ($cart as $food_id => $item) {

        $quantity = $item["quantity"];
        $price = $item["price"];

        $item_stmt->bind_param(
            "iiid",
            $order_id,
            $food_id,
            $quantity,
            $price
        );

        $item_stmt->execute();

    }


    $conn->commit();



    unset($_SESSION["cart"]);


} catch (Exception $e) {

    $conn->rollback();

    die("Order failed. Please try again.");

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Successful | Tasty Bites</title>

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

        <a href="logout.php">Logout</a>

    </nav>

</header>


<section class="success-section">

    <div class="success-card">

        <div class="success-icon">
            
        </div>

        <p class="welcome">
            ORDER CONFIRMED
        </p>

        <h1>
            Your order is on its way! 
        </h1>

        <p>
            Thank you for ordering from Tasty Bites.
            Your food will be prepared shortly.
        </p>

        <div class="order-number">

            Order ID:
            <strong>
                #<?php echo $order_id; ?>
            </strong>

        </div>

        <div class="success-total">

            Total Amount:
            <strong>
                ₹<?php echo number_format($total, 2); ?>
            </strong>

        </div>

        <a href="menu.php" class="btn">
            Order More 
        </a>

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