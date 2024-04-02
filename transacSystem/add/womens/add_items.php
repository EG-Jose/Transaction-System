<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if (!isset($_SESSION['popup_shown'])) {
    $_SESSION['popup_shown'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Add Item</title>

    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>

<body class="addForm">
    <div class="navbar" id="myNavbar">
        <div class="logo"><p class="highlight"></p></div>
        <span class="navlogo">
            <span class="navlogo-initial">Old</span>Smoke</span>
            <button class="openbtn" onclick="openNav()">Products</button>
        <div class="user active">
            <?php if (isset($user)): ?>
                <a class="logoutBtn" href="logout.php">
                    <i class="fa fa-power-off"></i></a>
            <p><?= htmlspecialchars($user["name"]) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div id="mySidebar" class="sidebar">
    </div>
</head>

<body>
    <h2>Add New Item</h2>
    <form action="add_item_process.php" method="POST" enctype="multipart/form-data">
        <label>Item Name:</label>
        <input type="text" id="item_name" name="item_name"><br>

        <label>Item Price:</label>
        <input type="text" id="item_price" name="item_price"><br>

        <label>Item Description:</label>
        <textarea id="item_content" name="item_content"></textarea><br>

        <label>Item Image:</label>
        <input type="file" id="item_image" name="item_image"><br>

        <input type="submit" value="Add Item">
    </form>

<script type="text/javascript" src="js/scripties.js"></script>

</body>
</html>