<?php
if(isset($_GET['delete_payment'])){
    include('../includes/connect.php');

    // Get the payment ID from the URL parameter and ensure it's an integer
    $delete_payment = intval($_GET['delete_payment']);

    // Prepare the delete query with a placeholder for the payment ID
    $delete_query_payment = "DELETE FROM `user_payments` WHERE order_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $delete_query_payment);
    
    // Bind the payment ID parameter to the statement
    mysqli_stmt_bind_param($stmt, "i", $delete_payment);

    // Execute the statement
    $success = mysqli_stmt_execute($stmt);

    // Check if the statement was executed successfully
    if($success){
        echo "<script>alert('Payment has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payment','_self')</script>";
    } else {
        // Handle errors if the statement execution fails
        echo "<script>alert('Failed to delete payment: " . mysqli_error($con) . "')</script>";
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
