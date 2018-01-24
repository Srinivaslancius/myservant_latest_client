<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId']) && !empty($_REQUEST['serviceCategoryId']) && isset($_REQUEST['serviceSubCatId']) && !empty($_REQUEST['groupId']) && isset($_REQUEST['serviceId']) && !empty($_REQUEST['servicePriceTypeId']) && isset($_REQUEST['servicePrice']) && !empty($_REQUEST['serviceQuantity']) ) {
	
	$user_id = $_POST['userId'];
	$session_cart_id = $_POST['CART_TEMP_RANDOM'];
	$category_id = $_POST['serviceCategoryId'];
	$sub_cat_id = $_POST['serviceSubCatId'];
	$group_id = $_POST['groupId'];
	$service_price = $_POST['servicePrice'];
	$services_service_id = $_POST['serviceId'];
	$service_price_type_id = $_POST['servicePriceTypeId'];
	$service_quantity = $_POST['serviceQuantity'];
	$created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
	$service_selected_time = date('H:i:s', strtotime($created_at));
	$service_selected_date = date("Y-m-d h:i:s");	    
   
    $sql1= "SELECT * from services_cart where service_id='$services_service_id' AND user_id='$user_id' ";
	$res = $conn->query($sql1);
	$getcartIt = $res->fetch_assoc();

	if ($getcartIt->num_rows > 0) {
		$cart_id = $getcartIt['cart_id'];
		$updateq = "UPDATE services_cart SET service_quantity = '$service_quantity' WHERE user_id='$user_id' AND id='$cart_id' ";
		$result = $conn->query($updateq);
	} else {
		$saveItems = "INSERT INTO `services_cart`(`user_id`, `session_cart_id`, `service_category_id`, `service_sub_category_id`, `group_id`, `service_id`, `services_price_type_id`, `service_price`,`service_selected_date`, `service_selected_time`, `created_at`) VALUES ('$user_id','$session_cart_id','$category_id','$sub_cat_id','$group_id','$services_service_id','$service_price_type_id','$service_price','$service_selected_date','$service_selected_time','$created_at')";
		$saveCart = $conn->query($saveItems);
	}   
	$getCartServicesData = getAllDataWhere('services_cart','user_id',$user_id); 
	$response["lists"] = array();
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
	}
        
    $response["success"] = 0;
    $response["message"] = "Success";
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>