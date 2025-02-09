<?php
    if(isset($_GET['delete_delivery'])){
        $delete_delivery=$_GET['delete_delivery'];
        $delete_query_delivery="DELETE FROM `delivery_option` WHERE delivery_id=$delete_delivery";
        $result=mysqli_query($con,$delete_query_delivery);
        if($result){
            echo "<script>alert('Delivery Option is been deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_delivery','_self')</script>";
        }

    }


?>