<?php
$mysqli = require __DIR__ . "/database.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

?>

<style>

.navbar {
    font-size: 0.75em;
    width: 100%;
    height: 70px;
    background-color: var(--bg-light);
    overflow: hidden;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.navbar a:hover {
    color: var(--theme-col);
}

.navbar .user {
    float: left;
    position: absolute;
    display: flex;
    top: 0;
    left: 0;
    z-index: 1;
}

.user a:hover {
    color: red;
    border-radius: 50px;
}

.nav-items {
    display: flex;
}

.navbar a {
    display: block;
    color: var(--dark-text-col);
    text-align: center;
    padding: 5px 10px;
    text-decoration: none;
}

.navlogo {
    font-weight: bolder;
    letter-spacing: 1px;
    color: white;
    font-size: 1.5rem;
    padding-right: 10px;
    margin: 0;
}

.navlogo-initial {
    font-weight: bolder;
    letter-spacing: 1px;
    color: var(--theme-col);
    font-size: 1.5rem;
    padding-right: 10px;
    margin: 0;
}

.sidebar {
    height: 100%;
    width: 0vw;
    position: fixed;
    z-index: 2;
    top: 0;
    right: 0;
    font-size: 0.75em;
    background-color: var(--dark-text-col);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 30px;
}

.sidebar-categ {
    font-size: 2em;
    font-weight: bolder;
    letter-spacing: 0.1em;
    padding: 0 1em 0 1em;
    color: var(--white-text-col);
}

.sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    display: block;
    transition: 0.3s;
}

.sidebar a:hover {
    color: #f1f1f1;
}

.sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.openbtn, .user {
    cursor: pointer;
    font-size: 2em;
    color: var(--dark-text-col);
    padding: 10px 15px;
    border: none;
}

.sidebar-link {
    font-size: 1rem;
    color: white;
    margin: 10px 10px 10px;
    padding: 15px 15px 15px;
    justify-content: center;
    align-items: center;
    width: 80%;
    transition: 0.5s;
    border-radius: 40px;
}

.sidebar-link:hover {
    background-color: var(--grey-col);
    color: var(--theme-col);
    border-radius: 30px;
}

@media screen and (max-width: 600px) {
    .navbar a {display: none;}
    .navbar a.icon {
        float: right;
        display: block;
    }
}

@media screen and (max-width: 600px) {
    .navbar.responsive {position: relative;}
    .navbar.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
    }
    .navbar.responsive a {
        float: none;
        display: block;
        text-align: left;
    }
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    border-radius: 10px;
    z-index: 1;
}

.dropdown-content a {
    color: black;
    font-size: 0.75em;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.show {
    display: block;
}

</style>

<div class="navbar" id="myNavbar">
    <div class="logo"><p class="highlight"></p></div>
    <span class="navlogo">
        <span class="navlogo-initial">TRIFTEE</span></span>
    <a class="name-brand" href="">MEN</a>
    <a class="name-brand" href="">WOMEN</a>
    <a class="name-brand" href="">UNISEX</a>
    <a href="index.php" class="active">HOME</a>
    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
    <!-- <a class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars"></i></a> -->
    <a></a> <!-- Padding -->
    <div class="user active">
        <?php if (isset($user)): ?>
            <div class="dropdown">
                <a class="dropbtn" onclick="toggleDropdown()"><i class="fa-solid fa-user"></i></a>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php"><i class="fa-regular fa-user"></i> <?= htmlspecialchars($user["name"]) ?></a>
                    <a href="process/logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>

<!-- <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-xmark"></i></a>
    <a class="sidebar-link categ" href="products.php">Products</a>
    
    <div class="sidebar-categ">Item</div>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    
    <div class="sidebar-categ">Item</div>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    
    <div class="sidebar-categ">Item</div>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
    <a class="sidebar-link" href="#">Link</a>
</div> -->

<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById("myDropdown");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        var mySidebar = document.getElementById("mySidebar");
        mySidebar.style.width = "0vw";
    });

    function openNav() {
        document.getElementById("mySidebar").style.width = "25vw";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
    }
</script>

