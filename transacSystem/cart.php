<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

function fetch_item_details($mysqli, $item_id, $item_type) {
    $item_details = array();

    if ($item_type === 'mens') {
        $sql = "SELECT m.*, 'add/mens/image/' AS base_url FROM mens m WHERE m.id = ?";
    } elseif ($item_type === 'womens') {
        $sql = "SELECT w.*, 'add/womens/image/' AS base_url FROM womens w WHERE w.id = ?";
    } else {
        return null;
    }

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $item_details['item_name'] = $row['item_name'];
        $item_details['item_price'] = $row['item_price'];
        $item_details['item_image'] = $row['base_url'] . $row['item_image_filename'];
    }

    $stmt->close();

    return $item_details;
}

$mens_base_url = 'add/mens/image/';
$womens_base_url = 'add/womens/image/';
$item_base_url = 'item_details.php?type=';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>

<body class="cart-page">

<?php include 'include/header.php'; ?>

<div class="cart-container">

    <div>
        <h1>Items in Your Cart</h1>
    </div>

<?php
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<div class="empty-cart-message">';
    echo '<p>You need to log in to view your cart.</p>';
    echo '<a class="cartcheck" onclick="showModal()">Sign In</a>';
    echo '</div>';
} elseif (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];

    foreach ($cart_items as $cart_item) {
        $item_id = $cart_item['id'];
        $item_type = $cart_item['type'];

        $item_details = fetch_item_details($mysqli, $item_id, $item_type);

        if ($item_details) {
?>

            <div class="cartcon column">

                <div class="cartcon left">
                    <div class="cart-image">
                        <img src="<?= htmlspecialchars($item_details["item_image"]) ?>">
                    </div>
                    <div class="cart-details">
                        <h2><?= htmlspecialchars($item_details["item_name"]) ?></h2>
                        <p>Price: ₱<?= htmlspecialchars($item_details["item_price"]) ?></p>
                    </div>
                </div>
                <div class="cartcon right">
                    <form method="post" action="process/remove_from_cart.php">
                        <input type="hidden" name="item_id" value="<?= $item_id ?>">
                        <input class="cartremove" type="submit" name="remove_from_cart" value="Remove">
                    </form>
                </div>

            </div>
            <br>

<?php
        } else {
            echo 'Item details not found for ID: ' . $item_id . '<br>';
        }
    }
?>

    <a class="cartcheck" href="checkout.php">Proceed to Checkout</a>

<?php
} else {
?>

    <div class="empty-cart-message">
        <p>Your cart is empty.</p>
    </div>

<?php
}
?>

</div>

<?php include 'include/logsign.php'; ?>

<footer>
    <?php include 'include/footer.php' ?>
</footer>

<script type="text/javascript" src="js/scripties.js"></script>

</body>
</html>
