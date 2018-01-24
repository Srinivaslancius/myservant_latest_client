<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId']) && !empty($_REQUEST['serviceQuantity']) && !empty($_REQUEST['cartId']) && !empty($_REQUEST['serviceDate']) && !empty($_REQUEST['serviceTime']) ) {
	
	$user_id = $_REQUEST['userId'];
	$cart_id = $_REQUEST['cartId'];	
	$service_quantity = $_REQUEST['serviceQuantity'];
	$serviceDate=date_create($_REQUEST["serviceDate"]);
	$getServiceDate=date_format($serviceDate,"Y-m-d");	
	$service_selected_time = date('H:i:s', strtotime($_REQUEST["serviceTime"]));	 
	
	$updateq = "UPDATE services_cart SET service_quantity = '$service_quantity',service_selected_date='$getServiceDate',service_selected_time='$service_selected_time' WHERE user_id='$user_id' AND id='$cart_id' ";
	if($conn->query($updateq) === TRUE) {

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