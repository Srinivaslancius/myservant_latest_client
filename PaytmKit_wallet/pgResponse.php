<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

$user_id = $_SESSION['user_login_session_id'];
$last_id = $_SESSION['last_id'];


if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {

		$getSiteSettings1 = getIndividualDetails('grocery_site_settings','id','1');
		$getUserDetails = getIndividualDetails('users','id',$user_id);

		header("Location: ../walletsuccess.php?lastTransId=".$last_id."");
		//echo 1; die;
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	} else {	
		
		//echo "<b>Transaction status is failure</b>" . "<br/>";		
		//unset($_SESSION['payment_service_type']);

		header("Location: ../walletfailure.php?lastTransId=".$last_id."");
		//echo 2; die;
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {

	//unset($_SESSION['order_last_session_id']);
	unset($_SESSION['payment_service_type']);
	header("Location: ../walletfailure.php?lastTransId=".$last_id."");
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>