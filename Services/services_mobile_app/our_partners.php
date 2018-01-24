<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$getServiceProvider =  getServicesProviderDataLimit('','');
	$response["lists"] = array();
	while($getAllgetServiceProvider = $getServiceProvider->fetch_assoc()) {

		$lists = array();
    	$lists["id"] = $getAllgetServiceProvider["id"];
    	$lists["companyName"] = $getAllgetServiceProvider["company_name"];	
    	$lists["description"] = strip_tags($getAllgetServiceProvider["description"]);			    	
    	$lists["logo"] = $base_url."uploads/service_provider_business_logo/".$getAllgetServiceProvider["logo"];
		array_push($response["lists"], $lists);	
	}
	//Success
	$response["success"] = 0;
    $response["message"] = "Success";
	
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>