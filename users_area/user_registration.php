<?php
session_start(); // Initialize session

include('../includes/connect.php');
include_once('../functions/common_function.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_register'])) {
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_pass = $_POST['user_pass'];
    $user_pass2 = $_POST['user_pass2'];
    $user_ip = getIPAddress($con); // Assuming getIPAddress() is a function to fetch IP address

    // Check if password and confirmation match
    if ($user_pass !== $user_pass2) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Check if username or email already exist
        $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
        $result = mysqli_query($con, $select_query);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or Email already exists')</script>";
        } else {
            // Insert user data into the database
            $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO `user_table` (user_address, user_mobile, username, user_email, user_image, user_password, user_ip) 
                            VALUES ('$user_address', '$user_contact', '$user_username', '$user_email', '$user_image', '$hashed_password', '$user_ip')";
            
            if (mysqli_query($con, $insert_query)) {
                $destination_path = "users_area/user_images/$user_image";  // Adjust the path here

                // Check if the directory exists, create it if not
                if (!is_dir(dirname($destination_path))) {
                    mkdir(dirname($destination_path), 0777, true);
                }

                // Move uploaded file to destination path
                move_uploaded_file($user_image_tmp, $destination_path);
                echo "<script>alert('Registration successful')</script>";
            } else {
                echo "<script>alert('Failed to register')</script>";
            }
        }
    }
    
    // Redirect user based on cart items
    $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    
    if (mysqli_num_rows($result_cart) > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Registration</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(to bottom, #959EC9, #E8EAE7); /* Gradient from purple to red */
            backdrop-filter: blur(100px); /* Apply blur effect */
            overflow-x: hidden;
        }

        .login-container {
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8); /* Light purple with opacity */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2a1546; /* Dark purple text color */
        }

        .login-logo img {
            max-width: 140px; /* Adjust the maximum width as needed */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center" style="color: #2a1546;">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6 login-container">
                <form method="post" action="" enctype="multipart/form-data">
                    <!-- Address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your complete address" autocomplete="off" required="required" name="user_address">
                    </div>

                    <!-- Phone number field -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Phone number</label>
                        <input name="user_contact" type="text" id="user_contact" class="form-control" placeholder="Enter your phone number" autocomplete="off" required="required">
                    </div>

                    <!-- Username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                    </div>

                    <!-- Email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your E-mail" autocomplete="off" required="required" name="user_email">
                    </div>

                    <!-- User Image field -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                    </div>

                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="user_pass" class="form-label">Password</label>
                        <input type="password" id="user_pass" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_pass">
                    </div>

                    <!-- Confirm Password field -->
                    <div class="form-outline mb-4">
                        <label for="user_pass2" class="form-label">Confirm Password</label>
                        <input type="password" id="user_pass2" class="form-control" placeholder="Confirm Password" autocomplete="off" required="required" name="user_pass2">
                    </div>

                    <!-- Register button -->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-3 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- 
if (isset($_POST['user_register'])) {
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_pass=$_POST['user_pass'];
    $user_pass2=$_POST['user_pass2'];
    $user_ip=getIPAddress();

    // Check if password and confirmation match
    if ($user_pass !== $user_pass2) {
        echo "<script>alert('Password do not match')</script>";
    } else {
        // Select query
        $select_query="SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
        $result=mysqli_query($con, $select_query);
        $rows_count=mysqli_num_rows($result);

        if ($rows_count > 0) {
            echo "<script>alert('Username and Email already exist')</script>";
        } else {
            // Insert query
            $hashed_password=password_hash($user_pass, PASSWORD_DEFAULT);
            $insert_query="INSERT INTO `user_table` (user_addres, user_mobile, username, user_email, user_image, user_password, user_ip) 
                            VALUES ('$user_address', '$user_contact', '$user_username', '$user_email', '$hashed_password', '$user_image', '$user_ip')";

            $sql_execute=mysqli_query($con, $insert_query);

            if ($sql_execute) {
                $destination_path="users_area/user_images/$user_image";  // Adjust the path here

                // Check if the directory exists, create it if not
                if (!is_dir(dirname($destination_path))) {
                    mkdir(dirname($destination_path), 0777, true);
                }

                move_uploaded_file($user_image_tmp, $destination_path);
                echo "<script>alert('Registration successful')</script>";
            } else {
                echo "<script>alert('Failed to register')</script>";
            }
        }
    }
    // selecting cart items
    $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
    $result_cart=mysqli_query($con, $select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if ($rows_count>0) {
        $_SESSION['username']=$user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
-->


