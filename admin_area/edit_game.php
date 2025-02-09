<?php
    if(isset($_GET['edit_game'])){
        $edit_game=$_GET['edit_game'];
        $get_game="SELECT * FROM `vouchers` WHERE game_id=$edit_game";
        $result=mysqli_query($con,$get_game);
        $row=mysqli_fetch_assoc($result);
        $game_title=$row['game_title'];
    }

    if(isset($_POST['edit_games'])){
        $games_title=$_POST['game_title'];
        $update_query="UPDATE `vouchers` SET game_title='$games_title' WHERE game_id= $edit_game";
        $result_upd=mysqli_query($con,$update_query);
        if($result_upd){
            echo "<script>alert('Vouchers Updated Successfully')</script>";
            echo "<script>window.open('./index.php?view_game','_self')</script>";
        }
    }
?>
<div class="container mt-3">
    <h1 class="text-center text-success">Edit Delivery Option</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <label for="game_title" class="form-label">Delivery Title</label>
            <input type="text" name="game_title" id="game_title" class="form-control w-50 m-auto" required="required" value='<?php echo $game_title; ?>' autocomplete="off">
        </div>
        <input type="submit" value="Update Game" class="btn btn-info px-3 mb-3" name="edit_games">
    </form>
</div>