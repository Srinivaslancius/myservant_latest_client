<?php 
error_reporting(0);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['walletAmount']) ) {

		$user_id = $_REQUEST['userId'];
		$credit_amnt = $_REQUEST['walletAmount'];
		$description = "Money Added in Wallet";
		$updated_date = date('Y-m-d H:i:s');

		$amount = getIndividualDetails('user_wallet','user_id',$user_id);
		$walletAmount = $credit_amnt+$amount['amount'];
		$wallet_id = $amount['wallet_id'];

		$sqlInwallet = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `credit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('$wallet_id','$user_id','$credit_amnt','$description','2','$updated_date')";
		$conn->query($sqlInwallet);

		$updateWalletAmount = "UPDATE `user_wallet` SET amount='$walletAmount' WHERE user_id='$user_id' AND wallet_id = '$wallet_id'";
		$updateWalletAmount1 = $conn->query($updateWalletAmount);

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