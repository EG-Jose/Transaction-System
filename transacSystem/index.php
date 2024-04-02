<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$mysqli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {
    $sql = "SELECT `id`, `name`, `email`, `password_hash` FROM `user` WHERE `email` = ? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if (!isset($_SESSION['popup_shown'])) {
    $_SESSION['popup_shown'] = false;
}

$mens_base_url = 'add/mens/image/';
$womens_base_url = 'add/womens/image/';
$item_base_url = 'item_details.php?type=';

$menshit_sql = "SELECT * FROM mens LIMIT 10";
$womenshit_sql = "SELECT * FROM womens LIMIT 10";

$menshit_result = $mysqli->query($menshit_sql);
$womenshit_result = $mysqli->query($womenshit_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Home</title>

    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>
<body class="index">

        <?php include 'include/header.php'; ?>
    
<div class="index-container">

    <div class="slider-container">
        <div class="slider">
            <div class="slide clone-end"><img src="images/cat.jpg"></div>
    
            <div class="slide"><img src="images/cat.jpg"></div>
            <div class="slide"><img src="images/cat.jpg"></div>
            <div class="slide"><img src="images/cat.jpg"></div>
            <div class="slide"><img src="images/cat.jpg"></div>
            <div class="slide"><img src="images/cat.jpg"></div>
    
            <div class="slide clone-start"><img src="images/cat.jpg"></div>
        </div>
    </div><!--    slider-container END  -->

    <div class="latest-news" id="options">
        <p><a href="latest">What's New</a></p>
        <p><a href="latest">What's Trending</a></p>
    </div>

<div class="recom-grid">
    <div class="recom-grid-slides">
        
        <div class="itemListContainer"> <!--=============================== M E N ====================================-->

            <?php include  'include/item_men.php'; ?>
            
        </div>  <!--===========================================================-->

        <div class="itemListContainer"> <!--============================= W O M E N ==================================-->

            <?php include  'include/item_women.php'; ?>

        </div>  <!--===========================================================-->

    </div>
</div>  <!--    recom-grid END  -->

</div>  <!--    Index Container END -->


    <!--Login/Signup Panel-->
    <?php include 'include/logsign.php'; ?>

<footer>
    <?php include 'include/footer.php'; ?>
</footer>

<script type="text/javascript" src="js/scripties.js"></script>

<?php if (!$_SESSION['popup_shown']): ?>
    <script type="text/javascript">
        window.onload = function() {
            showModal();
        };
    </script>

    <?php $_SESSION['popup_shown'] = true; ?>
<?php endif; ?>

</body>
</html>