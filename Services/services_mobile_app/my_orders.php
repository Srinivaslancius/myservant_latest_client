<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']))  {

		$uid = $_REQUEST['userId'];
		$getOrders = "SELECT * from services_orders WHERE user_id = '$uid' GROUP BY order_id ORDER BY id DESC"; 
        $getOrders1 = $conn->query($getOrders);

		if ($getOrders1->num_rows > 0) {
				$response["lists"] = array();				
				while($orderData = $getOrders1->fetch_assoc()) {				
					//Chedck the condioton for emptty or not		
					$lists = array();					
			    	$lists["orderIncId"]   = $orderData["id"];			    	
			    	$lists["orderDate"] = $orderData["created_at"];
			    	$lists["orderTotalPrice"] = $orderData["order_total"];
			    	$lists["address"] = $orderData["address"];
			    	$lists["orderId"] = $orderData["order_id"];
			    	$order_id = $orderData["order_id"];
			    	$cntOrd = "SELECT * FROM services_orders WHERE user_id ='$uid' AND order_id='$order_id' ";
			    	$res = $conn->query($cntOrd);
			    	$lists["orderItemsCount"] = $res->num_rows;
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