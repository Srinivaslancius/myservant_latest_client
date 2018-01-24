<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId']) && !empty($_REQUEST['serviceCategoryId']) && isset($_REQUEST['serviceSubCatId']) && !empty($_REQUEST['groupId']) && isset($_REQUEST['serviceId']) && !empty($_REQUEST['servicePriceTypeId']) && isset($_REQUEST['servicePrice'])  ) {
	
	$user_id = $_REQUEST['userId'];
	$session_cart_id = 1234;
	$category_id = $_REQUEST['serviceCategoryId'];
	$sub_cat_id = $_REQUEST['serviceSubCatId'];
	$group_id = $_REQUEST['groupId'];
	$service_price = $_REQUEST['servicePrice'];
	$services_service_id = $_REQUEST['serviceId'];
	$service_price_type_id = $_REQUEST['servicePriceTypeId'];
	//$service_quantity = 1;
	$created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
	$service_selected_time = date('H:i:s', strtotime($created_at));
	$service_selected_date = date("Y-m-d h:i:s");	    
   
    /* $sql1= "SELECT * from services_cart where service_id='$services_service_id' AND user_id='$user_id' ";
	$res = $conn->query($sql1);
	$getcartIt = $res->fetch_assoc();

	if ($getcartIt->num_rows > 0) {
		$cart_id = $getcartIt['cart_id'];
		$updateq = "UPDATE services_cart SET service_quantity = '$service_quantity' WHERE user_id='$user_id' AND id='$cart_id' ";
		$result = $conn->query($updateq);
	} else {*/
	$saveItems = "INSERT INTO `services_cart`(`user_id`, `session_cart_id`, `service_category_id`, `service_sub_category_id`, `group_id`, `service_id`, `services_price_type_id`, `service_price`,`service_selected_date`, `service_selected_time`, `created_at`) VALUES ('$user_id','$session_cart_id','$category_id','$sub_cat_id','$group_id','$services_service_id','$service_price_type_id','$service_price','$service_selected_date','$service_selected_time','$created_at')";
	//$saveCart = $conn->query($saveItems);
	//}   	
	/*$response["lists"] = array();
	while($row = $getCartServicesData->fetch_assoc()) {
		$lists = array();
		$lists["cartId"] = $row["id"];
		$lists["servicePrice"] = $row["service_price"];
		$lists["serviceQuantity"] = $row["service_quantity"];	
		$lists["serviceSelectedDate"] = date('m/d/Y', strtotime($row['service_selected_date']));
		$lists["serviceSelectedTime"] = date('H:i:s A', strtotime($row['service_selected_time']));
		$getSerName= getIndividualDetails('services_group_service_names','id',$row['service_id']);
		$lists["groupServiceName"] = $getSerName['group_service_name'];
		array_push($response["lists"], $lists);
	}*/
	if($conn->query($saveItems) === TRUE) {

		$getCartServicesData = getAllDataWhere('services_cart','user_id',$user_id); 
		$response["cartCount"] = $getCartServicesData->num_rows;
	    $response["success"] = 0;
	    $response["message"] = "Success";
	} else {

	    $response["success"] = 1;
	    $response["message"] = "Error";
	}
    
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>