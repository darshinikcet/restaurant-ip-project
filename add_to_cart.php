<?php

session_start();

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $food_id = intval($_POST["food_id"]);

    $sql = "SELECT * FROM food_items
            WHERE id = $food_id
            AND available = TRUE";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $food = $result->fetch_assoc();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$food_id])) {

            $_SESSION['cart'][$food_id]['quantity']++;

        } else {

            $_SESSION['cart'][$food_id] = [
                'name' => $food['name'],
                'price' => $food['price'],
                'quantity' => 1
            ];
        }
    }
}

header("Location: cart.php");
exit();

?>