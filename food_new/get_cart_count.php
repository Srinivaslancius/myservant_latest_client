<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
include "../admin_includes/food_common_functions.php";

if (isset($_POST['item_id']) && isset($_POST['item_weight']) ){

    $ProductId = $_POST['item_id'];
    //$ProductPrice = $_POST['item_price'];
    $ProductWeighType = $_POST['item_weight'];

    if($_SESSION['CART_TEMP_RANDOM'] == "") {

        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    if($_SESSION['user_login_session_id'] == "") {

        $user_id = 0;
    } else {
        $user_id = $_SESSION['user_login_session_id'];
    }

  $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    
  $checkCartItems = "SELECT * FROM food_cart WHERE food_item_id = '$ProductId' AND item_weight_type_id = '$ProductWeighType' AND session_cart_id = '$session_cart_id'";
  $getCartCount = $conn->query($checkCartItems);    
  $getCartQuantity = $getCartCount->fetch_assoc();
  echo $getCartQuantity['item_quantity'] . "," . $_POST['item_id'] ;
}
?>