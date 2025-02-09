<?php
    if(isset($_GET['delete_game'])){
        $delete_game=$_GET['delete_game'];
        $delete_query_game="DELETE FROM `vouchers` WHERE game_id=$delete_game";
        $result=mysqli_query($con,$delete_query_game);
        if($result){
            echo "<script>alert('Voucher is been deleted successfully')</script>";
            echo "<script>window.open('./index.php?view_game','_self')</script>";
        }

    }


?>