<?php 
error_reporting(1);
include "../../admin_includes/config.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['cartId']))  {

		$uid = $_REQUEST['userId'];
		$cartId = $_REQUEST['cartId'];
		
		$getOrders = "DELETE from food_cart WHERE user_id = '$uid' AND id='$cartId' "; 
        $getOrders1 = $conn->query($getOrders);
				
		$response["success"] = 0;
		$response["message"] = "Success";				
		
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