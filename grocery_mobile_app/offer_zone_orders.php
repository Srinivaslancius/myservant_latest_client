<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['userId'])  ) {

		$user_first_name = $_REQUEST["userFirstName"];
		$user_last_name = $_REQUEST["userLastName"];
		$user_email = $_REQUEST["userEmail"];
		$user_phone = $_REQUEST["userPhone"];
		$order_date = date("Y-m-d h:i:s");
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$contstr = "MYSER-GR";
		$order_id = $contstr.$random1.$random2;
		$offer_id = $_GET['offer_id'];
		$offer_reward_points = $_REQUEST["offerRewardPoints"];
		$offer_end_date = $_REQUEST["offerEndDate"];
		$offer_code = $_REQUEST["offerCode"];
		//Saving user id 
		$user_id = $_REQUEST['userId'];

		$orders = "INSERT INTO grocery_offer_zone_orders (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `order_id`, `offer_id`, `offer_reward_points`, `offer_end_date`, `created_at`) VALUES ('$user_id','$user_first_name','$user_last_name','$user_email','$user_phone','$order_id','$offer_id','$offer_reward_points','$offer_end_date','$order_date')";
		$groceryOrders = $conn->query($orders);

		$transation_status = "Debited Reward Points to purchase coupon";
		$reward_points = "INSERT INTO grocery_reward_transactions (`user_id`, `offerzone_purchase_id`, `transation_status`, `debit_reward_points`, `created_at`) VALUES ('$user_id','$order_id','$transation_status','$offer_reward_points','$order_date')";
		$result = $conn->query($reward_points);

		if ($conn->query($orders) === TRUE) {
            // check the conditions for query success or not
            $response["success"] = 0;            
            $response["message"] = "Save Successfully";   
            $response["order_id"] = $order_id;      
        } else {
            // fail query insert problem
            $response["success"] = 1;
            $response["message"] = "Oops! An error occurred.";                      
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