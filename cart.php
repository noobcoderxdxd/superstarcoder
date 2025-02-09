
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
    <title>Chiefs Store - Cart Details</title>
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
<link rel="stylesheet" href="style.css">
<style>
.cart_img{
    width: 80px;
    height: 80px;
    object-fit:contain;

}

body {
        background: linear-gradient(to bottom, #959EC9, #E8EAE7);
        backdrop-filter: blur(100px);
        overflow-x: hidden;
        color: #28264C; /* Set text color for the body */
    }
    
    table {
        background-color: #fff; /* Set background color for the table */
    }
    
    th, td {
        border: 1px solid #ccc; /* Add border to table cells */
        padding: 8px; /* Add padding to table cells */
    }   .logo {
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
</styl>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!--banana banana-->
        <nav class="navbar navbar-expand-lg navbar-light position-relative bg-primary" style="background-image: url('./pictures/arellano.jpg');background-size: cover; background-position: center;">
    <img src="./pictures/aulogo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
      </ul>
    </div>
  </div>
</div>
</nav>
<!-- calling cart function -->
<?php
cart();
?>
<!--second banana-->
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

<!--third banana-->
<div class="body">
  <h3 class="text-center">CHIEF STORE</h3>
  <p class="text-center">Communication is the heart of e-commerce and community</p>
</div>
<!-- fourth banana -->
<div class="container">
    <div class="row">
      <form action="" method="post">
        <table class="table table-bordered text-center">
           
        <?php
$get_ip_address = getIPAddress();
$total = 0;
$cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart = mysqli_query($con, $cart_query);
$result_count = mysqli_num_rows($result_cart);

if ($result_count > 0) {
    echo "<thead>
    <tr>
        <th class='body'>Product title</th>
        <th>Product Image</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Product Color</th>
        <th>Product Size</th>
        <th>Stock</th> <!-- New column for displaying stock -->
        <th>Remove</th>
        <th colspan='2'>Operations</th>
    </tr>
    </thead>
    <tbody>";

    while ($row_cart = mysqli_fetch_array($result_cart)) {
        $product_id = $row_cart['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);

        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $product_title = $row_product_price['product_title'];
            $product_img1 = $row_product_price['product_img1'];
            $quantity = $row_cart['quantity'];
            $stock_quantity = $row_product_price['stock_quantity']; // Get stock quantity
            $product_values = floatval($product_price) * $quantity;
            $total += $product_values;
            
            // Check if the product title contains the word "shirt"
            $display_color_size = false;
            if (strpos(strtolower($product_title), 'shirt') !== false) {
                // If the product title contains the word "shirt", display color and size options
                $product_color = $row_product_price['product_color']; // Fetch color information
                $product_size = $row_product_price['product_size']; // Fetch size information
                $display_color_size = true;
            }
        
            // Output table row
            ?>
            <tr>
                <td class="body"><?php echo $product_title ?></td>
                <td class="body"><img src="./admin_area/product_images/<?php echo $product_img1; ?>" alt="<?php echo $product_title; ?>" class="cart_img"></td>
                <td class="body"><input type="text" name="qty[<?php echo $product_id; ?>]" class="form-input w-50" value="<?php echo $quantity; ?>"></td>
                <td class="body"><?php echo $product_values ?></td>
                <?php if ($display_color_size) { ?>
    <td class="body">
        <select name="color[<?php echo $product_id; ?>]">
            <option value="Black" <?php echo ($product_color === 'Black' || !$product_color) ? 'selected' : ''; ?>>Black</option>
            <option value="White" <?php echo ($product_color === 'White') ? 'selected' : ''; ?>>White</option>
            <option value="Blue" <?php echo ($product_color === 'Blue') ? 'selected' : ''; ?>>Blue</option>
        </select>
    </td>
    <td class="body">
        <select name="size[<?php echo $product_id; ?>]">
            <option value="S" <?php echo ($product_size === 'S' || !$product_size) ? 'selected' : ''; ?>>S</option>
            <option value="M" <?php echo ($product_size === 'M') ? 'selected' : ''; ?>>M</option>
            <option value="L" <?php echo ($product_size === 'L') ? 'selected' : ''; ?>>L</option>
        </select>
    </td>
<?php } else { ?>
    <td>N/A</td>
    <td>N/A</td>
<?php } ?>

<!-- <script>
    // JavaScript to handle color and size selection
    $(document).ready(function() {
        $('.color-select, .size-select').change(function() {
            var productId = $(this).data('product-id');
            var selectedColor = $('.color-select[data-product-id="' + productId + '"]').val();
            var selectedSize = $('.size-select[data-product-id="' + productId + '"]').val();

            // Send AJAX request to update cart details
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: {
                    productId: productId,
                    selectedColor: selectedColor,
                    selectedSize: selectedSize
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> -->
                <td class="body"><?php echo $stock_quantity ?></td> <!-- Display stock quantity -->
                <td class="body"><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                <td class="body">
                    <input type="submit" value="Update" class="px-3 py-2 border-0" style="background-color: #959EC9;" name="update_cart">
                    <input type="submit" value="Remove" class="px-3 py-2 border-0 text-light" style="background-color: #A40033;" name="remove_cart">
                </td>
            </tr>
            <?php
        }
    }
} else {
    echo "<tr><td colspan='7'><h2 class='text-center text-danger'>Cart is empty</h2>
    </td>
    </tr>";
}


if (isset($_POST['update_cart'])) {
    // Check if the quantities array is set and not empty
    if (isset($_POST['qty']) && !empty($_POST['qty'])) {
        $quantities = $_POST['qty'];
        $update_successful = true; // Flag to track if all updates were successful

        foreach ($quantities as $product_id => $quantity) {
            // Check if quantity is provided and not empty
            if (!isset($quantity) || $quantity === "") {
                // Quantity not provided for this product
                $update_successful = false;
                echo "<script>alert('Please add a quantity for product with ID: $product_id');</script>";
            } else {
                // Quantity provided, proceed with update
                $product_color = isset($_POST['color'][$product_id]) ? $_POST['color'][$product_id] : ""; // Get selected color
                $product_size = isset($_POST['size'][$product_id]) ? $_POST['size'][$product_id] : ""; // Get selected size

                // Update cart details in the database
                $update_cart = "UPDATE `cart_details` 
                                SET quantity='$quantity', product_color='$product_color', product_size='$product_size' 
                                WHERE ip_address='$get_ip_address' AND product_id='$product_id'";
                $result_products_quantity = mysqli_query($con, $update_cart);
                
                if (!$result_products_quantity) {
                    // Error updating cart for this product
                    $update_successful = false;
                    echo "<script>alert('Error updating cart for product with ID: $product_id - " . mysqli_error($con) . "');</script>";
                }
            }
        }

        if ($update_successful) {
            echo "<script>alert('Cart updated successfully!');</script>";
        } else {
            // If any errors occurred during updates
            echo "<script>alert('Some products could not be updated. Please try again.');</script>";
        }
    } else {
        // If quantities array is not set or empty
        echo "<script>alert('Please add quantities for products before updating.');</script>";
    }
}
?>
</tbody>

        </table>
        <!-- subtotal -->
        <div class="d-flex mb-5">
          <?php 
              $get_ip_address = getIPAddress();
              $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
              $result_cart = mysqli_query($con, $cart_query);
              $result_count=mysqli_num_rows($result_cart);
              if ($result_count > 0) {
                echo "<h4 class='px-3'>Subtotal: <strong class='text-light' style='background-color: #28264C;'>$total</strong></h4>
                <input type='submit' value='Continue Shopping' class='bg-custom2 px-3 py-2 border-0' name='continue_shopping'>
                      <button class='bg-custom3 px-3 py-2 border-0 text-light'><a href='./users_area/checkout.php' class='ms-2 text-light text-decoration-none'>Checkout</a></button>";
            } else {
                echo "<input type='submit' value='Continue Shopping' class='bg-custom2 px-3 py-2 border-0'  name='continue_shopping'>";
            }
            
            if (isset($_POST['continue_shopping'])) {
                echo "<script>window.open('index.php','_self')</script>";
            }
            
            
          ?>
</div>

    </div>
</div>
</form>
<!-- function to remove items -->
<?php
function remove_items(){
  global $con;
  if(isset($_POST['remove_cart']) && isset($_POST['removeitem'])){
    foreach ($_POST['removeitem'] as $remove_id){
      echo  $remove_id;
      $delete_query="Delete from  `cart_details` where product_id=$remove_id";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete){
        echo "<script>window.open('cart.php','self')</script>";
      }
    }
  }
}

echo $remove_item=remove_items(); 
?>

 <!-- include footer -->
<?php
  include ("./includes/footer.php")
?>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous"></script>
</body>
</html>