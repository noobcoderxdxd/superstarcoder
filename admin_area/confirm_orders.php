<h3 class="text-success text-center">All Confirm Orders</h3>
<table class="table table-bordered mt-5">
<?php
    $get_confirmed_orders_query = "SELECT u.order_id, u.student_id, d.username, u.amount_due, u.invoice_number, u.total_products, u.order_date 
                                   FROM user_orders u 
                                   INNER JOIN dummy_record d ON u.student_id = d.student_id 
                                   WHERE u.order_received = 1";

    $confirmed_orders_result = mysqli_query($con, $get_confirmed_orders_query);
    // Check if any confirmed orders were found
    if (mysqli_num_rows($confirmed_orders_result) > 0) {
        // Display a table header
        echo "<thead><tr class='text-center'>";
        echo "<th style='background-color: cyan;'>Order Number</th>";
        echo "<th style='background-color: cyan;'>User ID</th>";
        echo "<th style='background-color: cyan;'>Username</th>";
        echo "<th style='background-color: cyan;'>Amount</th>";
        echo "<th style='background-color: cyan;'>Invoice Number</th>";
        echo "<th style='background-color: cyan;'>Total Products</th>";
        echo "<th style='background-color: cyan;'>Order Date</th>";
        echo "<th style='background-color: cyan;'>Delete</th>";
        echo "</tr></thead><tbody>";
        
        while($row_data = mysqli_fetch_assoc($confirmed_orders_result)){
            $order_id = $row_data['order_id'];
            $student_id = $row_data['student_id'];
            $username = $row_data['username'];
            $amount = $row_data['amount_due'];
            $invoice_number = $row_data['invoice_number'];
            $tp = $row_data['total_products'];
            $order_date = $row_data['order_date'];
            
            echo "<tr class='text-center'>";
            echo "<td style='background-color: grey;' class='text-light'>$order_id</td>";
            echo "<td style='background-color: grey;' class='text-light'>$student_id</td>";
            echo "<td style='background-color: grey;' class='text-light'>$username</td>";
            echo "<td style='background-color: grey;' class='text-light'>$amount</td>";
            echo "<td style='background-color: grey;' class='text-light'>$invoice_number</td>";
            echo "<td style='background-color: grey;' class='text-light'>$tp</td>";
            echo "<td style='background-color: grey;' class='text-light'>$order_date</td>";
            echo "<td style='background-color: grey;' class='text-light'><a href='index.php?delete_payment=$order_id' type='button' class='text-light' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<h2 class='bg-danger text-center mt-5'>No Confirmed Orders Yet</h2>";
    }
?>
</table>
