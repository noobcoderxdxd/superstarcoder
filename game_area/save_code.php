<?php
session_start();
include('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the unique code sent from JavaScript
    $uniqueCode = $_POST['unique_code'];

    // Define the discount value (10%)
    $discountValue = 10;

    // Insert the unique code and discount value into the database
    $insertQuery = "INSERT INTO discount_codes (code, discount_value) VALUES ('$uniqueCode', $discountValue)";
    $result = mysqli_query($con, $insertQuery);
    
    if ($result) {
        // Insertion successful
        http_response_code(200);
    } else {
        // Insertion failed
        http_response_code(500);
    }
} else {
    // If not a POST request, respond with an error
    http_response_code(400);
    echo 'Error: Invalid request';
}
?>
