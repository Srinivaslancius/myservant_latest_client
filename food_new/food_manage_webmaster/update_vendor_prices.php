<?php
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');

if (!isset($_POST['submit']))  {
  echo "fail";
} else  { 
	//echo "<pre>"; print_r($_POST); die;
	$deliveryCharges = $_POST['delivery_charges'];
	$adminComission = $_POST['admin_comin'];
	$vid = $_POST['vid'];
	$updatePrices = "UPDATE food_vendors SET delivery_charges='$deliveryCharges', admin_comission='$adminComission', vendor_charges_approved='0' WHERE id ='$vid' ";
	$conn->query($updatePrices);
	echo "<script type='text/javascript'>window.location='vendors.php?msg=success'</script>";
}
?>