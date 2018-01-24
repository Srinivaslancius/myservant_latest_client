<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['user_login_session_id']) && $_GET['lastTransId']!="") {
	
	//1-success, 2- Inprogress
	$key = $_GET['lastTransId'];
	$txnid = $_POST['txnid'];
	$sqlInwallet = "UPDATE user_wallet_transactions SET lkp_payment_status_id =1 , transaction_id='$txnid' WHERE id='$key' ";
	$conn->query($sqlInwallet);
	$getWalletPrice = getIndividualDetails('user_wallet_transactions','id',$key);
	$amount = getIndividualDetails('user_wallet','user_id',$_SESSION['user_login_session_id']);
	$walletAmount = $getWalletPrice['credit_amnt']+$amount['amount'];
	$updateWalletAmount = "UPDATE `user_wallet` SET amount='$walletAmount' WHERE user_id='".$_SESSION['user_login_session_id']."' AND wallet_id = '".$_SESSION['wallet_id']."'";
	$updateWalletAmount1 = $conn->query($updateWalletAmount);
	header("Location: wallet_thankyou.php");
}
?>
