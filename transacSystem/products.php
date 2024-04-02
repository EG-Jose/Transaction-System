

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Products</title>

    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>
</head>
<body class="products">

    <!--    Nav Bar -->
    <?php include 'include/header.php'; ?>
    
<div class="item-container">

    <div class="items-column left">

        <div class="index-panel">

            <div class="weblogo">
                <img src="images/bigLogo.jpg">
            </div>

            <div class="panopt">
                <a href="#itcat1"></a>
            </div>
            
            <div class="panopt">
                <a href="#itcat2"></a>
            </div>
            
            <div class="panopt">
                <a href="#itcat3"></a>
            </div>
            
            <!--<div class="panopt">
                <a href="#itcat3">Option 4</a>
            </div>-->

        </div>
    
    </div>

    <div class="items-column right">

        <div class="itemListContainer">
        <p class="item-title" id="itcat1"><a href="https://www.geekvape.com/"></a></p>
        <div class="items-column-container" id="itemCat1">

   

        </div>
        <div class="shbtn">
            <div></div><!--Just for spacing-->
            <div></div><!--Just for spacing-->
            <button class="toggleButton" data-target="itemCat1">
                <i class="fa fa-angles-down icon1"></i>
                <span class="buttonText">Show More</span>
                <i class="fa fa-angles-down icon2"></i>
            </button>            
        </div>
        </div>

    <!--==========Another Category==========-->

        <div class="itemListContainer">
        <p class="item-title" id="itcat2"><a href="https://store.smoktech.com/"></a></p>
        <div class="items-column-container" id="itemCat2">

    
            

        </div>
        <div class="shbtn">
            <div></div><!--Just for spacing-->
            <div></div><!--Just for spacing-->
            <button class="toggleButton" data-target="itemCat2">
                <i class="fa fa-angles-down icon1"></i>
                <span class="buttonText">Show More</span>
                <i class="fa fa-angles-down icon2"></i>
            </button>            
        </div>
        </div>
         
        
    <!--==========Another Category==========-->
         
        <div class="itemListContainer">
        <p class="item-title" id="itcat3"><a href="https://www.voopoo.com/"></a></p>
        <div class="items-column-container" id="itemCat3">

   

            

        </div>
        <div class="shbtn">
            <div></div><!--Just for spacing-->
            <button class="toggleButton" data-target="itemCat3">
                <i class="fa fa-angles-down icon1"></i>
                <span class="buttonText">Show More</span>
                <i class="fa fa-angles-down icon2"></i>
            </button>
        </div>
        </div>

    </div>

</div>

<!--Login/Signup Panel-->
<?php
        include 'include/logsign.php';
    ?>

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