<?php
// Start output buffering to prevent header-related issues
ob_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: user_login.php");
    exit(); // Ensure no further code is executed after redirection
}

// Get the username from the session
$username = $_SESSION['username'];

// Query the database to get the user's information based on their username
$get_user_query = "SELECT * FROM `dummy_record` WHERE `username`='$username'";
$user_result = mysqli_query($con, $get_user_query);

// Check if the query was successful and if a user was found
if ($user_result && mysqli_num_rows($user_result) > 0) {
    // Fetch the user details
    $user_row = mysqli_fetch_assoc($user_result);
    // Assign the student ID from the fetched user details
    $student_id = $user_row['student_id'];

   // Now that we have the student ID, we can use it to retrieve the orders
$get_order_details = "SELECT user_orders.*, products.product_title, user_orders.quantity
FROM user_orders
LEFT JOIN products ON user_orders.product_id = products.product_id
WHERE user_orders.student_id='$student_id'";
$result_orders = mysqli_query($con, $get_order_details);

    // Display the orders in a table
    // ...
} else {
    // Display a message or handle the case where no user was found
    echo "No user found for the provided username.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

        <tbody class="table-danger text-light">
        <h3 class="text-center">All Orders</h3>
<table class="table table-bordered mt-5">
<?php
   if (mysqli_num_rows($result_orders) > 0) {
       // Display a table header
       echo "<thead><tr class='text-center'>";
       echo "<th class='text-light' style='background-color: #28264C;'>Order Number</th>";
       echo "<th  class='text-light' style='background-color: #28264C;'>Total Products</th>";
       echo "<th  class='text-light' style='background-color: #28264C;'>Product Title</th>"; // Add this header for product title
       echo "<th  class='text-light' style='background-color: #28264C;'>Product Color</th>"; // Add this header for product color
       echo "<th  class='text-light' style='background-color: #28264C;'>Product Size</th>"; // Add this header for product size
       echo "<th  class='text-light' style='background-color: #28264C;'>Invoice Number</th>";
       echo "<th  class='text-light' style='background-color: #28264C;'>Amount Due</th>";
       echo "<th  class='text-light' style='background-color: #28264C;'>Date</th>";
       echo "<th  class='text-light' style='background-color: #28264C;'>Payment Status</th>";
       echo "<th  class='text-light' style='background-color: #28264C;'>Payment Confirment</th>"; // Add this header
       echo "</tr></thead><tbody>";
        
         while($row_orders = mysqli_fetch_assoc($result_orders)){
        $order_id = $row_orders['order_id'];
        $amount_due = $row_orders['amount_due'];
        $total_products = $row_orders['total_products'];
        $invoice_number = $row_orders['invoice_number'];
        $order_date = $row_orders['order_date'];
        $order_status = $row_orders['order_status'];
        $order_received = $row_orders['order_received'];
        $product_title = $row_orders['product_title']; // Fetch product title
        $product_color = $row_orders['product_color']; // Fetch product color
        $product_size = $row_orders['product_size']; // Fetch product size
            
            echo "<tr class='text-center'>";
            echo "<td style='background-color: #959EC9' class='text-light'>$order_id</td>";
            echo "<td style='background-color: #959EC9' class='text-light'>$total_products</td>";
            echo "<td style='background-color: #959EC9' class='text-light'>$product_title </td>";
echo "<td style='background-color: #959EC9;' class='text-light'>$product_color</td>"; // Display product color
echo "<td style='background-color: #959EC9;' class='text-light'>$product_size</td>"; // Display product size
            echo "<td style='background-color: #959EC9' class='text-light'>$invoice_number</td>";
            echo "<td style='background-color: #959EC9' class='text-light'>$amount_due</td>";
            echo "<td style='background-color: #959EC9' class='text-light'>$order_date</td>";
            echo "<td style='background-color: #959EC9' class='text-light'>$order_status</td>";
            echo "<td style='background-color: #959EC9' class='text-light'>";
            
            if ($order_status == 'Complete' && !$order_received) {
                // If order status is complete and not already confirmed as received, show the confirm receipt text
                echo "Payment Confirm";
            } elseif ($order_status == 'Complete' && $order_received) {
                // If order status is complete and already confirmed as received, show order confirmed
                echo "Order Confirmed";
            } else {
                // If the order status is not complete, do not display anything in the confirm order receipt column
                echo "Payment not confirm";
            }
            
            echo "</td></tr>";
        }
        echo "</tbody>";
    } else {
        echo "<h2 class='bg-danger text-center mt-5'>No Orders Yet</h2>";
    }
?>
        </tbody>
    </table>
</body>
</html>

<?php
// Flush the output buffer and send the output to the browser
ob_end_flush();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Handle click event for View More button
    $('.view-more-btn').click(function() {
        // Get the order ID associated with the clicked button
        var orderId = $(this).data('order-id');
        
        // AJAX request to fetch product titles for the order
        $.ajax({
            url: 'viewmore.php', // URL to fetch product titles
            type: 'GET',
            data: { order_id: orderId }, // Pass order ID as parameter
            success: function(response) {
                // Display product titles in a modal or expandable section
                // Here you can dynamically generate HTML to display the product titles
                alert('Product Titles: ' + response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error fetching product titles:', error);
            }
        });
    });
});
</script>