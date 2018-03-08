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

$order_id = $_SESSION['order_last_session_id'];
$user_id = $_SESSION['user_login_session_id'];

if($_SESSION['CART_TEMP_RANDOM'] == "") {
    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];

if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {

		$getSiteSettings1 = getIndividualDetails('grocery_site_settings','id','1');
		$getUserDetails = getIndividualDetails('users','id',$user_id);

		if(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==3) {

			$getWalletAmount = getIndividualDetails('grocery_orders','order_id',$_SESSION['order_last_session_id']);
			
			$updateOrderStatus = "UPDATE grocery_orders SET lkp_payment_status_id = '1' WHERE user_id = '$user_id' AND order_id='$order_id' ";
			$conn->query($updateOrderStatus);
		} elseif(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==1) {

			$getWalletAmount = getIndividualDetails('services_orders','order_id',$_SESSION['order_last_session_id']);
			$updateOrderStatus = "UPDATE services_orders SET lkp_payment_status_id = '1' WHERE user_id = '$user_id' AND order_id='$order_id' ";
			$conn->query($updateOrderStatus);

		} elseif(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==2) { 

			$getWalletAmount = getIndividualDetails('food_orders','order_id',$_SESSION['order_last_session_id']);

			$updateOrderStatus = "UPDATE food_orders SET lkp_payment_status_id = '1' WHERE user_id = '$user_id' AND order_id='$order_id' ";
			$conn->query($updateOrderStatus);
		} else {
			echo "Sorry ! Your Payment Failed"; die;
		}
		

		//echo "<b>Transaction status is success</b>" . "<br/>";

		//$dataem = $_POST["email"];
		$to = $getWalletAmount['email'];
		$from = $getSiteSettings1["orders_email"];
		$subject = "My Servent - Order ";
		$message = '';
		$message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><h1>My Servant</h1></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Greetings From Myservant</h1>
			  <p>Dear <span style="color:#fe6003;">'.$getWalletAmount['first_name'].'</span>, Thank you for Ordering myservant.com!</p>
				<p>Your Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>
				<p>Your Order Total: Rs. <span style="color:#fe6003;">'.$getWalletAmount['order_total'].'</span></p>
				<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
				<p>Warm Regards,<br>The Myservant Team </p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettings1['footer_text'].'</footer>
			</div>

			</body>';

		//echo $message; die;
		//$sendMail = sendEmail($to,$subject,$message,$from);
		$name = "My Servant - ORDER";
		$mail = sendEmail($to,$subject,$message,$from,$name);

		//Mail to Admin
		//$to = "srinivas@lanciussolutions.com";
		$to = $getSiteSettings1["orders_email"];
		$from = $getSiteSettings1["orders_email"];
		$subject = "My Servent - Order ";
		$message = '';
		$message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><h1>My Servant</h1></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Greetings From Myservant</h1>
			  <p>Dear <span style="color:#fe6003;">Admin</span>, order details.</p>
				<p>Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>
				<p>Order Total: Rs. <span style="color:#fe6003;">'.$getWalletAmount['order_total'].'</span></p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettings1['footer_text'].'</footer>
			</div>

			</body>';

		//echo $message; die;
		//$sendMail = sendEmail($to,$subject,$message,$from);
		$name = "My Servant - ORDER";
		$mail = sendEmail($to,$subject,$message,$from,$name);

		//Sending SMS after placing Order
		$user_mobile = $getUserDetails['user_mobile'];
		$message1 = urlencode('Thank you for placing order. Your order number is '.$order_id.''); // Message text required to deliver on mobile number
	    $sendSMS = sendMobileSMS($message1,$user_mobile);

		if(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==3) {

			$delCart ="DELETE FROM grocery_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
			$conn->query($delCart);
			header("Location: ../thankyou.php?odi=".$order_id."");
			
		} elseif(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==1) {

			$delCart ="DELETE FROM services_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
			$conn->query($delCart);
			header("Location: ../Services/thankyou.php?odi=".$order_id."");

		} elseif(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==2) { 

			//after placing order that item will delete in cart
			$delCart ="DELETE FROM food_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
			$conn->query($delCart);
			$delCartIngredients ="DELETE FROM food_update_cart_ingredients WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
			$conn->query($delCartIngredients);
			header("Location: ../food_new/finish.php?odi=".$order_id."");
		}
		//echo 1; die;
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	} else {	
		
		//echo "<b>Transaction status is failure</b>" . "<br/>";
		unset($_SESSION['order_last_session_id']);
		//unset($_SESSION['payment_service_type']);

		if(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==3) {

			$updateOrderStatus = "UPDATE grocery_orders SET lkp_payment_status_id = '3' WHERE user_id = '$user_id' AND order_id='$order_id' ";
			$conn->query($updateOrderStatus);
			header("Location: ../failure.php");
		} elseif(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==1) {

			$updateOrderStatus = "UPDATE services_orders SET lkp_payment_status_id = '3' WHERE user_id = '$user_id' AND order_id='$order_id' ";
			$conn->query($updateOrderStatus);
			header("Location: ../Services/failure.php");
		} elseif(isset($_SESSION['payment_service_type']) && $_SESSION['payment_service_type']!='' && $_SESSION['payment_service_type']==2) { 

			$updateOrderStatus = "UPDATE food_orders SET lkp_payment_status_id = '3' WHERE user_id = '$user_id' AND order_id='$order_id' ";
			$conn->query($updateOrderStatus);
			header("Location: ../food_new/failure.php");
		}
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

	unset($_SESSION['order_last_session_id']);
	unset($_SESSION['payment_service_type']);
	header("Location: ../failure.php");
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>