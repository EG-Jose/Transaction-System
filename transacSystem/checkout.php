<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

// Check if user is logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id && !isset($_SESSION['popup_shown'])) {
    // Set session variable to indicate that the popup has been shown
    $_SESSION['popup_shown'] = true;

    // Display the logsign.php modal
    echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function() { document.getElementById("logsignModal").style.display = "block"; });</script>';
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = [];
    $total_price = 0;

    foreach ($_SESSION['cart'] as $cart_item) {
        $item_id = $cart_item['id'];
        $item_type = $cart_item['type'];

        $table_name = ($item_type === 'mens') ? 'mens' : 'womens';

        $sql = "SELECT * FROM `$table_name` WHERE `id` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            $cart_items[] = $item;
            $total_price += $item['item_price'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
        $house_number = $_POST['house_number'];
        $barangay = $_POST['barangay'];
        $town_city = $_POST['town_city'];
        $province = $_POST['province'];
        $postal_code = $_POST['postal_code'];
        $payment_method = $_POST['payment_method'];

        $shipping_address = $house_number . ', ' . $barangay . ', ' . $town_city . ', ' . $province . ', ' . $postal_code;
        $order_status = 'pending';

        // Check if user is logged in
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Prepare SQL query with user_id column
        $sql = "INSERT INTO orders (user_id, shipping_address, payment_method, order_status, total_price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("isssd", $user_id, $shipping_address, $payment_method, $order_status, $total_price);

        if ($stmt->execute()) {
            unset($_SESSION['cart']);
            $order_id = $stmt->insert_id;

            function generateTrackingNumber() {
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $tracking_length = 10;
                $tracking_number = '';

                for ($i = 0; $i < $tracking_length; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $tracking_number .= $characters[$index];
                }

                return $tracking_number;
            }

            $tracking_number = generateTrackingNumber();

            header("Location: order_confirmation.php?order_id=$order_id&tracking_number=$tracking_number");
            exit();
        } else {
            echo 'Error: Failed to place order. Please try again.';
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Checkout</title>

    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'include/header.php'; ?>

    <h1>Selected Items</h1>
    <?php foreach ($cart_items as $item): ?>
        <div>
            <h2><?= htmlspecialchars($item["item_name"]) ?></h2>
            <p>Price: $<?= htmlspecialchars($item["item_price"]) ?></p>
        </div><br>
    <?php endforeach; ?>

    <p>Total Price: $<?= $total_price ?></p>

    <form id="checkoutForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Address</h2>

        <label for="house_number">House Number:</label>
        <input type="text" id="house_number" name="house_number" required><br>

        <label for="barangay">Barangay:</label>
        <input type="text" id="barangay" name="barangay" required><br>

        <label for="town_city">Town/City:</label>
        <input type="text" id="town_city" name="town_city" required><br>

        <label for="province">Province:</label>
        <input type="text" id="province" name="province" required><br>

        <label for="postal_code">Postal Code:</label>
        <input type="text" id="postal_code" name="postal_code" required><br>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="cash on delivery">Cash on Delivery</option>
        </select><br>

        <input type="submit" name="checkout" value="Proceed to Payment">
    </form>

    <?php include 'include/logsign.php'; ?>

    <footer>
        <?php include 'include/footer.php'; ?>
    </footer>

    <script type="text/javascript" src="js/scripties.js"></script>
</body>
</html>
