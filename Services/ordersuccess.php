<?php 
ob_start(); 
include_once 'meta.php';
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_GET["odi"]) && $_GET["odi"]!="") {

	$payment_status = $_GET['pay_stau']; //1-success,cod-2(inprogress),3-failed
	$order_id = $_GET["odi"];
	$user_id = $_SESSION['user_login_session_id'];
	$updateOrderStatus = "UPDATE services_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	
	if($conn->query($updateOrderStatus) === TRUE ) {

		//$dataem = $_POST["email"];
		$getUserEmail = getIndividualDetails('users','id',$user_id);
		//$to = "srinivas@lanciussolutions.com";
		$to = $getUserEmail['user_email'];
		$from = $getSiteSettingsData["orders_email"];
		$subject = "Myservent - Services ";
		$message = '';
		$message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData["logo"].' class="logo-responsive"></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Greetings From Myservant</h1>
			  <p>Dear <span style="color:#fe6003;">Customer,</span>, Thank you for Ordering myservant.com!</p>
				<p>Your Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>				
				<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
				<p>Warm Regards,<br>The Myservant Team </p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData['footer_text'].'</footer>
			</div>

			</body>';

		//echo $message; die;
		//$sendMail = sendEmail($to,$subject,$message,$from);
		$name = "My Servant";
		$mail = sendEmail($to,$subject,$message,$from,$name);

		//$to = "srinivas@lanciussolutions.com";
		$to = $getSiteSettingsData["orders_email"];
		$from = $getSiteSettingsData["orders_email"];
		$subject = "Myservent - Services ";
		$message = '';
		$message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData["logo"].' class="logo-responsive"></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Greetings From Myservant</h1>
			  <p>Dear <span style="color:#fe6003;">Admin</span>, order details.</p>
				<p>Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>				
				<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
				<p>Warm Regards,<br>The Myservant Team </p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData['footer_text'].'</footer>
			</div>

			</body>';

		//echo $message; die;
		//$sendMail = sendEmail($to,$subject,$message,$from);
		$name = "My Servant";
		$mail = sendEmail($to,$subject,$message,$from,$name);

	}

	//after placing order that item will delete in cart
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
	$delCart ="DELETE FROM services_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
	$conn->query($delCart);
	
	header("Location: thankyou.php?odi=".$order_id."");
}
?>
