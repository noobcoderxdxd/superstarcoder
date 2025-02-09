
<!-- connect file -->
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('./includes/connect.php');
include_once('./functions/common_function.php');
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chiefs Store</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
    body {
    /* background: linear-gradient(to bottom, #959EC9, #E8EAE7); /* Gradient from purple to red */
    /* backdrop-filter: blur(100px); Apply blur effect */
    overflow-x: hidden;
}
    .logo {
        width: 50px; /* Adjust as needed */
    }
    .navbar-nav {
        /* margin-left: auto; Remove this line to align items to the left */
    }
    .navbar-toggler {
        border-color: #fff;
    }
    .bg-light {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
    }
    .bg-secondary {
        background-color: #6c757d;
    }
    .bg-info {
        background-color: #0dcaf0;
    }
    .text-light {
        color: #fff !important;
    }
    .text-center {
        text-align: center;
    }
    .p-0 {
        padding: 0 !important;
    }
    .bg-custom {
        background-color: #28264C;
    }
    .bg-custom2{
        background-color: #959EC9;  
    }
    .bg-custom3{
        background-color: #A40033;
    }
    .category-button, .game-button,
.brand-button {
    display: block; /* Change to block display */
    width: 100%; /* Set width to 100% */
    padding: 8px 16px;
    border-radius: 8px;
    background-color: white;
    color: #28264C;
    border: 2px solid #5E59FB; /* Update border color */
    text-decoration: none;
    transition: background-color 0.3s ease;
    margin-top: 5px; /* Add margin for spacing */
}
.category-button:hover, .game-button:hover,
.brand-button:hover {
    background-color: #959EC9; /* Change background color on hover */
    color: #000000; /* Change text color on hover */
}

    /* Remove the following rule to align the logo and total price to the left */
    /* .navbar-nav {
        margin: auto;
    } */
</style>
</head>
<body>
    
    <!-- Navbar with background image -->
<nav class="navbar navbar-expand-lg navbar-light position-relative bg-primary" style="background-image: url('./pictures/arellano.jpg');background-size: cover; background-position: center;">
    <div class="container-fluid">
        <img src="./pictures/aulogo.png" alt="Logo" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="display_all.php">Products</a>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>  
                                    <a class='nav-link text-light' href='./users_area/profile.php'>My Account</a>";
                        }
                    ?>
                    
                    <li class="nav-item">
                    <a class="nav-link text-light" href="cart.php"><i class='fa fa-shopping-bag'></i><sup><?php cart_item();?></sup></a>
                    <li class="nav-item">
                    <a class="nav-link text-light" href="#">Total Price: <?php total_cart_price(); ?></a>
                </li>
            </ul>
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#codeModal">
            How can I get a code to play?
        </button>
            <form class="d-flex ms-auto" action="search_product.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" autocomplete="off" aria-label="Search" name="search_data">
                <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
            </form>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="codeModalLabel">Instructions to Get a Code to Play</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            To obtain a code, you are required to participate in any event organized by the school. Upon your participation, the event organizer will provide you with a unique code. This code can then be inputted into the e-shop of Arellano University Juan Sumulong Campus. Subsequently, you will be enabled to engage in a brief game, allowing you to acquire a voucher code.            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- calling cart function -->
<?php
cart();
?>


    <!-- Second Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom3">
        <ul class="navbar-nav me-auto">
            <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                            <a class='nav-link text-light' href='#'>Welcome Chiefs</a>
                          </li>";
                    echo "<li class='nav-item'>
                            <a class='nav-link text-light' href='./users_area/user_login.php'>Login</a>
                          </li>";
                } else {
                    echo "<li class='nav-item'>
                            <a class='nav-link text-light' href='#'>Welcome ".$_SESSION['username']."</a>
                          </li>";
                    echo "<li class='nav-item'>
                            <a class='nav-link text-light' href='./users_area/logout.php'>Logout</a>
                          </li>";
                }
            ?>
        </ul>
    </nav>

    <!-- Third Section -->
    <!-- <div class="body">
        <h3 class="text-center">CHIEFS STORE</h3>
        <p class="text-center">Communication is the heart of e-commerce and community</p>
    </div> -->

    <!-- Fourth Section -->
    <div class="row px-1">
        <div class="col-md-10">
            <div class="row">
            <div class="bg-light">
        <h3 class="text-center">CHIEFS STORE</h3>
        <p class="text-center">Communication is the heart of e-commerce and community</p>
    </div> 
                <!-- Fetching products -->
                <?php
                    // Include necessary files
                    include('./includes/connect.php');
                    include_once('./functions/common_function.php');

                    // Call the functions
                    getproducts();
                    get_products_by_category();
                    get_products_by_brands();
                    // $ip = getIPAddress();  
                ?>
            </div>
        </div>
        <div class="col-md-2 bg-light p-0">
    <!-- side nav -->
    <!-- Categories -->
    <ul class="navbar-nav me-auto text-center" style="font-size: 14px; border-top: 1px solid #ccc;">
        <li class="nav-item bg-custom">
            <a href="#" class='nav-link text-light'><h6>Categories</h6></a>
        </li>
        <?php
            getcat();
        ?>
    </ul>

    <!-- Voucher and Discounts -->
    <ul class="navbar-nav me-auto text-center" style="font-size: 14px; border-top: 1px solid #ccc;">
        <li class="nav-item bg-custom">
            <a href="#" class="nav-link text-light"><h6>Enter A Code</h6></a>
        </li>
        <li class="nav-item">
            <?php
                getgame();
            ?>
        </li>
    </ul>

    <!-- Brands -->
    <ul class="navbar-nav me-auto text-center" style="font-size: 14px; border-top: 1px solid #ccc;">
        <li class="nav-item bg-custom">
            <a href="#" class="nav-link text-light"><h6>Organization/Merchandise</h6></a>
        </li>
        <?php
            getbrands();
        ?>
    </ul>
</div>


    <!-- Footer -->
    <?php
        include ("./includes/footer.php")
    ?>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
