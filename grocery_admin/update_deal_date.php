<?php
error_reporting(1);
include_once('../admin_includes/config.php');
if(!empty($_POST['submit']) && !empty($_POST['submit']))  {
	//echo "<pre>"; print_r($_POST); die;
	$pid = $_POST['pid'];
	//Deal satrt date convertions
	$deal_start_date =  date_create($_POST['deal_start_date']);
	$DealStartDate=date_format($deal_start_date,"Y-m-d");
	//Deal end date convertions
	$deal_end_date =  date_create($_POST['deal_end_date']);
	$DealEndDate=date_format($deal_end_date,"Y-m-d");
	
	$deal_start_time = date('H:i:s', strtotime($_POST['deal_start_time']));
	$deal_end_time =  date('H:i:s', strtotime($_POST['deal_end_time']));	
	
	$sql="UPDATE grocery_products SET deal_start_date = '$DealStartDate', deal_end_date = '$DealEndDate', deal_start_time = '$deal_start_time', deal_end_time = '$deal_end_time' WHERE id='$pid' ";
	$conn->query($sql);
	echo "<script type='text/javascript'>window.location='manage_products.php?msg=success'</script>";
	exit();
}

?>