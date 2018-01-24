<?php 
include "../admin_includes/config.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['order_last_session_id']) && $_SESSION['order_last_session_id']!="") {
	$payment_status = $_GET['pay_stau']; //success
	$order_id = $_SESSION['order_last_session_id'];
	$user_id = $_SESSION['user_login_session_id'];
	$updateOrderStatus = "UPDATE food_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);

	//after placing order that item will delete in cart
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
	
	$delCart ="DELETE FROM food_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
	$conn->query($delCart);

	$delCartIngredients ="DELETE FROM food_update_cart_ingredients WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
	$conn->query($delCartIngredients);

	header("Location: finish.php?odi=".$order_id."");
}
?>
