<?php

session_start();

include "db.php";

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM orders
        WHERE user_id = ?
        ORDER BY order_date DESC";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders | Tasty Bites</title>

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

        <a href="my_orders.php">My Orders</a>

        <span class="user-welcome">

            Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?> 

        </span>

        <a href="logout.php">Logout</a>

    </nav>

</header>


<section class="orders-section">

    <div class="orders-container">

        <p class="welcome">
            ORDER HISTORY
        </p>

        <h1>
            My Orders 
        </h1>

        <p class="orders-subtitle">
            Here you can view all your previous orders.
        </p>


        <?php if ($result->num_rows > 0) { ?>


            <div class="orders-list">


                <?php while ($order = $result->fetch_assoc()) { ?>


                    <div class="order-card">

                        <div class="order-header">

                            <div>

                                <span class="order-label">
                                    Order ID
                                </span>

                                <h3>
                                    #<?php echo $order["id"]; ?>
                                </h3>

                            </div>


                            <span class="status">

                                <?php echo htmlspecialchars(
                                    $order["order_status"]
                                ); ?>

                            </span>

                        </div>


                        <div class="order-details">

                            <div>

                                <span>
                                    Order Date
                                </span>

                                <strong>

                                    <?php echo date(
                                        "d M Y, h:i A",
                                        strtotime($order["order_date"])
                                    ); ?>

                                </strong>

                            </div>


                            <div>

                                <span>
                                    Total Amount
                                </span>

                                <strong class="order-price">

                                    ₹<?php echo number_format(
                                        $order["total_amount"],
                                        2
                                    ); ?>

                                </strong>

                            </div>

                        </div>

                    </div>


                <?php } ?>


            </div>


        <?php } else { ?>


            <div class="no-orders">

                <div class="empty-icon">
                    
                </div>

                <h2>
                    No orders yet
                </h2>

                <p>
                    Your previous orders will appear here.
                </p>

                <a href="menu.php" class="btn">
                    Explore Menu 
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

    <p>
        © 2026 Tasty Bites. All rights reserved.
    </p>

</footer>


</body>

</html>