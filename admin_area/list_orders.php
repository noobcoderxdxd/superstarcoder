<?php
// Assuming $con is your database connection
// Get the current date and time
$current_date = date('Y-m-d H:i:s');

// Query to select expired orders
$select_expired_orders = "SELECT * FROM user_orders WHERE order_status = 'Incomplete' AND expiration_date < '$current_date'";

// Execute the query
$result_expired_orders = mysqli_query($con, $select_expired_orders);

// Loop through the expired orders and delete them
while ($row_expired_order = mysqli_fetch_assoc($result_expired_orders)) {
    $expired_order_id = $row_expired_order['order_id'];
    // Delete the expired order from the database
    $delete_query = "DELETE FROM user_orders WHERE order_id = '$expired_order_id'";
    mysqli_query($con, $delete_query);
}

// SQL query to retrieve orders with product information including color and size
// Query to retrieve orders along with username and product title
// Query to retrieve orders along with username, product title, quantity from cart_details, and expiration date
$get_orders = "SELECT user_orders.*, dummy_record.username, products.product_title, cart_details.quantity, user_orders.expiration_date
               FROM user_orders 
               LEFT JOIN dummy_record ON user_orders.student_id = dummy_record.student_id
               LEFT JOIN products ON user_orders.product_id = products.product_id
               LEFT JOIN cart_details ON user_orders.student_id = cart_details.student_id";

// Check if there's a search query
if(isset($_GET['search_invoice']) && !empty($_GET['search_data'])) {
  $search_query = $_GET['search_data'];
  $get_orders .= " WHERE invoice_number = '$search_query'";
}

// Execute the query
$result = mysqli_query($con, $get_orders);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<h3 class=' text-center'>All Orders</h3>";
    echo "<form class='d-flex justify-content-end mt-3 mb-3' action='index.php?search_invoice' method='get' style='max-width: 300px;'>";
    echo "<input class='form-control form-control-sm me-2' type='search' placeholder='Search by Invoice Number' autocomplete='off' aria-label='Search' name='search_data'>";
    echo "<input type='submit' value='Search' class='btn btn-outline-primary btn-sm' name='search_invoice'>";
    echo "</form>";
    
    echo "<table class='table table-bordered mt-3'>";
    echo "<thead>
            <tr class='text-center'>
                <th style='background-color: #28264C;' class='text-light'>Order ID</th>
                <th style='background-color: #28264C;' class='text-light'>Student ID</th>
                <th style='background-color: #28264C;' class='text-light'>Username</th>
                <th style='background-color: #28264C;' class='text-light'>Product Name</th>
                <th style='background-color: #28264C;' class='text-light'>Product Color</th> <!-- New column for product color -->
                <th style='background-color: #28264C;' class='text-light'>Product Size</th> <!-- New column for product size -->
                <th style='background-color: #28264C;' class='text-light'>Due Amount</th>
                <th style='background-color: #28264C;' class='text-light'>Invoice Number</th>
                <th style='background-color: #28264C;' class='text-light'>Total Products</th>
                <th style='background-color: #28264C;' class='text-light'>Order Date</th>
                <th style='background-color: #28264C;' class='text-light'>Status</th>
                <th style='background-color: #28264C;' class='text-light'>Expiration Date</th> <!-- New column for expiration date -->
                <th style='background-color: #28264C;' class='text-light'>Delete</th>
                <th style='background-color: #28264C;' class='text-light'>Payment</th>
            </tr>
          </thead>";
          
    // Loop through each row of the result set
    while ($row_data = mysqli_fetch_assoc($result)) {
        // Fetch data from the row
        $order_id = $row_data['order_id'];
        $student_id = $row_data['student_id'];
        $username = $row_data['username']; // Fetch StudentNumber from dummy_record table
        $product_name = $row_data['product_title']; // Fetch product name
        $product_color = $row_data['product_color']; // Fetch product color
        $product_size = $row_data['product_size']; // Fetch product size
        $amount_due = $row_data['amount_due'];
        $invoice_number = $row_data['invoice_number'];
        $total_products = $row_data['total_products'];
        $order_date = $row_data['order_date'];
        $order_status = $row_data['order_status'];
        $expiration_date = $row_data['expiration_date']; // Fetch expiration date
        $order_status_display = ($order_status == 'pending') ? 'Incomplete' : 'Complete';

        // Display the order details in table rows
        echo "<tr class='text-center'>
                <td style='background-color: #959EC9;' class='text-light'>$order_id</td>
                <td style='background-color: #959EC9;' class='text-light'>$student_id</td>
                <td style='background-color: #959EC9;' class='text-light'>$username</td>
                <td style='background-color: #959EC9;' class='text-light'>$product_name</td>
                <td style='background-color: #959EC9;' class='text-light'>$product_color</td> <!-- Display product color -->
                <td style='background-color: #959EC9;' class='text-light'>$product_size</td> <!-- Display product size -->
                <td style='background-color: #959EC9;' class='text-light'>$amount_due</td>
                <td style='background-color: #959EC9;' class='text-light'>$invoice_number</td>
                <td style='background-color: #959EC9;' class='text-light'>$total_products</td>
                <td style='background-color: #959EC9;' class='text-light'>$order_date</td>
                <td style='background-color: #959EC9;' class='text-light'>$order_status_display</td>
                <td style='background-color: #959EC9;' class='text-light'>$expiration_date</td> <!-- Display expiration date -->
                <td style='background-color: #959EC9;' class='text-light'><a href='index.php?delete_orders=$order_id' type='button' class='text-light' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>";

        // Payment confirmation section
        if ($order_status == 'pending') {
            echo "<td style='background-color: #959EC9;' class='text-light'><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>";
        } else {
            echo "<td style='background-color: #959EC9;' class='text-light'>Paid</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
} else {
    // If no rows are returned, display a message
    echo "<h2 class='bg-danger text-center mt-5'>No orders found with the provided invoice number</h2>";
}
?>
