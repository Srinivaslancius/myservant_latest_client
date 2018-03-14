<?php 
ob_start();
include "admin_includes/config.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['order_last_session_id']) && $_SESSION['order_last_session_id']!="") {
	$payment_status = 3; //success
	$order_id = $_SESSION['order_last_session_id'];
	$user_id = $_SESSION['user_login_session_id'];
	$getSiteSettings1 = getIndividualDetails('grocery_site_settings','id','1');
	$getWalletAmount = getIndividualDetails('grocery_orders','order_id',$_SESSION['order_last_session_id']);
	$updateOrderStatus = "UPDATE grocery_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);

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
		  <p>Dear <span style="color:#fe6003;">'.$getWalletAmount['first_name'].'</span>, Thank you for Ordering myservant.com!</p>
			<p>Your Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>
			<p>Your Order Total: Rs. <span style="color:#fe6003;">'.$getWalletAmount['order_total'].'</span></p>
		</article>
		<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettings1['footer_text'].'</footer>
		</div>

		</body>';

	//echo $message; die;
	//$sendMail = sendEmail($to,$subject,$message,$from);
	$name = "My Servant - Grocery";
	$mail = sendEmail($to,$subject,$message,$from,$name);

	unset($_SESSION['order_last_session_id']);
	header("Location: failure.php");
}
?>
