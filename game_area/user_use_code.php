<?php
// user_use_code.php

// Include the database connection file
include('../includes/connect.php');

if (isset($_POST['submit_code'])) {
    // Check if the code is provided
    if (!empty($_POST['user_code'])) {
        $user_code = $_POST['user_code'];

        // Select query to check if the entered code exists and is valid
        $code_query = "SELECT * FROM generated_codes WHERE code = '$user_code' AND is_used = 0 AND expiration_date > NOW()";
        $code_result = mysqli_query($con, $code_query);
        $code_rows_count = mysqli_num_rows($code_result);

        if ($code_rows_count > 0) {
            // Code is valid, redirect to the game page
            echo "<script>alert('Code is valid. Redirecting to the game page...')</script>";
            echo "<script>window.location.href = '../game_area/spintowin.php?code=" . urlencode($user_code) . "'</script>";
        } else {
            // Invalid or expired code
            echo "<script>alert('Invalid or expired code. Please try again.')</script>";
        }
    } else {
        // No code provided
        echo "<script>alert('Please enter a code.')</script>";
    }
}
?>
