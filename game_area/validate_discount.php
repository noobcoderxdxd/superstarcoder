<?php
// Include the database connection file
include('../includes/connect.php');

// Check if the discount_code parameter is set
if(isset($_POST['discount_code'])) {
    // Sanitize the discount code input to prevent SQL injection
    $discount_code = mysqli_real_escape_string($con, $_POST['discount_code']);

    // Query to check if the discount code exists in the database and get the discount value
    $check_discount_query = "SELECT discount_value FROM discount_codes WHERE code = '$discount_code'";
    $check_discount_result = mysqli_query($con, $check_discount_query);

    if($check_discount_result && mysqli_num_rows($check_discount_result) > 0) {
        $discount_row = mysqli_fetch_assoc($check_discount_result);
        $discount_value = $discount_row['discount_value'];

        // Return the discount value if the code is valid
        echo json_encode(array('valid' => true, 'discount' => $discount_value));
        exit;
    } else {
        // Return invalid if the code doesn't exist in the database
        echo json_encode(array('valid' => false));
        exit;
    }
} else {
    // If discount_code parameter is not set, return error message
    echo json_encode(array('error' => 'Discount code parameter is missing'));
    exit;
}
?>
