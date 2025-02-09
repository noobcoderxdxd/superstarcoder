<?php
    if(isset($_GET['edit_delivery'])){
        $edit_delivery=$_GET['edit_delivery'];
        $get_delivery="SELECT * FROM `delivery_option` WHERE delivery_id=$edit_delivery";
        $result=mysqli_query($con,$get_delivery);
        $row=mysqli_fetch_assoc($result);
        $delivery_title=$row['delivery_title'];
    }

    if(isset($_POST['edit_deli'])){
        $deli_title=$_POST['delivery_title'];
        $update_query="UPDATE `delivery_option` SET delivery_title='$deli_title' WHERE delivery_id= $edit_delivery";
        $result_upd=mysqli_query($con,$update_query);
        if($result_upd){
            echo "<script>alert('Delivery Option Updated Successfully')</script>";
            echo "<script>window.open('./index.php?view_delivery','_self')</script>";
        }
    }
?>
<div class="container mt-3">
    <h1 class="text-center text-success">Edit Delivery Option</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <label for="delivery_title" class="form-label">Delivery Title</label>
            <input type="text" name="delivery_title" id="delivery_title" class="form-control w-50 m-auto" required="required" value='<?php echo $delivery_title; ?>' autocomplete="off">
        </div>
        <input type="submit" value="Update Delivery" class="btn btn-info px-3 mb-3" name="edit_deli">
    </form>
</div>