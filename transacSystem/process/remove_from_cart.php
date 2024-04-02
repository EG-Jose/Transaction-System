<?php
session_start();

if (isset($_POST['remove_from_cart']) && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    function remove_item_from_cart($item_id) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $cart_item) {
                if ($cart_item['id'] === $item_id) {
                    unset($_SESSION['cart'][$key]);
                    return true;
                }
            }
        }
        return false;
    }

    if (remove_item_from_cart($item_id)) {
        header('Location: /transacsystem/cart.php');
        exit();
    } else {
        echo 'Error: Item not found in cart.';
    }
} else {
    echo 'Invalid request.';
}