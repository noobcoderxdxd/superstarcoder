<?php
    if(isset($_GET['delete_orders'])){
        $delete_orders=$_GET['delete_orders'];
        $delete_query_orders="DELETE FROM `user_orders` WHERE order_id=$delete_orders";
        $result=mysqli_query($con,$delete_query_orders);
        if($result){
            echo "<script>alert('Order is been deleted successfully')</script>";
            echo "<script>window.open('./index.php?list_orders','_self')</script>";
        }

    }


?>