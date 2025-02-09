<?php
session_start();
include('../includes/connect.php');
include_once('../functions/common_function.php');

if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_pass = $_POST['user_pass'];

    // Select user data from the database
    $select_query = "SELECT * FROM `dummy_record` WHERE `username`='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($result);

    // Check if user exists
    if ($row_data) {
        // Verify the password
        $password_from_db = $row_data['StudentNumber'];
        if ($user_pass === $password_from_db) { // Compare passwords directly
            // Password is correct, set session variables
            $_SESSION['username'] = $user_username;
            $_SESSION['student_id'] = $row_data['student_id']; // Assuming student_id is retrieved from the database

            // Redirect the user to the profile page
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
            exit(); // Stop further execution
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid Password')</script>";
        }
    } else {
        // User does not exist
        echo "<script>alert('User does not exist')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Login</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        html, body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <div class="login-logo">
                        <!-- Add your logo or image here -->
                        <img src="../pictures/aulogo.png" alt="arellano">
                    </div>
                    <h2 class="login-title">WELCOME BACK CHIEFS</h2>
                    <h4 class="login-title">USER LOGIN</h4>
                    <form action="" method="post">
                        <div class="mb-3">
                            <!-- Username field -->
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                        </div>
                        <div class="mb-3">
                            <!-- Password field -->
                            <label for="user_pass" class="form-label">Password</label>
                            <input type="password" id="user_pass" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_pass">
                        </div>
                        <!-- Login button -->
                        <div class="mb-3">
                            <input type="submit" value="Login" class="btn btn-info" name="user_login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
