<?php
if(isset($_GET['delete_user'])){
    include('../includes/connect.php');

    // Get the user ID from the URL parameter and ensure it's an integer
    $delete_user = intval($_GET['delete_user']);

    // Prepare the delete query with a placeholder for the user ID
    $delete_query = "DELETE FROM `user_table` WHERE user_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $delete_query);
    
    // Bind the user ID parameter to the statement
    mysqli_stmt_bind_param($stmt, "i", $delete_user);

    // Execute the statement
    $success = mysqli_stmt_execute($stmt);

    // Check if the statement was executed successfully
    if($success){
        echo "<script>alert('User has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_user','_self')</script>";
    } else {
        // Handle errors if the statement execution fails
        echo "<script>alert('Failed to delete user: " . mysqli_error($con) . "')</script>";
    }

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
