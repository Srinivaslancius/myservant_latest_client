<?php 
ob_start();
include_once 'meta.php';
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_GET["odi"]) && $_GET["user_id"]!="") {
	$payment_status = 3; //success
	$order_id = $_GET["odi"];
	$user_id = $_GET["user_id"];
	$updateOrderStatus = "UPDATE services_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);
	header("Location: failure.php");
}

?>
