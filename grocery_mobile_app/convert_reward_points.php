<?php 
error_reporting(0);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['rewardPoints']) ) {

		$user_id = $_REQUEST['userId'];
		$totalRewards = $_REQUEST['rewardPoints'];
		$getRewardAmount = getIndividualDetails('grocery_reward_points','id',1);
 		$conversionAmount = ($getRewardAmount['amount_credits']*round($totalRewards))/$getRewardAmount['for_reward_points'];

		$getwalletAmount = getIndividualDetails('user_wallet','user_id',$user_id);
		$walletAmount = $getwalletAmount['amount'];
		$total_amount += $walletAmount+$conversionAmount;
		$wallet_id = $getwalletAmount['wallet_id'];
		$transation_status = "Debited Reward points for Wallet";
		$updated_date = date('Y-m-d H:i:s');

		//Insert Reward Transcation
		$transaction = "INSERT INTO `grocery_reward_transactions` (`user_id`,`transation_status`,`debit_reward_points`,`transanction_amount`) VALUES ('$user_id','$transation_status','$reward_points','$total_amount')";
		$conn->query($transaction);

		//Insert User Wallet Transcation
		$description = "Credited Reward Amount Into Your Wallet";
		$sqlInwallet = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `credit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('$wallet_id','$user_id','$conversionAmount','$description','1','$updated_date')";
		$conn->query($sqlInwallet);
		
		//Update Wallet Amount
		$sql = "UPDATE `user_wallet` SET amount = '$total_amount' WHERE user_id = '$user_id' ";
		$result = $conn->query($sql);

		$response["success"] = 0;
		$response["message"] = "Success";

	} else {
		$response["success"] = 2;
		$response["message"] = "Required Fields Missings!";

	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";

}
echo json_encode($response);

?>