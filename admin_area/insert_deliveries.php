<?php
include('../includes/connect.php');
if (isset($_POST['insert_del'])){
  $delivery_title = $_POST['delivery_title'];
  
    // select data from database
    if (empty($delivery_title)) {
      echo "<script>alert('Please provide a Delivery Option title.')</script>";
  } else {
    $select_query="Select * from `delivery_option` where delivery_title='$delivery_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
      echo "<script>alert ('This Delivery Option is present inside the database')</script>";
    }else{
    $insert_query="insert into `delivery_option` (delivery_title) values ('$delivery_title')";
    $result=mysqli_query($con,$insert_query);
    if($result){
      echo "<script>alert ('Delivery Option has been successfully added')</script>";
    } 
  }
}
}
  
?>
<h2 class="text-center">Insert Shipping Company</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90  mb-2">
  <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="delivery_title" placeholder="Insert Shipping Company" aria-label="Shipping Company" aria-describedby="basic-addon1" autocomplete="off">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info p-2 border-0 my-3" name="insert_del" value="Insert Shipping Company">
  <button style="background-color: #5bc0de; color: black; padding: 5px ; border: none; border-radius: 10px; cursor: pointer; margin-left: 10px; height: 60px;" onclick="clearSearch()">Clear Search</button>
  <script>
    function clearSearch() {
        document.getElementById('searchInput').value = '';
    }
    </script>
</div>
</form>