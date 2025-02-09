<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session

include('../includes/connect.php');
include_once('../functions/common_function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />


    <!--css file-->
    <link rel="stylesheet" href="../style.css">
    <style>
         .admin_image{
    width: 100px;
    object-fit: contain;
} 
.footer{
    position: absolute;
    bottom: 0;
}
body{
    overflow-x:hidden;
}
.product_img{
    width:100px;
    object-fit:contain;
}
</style>
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!-- first banana -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <img src="../pictures/aulogo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                    <?php
                            echo "<li class='nav-item'>
                            <a class='nav-link text-light' href='#'>Welcome ".$_SESSION['admin_username']."</a>
                                </li>";
                        ?>

                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second banana -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!-- third banana -->
        <div class="row">
    <div class="col-md-12 bg-dark p-1 d-flex align-items-center">
    <div class="p-3">
    <?php
    $adminname = $_SESSION['admin_username']; // Retrieve admin username from session
    $admin_img_query = "SELECT * FROM `admin_table` WHERE admin_name='$adminname'"; // Query to select admin image based on username
    $admin_img_result = mysqli_query($con, $admin_img_query); // Execute the query

    // Check if the query executed successfully and fetch the result
    if ($admin_img_result && $row_img = mysqli_fetch_array($admin_img_result)) {
        // Check if the admin has uploaded a profile image
        if (isset($row_img['admin_image'])) {
            $admin_img = $row_img['admin_image']; // Retrieve admin image filename
            // Display the admin image
            echo "<li class='nav-item'>
                      <img src='./admin_image/$admin_img' class='admin_image my-4'>
                  </li>";
        } else {
            // If the admin has not uploaded a profile image, display an error message
            echo "Error fetching user image.";
        }
        
        // Display admin name
        echo "<p class='admin-name text-light text-center'>" . $row_img['admin_name'] . "</p>";
    }
    ?>
</div>

    
                <div class="button text-center">
                    <button>
                        <a href="insert_product.php" class="nav-link text-light bg-dark my-1">Insert Products </a>
                    </button>
                    <button>
                        <a href="index.php?view_products" class="nav-link text-light bg-dark my-1">View Products</a>
                    </button>
                    <button>
                        <a href="index.php?insert_category" class="nav-link text-light bg-dark my-1">Insert Categories</a>
                    </button>
                    <button>
                        <a href="index.php?view_categories" class="nav-link text-light bg-dark my-1">View Categories</a>
                    </button>
                    <button>
                        <a href="index.php?insert_game" class="nav-link text-light bg-dark my-1">Insert Game</a>
                    </button>
                    <button>
                        <a href="index.php?view_game" class="nav-link text-light bg-dark my-1">View Games</a>
                    </button>
                    <button>
                        <a href="index.php?insert_delivery" class="nav-link text-light bg-dark my-1">Insert Shipping Company</a>
                    </button>
                    <button>
                        <a href="index.php?view_delivery" class="nav-link text-light bg-dark my-1">View Shipping Company</a>
                    </button>
                    <button>
                        <a href="index.php?insert_brands" class="nav-link text-light bg-dark my-1">Insert Brands</a>
                    </button>
                    <button>
                        <a href="index.php?view_brands" class="nav-link text-light bg-dark my-1">View Brands</a>
                    </button>
                    <button>
                        <a href="index.php?list_orders" class="nav-link text-light bg-dark my-1">All Orders</a></button>
                    <button>
                        <a href="index.php?list_payment" class="nav-link text-light bg-dark my-1">All Payments</a>
                    </button>
                    <button>
                        <a href="index.php?list_user" class="nav-link text-light bg-dark my-1">List Users</a>
                    </button>
                    <button>
                    <a href="./admin_logout.php" class="nav-link text-light bg-dark my-1">Logout</a>
                    </button>
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
         <!--last banana-->
         <?php
  include ("../includes/footer.php")
?>
    </div>


    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>