<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['order_last_session_id']) && $_SESSION['order_last_session_id']!="") {
	$payment_status = $_GET['pay_stau']; //success
	$order_id = $_SESSION['order_last_session_id'];
	$user_id = $_SESSION['user_login_session_id'];
	$updateOrderStatus = "UPDATE grocery_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);
	$getSiteSettings1 = getIndividualDetails('grocery_site_settings','id','1');
	$getWalletAmount = getIndividualDetails('grocery_orders','order_id',$_SESSION['order_last_session_id']);
	$getAmount = getIndividualDetails('user_wallet','wallet_id',$_SESSION['wallet_id']);
	if($getWalletAmount['wallet_amount'] != '') {
		if($getAmount['amount'] > $getWalletAmount['wallet_amount']) {
			$amount = $getAmount['amount'] - $getWalletAmount['wallet_amount'];
		} else {
			$amount = 0;
		}
		$updateWalletAmount = "UPDATE user_wallet SET amount = '$amount' WHERE user_id = '$user_id' ";
		$conn->query($updateWalletAmount);

		$description = "Money Debited for placing Order";
		$updated_date = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
		$insertTransaction = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `debit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('".$_SESSION['wallet_id']."','$user_id','".$getWalletAmount['wallet_amount']."','$description','$payment_status','$updated_date')";
		$conn->query($insertTransaction);
	}

	//Saving data into reward transactions
	$transation_status = "Credited reward points at the time of placing order";
	$order_date = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
	$reward_points = $getWalletAmount['reward_points'];
	$reward_points = "INSERT INTO grocery_reward_transactions (`user_id`, `offerzone_purchase_id`, `transation_status`, `credit_reward_points`, `created_at`) VALUES ('$user_id','$order_id','$transation_status','$reward_points','$order_date')";
	$conn->query($reward_points);

	//after placing order that item will delete in cart
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
	
	$delCart ="DELETE FROM grocery_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
	$conn->query($delCart);

	//$dataem = $_POST["email"];
	$to = $getWalletAmount['email'];
	$from = $getSiteSettings1["orders_email"];
	$subject = "My Servent - Order ";
	$message = '';
	$message .= '<body>
		<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
		<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
		 <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettings1["logo"].' class="logo-responsive"></center>
		</header>
		<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
		  <h1 style="color:#fe6003">Greetings From Myservant</h1>
		  <p>Dear <span style="color:#fe6003;">'.$first_name.'</span>, Thank you for Ordering myservant.com!</p>
			<p>Your Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>
			<p>Your Order Total: Rs. <span style="color:#fe6003;">'.$order_total.'</span></p>
			<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
			<p>Warm Regards,<br>The Myservant Team </p>
		</article>
		<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettings1['footer_text'].'</footer>
		</div>

		</body>';

	//echo $message; die;
	//$sendMail = sendEmail($to,$subject,$message,$from);
	$name = "My Servant - Grocery";
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
		 <center><img src='.$base_url . "uploads/logo/".$getSiteSettings1["logo"].' class="logo-responsive"></center>
		</header>
		<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
		  <h1 style="color:#fe6003">Greetings From Myservant</h1>
		  <p>Dear <span style="color:#fe6003;">Admin</span>, order details.</p>
			<p>Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>
			<p>Order Total: Rs. <span style="color:#fe6003;">'.$order_total.'</span></p>
			<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
			<p>Warm Regards,<br>The Myservant Team </p>
		</article>
		<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettings1['footer_text'].'</footer>
		</div>

		</body>';

	//echo $message; die;
	//$sendMail = sendEmail($to,$subject,$message,$from);
	$name = "My Servant - Grocery";
	$mail = sendEmail($to,$subject,$message,$from,$name);

	header("Location: thankyou.php?odi=".$order_id."");
}
?>
