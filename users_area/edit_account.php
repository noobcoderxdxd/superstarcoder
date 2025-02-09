<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['edit_account'])) {
    // Check if the session variable is set
    if (!isset($_SESSION['username'])) {
        echo "Session username is not set.";
        // Handle the case where the session username is not set
        exit();
    }

    $user_session_name = $_SESSION['username'];
    
    // Use prepared statements to prevent SQL injection
    $select_query = "SELECT * FROM `user_table` WHERE username=?";
    $stmt = mysqli_prepare($con, $select_query);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $user_session_name);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result_query = mysqli_stmt_get_result($stmt);

    // Fetch the user data
    $row_fetch = mysqli_fetch_assoc($result_query);

    if ($row_fetch) {
        // User found, update variables
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];

        if (isset($_POST['user_update'])) {
            // Form submitted, update user information
            $update_id = $user_id;
            $new_username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_address = $_POST['user_address'];
            $user_mobile = $_POST['user_mobile'];
            $user_img = $_FILES['user_img']['name'];
            $user_img_tmp = $_FILES['user_img']['tmp_name'];

            if (!empty($user_img_tmp)) {
                // File uploaded, move it to the desired location
                move_uploaded_file($user_img_tmp, "./users_area/user_images/$user_img");
            } else {
                // File not selected or not uploaded, handle the error
                echo "Error uploading file or file not selected.";
                exit();
            }

            // Use prepared statement to prevent SQL injection
            $update_data = "UPDATE `user_table` SET username=?, user_email=?, user_address=?, user_image=?, user_mobile=? WHERE user_id=?";
            $stmt_update = mysqli_prepare($con, $update_data);

            // Bind parameters
            mysqli_stmt_bind_param($stmt_update, "sssssi", $new_username, $user_email, $user_address, $user_img, $user_mobile, $update_id);
            
            // Execute the statement
            $result_query_update = mysqli_stmt_execute($stmt_update);

            if ($result_query_update) {
                // Data updated successfully
                echo "<script>alert('Data updated successfully!')</script>";
                echo "<script>window.open('logout.php','_self')</script>";
            } else {
                // Error updating data, display the error message
                echo "Error updating data: " . mysqli_error($con);
            }
        }
    } else {
        // User not found, handle the error
        echo "No user found for the provided username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline mb-4">
    <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="username">
</div>
<div class="form-outline mb-4">
    <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
</div>
<div class="form-outline mb-4 d-flex w-50 m-auto">
    <input type="file" class="form-control" name="user_img">
    <img src="./users_area/user_images/<?php echo $user_img?>" alt="" class="edit_img">
</div>
<div class="form-outline mb-4">
    <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
</div>
<div class="form-outline mb-4">
    <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile">
</div>


    <input type="submit" value="Update" class="bg-info text-center py-2 px-3 border-0" name="user_update">
</form>
</body>
</html>