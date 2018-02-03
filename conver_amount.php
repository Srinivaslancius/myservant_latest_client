<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
$conversion_amount = $_POST['conversionAmount'];
$reward_points = $_POST['reward_points'];
$getwalletAmount = getIndividualDetails('user_wallet','user_id',$_SESSION['user_login_session_id']);
$walletAmount = $getwalletAmount['amount'];
$total_amount += $walletAmount+$reward_points;
$transation_status = "Credited Reward Amount Into Your Wallet"
//Insert Reward Transcation
$transaction = "INSERT INTO `reward_transactions` (`user_id`,`transation_status`,`reward_points`,`transanction_amount`) VALUES ('".$_SESSION['user_login_session_id']."','$transation_status1,'$reward_points','$total_amount');"
$conn->query($transaction);
//Update Wallet Amount
$sql = "UPDATE `user_wallet` SET amount = '$total_amount' WHERE user_id = '".$_SESSION['user_login_session_id']."' ";
$result = $conn->query($sql);
if(isset($result)) {
   echo 1;
} else {
   echo 0;
}
?>