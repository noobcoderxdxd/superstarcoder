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
    <title>Chiefs Store - Admin Dashboard</title>
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
            background: linear-gradient(to bottom, #959EC9, #E8EAE7); /* Gradient from purple to red */
    backdrop-filter: blur(100px); /* Apply blur effect */
    opacity: 1.9; /* Adjust opacity as needed */
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
    
</style>


</head>
<body>
<div class="container-fluid p-0">
        <!-- first banana -->
        <nav class="navbar navbar-expand-lg navbar-light position-relative bg-primary" style="background-image: url('../pictures/arellano.jpg');background-size: cover; background-position: center;">
            <div class="container-fluid">
                <img src="../pictures/aulogo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                    <?php
                            if(isset($_SESSION['admin_username'])) {
                                echo "<li class='nav-item'>
                                <a class='nav-link text-light' href='#'>Welcome ".$_SESSION['admin_username']."</a>
                                    </li>";
                            }
                        ?>

                    </ul>
                </nav>
            </div>
        </nav>


<!--third banana-->
<div class="body">
  <h3 class="text-center">Admin Dashboard</h3>
</div>

<!-- fourth banana-->
<div class="row">
    <div class="col-md-2">
        <ul class="navbar-nav bg-custom2 text-center" style="height: 100vh">
            <li class="nav-item bg-custom">
                <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
            </li>
            <?php
           $adminname = $_SESSION['admin_username'] ?? ''; // Using null coalescing operator to set default value
           $admin_img_query = "SELECT * FROM `admin_table` WHERE admin_name='$adminname'";
           $admin_img_result = mysqli_query($con, $admin_img_query);
  
           if ($admin_img_result && $row_img = mysqli_fetch_array($admin_img_result)) {
               if (isset($row_img['admin_image'])) {
                   $admin_img = $row_img['admin_image'];
                   echo "<li class='nav-item'>
                       <img src='../admin_area/admin_image/$admin_img' class='profile_img my-4'>
                   </li>";
               } else {
                   echo "<li class='nav-item'>
                       <img src='../pictures/ambutakam.jpeg' class='profile_img my-4'>
                   </li>";
               }
           } else {
               
               echo "Error fetching user image.";
           }
           
          
               
            ?>
            <li class="nav-item">
    <a class="nav-link" href="adminhome.php?list_payment" style="color: #2a1546;">All Payments</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="adminhome.php?list_orders" style="color: #2a1546;">All Orders</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="adminhome.php?list_user" style="color: #2a1546;">List Users</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="./admin_logout.php" style="color: #2a1546;">Logout</a>
</li>

        </ul>
    </div>
    <!-- content area -->
    <div class="col-md-10">
    <div class="container my-3" style="margin-top: 50px; background-color: rgba(255, 255, 255, 0.8); padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
        <div class="card p-4">
            <h4 class="card-title">Admin Actions</h4>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        <a href="insert_product.php" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">Insert Products</a>
                    </li>
                    <li>
                        <a href="adminhome.php?view_products" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">View Products</a>
                    </li>
                    <li>
                        <a href="adminhome.php?insert_category" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">Insert Categories</a>
                    </li>
                    <li>
                        <a href="adminhome.php?view_categories" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">View Categories</a>
                    </li>
                    <li>
                        <a href="adminhome.php?insert_game" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">Insert Game</a>
                    </li>
                    <li>
                        <a href="adminhome.php?view_game" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">View Games</a>
                    </li>
                    <li>
                        <a href="adminhome.php?insert_delivery" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">Insert Shipping Company</a>
                    </li>
                    <li>
                        <a href="adminhome.php?view_delivery" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">View Shipping Company</a>
                    </li>
                    <li>
                        <a href="adminhome.php?insert_brands" class="nav-link insert-brands-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">Insert Brands</a>
                    </li>
                    <li>
                        <a href="adminhome.php?view_brands" class="nav-link" style="color: #2a1546; background-color: #959EC9; padding: 10px 20px; margin: 5px 0; display: block;">View Brands</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>






    <!-- fourth banana -->
    <div class="container my-3">
            <?php
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_delivery'])){
                include('insert_deliveries.php');
            } 
            if(isset($_GET['insert_brands'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['view_delivery'])){
                include('view_delivery.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_brand'])){
                include('edit_brand.php');
            }
            if(isset($_GET['edit_delivery'])){
                include('edit_delivery.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_brand'])){
                include('delete_brand.php');
            }
            if(isset($_GET['delete_delivery'])){
                include('delete_delivery.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['delete_orders'])){
                include('delete_orders.php');
            }
            if(isset($_GET['list_payment'])){
                include('list_payment.php');
            }
            if(isset($_GET['delete_payment'])){
                include('delete_payment.php');
            }
            if(isset($_GET['list_user'])){
                include('list_user.php');
            }
            if(isset($_GET['delete_user'])){
                include('delete_user.php');
            }
            if(isset($_GET['insert_game'])){
                include('insert_game.php');
            }
            if(isset($_GET['view_game'])){
                include('view_game.php');
            }
            if(isset($_GET['edit_game'])){
                include('edit_game.php');
            }
            if(isset($_GET['delete_game'])){
                include('delete_game.php');
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


