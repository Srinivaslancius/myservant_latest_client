<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$getContentPageData = getAllDataWhere('grocery_payments_settings','id',1);
	$getPrivacyPolicyData = $getContentPageData->fetch_assoc();

	$response["delivery_charges"] = $getPrivacyPolicyData['delivery_charges'];	
	//Success
	$response["success"] = 0;
    $response["message"] = "Success";
	
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>