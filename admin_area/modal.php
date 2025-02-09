<?php
// Include your database connection file
include('../includes/connect.php');

// Attempt to establish a connection
if ($con) {
    echo "Connected successfully to the database!";
} else {
    echo "Failed to connect to the database: " . mysqli_connect_error();
}

// Close the database connection
mysqli_close($con);
?>