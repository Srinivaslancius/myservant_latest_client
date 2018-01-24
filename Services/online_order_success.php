<?php 
ob_start();
include_once 'meta.php';
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_GET["odi"]) && $_GET["user_id"]!="") {
	$payment_status = 1; //success
	$order_id = $_GET["odi"];
	$user_id = $_GET["user_id"];
	$updateOrderStatus = "UPDATE services_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);

	//after placing order that item will delete in cart
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
	$delCart ="DELETE FROM services_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
	$conn->query($delCart);
	
	header("Location: thankyou.php?odi=".$order_id."");
}
?>
