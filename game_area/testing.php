<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Submit Code</title>
</head>
<body>
<?php
// Include the database connection file
include('../includes/connect.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, fetch user information
    $username = $_SESSION['username'];
    $query = "SELECT * FROM user_table WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // User found, display user information
        $user = mysqli_fetch_assoc($result);
        echo "<p>User ID: {$user['user_id']}</p>";
        echo "<p>Username: {$user['username']}</p>";
        echo "<p>Email: {$user['user_email']}</p>";
        // Add other user information as needed
    } else {
        // User not found in the database
        echo "<p>Error: User not found in the database.</p>";
    }
} else {
    // User is not logged in
    echo "<p>User is not logged in.</p>";
}
?>

    <!-- Your HTML for the code entry form goes here -->
</body>
</html>
