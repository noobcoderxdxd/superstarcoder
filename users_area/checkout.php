<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chiefs Store - Checkout Page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <!-- font aweseome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />



<!-- css file -->
<link rel="stylesheet" href="../style.css">
<style>
    body {
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
    /* Remove the following rule to align the logo and total price to the left */
    /* .navbar-nav {
        margin: auto;
    } */
</style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!--banana banana-->
        <nav class="navbar navbar-expand-lg navbar-light position-relative bg-primary" style="background-image: url('../pictures/arellano.jpg');background-size: cover; background-position: center;">
        
  <div class="container-fluid">
    <img src="../pictures/aulogo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="../display_all.php">Products</a>
          

      </ul>
      <form class="d-flex" action="includes/search_product.php" method="get">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
</form>
    </div>
  </div>
</div>
</nav>
<!--second banana-->
<nav class="navbar navbar-expand-lg navbar-dark bg-custom3">
  <ul class="navbar-nav me-auto">
    <?php
    if (!isset($_SESSION['username'])) {
        echo "<li class='nav-item'>
                <a class='nav-link text-light' href='#'>Welcome Chiefs</a>
              </li>";
        echo "<li class='nav-item'>
                <a class='nav-link text-light' href='../users_area/user_login.php'>Login</a>
              </li>";
    } else {
        echo "<li class='nav-item'>
                <a class='nav-link text-light' href='#'>Welcome ".$_SESSION['username']."</a>
              </li>";
        echo "<li class='nav-item'>
                <a class='nav-link text-light' href='../users_area/logout.php'>Logout</a>
              </li>";
    }
    ?>
  </ul>
</nav>

<!--third banana-->
<div class="bg-light">
  <h3 class="text-center">CHIEF STORE</h3>
  <p class="text-center">Communication is the heart of e-commerce and community</p>
</div>

<!-- fourth banana-->
<div class="row px-1">
    <div class="col-md-12">
        <!-- products -->
        <div class="row">
            <?php
            if(!isset($_SESSION['username'])){
                include('../users_area/user_login.php');
            }else{
                include('payment.php');
            }
            ?>
        </div>
    </div>
</div>
 <!--last banana-->
 <!-- include footer -->
<?php
  include ("../includes/footer.php")
?>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous"></script>
</body>
</html>