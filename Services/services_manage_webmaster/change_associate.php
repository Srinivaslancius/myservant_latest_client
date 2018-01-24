<?php
include "../../admin_includes/config.php";
if(!empty($_POST['check_associate_or_not_id']) && !empty($_POST['check_associate_or_not_id']))  {
	//echo "<pre>"; print_r($_POST); die;
	$check_associate_or_not_id = $_POST['check_associate_or_not_id'];
	$send_associate_or_not = $_POST['send_associate_or_not'];
	$sql="UPDATE `service_provider_business_registration` SET associate_or_not = '$send_associate_or_not' WHERE service_provider_registration_id='$check_associate_or_not_id' ";
	if($conn->query($sql) === TRUE){
		$succ = "1";
	} else {
		$succ = "0";
	}
	echo $succ;
}
?>