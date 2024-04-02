<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$mysqli = require __DIR__ . "/database.php";

$item = null;

if (isset($_GET['id']) && isset($_GET['type'])) {
    $item_id = $_GET['id'];
    $item_type = $_GET['type'];

    if ($item_type !== 'mens' && $item_type !== 'womens') {
        echo 'Invalid item type.';
        exit;
    }

    $sql = "SELECT * FROM `$item_type` WHERE `id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo 'Item not found.';
        exit;
    }

    $stmt->close();
} else {
    echo 'Error: Item ID or Type not provided.';
    exit;
}

$mens_base_url = 'add/mens/image/';
$womens_base_url = 'add/womens/image/';
$item_base_url = 'item_details.php?type=';

$menshit_sql = "SELECT * FROM mens LIMIT 10";
$womenshit_sql = "SELECT * FROM womens LIMIT 10";

$menshit_result = $mysqli->query($menshit_sql);
$womenshit_result = $mysqli->query($womenshit_sql);

?>

<style>

.product-container {
    display: flex;
    max-width: 80%;
    margin: 0 auto;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
    background-color: #f7f7f7;
}

.product-image-section {
    width: 45%;
    margin-right: 20px;
}

.product-image-section img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.product-specs-section {
    width: calc(55% - 20px);
}

.product-specs-section h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.product-specs-section p {
    font-size: 16px;
    margin-bottom: 8px;
}

.add_buttons {
    margin-top: 20px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.add_buttons input[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    background-color: var(--theme-col);
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add_buttons input[type="submit"]:hover {
    background-color: var(--dark-text-col);
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Item Details</title>

    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <div class="product-container">
        <?php if ($item): ?>
            <div class="product-image-section">
                <?php
                $image_url = ($item_type === 'mens') ? $mens_base_url : $womens_base_url;
                $image_url .= $item["item_image_filename"];
                ?>
                <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Item Image">
            </div>
            <div class="product-specs-section">
                <h1><?php echo htmlspecialchars($item["item_name"]); ?></h1>
                <p>Price: ₱<?php echo htmlspecialchars($item["item_price"]); ?></p>
                <p>Description:<br> <?php echo htmlspecialchars($item["item_content"]); ?></p>

                <!-- Add to Cart form -->
                <form class="add_buttons" method="post" action="process/add_to_cart.php">
                    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                    <input type="hidden" name="item_type" value="<?php echo $item_type; ?>">
                    <input type="submit" name="add_to_cart" value="Add to Cart">
                </form>

            </div>
        <?php else: ?>
            <p>Item not found.</p>
        <?php endif; ?>
    </div>

    <?php include 'include/logsign.php'; ?>

    <div class="latest-news">More Items</div>

<div class="recom-grid">
    <div class="recom-grid-slides">

        <div class="itemListContainer">

                <?php include 'include/item_men.php'; ?>
            
        </div>

        <div class="itemListContainer">

            <?php include 'include/item_women.php'; ?>

        </div>

    </div>
</div>

    <footer>
        <?php include 'include/footer.php'; ?>
    </footer>

    <script type="text/javascript" src="js/scripties.js"></script>
</body>
</html>