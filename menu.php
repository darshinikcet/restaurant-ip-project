
<?php
include "db.php";

$sql = "SELECT * FROM food_items WHERE available = TRUE ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menu | Tasty Bites</title>

</head>

<body>

    <h1>Tasty Bites</h1>

    <nav>

        <a href="index.php">Home</a> |
        <a href="menu.php">Menu</a> |
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a> |
        <a href="cart.php">Cart</a>

    </nav>

    <hr>

    <h2>OUR MENU</h2>

    <p>Choose your favourite food and enjoy a tasty meal.</p>

    <table border="1" cellpadding="15" cellspacing="10">

        <?php

        $count = 0;

        if ($result && $result->num_rows > 0) {

            while ($food = $result->fetch_assoc()) {

                if ($count % 2 == 0) {
                    echo "<tr>";
                }

        ?>

                <td width="400">

                    <?php if (!empty($food['image'])) { ?>

                        <a href="food_details.php?id=<?php echo $food['id']; ?>">

                            <img
                                src="Images/<?php echo htmlspecialchars($food['image']); ?>"
                                alt="<?php echo htmlspecialchars($food['name']); ?>"
                                width="350"
                                height="220"
                            >

                        </a>

                    <?php } ?>

                    <h3>

                        <a href="food_details.php?id=<?php echo $food['id']; ?>">

                            <?php
                            echo htmlspecialchars($food['name']);
                            ?>

                        </a>

                    </h3>

                    <p>

                        Category:
                        <?php
                        echo htmlspecialchars($food['category']);
                        ?>

                    </p>

                    <p>

                        <?php
                        echo htmlspecialchars($food['description']);
                        ?>

                    </p>

                    <p>

                        <b>

                            ₹<?php
                            echo number_format($food['price'], 2);
                            ?>

                        </b>

                    </p>

                    <form action="add_to_cart.php" method="POST">

                        <input
                            type="hidden"
                            name="food_id"
                            value="<?php echo $food['id']; ?>"
                        >

                        <button type="submit">
                            + Add
                        </button>

                    </form>

                </td>

        <?php

                $count++;

                if ($count % 2 == 0) {
                    echo "</tr>";
                }

            }

            if ($count % 2 != 0) {
                echo "</tr>";
            }

        } else {

            echo "<tr>";
            echo "<td>No food items available.</td>";
            echo "</tr>";

        }

        ?>

    </table>

    <hr>

    <h3>Tasty Bites</h3>

    <p>Delicious food, happy moments.</p>

    <p>© 2026 Tasty Bites. All rights reserved.</p>

</body>

</html>

