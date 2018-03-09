<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$getContentPageData = getAllDataWhere('grocery_content_pages','id',3);
	$getPrivacyPolicyData = $getContentPageData->fetch_assoc();

	$response["title"] = $getPrivacyPolicyData['title'];
	$response["description"] = strip_tags($getPrivacyPolicyData['description']);
	//Success
	$response["success"] = 0;
    $response["message"] = "Success";
	
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>