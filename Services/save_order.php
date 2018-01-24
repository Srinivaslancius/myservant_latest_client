<?php 
include_once 'meta.php';
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_POST["submit"]) && $_POST["submit"]!="") {

	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	$mobile = $_POST["mobile"];
	$state = $_POST["state"];
	$district = $_POST["district"];
	$city = $_POST["city"];
	$postal_code=$_POST["postal_code"];
	$location = $_POST["location"];
	$address = $_POST["address"];
	$order_note = $_POST["order_note"];
	$sub_total = $_POST["sub_total"];
	$order_total = $_POST["order_total"];
	$coupon_code = $_POST["coupon_code"];
	$coupon_code_type = $_POST["coupon_code_type"];
	$discount_money = $_POST["discount_money"];
	$payment_group = $_POST["payment_group"];
	$order_date = date("Y-m-d h:i:s");
	$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
	$random1 = substr($string1,0,3);
	$string2 = str_shuffle('1234567890');
	$random2 = substr($string2,0,3);
	$contstr = "MYSER-SERVICES";
	$order_id = $contstr.$random1.$random2;
	$service_tax = $_POST["service_tax"];
	$servicesCount = count($_POST["service_id"]);
	//Saving user id and coupon id
	$user_id = $_SESSION['user_login_session_id'];
	$payment_status = 2; //In progress
	
	for($i=0;$i<$servicesCount;$i++) {
		//Generate sub randon id
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$date = date("ymdhis");
		$contstr = "MYSER-SERVICES";
		$sub_order_id = $contstr.$random1.$random2.$date;
		$orders = "INSERT INTO services_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `state`, `district`, `city`, `postal_code`, `location`, `address`, `order_note`, `category_id`, `sub_category_id`,  `group_id`, `service_id`, `service_price_type_id`,`service_price`,`order_price`,`service_quantity`, `service_selected_date`, `service_selected_time`, `sub_total`, `order_total`, `coupon_code`, `coupon_code_type`, `discount_money`, `payment_method`,`lkp_payment_status_id`,`service_tax`, `order_id`,`order_sub_id`, `created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$state','$district','$city','$postal_code','$location','$address','$order_note','" . $_POST["category_id"][$i] . "','" . $_POST["sub_cat_id"][$i] . "','" . $_POST["group_id"][$i] . "','" . $_POST["service_id"][$i] . "','" . $_POST["service_price_type_id"][$i] . "','" . $_POST["service_price"][$i] . "','" . $_POST["service_price"][$i] . "','" . $_POST["service_quantity"][$i] . "','" . $_POST["service_selected_date"][$i] . "','" . $_POST["service_selected_time"][$i] . "','$sub_total','$order_total',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','$service_tax', '$order_id','$sub_order_id','$order_date')";
		$servicesOrders = $conn->query($orders);
	}

		$dataem = $_POST["email"];
		//$to = "srinivas@lanciussolutions.com";
		$to = $dataem;
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
			  <p>Dear <span style="color:#fe6003;">'.$first_name.'</span>, Thank you for Ordering myservant.com!</p>
				<p>Your Order Number is: <span style="color:#fe6003;">'.$order_id.'</span></p>
				<p>Your Order Total: Rs. <span style="color:#fe6003;">'.$order_total.'</span></p>
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
				<p>Order Total: Rs. <span style="color:#fe6003;">'.$order_total.'</span></p>
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


	if($_POST['payment_group'] == "1") {
		//payemnt group 1 means COD		
		//after placing order that item will delete in cart
		if($_SESSION['CART_TEMP_RANDOM'] == "") {
	        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
	    }
	    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
		$delCart ="DELETE FROM services_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
		$conn->query($delCart);
		header("Location: thankyou.php?odi=".$order_id."");
	} else {
		//Online
		header("Location: hdfc_form.php?odi=".$order_id."&user_id=".$user_id."");
	}
		
	
}
?>
