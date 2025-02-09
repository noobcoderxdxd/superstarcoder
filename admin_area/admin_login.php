<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../includes/connect.php');
include_once('../functions/common_function.php');

if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['username'];
    $admin_pass = $_POST['pass'];

    $stmt = $con->prepare("SELECT * FROM admin_table WHERE admin_name = ?");
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row_data = $result->fetch_assoc();
        if (password_verify($admin_pass, $row_data['admin_password'])) {
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['admin_name'] = $row_data['admin_name'];
            $_SESSION['admin_image'] = $row_data['admin_image'];
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid username or password. Please try again.')</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password. Please try again.')</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <img src="/Arellano University Store\pictures\adminlog.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-3">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter Your Name" required="required" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" id="pass" name="pass" placeholder="Enter Your Password" required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
