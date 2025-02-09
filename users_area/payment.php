<?php
include('../includes/connect.php');
include_once('../functions/common_function.php');

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Assign a default value or handle the case where the username is not set
    $username = "Guest";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
</head>
<style>
    .payment_img{
        width:90%;
        margin:auto;
        display:block;
    }
</style>
<body>
    <div class="container">
        <h2 class="text-center text-info">Payment options</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
            <?php
                $get_user = "SELECT * FROM `dummy_record` WHERE `username`='$username'";
                $result = mysqli_query($con, $get_user);
                if ($result && mysqli_num_rows($result) > 0) {
                    $run_query = mysqli_fetch_array($result);
                    $student_id = $run_query['student_id'];
                    echo "<a href='apply_voucher.php?student_id=$student_id'><h2 class='text-center'>Pick up</h2></a>";
                } else {
                    echo "<p class='text-center'>No user found for this student ID.</p>";
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>
