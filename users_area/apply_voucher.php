<?php
session_start();
include('../includes/connect.php');
include_once('../functions/common_function.php');

// Check if student_id is set in the session
if(isset($_SESSION['student_id'])) {
    // Retrieve student_id from session
    $student_id = $_SESSION['student_id'];

    // Get total amount from cart
    $get_total_query = "SELECT SUM(cd.quantity * p.product_price) AS total_amount 
                        FROM cart_details cd 
                        INNER JOIN products p ON cd.product_id = p.product_id
                        WHERE cd.student_id='$student_id'";
    $result_total = mysqli_query($con, $get_total_query);
    $row_total = mysqli_fetch_assoc($result_total);
    $total = $row_total['total_amount'];

    // Check if form is submitted
    if(isset($_POST['voucherCode'])) {
        $voucherCode = mysqli_real_escape_string($con, $_POST['voucherCode']);

        // Check if the total amount is already $10
        if($total == 10) {
            // Display an error message
            echo "<script>alert('The total amount is already 10php. You cannot apply a voucher code.')</script>";
        } else {
            // Query to check if the voucher code exists in the database for any user or specific user
            $checkVoucherQuery = "SELECT * FROM discount_codes WHERE code = '$voucherCode' AND (student_id = '$student_id' OR student_id IS NULL)";
            $checkVoucherResult = mysqli_query($con, $checkVoucherQuery);

            if($checkVoucherResult && mysqli_num_rows($checkVoucherResult) > 0) {
                // Voucher code is valid
                $voucherDetails = mysqli_fetch_assoc($checkVoucherResult);

                // Apply discount
                $_SESSION['voucher_code'] = $voucherCode;
                $_SESSION['voucher_discount'] = $voucherDetails['discount_value'];

                // Mark the voucher code as used in the database
                $markUsedQuery = "UPDATE discount_codes SET is_used = 1 WHERE code = '$voucherCode'";
                mysqli_query($con, $markUsedQuery);

                // Redirect to order submission page
                header("Location: order_submission.php");
                exit();
            } else {
                // Handle invalid voucher code
                echo "<script>alert('Invalid voucher code. Please try again.')</script>";
            }
        }
    }
} else {
    // Student ID is not set, redirect to login page or display error message
    echo "Error: Student ID is not set. Please log in.";
    // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Voucher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 8px;
            margin-bottom: 20px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        h3 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Apply Voucher</h2>
        <form method="POST">
            <label for="voucherCode">Enter voucher code:</label>
            <input type="text" id="voucherCode" name="voucherCode" required>
            <button type="submit">Apply</button>
        </form>
        <form action="order.php" method="GET">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <button type="submit" class="btn btn-primary" name="submit">Proceed to Order</button>
        </form>
        <h3>Total Amount Due: <?php echo number_format($total, 2); ?> Php</h3>
    </div>
</body>
</html>

