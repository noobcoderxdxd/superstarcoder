<?php
include('../includes/connect.php');
session_start();

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = ?";
    $stmt_select = $con->prepare($select_data);
    $stmt_select->bind_param("i", $order_id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $row_fetch = $result->fetch_assoc();
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];

    // Fetch other orders with the same invoice number
    $fetch_other_orders = "SELECT order_id FROM `user_orders` WHERE invoice_number = ? AND order_status != 'Complete'";
    $stmt_fetch = $con->prepare($fetch_other_orders);
    $stmt_fetch->bind_param("s", $invoice_number);
    $stmt_fetch->execute();
    $other_orders_result = $stmt_fetch->get_result();

    // Update status for other orders with the same invoice number
    while ($other_order_row = $other_orders_result->fetch_assoc()) {
        $other_order_id = $other_order_row['order_id'];
        $update_other_order = "UPDATE `user_orders` SET order_status = 'Complete' WHERE order_id = ?";
        $stmt_update_other = $con->prepare($update_other_order);
        $stmt_update_other->bind_param("i", $other_order_id);
        $stmt_update_other->execute();
    }
}
if(isset($_POST['confirm_payment'])) {
    // Retrieve necessary details
    $order_id = $_GET['order_id']; // Assuming you have order_id available in the URL or session
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode']; 
    $date = date('Y-m-d H:i:s'); // Assuming you want to use the current date

    // Insert payment data into user_payments table
    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode, date) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $con->prepare($insert_query);
    $stmt_insert->bind_param('isdss', $order_id, $invoice_number, $amount, $payment_mode, $date);
    
    if($stmt_insert->execute()) {
        // Update order status to 'Complete' in user_orders table
        $update_orders = "UPDATE `user_orders` SET order_status = 'Complete' WHERE order_id = ?";
        $stmt_update = $con->prepare($update_orders);
        $stmt_update->bind_param("i", $order_id);
        
        if($stmt_update->execute()) {
            // Update stock quantity and total sold in the products table based on the quantity ordered
            $update_stock_query = "UPDATE `products` p 
                       INNER JOIN `user_orders` u ON p.product_id = u.product_id 
                       SET p.stock_quantity = p.stock_quantity - u.total_products, 
                           p.total_sold = p.total_sold + u.total_products
                       WHERE u.order_id = ?";

            $stmt_update_stock = $con->prepare($update_stock_query);
            $stmt_update_stock->bind_param("i", $order_id);
            $stmt_update_stock->execute();

            echo "<script>alert('Payment successfully completed.')</script>";
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to update order status.')</script>";
        }
    } else {
        echo "<script>alert('Failed to confirm payment.')</script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chief Store - Confirm Payment</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .form-control {
            width: 50%;
            margin: auto;
        }
        .form-select {
            width: 50%;
            margin: auto;
        }
        .btn-confirm {
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-confirm:hover {
            background-color: #212529;
        }
    </style>
</head>
<body class="bg-secondary">
    <h1 class="text-center text-light">Confirm Payment</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control" name="invoice_number" value="<?php echo $invoice_number ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control" name="amount" value="<?php echo $amount_due ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center">
                <select name="payment_mode" class="form-select">
                    <option value="">Select Payment Method:</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center">
                <input type="submit" class="btn btn-confirm" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>
