<?php
include "../admin_includes/config.php";

if($_SESSION['CART_TEMP_RANDOM'] == "") {

    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
if($_SESSION['user_login_session_id'] == "") {
        $user_id = 0;
} else {
        $user_id = $_SESSION['user_login_session_id'];
}
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
$deleteCart = "DELETE FROM food_cart WHERE user_id='$user_id' OR session_cart_id='$session_cart_id' ";
if($conn->query($deleteCart) === TRUE) {
    echo "<script type='text/javascript'>window.location='cart.php'</script>";
}
?>