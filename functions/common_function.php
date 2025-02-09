<?php 

// Function to get products
function getproducts(){
  global $con;
  // condition to check isset or not
  if(!isset($_GET['category'])){
      if(!isset($_GET['brand'])){
          if(!isset($_GET['deliveryopt'])){
              $select_query = "SELECT * FROM `products` ORDER BY rand() LIMIT 0,4";
              $result_query = mysqli_query($con, $select_query);
              while($row = mysqli_fetch_assoc($result_query)){
                  $product_id = $row['product_id'];
                  $product_title = $row['product_title'];
                  $product_description = $row['product_description'];
                  $product_img1 = $row['product_img1'];
                  $category_id = $row['category_id'];
                  $delivery_id = $row['delivery_id'];
                  $product_price = $row['product_price'];
                  echo "<div class='col-md-3 mb-2'>
                          <div class='card'>
                              <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>
                              <div class='card-body'>
                              <h5 class='card-title mb-4 mt-3 product-title' style='font-size: 1.7rem;'>$product_title</h5>
                                  <p class='card-text'><b>Price: $product_price</b></p>
                                  <a href='index.php?add_to_cart=$product_id' class='btn' style='background-color: #959EC9; color: #fff;'>Add to cart</a> <!-- Add inline styles here -->
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View Details</a>
                              </div>
                          </div>
                      </div>";
              }
          }
      }
  }
}




// getting all products
function get_all_products(){
  global $con;
    // condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            if(!isset($_GET['deliveryopt'])){
    $select_query = "SELECT * FROM `products` order by rand()";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $category_id=$row['category_id'];
        $delivery_id=$row['delivery_id'];
        $product_price=$row['product_price'];
        echo "<div class='col-md-3 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
        <h5 class='card-title mb-4 mt-3 product-title' style='font-size: 1.7rem;'>$product_title</h5>
            <p class='card-text'><b>Price: $product_price</b></p>
             <a href='index.php?add_to_cart=$product_id' class='btn' style='background-color: #959EC9; color: #fff;'>Add to cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View Details</a>
            </div>
          </div>
      </div>";
      }
}
}
}
}
// getting unique categories
function get_products_by_category(){
 global $con;
    // condition to check isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
    $select_query = "SELECT * FROM `products` WHERE category_id = $category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>No Stock for this Category</h2>";
    }
    while($row = mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $category_id=$row['category_id'];
        $delivery_id=$row['delivery_id'];
        $product_price=$row['product_price'];
        echo "<div class='col-md-3 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>
          <div class='card-body'>
          <h5 class='card-title mb-4 mt-3 product-title' style='font-size: 1.7rem;'>$product_title</h5>
            <p class='card-text'><b>Price: $product_price</b></p>
            <a href='index.php?add_to_cart=$product_id' class='btn' style='background-color: #959EC9; color: #fff;'>Add to cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View Details</a>
          </div>
        </div>
      </div>";
}
}
}


// getting unique categories
function get_products_by_brands(){
  global $con;
     // condition to check isset or not
     if(isset($_GET['brand'])){
         $brand_id=$_GET['brand'];
     $select_query = "SELECT * FROM `products` WHERE brand_id = $brand_id";
     $result_query = mysqli_query($con, $select_query);
     $num_of_rows=mysqli_num_rows($result_query);
     if($num_of_rows==0){
         echo "<h2 class='text-center text-danger'>This Organization Shirt is not available </h2>";
     }
     while($row = mysqli_fetch_assoc($result_query)){
         $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_img1=$row['product_img1'];
         $category_id=$row['category_id'];
         $delivery_id=$row['delivery_id'];
         $product_price=$row['product_price'];
         echo "<div class='col-md-3 mb-2'>
         <div class='card'>
           <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>
         <div class='card-body'>
         <h5 class='card-title mb-4 mt-3 product-title' style='font-size: 1.7rem;'>$product_title</h5>
              <p class='card-text'><b>Price: $product_price</b></p>
              <a href='index.php?add_to_cart=$product_id' class='btn' style='background-color: #959EC9; color: #fff;'>Add to cart</a>
               <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View Details</a>
             </div>
           </div>
       </div>";
       }
 }
 }

