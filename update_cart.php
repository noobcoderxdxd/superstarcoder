<!-- PHP Script to Update Cart Details (update_cart.php) -->
<?php
include('./includes/connect.php');
// Connect to the database

if (isset($_POST['productId'], $_POST['selectedColor'], $_POST['selectedSize'])) {
    $productId = $_POST['productId'];
    $selectedColor = $_POST['selectedColor'];
    $selectedSize = $_POST['selectedSize'];

    // Update cart details in the database
    $updateQuery = "UPDATE cart_details 
                    SET product_color = '$selectedColor', product_size = '$selectedSize'
                    WHERE product_id = $productId";

    $result = mysqli_query($con, $updateQuery);
    if ($result) {
        echo "Cart details updated successfully.";
    } else {
        echo "Error updating cart details: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
