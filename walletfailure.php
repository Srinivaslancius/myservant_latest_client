<?php 
include "admin_includes/config.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['user_login_session_id']) && $_GET['lastTransId']!="") {
	
	$key = $_GET['lastTransId'];
	$txnid = $_POST['txnid'];
	$sqlInwallet = "UPDATE user_wallet_transactions SET lkp_payment_status_id =3 , transaction_id='$txnid' WHERE id='$key' ";
	$conn->query($sqlInwallet);	
	header("Location: wallet_failure.php");
}
?>
