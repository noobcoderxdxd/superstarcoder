<?php
    if(isset($_GET['edit_brand'])){
        $edit_brand=$_GET['edit_brand'];
        $get_brands="SELECT * FROM `brands` WHERE brand_id=$edit_brand";
        $result=mysqli_query($con,$get_brands);
        $row=mysqli_fetch_assoc($result);
        $brand_title=$row['brand_title'];
    }

    if(isset($_POST['edit_bra'])){
        $bra_title=$_POST['brand_title'];
        $update_query="UPDATE `brands` SET brand_title='$bra_title' WHERE brand_id= $edit_brand";
        $result_upd=mysqli_query($con,$update_query);
        if($result_upd){
            echo "<script>alert('Brand Updated Successfully')</script>";
            echo "<script>window.open('./index.php?view_brands','_self')</script>";
        }
    }
?>

<div class="container mt-3">
    <h1 class="text-center text-dark">Edit Organization/Merchandise</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <label for="brand_title" class="form-label">Organization/Merchandise Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control w-50 m-auto" required="required"  value='<?php echo $brand_title; ?>' autocomplete="off">
        </div>
        <input type="submit" value="Update Organization/Merchandise" class="btn btn-info px-3 mb-3"  name="edit_bra">
    </form>
</div>