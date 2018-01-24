<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['orderId']))  {

		$uid = $_REQUEST['userId'];
		$order_id = $_REQUEST['order_id'];
		$getOrders = "SELECT * from services_orders WHERE user_id = '$uid' AND order_id ='$order_id' ORDER BY id DESC"; 
        $getOrders1 = $conn->query($getOrders);

		if ($getOrders1->num_rows > 0) {
				$response["lists"] = array();				
				while($orderData = $getOrders1->fetch_assoc()) {		
					//Chedck the condioton for emptty or not		
					$lists = array();		
					$lists["id"] = $orderData["id"];				
			    	$lists["orderDate"] = $orderData["created_at"];
			    	$lists["orderTotalPrice"] = $orderData["order_total"];			    	
			    	$lists["subOrderId"] = $orderData["order_sub_id"];	
			    	$getServicenamesData = getIndividualDetails('services_group_service_names','id',$orderData['service_id']);
			    	$lists["group_service_name"] = $getServicenamesData['group_service_name'];
			    	$lists["service_price"] = $getServicenamesData['service_price'];
			    	$orderStatus = getIndividualDetails('lkp_order_status','id',$row['lkp_order_status_id']);
			    	$lists["order_status"] = $orderStatus['order_status'];
			    	$orderPaymentStatus = getIndividualDetails('lkp_payment_status','id',$row['lkp_payment_status_id']);
			    	$lists["payment_status"] = $orderPaymentStatus['payment_status'];

			    	array_push($response["lists"], $lists);		
				}
				
				$response["success"] = 0;
				$response["message"] = "Success";				
		} else {
		    $response["success"] = 1;
		    $response["message"] = "No Orders found";	   
		}
	} else {
		$response["success"] = 2;
		$response["message"] = "Required field(s) is missing";
	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";

}
echo json_encode($response);

?>