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
		$getRewards1 = "SELECT * FROM grocery_orders WHERE user_id = '$user_id' AND lkp_order_status_id = 2";
 		$getRewards = $conn->query($getRewards1);

		if ($getRewardAmount->num_rows > 0) {
				$response["lists"] = array();				
				while ($getRewards1 = $getRewards->fetch_assoc()) {					
					$totalRewards += $getRewards1['product_reward_points'];
				}
				$response["totalRewards"] = $totalRewards;
				$response["success"] = 0;
				$response["message"] = "Success";				
		} else {
		    $response["success"] = 1;
		    $response["message"] = "No Rewards found";	   
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