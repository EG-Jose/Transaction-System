<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'], $_POST['item_id'], $_POST['item_type'])) {
        $item_id = $_POST['item_id'];
        $item_type = $_POST['item_type'];

        echo 'Received Item ID: ' . $item_id . '<br>';
        echo 'Received Item Type: ' . $item_type . '<br>';

        $_SESSION['cart'][] = ['id' => $item_id, 'type' => $item_type];

        header('Location: /transacsystem/cart.php');
        exit();
    } else {
        echo 'Incomplete form data. Please provide item ID and type.';
        var_dump($_POST);
    }
} else {
    echo 'Invalid request method.';
}
