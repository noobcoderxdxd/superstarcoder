<?php
    include('../includes/connect.php');
    include_once('../functions/common_function.php');

    if (isset($_POST['admin_reg'])) {
        $admin_username = $_POST['username'];
        $admin_email = $_POST['email'];
        $admin_pass = $_POST['pass'];
        $admin_pass2 = $_POST['cpass'];
        $admin_ip = getIPAddress();

        // Check if password and confirmation match
        if ($admin_pass !== $admin_pass2) {
            echo "<script>alert('Passwords do not match')</script>";
        } else {
            // Check if the username or email already exist
            $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_username' OR admin_email='$admin_email'";
            $result = mysqli_query($con, $select_query);
            $rows_count = mysqli_num_rows($result);

            if ($rows_count > 0) {
                echo "<script>alert('Username or Email already exists')</script>";
            } else {
                // File upload handling
                $admin_image = $_FILES['profile_picture']['name'];
                $admin_image_tmp = $_FILES['profile_picture']['tmp_name'];

                // Move uploaded file to destination
                $destination_path = "./admin_image/$admin_image"; // Adjust the path here
                move_uploaded_file($admin_image_tmp, $destination_path);

                // Hash password
                $hashed_password = password_hash($admin_pass, PASSWORD_DEFAULT);

                // Insert query
                $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password, admin_image, admin_ip) 
                                VALUES ('$admin_username', '$admin_email', '$hashed_password', '$admin_image', '$admin_ip')";
                $sql_execute = mysqli_query($con, $insert_query);

                if ($sql_execute) {
                    echo "<script>alert('Registration successful')</script>";
                    echo "<script>window.open('admin_login.php','_self')</script>";
                } else {
                    echo "<script>alert('Failed to register')</script>";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom Styles */
        body {
            background-image: url('../pictures/arellano-university-campus.jpg'); /* Background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-attachment: fixed; /* Fixed background */
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            padding-top: 30px;
        }
        .header {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .header a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .header a:hover {
            color: #ffc107;
        }
        /* Form Styles */
        .form-card {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
            padding: 20px;
        }
        .form-card .form-control {
            border-radius: 5px;
        }
        .form-card input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }
        .form-card input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-card .small {
            font-size: 14px;
        }
        .form-card .link-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <h1>Admin Registration</h1>
        <a href="../admin_area/admin_login.php">Go Back</a>
    </header>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter Your Name" required="required" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter Your Email" required="required" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" id="pass" name="pass" placeholder="Enter Your Password" required="required" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="cpass" class="form-label">Confirm Password</label>
                        <input type="password" id="cpass" name="cpass" placeholder="Confirm Your Password" required="required" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                    </div>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-info" name="admin_reg" value="Register">
                        <p class="small mt-3">Already have an account? <a href="admin_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
</body>
</html>
