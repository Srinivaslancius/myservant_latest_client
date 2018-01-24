<?php 
include "../admin_includes/config.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['order_last_session_id']) && $_SESSION['order_last_session_id']!="") {
	$payment_status = 3; //success
	$order_id = $_SESSION['order_last_session_id'];
	$user_id = $_SESSION['user_login_session_id'];
	$updateOrderStatus = "UPDATE food_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);

	unset($_SESSION['order_last_session_id']);
	header("Location: failure.php");
}
?>