// displaying delivery option in sidenav
function getdeliveryopt(){
    global $con;
    $select_shipping = "SELECT * FROM `delivery_option`";
      $result_shipping = mysqli_query($con, $select_shipping);
      if ($result_shipping && mysqli_num_rows($result_shipping) > 0) {
        while ($row_data = mysqli_fetch_assoc($result_shipping)) {
          $delivery_title = $row_data['delivery_title'];
          $delivery_id = $row_data['delivery_id'];
          echo "<li class='nav-item'>
                  <a href='/Arellano%20University%20Store/index.php?delivery=$delivery_id' class='nav-link text-light'>$delivery_title</a>
                </li>";
        }
      }
}

// displaying delivery option in sidenav
function getcat(){
  global $con;
  $select_cat = "SELECT * FROM `categories`";
  $result_cat = mysqli_query($con, $select_cat);
  if ($result_cat && mysqli_num_rows($result_cat) > 0) {
      while ($row_data = mysqli_fetch_assoc($result_cat)) {
          $category_title = $row_data['category_title'];
          $category_id = $row_data['category_id'];
          echo "<li class='nav-item'>
                  <a href='/Arellano%20University%20Store/index.php?category=$category_id' class='nav-link text-dark category-button'>$category_title</a>
                </li>";
      }
  }
}


// displaying brands in sidenav
function getbrands(){
  global $con;
  $select_brand = "SELECT * FROM `brands`";
  $result_brand = mysqli_query($con, $select_brand);
  if ($result_brand && mysqli_num_rows($result_brand) > 0) {
      echo "<ul class='navbar-nav text-center side-nav brands'>";
      while ($row_data = mysqli_fetch_assoc($result_brand)) {
          $brand_title = $row_data['brand_title'];
          $brand_id = $row_data['brand_id'];
          echo "<li class='nav-item'>
                  <a href='/Arellano%20University%20Store/index.php?brand=$brand_id' class='nav-link text-dark brand-button'>$brand_title</a>
                </li>";
      }
      echo "</ul>";
  }
}

// getting game
function getgame(){
  global $con;
  // Check if the user is logged in
  if(isset($_SESSION['username'])) {
      $username = $_SESSION['username'];

      // Query to fetch spins remaining for the logged-in user
      $select_game = "SELECT * FROM `vouchers`";
      $result_game = mysqli_query($con, $select_game);
      
      if ($result_game && mysqli_num_rows($result_game) > 0) {
          echo "<ul class='navbar-nav text-center side-nav games'>";
          while ($row_data = mysqli_fetch_assoc($result_game)) {
              $game_title = $row_data['game_title'];
              $game_id = $row_data['game_id'];
              
              // Check if the user has spins remaining
              $spinsQuery = "SELECT spins_remaining FROM dummy_record WHERE username='$username'";
              $result = mysqli_query($con, $spinsQuery);

              if(mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $spinsRemaining = $row['spins_remaining'];

                  // If user has spins remaining, link to the game page
                  if($spinsRemaining > 0) {
                      echo "<li class='nav-item' >
                              <a href='./game_area/spintowin.php?game_id=$game_id' class='nav-link text-dark game-button'>$game_title</a>
                            </li>";
                  } else {
                      // User has no spins remaining, display enteracode.php link
                      echo "<li class='nav-item'>
                              <a href='./game_area/enteracode.php?game_id=$game_id' class='nav-link text-dark game-button'>$game_title</a>
                            </li>";
                  }
              } else {
                  // Error fetching spins remaining
                  echo "<li class='nav-item' >
                          <a href='#' class='nav-link text-grey'>Error fetching spins remaining</a>
                        </li>";
              }
          }
          echo "</ul>";
      }
  } 
}






// searching products function
function search_product(){
  global $con;
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];

    // Prevent SQL injection
    $search_data_value = mysqli_real_escape_string($con, $search_data_value);

    $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);

    if ($num_of_rows == 0) {
        echo "<h2 class='text-center text-danger'>No results match. No products found in this category!</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_img1 = $row['product_img1'];
        $product_price=$row['product_price'];
        echo "<div class='col-md-3 mb-2'>
                <div class='card'>
                    <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                    <h5 class='card-title mb-4 mt-3 product-title' style='font-size: 1.7rem;'>$product_title</h5>
                        <p class='card-text'><b>Price: $product_price</b></p>
                        <a href='./index.php?add_to_cart=$product_id' class='btn' style='background-color: #959EC9; color: #fff;'>Add to cart</a>
                        <a href='./product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                    </div>
                </div>
            </div>";
    }
}
}

