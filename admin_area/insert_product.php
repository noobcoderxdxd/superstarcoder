<?php
include('../includes/connect.php');

if (isset($_POST['insert_product'])) {
    // Extracting the received data
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $product_category = intval($_POST['product_category']);
    $brand_id = intval($_POST['brand_id']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_status = 'true';

    // Accessing image info
    $product_image1 = mysqli_real_escape_string($con, $_FILES['product_image1']['name']);
    $product_image2 = mysqli_real_escape_string($con, $_FILES['product_image2']['name']);
    $product_image3 = mysqli_real_escape_string($con, $_FILES['product_image3']['name']);

    // Move uploaded files to the correct directory
    move_uploaded_file($_FILES['product_image1']['tmp_name'], "../admin_area/product_images/$product_image1");
    move_uploaded_file($_FILES['product_image2']['tmp_name'], "../admin_area/product_images/$product_image2");
    move_uploaded_file($_FILES['product_image3']['tmp_name'], "../admin_area/product_images/$product_image3");

    // Insert query
    $insert_products = "INSERT INTO products (product_title, product_description, product_keywords, 
                        category_id, brand_id, product_price, product_img1, product_img2, product_img3, 
                        date, status) VALUES ('$product_title', '$description', '$product_keywords', 
                        $product_category, $brand_id, '$product_price', 
                        '$product_image1', '$product_image2', '$product_image3', NOW(), '$product_status')";


    $result_query = mysqli_query($con, $insert_products);

    if ($result_query) {
        echo "<script>alert('Successfully inserted the products')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

    <!--css file-->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3 w-50 m-auto">
        <!-- title -->
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="insert_product.php" method="post" enctype="multipart/form-data">

            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off"
                required="required">            
            </div>
            <!-- description -->
            <div class="form-outline mb-4">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter Product Description" autocomplete="off"
                required="required">            
            </div>
            <!-- keyword -->
            <div class="form-outline mb-4">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter Product Keywords" autocomplete="off"
                required="required">            
            </div>
            <!-- categories -->
            <div class="form-outline mb-4">
                <select name="product_category" class="form-select">
                    <option value="">Select a category</option>
                    <?php
                        $select_query="SELECT * FROM `categories`";
                        $result_query=mysqli_query($con,$select_query);
                        while($row=mysqli_fetch_assoc($result_query)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>            
            </div>
            <!-- brand -->
            <div class="form-outline mb-4">
    <select name="brand_id" class="form-select">
        <option value="">Select a Organizaton option</option>
        <?php
            $select_query = "SELECT * FROM `brands`";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $brand_title = $row['brand_title'];
                $brand_id = $row['brand_id'];
                echo "<option value='$brand_id'>$brand_title</option>";
            }
        ?>
    </select>
</div>

            <!-- image 1 -->
            <div class="form-outline mb-4">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">            
            </div>
            <!-- image 2 -->
            <div class="form-outline mb-4">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control">            
            </div>
            <!-- image 3 -->
            <div class="form-outline mb-4">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control">            
            </div>
            <!-- price -->
            <div class="form-outline mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" autocomplete="off"
                required="required">            
            </div>
            <!-- price -->
            <div class="form-outline mb-4">
                <input type="submit" name="insert_product" class="btn btn-info border-0 mb-3 px-3" value="Insert Product">            
            </div>
        </form>
    </div>
    
</body>
</html>