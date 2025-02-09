<?php
include('../includes/connect.php');
if (isset($_POST['insert_game'])){
  $game_title = $_POST['game_title'];
  
    // select data from database
    if (empty($game_title)) {
      echo "<script>alert('Please provide a game title.')</script>";
  } else {
    $select_query="Select * from `vouchers` where game_title='$game_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
      echo "<script>alert ('This voucher is present inside the database')</script>";
    }else{
    $insert_query="insert into `vouchers` (game_title) values ('$game_title')";
    $result=mysqli_query($con,$insert_query);
    if($result){
      echo "<script>alert ('Voucher has been successfully added')</script>";
    } 
  }
}
}
  
?>
<h2 class="text-center">Insert Vouchers</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90  mb-2">
  <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="game_title" placeholder="Insert vouchers" aria-label="Vouchers" aria-describedby="basic-addon1" autocomplete="off">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info p-2 border-0 my-3" name="insert_game" value="Insert Vouchers">
  <button style="background-color: #5bc0de; color: black; padding: 5px ; border: none; border-radius: 10px; cursor: pointer; margin-left: 10px; height: 60px;" onclick="clearSearch()">Clear Search</button>
  <script>
    function clearSearch() {
        document.getElementById('searchInput').value = '';
    }
    </script>
</div>
</form>