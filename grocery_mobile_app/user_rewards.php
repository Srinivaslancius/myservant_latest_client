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
		$getRewards1 = "SELECT * FROM grocery_reward_transactions WHERE user_id = '$user_id'";
 		$getRewards = $conn->query($getRewards1);

		if ($getRewards->num_rows > 0) {
				$response["lists"] = array();				
				while ($getRewards1 = $getRewards->fetch_assoc()) {
		 			$credit_reward_points += $getRewards1['credit_reward_points'];
		 			$debit_reward_points += $getRewards1['debit_reward_points'];
		 		}
		 		$totalRewards = $credit_reward_points - $debit_reward_points;
				$response["totalRewards"] = $totalRewards;
				$response["success"] = 0;
				$response["message"] = "Success";				
		} else {
		    $response["success"] = 1;
		    $response["message"] = "No Rewards found";	
		    $response["totalRewards"] = '0';   
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