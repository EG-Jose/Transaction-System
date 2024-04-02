<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_content = $_POST['item_content'];

    if (isset($_FILES['item_image'])) {
        $file_name = $_FILES['item_image']['name'];
        $file_tmp = $_FILES['item_image']['tmp_name'];
        $file_size = $_FILES['item_image']['size'];
        $file_type = $_FILES['item_image']['type'];
        $file_error = $_FILES['item_image']['error'];

        if ($file_size > 10 * 1024 * 1024) {
            echo "Error: File size exceeds the limit.";
            exit;
        }

        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_types)) {
            echo "Error: Unsupported file type.";
            exit;
        }

        $upload_dir = __DIR__ . '/image/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $upload_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $mysqli = require __DIR__ . "/database.php";
            $sql = "INSERT INTO womens (item_name, item_price, item_content, item_image_filename) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssss", $item_name, $item_price, $item_content, $file_name);

            if ($stmt->execute()) {
                echo "Item added successfully!";
            } else {
                echo "Error adding item: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();
        } else {
            echo "Error moving uploaded file to destination.";
        }
    } else {
        echo "Error: File not uploaded.";
    }
} else {
    echo "Form submission method not allowed.";
}