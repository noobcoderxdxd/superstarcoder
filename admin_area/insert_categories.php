<?php
include('../includes/connect.php');
if (isset($_POST['insert_cat'])){
  $category_title = $_POST['dog_title'];
  
    // select data from database
    if (empty($category_title)) {
      echo "<script>alert('Please provide a category title.')</script>";
  } else {
    $select_query="Select * from `categories` where category_title='$category_title'";
    $result_select=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
      echo "<script>alert ('This category is present inside the database')</script>";
    }else{
    $insert_query="insert into `categories` (category_title) values ('$category_title')";
    $result=mysqli_query($con,$insert_query);
    if($result){
      echo "<script>alert ('Category has been successfully added')</script>";
    } 
  }
}
}
  
?>
<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90  mb-2">
  <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="dog_title" placeholder="Insert categories" aria-label="Categories" aria-describedby="basic-addon1" autocomplete="off">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info p-2 border-0 my-3" name="insert_cat" value="Insert Categories">
  <button style="background-color: #5bc0de; color: black; padding: 5px ; border: none; border-radius: 10px; cursor: pointer; margin-left: 10px; height: 60px;" onclick="clearSearch()">Clear Search</button>
  <script>
    function clearSearch() {
        document.getElementById('searchInput').value = '';
    }
    </script>
</div>
</form>