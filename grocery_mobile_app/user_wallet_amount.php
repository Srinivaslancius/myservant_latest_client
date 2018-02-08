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
		$getwalletAmount = "SELECT * FROM user_wallet WHERE user_id = '$uid' ";
		$getwalletAmount1 = $conn->query($getwalletAmount);
		$getwalletAmountDetails = $getwalletAmount1->fetch_assoc();
		if($getwalletAmountDetails['amount'] == '') {
			$amount = 0;
		} else {
			$amount = $getwalletAmountDetails['amount'];
		}	
		$response["amount"] = $amount;
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