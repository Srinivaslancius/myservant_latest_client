<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

$conversion_amount = $_POST['conversionAmount'];
$reward_points = $_POST['reward_points'];
$getwalletAmount = getIndividualDetails('user_wallet','user_id',$_SESSION['user_login_session_id']);
$walletAmount = $getwalletAmount['amount'];
$total_amount += $walletAmount+$conversion_amount;
$wallet_id = $_SESSION['wallet_id'];
$user_id = $_SESSION['user_login_session_id'];
$transation_status = "Debited Reward points for Wallet";
$updated_date = date('Y-m-d H:i:s');
//Insert Reward Transcation
$transaction = "INSERT INTO `grocery_reward_transactions` (`user_id`,`transation_status`,`debit_reward_points`,`transanction_amount`) VALUES ('$user_id','$transation_status','$reward_points','$total_amount')";
$conn->query($transaction);
//Insert User Wallet Transcation
$description = "Credited Reward Amount Into Your Wallet";
$sqlInwallet = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `credit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('$wallet_id','$user_id','$conversion_amount','$description','1','$updated_date')";
$conn->query($sqlInwallet);
//Update Wallet Amount
$sql = "UPDATE `user_wallet` SET amount = '$total_amount' WHERE user_id = '$user_id' ";
$result = $conn->query($sql);
if(isset($result)) {
   echo 1;
} else {
   echo 0;
}
?>