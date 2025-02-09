<?php
include('../includes/connect.php');
include_once('../functions/common_function.php');// Include any other required files

// Check if the order ID is provided in the request
if (isset($_GET['order_id'])) {
    // Retrieve the order ID from the request
    $order_id = $_GET['order_id'];

    // Query the database to fetch product titles for the specified order ID
    $get_product_titles_query = "SELECT products.product_title
                                 FROM user_orders
                                 LEFT JOIN products ON user_orders.product_id = products.product_id
                                 WHERE user_orders.order_id='$order_id'";
    $product_titles_result = mysqli_query($con, $get_product_titles_query);

    // Check if the query was successful and if product titles were found
    if ($product_titles_result && mysqli_num_rows($product_titles_result) > 0) {
        // Initialize an empty array to store product titles
        $product_titles = array();

        // Fetch product titles and store them in the array
        while ($row = mysqli_fetch_assoc($product_titles_result)) {
            $product_titles[] = $row['product_title'];
        }

        // Convert the array of product titles to a comma-separated string
        $product_titles_string = implode(', ', $product_titles);

        // Output the product titles string
        echo $product_titles_string;
    } else {
        // If no product titles were found, output an appropriate message
        echo "No product titles found for this order.";
    }
} else {
    // If the order ID is not provided in the request, output an error message
    echo "Order ID is missing in the request.";
}
?>