// view details function
function view_details(){
    global $con;
    // condition to check isset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){
    if(!isset($_GET['brand'])){
    if(!isset($_GET['deliveryopt'])){
      $product_id=$_GET['product_id'];
    $select_query = "SELECT * FROM `products` WHERE product_id=$product_id";
    $result_query = mysqli_query($con, $select_query);
    while($row = mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_img1=$row['product_img1'];
        $product_img2=$row['product_img2'];
        $product_img3=$row['product_img3'];
        $category_id=$row['category_id'];
        $delivery_id=$row['delivery_id'];
        $product_price=$row['product_price'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
        <h5 class='card-title mb-4 mt-3 product-title' style='font-size: 1.7rem;'>$product_title</h5>
             <p class='card-text'>$product_description</p>
             <p class='card-text'>Price: $product_price</p>
             <a href='index.php?add_to_cart=$product_id' class='btn' style='background-color: #959EC9; color: #fff;'>Add to cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
            </div>
          </div>
      </div>
      <div class='col-md-8'>
            <!-- related images -->
            <div class='row'>
                <div class='col-md-12'>
                <h4 class='text-center mb-5' style='color: #28264C;'>Related Products</h4>
                </div>
                <div class='col-md-8-mb-2'>
                    <img src='./admin_area/product_images/$product_img2' class='card-img-top' alt='$product_title'>
                </div>
                <div class='col-md-8 mb-2'>
                    <img src='./admin_area/product_images/$product_img3' class='card-img-top' alt='$product_title'>
                </div>
            </div>
        </div>";
    }
  }
} 
}
}
}
// getting the ip address
  function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress(); 
// echo 'User Real IP Address - '.$ip;   

function cart(){
  if(isset($_GET['add_to_cart'])){
      // Check if the student is logged in
      if(!isset($_SESSION['username'])){
          echo "<script>alert('Please log in first');</script>";
          return; // Stop execution if user is not logged in
      }
      
      // Retrieve student_id from session
      $student_id = $_SESSION['student_id'];

      global $con;
      $get_product_id = $_GET['add_to_cart'];
      $get_ip_address = getIPAddress();
      $quantity = 1; // Assuming quantity is always 1 for each product
      
      // Check if the product is already in the cart
      $select_query = "SELECT * FROM `cart_details` WHERE student_id='$student_id' AND product_id=$get_product_id";
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      
      if($num_of_rows > 0){
          // If the product is already in the cart, display a message
          echo "<script>alert('This item is already added in your cart')</script>";
          echo "<script>window.open('index.php', '_self')</script>";
      } else {
          // If the product is not in the cart, insert it
          $insert_query = "INSERT INTO cart_details (student_id, product_id, quantity, ip_address)
                          VALUES ('$student_id', '$get_product_id', '$quantity', '$get_ip_address')";
          $result_query = mysqli_query($con, $insert_query);
          echo "<script>alert('Item is added to cart')</script>";
          echo "<script>window.open('index.php', '_self')</script>";
      }
  }
}


// function to get cart item number
function cart_item(){
  global $con;
  if(isset($_SESSION['username'])){
      $student_id = $_SESSION['student_id'];
      $select_query = "SELECT * FROM `cart_details` WHERE student_id='$student_id'";
      $result_query = mysqli_query($con, $select_query);
      $count_cart_items = mysqli_num_rows($result_query);
      echo $count_cart_items;
  } else {
      echo "0"; // No items in the cart for non-logged-in users
  }
}



// total price function
function total_cart_price(){
  global $con;
  $total = 0;

  // Check if the user is logged in
  if(isset($_SESSION['username'])){
      $get_ip_address = getIPAddress();

      // Select all products in the cart for the given IP address
      $cart_query = "SELECT product_id FROM `cart_details` WHERE ip_address='$get_ip_address'";
      $result = mysqli_query($con, $cart_query);

      // Check if there are any products in the cart
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
              $product_id = $row['product_id'];

              // Sum up the prices of all products in the cart using a single query
              $select_products = "SELECT product_price FROM `products` WHERE product_id='$product_id'";
              $result_product = mysqli_query($con, $select_products);

              // Fetch the product price and add it to the total
              if($row_product_price = mysqli_fetch_array($result_product)){
                  // Check if the fetched value is numeric before adding to the total
                  if (is_numeric($row_product_price['product_price'])) {
                      $product_price = $row_product_price['product_price'];
                      $total += $product_price;
                  }
              }
          }
      }
  }

  // Display total price
  echo $total;
}


