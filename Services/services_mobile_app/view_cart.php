<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId'])  ) {
	
	$user_id = $_REQUEST['userId'];
	$response["lists"] = array();
	$getCartServicesData = getAllDataWhere('services_cart','user_id',$user_id); 
	if ($getCartServicesData->num_rows > 0) {

		while($row = $getCartServicesData->fetch_assoc()) {
		$lists = array();
		$lists["cartId"] = $row["id"];
		$lists["serviceCatId"] = $row["service_category_id"];
		$lists["serviceSubId"] = $row["service_sub_category_id"];
		$lists["serviceId"] = $row["service_id"];
		$lists["servicePriceTypeId"] = $row["services_price_type_id"];
		$lists["servicePrice"] = $row["service_price"];
		$lists["serviceQuantity"] = $row["service_quantity"];	
		$lists["groupId"] = $row["group_id"];
		$groupName= getIndividualDetails('services_groups','id',$row['group_id']);
		$lists["groupName"] = $groupName['group_name'];
		$lists["serviceSelectedDate"] = date('m/d/Y', strtotime($row['service_selected_date']));
		$lists["serviceSelectedTime"] = date('H:i:s A', strtotime($row['service_selected_time']));
		$getSerName= getIndividualDetails('services_group_service_names','id',$row['service_id']);
		$lists["groupServiceName"] = $getSerName['group_service_name'];
		array_push($response["lists"], $lists);
	}
	$response["success"] = 0;
	$response["message"] = "Success";
	} else {

		$response["success"] = 1;
	    $response["message"] = "No items in your cart!";	   
	}	
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>