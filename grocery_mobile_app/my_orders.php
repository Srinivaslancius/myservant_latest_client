<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']))  {

		$uid = $_REQUEST['userId'];
		$getOrders = "SELECT * from grocery_orders WHERE user_id = '$uid' GROUP BY order_id ORDER BY id DESC"; 
        $getOrders1 = $conn->query($getOrders);

		if ($getOrders1->num_rows > 0) {
				$response["lists"] = array();				
				while($orderData = $getOrders1->fetch_assoc()) {
					//$getCatName = getIndividualDetails('food_category','id',$row['category_id']);
					//Chedck the condioton for emptty or not	
					$order_id = $orderData["order_id"];	
					$getOrders2 = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
        			$getOrdersData3 = $conn->query($getOrders2);
					$lists = array();					
			    	$lists["orderIncId"]   = $orderData["id"];			    	
			    	$lists["orderDate"] = $orderData["created_at"];
			    	$lists["totalAmount"] = round($orderData["order_total"]);
			    	$lists["itemCount"] = $getOrdersData3->num_rows;	
			    	$lists["orderNo"] = $orderData["order_id"];
			    	
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