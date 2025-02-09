
<!-- connect file -->
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/connect.php');
include_once('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chiefs Store - Profile</title>
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
    .profile_img{
        width: 100%;
    height: 200px;
    object-fit: contain;
    }
    .edit_img{
      width:100px;
      height:100px;
      object-fit:contain;
    }
    body {
      background: linear-gradient(to bottom, #959EC9, #E8EAE7); 
      backdrop-filter: blur(100px);
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
    .btn-hover {
    padding: 10px 20px;
    border: 1px solid #5E59FB;
    background-color: white;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s, border-color 0.3s;
}

.btn-hover:hover {
    background-color: #5E59FB;
    color: white;
}

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
          <?php
              if (isset($_SESSION['username'])) {
                echo "<li class='nav-item'>  
                <a class='nav-link text-light' href='profile.php'>My Account</a>";
              }else{
                echo "<li class='nav-item'>  
                <a class='nav-link text-light' href='./users_area/user_registration.php'>Register</a>";
              }
            ?>
          <li class="nav-item">
          <a class="nav-link text-light" href="../cart.php"><i class='fa fa-shopping-bag'></i><sup><?php cart_item();?></sup></a>
        </li>
          <!-- calling cart function -->
<?php
cart();
?>
      </ul>
      <form class="d-flex" action="../search_product.php" method="get">
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
<div class="body">
  <h3 class="text-center">CHIEFS STORE</h3>
  <p class="text-center">Communication is the heart of e-commerce and community</p>
</div>

<!-- fourth banana-->
<div class="row">
    <div class="col-md-2">
        <ul class="navbar-nav bg-white text-center" style="height: 100vh">
            <li class="nav-item bg-custom">
                <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
            </li>
            <?php
            // Display a default profile image for all users
            echo "<li class='nav-item'>
                    <img src='../pictures/smiley.jpg' class='profile_img my-4'>
                  </li>";
            ?>
            </li>
            <li class="nav-item">
    <a class="nav-link btn-hover text-dark" href="profile.php">Pending orders</a>
</li>
<li class="nav-item">
    <a class="nav-link btn-hover text-dark" href="profile.php?user_orders">My orders</a>
</li>
<li class="nav-item">
    <a class="nav-link btn-hover text-dark" href="logout.php">Logout</a>
</li>

            <!-- <li class="nav-item">
                <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
            </li> -->
            
        </ul>
    </div>
    <div class="col-md-10 text-center">
      <?php
      get_user_order_details();
      if(isset($_GET['edit_account'])){
        include('edit_account.php');
      }
      if(isset($_GET['user_orders'])){
        include('user_orders.php');
      }
      if(isset($_GET['delete_account'])){
        include('delete_account.php');
      }
      ?>
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