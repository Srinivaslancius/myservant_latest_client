<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
	//echo "<pre>"; print_r($_POST); die;
	$order_id = $_GET['order_id'];
	$sql="UPDATE food_orders SET lkp_order_status_id = 6 WHERE order_id='$order_id' ";
	$conn->query($sql);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>