<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
	//echo "<pre>"; print_r($_POST); die;
	$default_id = $_GET['default_id'];
	$userAddress = getIndividualDetails('add_user_address','id',$default_id);
	if($userAddress['address_status'] == 0) {
	   $address_status = 1;
	} else {
	   $address_status = 0;
	}
	$sql="UPDATE add_user_address SET address_status = '$address_status' WHERE id='$default_id' ";
	if($conn->query($sql) === TRUE){             
	    echo "<script type='text/javascript'>window.location='my_address.php?succ=log-success'</script>";
	} else {               
	    header('Location: my_address.php?err=log-fail');
	}
?>