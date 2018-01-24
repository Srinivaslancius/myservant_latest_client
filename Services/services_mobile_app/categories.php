<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['cityId']) && !empty($_REQUEST['cityId']) && isset($_REQUEST['pincodeId']) && !empty($_REQUEST['pincodeId']) ) {

		$getAvailableLocationsData = "SELECT * FROM availability_of_locations WHERE lkp_status_id = 0 AND lkp_city_id = '".$_REQUEST['cityId']."' AND FIND_IN_SET('".$_REQUEST['pincodeId']."', pincodes) ORDER BY id DESC";
		$getAvailableLocations = $conn->query($getAvailableLocationsData); $getAvailableLocations1 =$getAvailableLocations->fetch_assoc();
		$service_id = $getAvailableLocations1['service_id'];

	} else {

		$getAvailableLocations = getIndividualDetails('availability_of_locations','lkp_city_id',1);
		$service_id = $getAvailableLocations['service_id'];		
	}

	$getCategories = "SELECT * from services_category WHERE id IN ($service_id) AND id IN (SELECT services_category_id FROM services_sub_category WHERE lkp_status_id = 0) AND lkp_status_id = '0' ORDER BY category_position DESC";
	$getCategoriesData = $conn->query($getCategories);
	$response["lists"] = array();
	while($row = $getCategoriesData->fetch_assoc()) {
		$lists = array();
    	$lists["categoryId"] = $row["id"];
    	$lists["categoryName"] = $row["category_name"];		    	
    	$lists["categoryImage"] = $base_url."uploads/services_category_images/".$row["category_image"];
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