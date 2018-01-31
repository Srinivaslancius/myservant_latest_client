<?php
include "admin_includes/config.php";
	//echo "<pre>"; print_r($_POST); die;
	$order_id = $_GET['order_id'];
	$sql="UPDATE grocery_orders SET lkp_order_status_id = 3 WHERE order_id='$order_id' ";
	$conn->query($sql);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>