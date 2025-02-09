<?php
session_start();
include('../includes/connect.php');
include_once('../functions/common_function.php');

// Check if student_id is set
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];

    // Initialize variables
    $total = 0;
    $product_ids = []; // Initialize an array to store product IDs
    $out_of_stock_products = []; // Initialize an array to store out of stock product IDs

    // Get IP address
    $get_ip_address = getIPAddress();

    // Calculate the total price of items in the cart
    $cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
    $result_cart_price = mysqli_query($con, $cart_query_price);

    while ($row_price = mysqli_fetch_array($result_cart_price)) {
        $product_id = $row_price['product_id'];
        $quantity_ordered = $row_price['quantity']; // Get quantity ordered
        $product_color = $row_price['product_color']; // Get product color
        $product_size = $row_price['product_size']; // Get product size

        $select_product = "SELECT product_price, stock_quantity FROM `products` WHERE product_id='$product_id'";
        $run_price = mysqli_query($con, $select_product);

        while ($row_product_price = mysqli_fetch_array($run_price)) {
            $product_price = $row_product_price['product_price'];
            $product_stock = $row_product_price['stock_quantity'];

            // Check if the product is out of stock
            if ($product_stock < $quantity_ordered) {
                $out_of_stock_products[] = $product_id; // Add the out of stock product ID to the array
            }

            $product_values = floatval($product_price) * $quantity_ordered;
            $total += $product_values;

            // Store product IDs in the array
            $product_ids[] = $product_id;
        }
    }

    // If there are out of stock products, display a message and exit
    if (!empty($out_of_stock_products)) {
        $out_of_stock_product_names = [];
        foreach ($out_of_stock_products as $out_of_stock_product_id) {
            // Retrieve the product name for display
            $product_name_query = "SELECT product_title FROM `products` WHERE product_id='$out_of_stock_product_id'";
            $result_product_name = mysqli_query($con, $product_name_query);
            $row_product_name = mysqli_fetch_assoc($result_product_name);
            $product_name = $row_product_name['product_title'];

            $out_of_stock_product_names[] = $product_name;
        }

        // Display a message indicating which products are out of stock
        $out_of_stock_product_names_str = implode(", ", $out_of_stock_product_names);
        echo "<script>alert('The following product(s) are out of stock: $out_of_stock_product_names_str. Please remove them from your cart.')</script>";
        echo "<script>window.open('../cart.php','_self')</script>";
        exit(); // Exit the script
    }

    // Continue with order submission if all products are in stock

// Generate invoice number
$invoice_number = mt_rand();

// Retrieve product IDs from the cart along with their color and size
$cart_query = "SELECT product_id, product_color, product_size FROM `cart_details` WHERE student_id='$student_id'";
$result_cart = mysqli_query($con, $cart_query);
$product_ids = [];
$product_colors = [];
$product_sizes = [];

// Fetch product IDs, colors, and sizes from the cart
while ($row = mysqli_fetch_assoc($result_cart)) {
    $product_ids[] = $row['product_id'];
    $product_colors[$row['product_id']] = $row['product_color'];
    $product_sizes[$row['product_id']] = $row['product_size'];
}

// Get count of products in the cart
$count_products = count($product_ids);

// Set status
$status = 'pending';

// Calculate the total amount due
$amount_due = $total;

// Insert order into user_orders table
foreach ($product_ids as $product_id) {
    $product_color = $product_colors[$product_id];
    $product_size = $product_sizes[$product_id];

    // Get quantity from cart_details table
    $get_quantity_query = "SELECT quantity FROM `cart_details` WHERE student_id='$student_id' AND product_id='$product_id'";
    $result_quantity = mysqli_query($con, $get_quantity_query);
    if ($result_quantity && mysqli_num_rows($result_quantity) > 0) {
        $row_quantity = mysqli_fetch_assoc($result_quantity);
        $quantity = $row_quantity['quantity'];

        // Calculate expiration date (7 days from now)
        $expiration_date = date('Y-m-d H:i:s', strtotime('+7 days'));

        // Insert order into user_orders table along with color, size, quantity, and expiration date
        $insert_order_query = "INSERT INTO user_orders (student_id, product_id, amount_due, invoice_number, total_products, order_date, order_status, product_color, product_size, expiration_date) 
            VALUES ('$student_id', '$product_id', '$amount_due', '$invoice_number', '$quantity', NOW(), '$status', '$product_color', '$product_size', '$expiration_date')";
        $result_insert_order = mysqli_query($con, $insert_order_query);

        if (!$result_insert_order) {
            // If the insert query fails, handle the error
            echo "Error inserting order into user_orders: " . mysqli_error($con);
            exit(); // Exit the script if an error occurs
        }
    } else {
        echo "Error: Quantity not found for product ID $product_id and student ID $student_id";
    }
}

// Display success message and redirect
echo "<script>alert('Orders submitted successfully')</script>";
echo "<script>window.open('profile.php','_self')</script>";

// Delete items from cart
$empty_cart_query = "DELETE FROM `cart_details` WHERE student_id='$student_id'";
$result_delete_cart = mysqli_query($con, $empty_cart_query);

} else {
    // Handle the case where student_id is not set
    echo "Error: Student ID is not set.";
}

?>
