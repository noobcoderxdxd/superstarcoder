<?php
    if(isset($_GET['delete_brand'])){
        $delete_brand=$_GET['delete_brand'];
        $delete_query_brands="DELETE FROM `brands` WHERE brand_id=$delete_brand";
        $result=mysqli_query($con,$delete_query_brands);
        if($result){
            echo "<script>alert('Brand is been deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_brands','_self')</script>";
        }

    }


?>