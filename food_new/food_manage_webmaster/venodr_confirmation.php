<?php
include "../../admin_includes/config.php";
if(!empty($_POST['check_active_id']) && !empty($_POST['check_active_id']))  {
	//echo "<pre>"; print_r($_POST); die;
	$check_active_id = $_POST['check_active_id'];
	$send_status = $_POST['send_status'];
	$sql="UPDATE food_orders SET vendor_order_status = '$send_status',lkp_order_status_id = 2 WHERE id='$check_active_id' ";
	if($conn->query($sql) === TRUE){
		$succ = "1";
	} else {
		$succ = "0";
	}
	echo $succ;
}
?>