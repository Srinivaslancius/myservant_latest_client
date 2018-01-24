<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list

if($_SERVER['REQUEST_METHOD']=='POST'){

	$getAllgetSiteSettingsData = getAllData('services_site_settings');
	$getSiteSettingsData = $getAllgetSiteSettingsData->fetch_assoc();
	//Chedck the condioton for emptty or not		
	
	$response["address"] = $getSiteSettingsData["address"];
	$response["mobile"] =  $getSiteSettingsData["mobile"];	
	$response["email"] =   $getSiteSettingsData["email"];	    			    		
	$response["success"] = 0;
	$response["message"] = "Success";				
	
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>