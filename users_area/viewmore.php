<?php
include('../includes/connect.php');

// Check if the order_id parameter is set
if(isset($_GET['order_id'])) {
    // Sanitize the input
    $order_id = mysqli_real_escape_string($con, $_GET['order_id']);

    // Query to retrieve product title from products table and color/size from user_orders table for the given order ID
    $product_details_query = "SELECT products.product_title, user_orders.product_color, user_orders.product_size
                             FROM user_orders
                             LEFT JOIN products ON user_orders.product_id = products.product_id
                             WHERE user_orders.order_id = '$order_id'";
    
    // Execute the query
    $product_details_result = mysqli_query($con, $product_details_query);

    // Check if any product details were found
    if(mysqli_num_rows($product_details_result) > 0) {
        // Display product details (title, color, size)
        while ($row = mysqli_fetch_assoc($product_details_result)) {
            $product_title = $row['product_title'];
            $product_color = $row['product_color'];
            $product_size = $row['product_size'];

            echo "Product Title: $product_title\n";
            echo "Product Color: $product_color\n";
            echo "Product Size: $product_size\n";
        }
    } else {
        // Handle case where no product details were found
        echo "No product details found for this order.";
    }
} else {
    // Handle case where order_id parameter is not set
    echo "Error: Order ID parameter is missing.";
}
?>

