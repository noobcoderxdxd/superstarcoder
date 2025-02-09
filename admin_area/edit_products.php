<?php
    if(isset($_GET['edit_products'])){
        $edit_id=$_GET['edit_products'];
        // echo $edit_id;
        $get_products="SELECT * FROM `products` WHERE product_id=$edit_id";
        $result=mysqli_query($con,$get_products);
        $row=mysqli_fetch_assoc($result);
        $product_title=$row['product_title'];
        // echo $product_title;
        $product_desc=$row['product_description'];
        $product_keywords=$row['product_keywords'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        $product_img1=$row['product_img1'];
        $product_img2=$row['product_img2'];
        $product_img3=$row['product_img3'];
        $product_price=$row['product_price'];

        // fetching category name
        $select_category="SELECT * FROM `categories` WHERE category_id=$category_id ";
        $cat_result=mysqli_query($con,$select_category);
        $row_cat=mysqli_fetch_assoc($cat_result);
        $category_title=$row_cat['category_title'];
        // echo $category_title;

                // fetching category name
                $select_brand="SELECT * FROM `brands` WHERE brand_id=$brand_id ";
                $brand_result=mysqli_query($con,$select_brand);
                $row_cat=mysqli_fetch_assoc($brand_result);
                $brand_title=$row_cat['brand_title'];
                // echo $brand_title;

        
    }
?>
<div class="container mt-5">
    <h1 class="text-center">Edit Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title?>" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" id="product_desc" value="<?php echo $product_desc?>" name="product_desc" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" value="<?php echo $product_keywords?>" name="product_keywords" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_category" class="form-label">Product Categories</label>
            <select name="product_category" class="form-select">
            <option value="<?php echo $category_id?>"><?php echo $category_title?></option>
                <?php 
                            $select_category_all="SELECT * FROM `categories`";
                            $cat_result_all=mysqli_query($con,$select_category_all);
                            while($row_cat_all=mysqli_fetch_assoc($cat_result_all)){
                                $category_title=$row_cat_all['category_title'];
                                $category_id=$row_cat_all['category_id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            };
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_brands" class="form-label">Product Brands</label>
            <select name="product_brands" class="form-select">
            <option value="<?php echo $brand_id?>"><?php echo $brand_title?></option>
                <?php 
                            $select_brand_all="SELECT * FROM `brands`";
                            $brand_result_all=mysqli_query($con,$select_brand_all);
                            while($row_brand_all=mysqli_fetch_assoc($brand_result_all)){
                                $brand_title=$row_brand_all['brand_title'];
                                $brand_id=$row_brand_all['brand_id'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                            };
                ?>
            </select>
        </div>
      <!-- Product Image1 -->
<div class="form-outline w-50 m-auto mb-4">
    <label for="product_img1" class="form-label">Product Image1</label>
    <div class="d-flex">
        <input type="file" id="product_img1" name="product_img1" class="form-control w-90 m-auto" required="required">
        <img src="./product_images/<?php echo $product_img1?>" alt="" class="product_img" style="max-width: 100px; max-height: 100px;">
    </div>
</div>
<!-- Product Image2 -->
<div class="form-outline w-50 m-auto mb-4">
    <label for="product_img2" class="form-label">Product Image2</label>
    <div class="d-flex">
        <input type="file" id="product_img2" name="product_img2" class="form-control w-90 m-auto" required="required">
        <img src="./product_images/<?php echo $product_img2?>" alt="" class="product_img" style="max-width: 100px; max-height: 100px;">
    </div>
</div>
<!-- Product Image3 -->
<div class="form-outline w-50 m-auto mb-4">
    <label for="product_img3" class="form-label">Product Image3</label>
    <div class="d-flex">
        <input type="file" id="product_img3" name="product_img3" class="form-control w-90 m-auto" required="required">
        <img src="./product_images/<?php echo $product_img3?>" alt="" class="product_img" style="max-width: 100px; max-height: 100px;">
    </div>
</div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price?>" name="product_price" class="form-control" required="required">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>

<!-- editing products -->
<?php
    if(isset($_POST['edit_product'])){
        $product_title = $_POST['product_title'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $product_category = $_POST['product_category'];
        $product_brands = $_POST['product_brands'];
        $product_price = $_POST['product_price'];

        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        $temp_img1 = $_FILES['product_img1']['tmp_name'];
        $temp_img2 = $_FILES['product_img2']['tmp_name'];
        $temp_img3 = $_FILES['product_img3']['tmp_name'];
        if(empty($product_title) || empty($product_desc) || empty($product_keywords) || empty($product_category) || empty($product_brands) || empty($product_img1) || empty($product_img2) || empty($product_img3) || empty($product_price)){
            echo "<script>alert('Please fill all the fields and continue the process')</script>";
        } else {
            move_uploaded_file($temp_img1, "./product_images/$product_img1");
            move_uploaded_file($temp_img2, "./product_images/$product_img2");
            move_uploaded_file($temp_img3, "./product_images/$product_img3");

            if(isset($edit_id) && !empty($edit_id)) {
                $update_product = "UPDATE `products` SET product_title=?, product_description=?, 
                product_keywords=?, category_id=?, brand_id=?, product_img1=?, product_img2=?, 
                product_img3=?, product_price=?, date=NOW() WHERE product_id=?";
                $stmt = mysqli_prepare($con, $update_product);
                if($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssiisssii", $product_title, $product_desc, $product_keywords, $product_category, $product_brands, $product_img1, $product_img2, $product_img3, $product_price, $edit_id);

                    $result_update = mysqli_stmt_execute($stmt);

                    if($result_update) {
                        echo "<script>alert('Product Updated Successfully')</script>";
                        echo "<script>window.open('./index.php','_self')</script>";
                    } else {
                        echo "<script>alert('Failed to update product')</script>";
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Edit ID is not set or empty.";
            }
        }
    }
?>