// get user order details
function get_user_order_details() {
  global $con;

  // Check if username is set in session
  if (!isset($_SESSION['username'])) {
    return; // Return early if username is not set
  }

  $username = $_SESSION['username'];
  $get_details = "SELECT * FROM `dummy_record` WHERE `username`='$username'";
  $result_query = mysqli_query($con, $get_details);

  // Fetch user details
  while ($row_query = mysqli_fetch_array($result_query)) {
    $student_id = $row_query['student_id'];

    // Check if edit_account, my_orders, or delete_account is not set
    if (!isset($_GET['user_orders']) && !isset($_GET['delete_account'])) {
      $get_orders = "SELECT * FROM  `user_orders` WHERE student_id=$student_id AND order_status='pending'";
      $result_query_orders = mysqli_query($con, $get_orders);
      $row_count = mysqli_num_rows($result_query_orders);

      // Display pending orders information
      if ($row_count > 0) {
        echo "<h3 class='text-center text-dark mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders!</h3>
              <p class='text-center'><a href='profile.php?user_orders' class='text-dark'>Order Details</a></p>";
      } else {
        echo "<h3 class='text-center text-dark mt-5 mb-2'>You have 0 pending orders!</h3>
              <p class='text-center'><a href='../index.php' class='text-dark'>Explore more products</a></p>";
      }
    }
  }
}
function generateUniqueCode() {
  global $con;
  return uniqid(); // You can use any method to generate a unique code
}
function validateCode($user_code, $username) {
  global $con;

  // Check if the code is provided
  if (empty($user_code)) {
      return "Please enter a code.";
  }

  // Query to check the validity of the code
  $code_query = "SELECT * FROM generated_codes WHERE code = ? AND expiration_date > NOW() AND is_used = 0";
  $stmt = mysqli_prepare($con, $code_query);
  mysqli_stmt_bind_param($stmt, "s", $user_code);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result) {
      if (mysqli_num_rows($result) > 0) {
          // Code is valid, mark it as used
          $mark_used_query = "UPDATE generated_codes SET is_used = 1 WHERE code = ?";
          $stmt = mysqli_prepare($con, $mark_used_query);
          mysqli_stmt_bind_param($stmt, "s", $user_code);
          mysqli_stmt_execute($stmt);

          // Update spins_remaining for the user
          $update_spins_query = "UPDATE dummy_record SET spins_remaining = 3 WHERE username = ?";
          $stmt = mysqli_prepare($con, $update_spins_query);
          mysqli_stmt_bind_param($stmt, "s", $username);
          mysqli_stmt_execute($stmt);

          return true; // Code is valid
      } else {
          return "Invalid or expired code. Please try again.";
      }
  } else {
      return "Error executing the code query.";
  }
}
// // Function to generate a unique discount code
// function generateUniqueCode() {
//   global $con;
//   return bin2hex(random_bytes(5)); // Generates a random 10-character hexadecimal string
// }





  // Retrieve user ID from user_table
  // $get_student_id_query = "SELECT student_id FROM `user_table` WHERE username = '$username'";
  // $result_student_id = mysqli_query($con, $get_student_id_query);

  // if ($result_student_id && $row_student_id = mysqli_fetch_assoc($result_student_id)) {
  //     $student_id = $row_student_id['student_id'];

  //     $get_orders = "SELECT * FROM `user_orders` WHERE student_id = $student_id AND order_status = 'pending'";
  //     $result_query_orders = mysqli_query($con, $get_orders);
  //     $row_count = mysqli_num_rows($result_query_orders);

  //     if ($row_count > 0) {
  //         echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
  //             <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
  //     } else {
  //         echo "<h3 class='text-center text-success mt-5 mb-2'>You have 0 pending orders</h3>
  //             <p class='text-center'><a href='../index.php' class='text-dark'>Explore products</a></p>";
  //     }
  // } else {
  //     // Handle error if user ID retrieval fails
  //     echo "Error retrieving user ID.";
  // }

?> 