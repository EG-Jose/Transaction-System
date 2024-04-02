<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

// Skip user authentication check for testing purposes if commented
// if (!isset($_SESSION['user_id'])) {
//     header('Location: /transacsystem/login-signup.php');
//     exit();
// }

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
$tracking_number = isset($_GET['tracking_number']) ? $_GET['tracking_number'] : null;

if ($order_id === null || $tracking_number === null) {
    echo '<p>Error: Order ID or Tracking Number not provided.</p>';
    exit();
}

$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
} else {
    echo '<p>No orders found.</p>';
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Order Confirmation</title>
    
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <div class="order-details">
        <h1>Order Confirmation</h1>
        <?php if ($result->num_rows > 0): ?>
            <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order["shipping_address"]) ?></p>
            <p><strong>Payment Method:</strong> <?= htmlspecialchars($order["payment_method"]) ?></p>
            <p><strong>Order Status:</strong> <?= htmlspecialchars($order["order_status"]) ?></p>
            <p><strong>Tracking Number:</strong> <?= htmlspecialchars($tracking_number) ?></p>
            
            <!-- Display change -->
            <!-- <p><strong>Change:</strong> <?= htmlspecialchars($change) ?></p> -->
        <?php endif; ?>
    </div>

    <div>
        <a href="index.php">Go Home</a>
    </div>

    <?php include 'include/logsign.php'; ?>

<footer>
    <?php include 'include/footer.php'; ?>
</footer>

<script type="text/javascript" src="js/scripties.js"></script>

</body>
</html>
