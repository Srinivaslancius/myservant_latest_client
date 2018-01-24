<?php

include "admin_includes/config.php";
include "admin_includes/common_functions.php";

$getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc();
//echo "<pre>"; print_r($_POST); die;
if(!empty($_POST['user_mobile']) && !empty($_POST['mobile_otp']))  {
	//echo "<pre>"; print_r($_POST); die;
	$mobile_otp = $_POST['mobile_otp'];
		
	$user_full_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_mobile = $_POST['user_mobile'];
	$user_password = $_POST['user_password'];	
	$lkp_status_id = 0; //0-active, 1- inactive
	$login_count = 1;
	$last_login_visit = date("Y-m-d h:i:s");
	$lkp_register_device_type_id=1; //1- web, 2- android, 3-ios
	$user_login_type = 1; //1-Normal, 2-Facebook,3-twitter
	$user_register_service_id = 3;
	$created_at = date("Y-m-d h:i:s");

	$sql="SELECT * FROM user_mobile_otp WHERE user_mobile='$user_mobile' AND mobile_otp='$mobile_otp' ";
	$getCn = $conn->query($sql);
	$getnoRows = $getCn->num_rows;
	if($getnoRows > 0) {
		$saveUser = saveUser($user_full_name, $user_email, $user_mobile, $user_password,$lkp_status_id,$login_count,$last_login_visit,$lkp_register_device_type_id,$user_login_type,'',$user_register_service_id,$created_at);
		$getUserData = userLogin($user_email,$user_password);
		$getLoggedInDetails = $getUserData->fetch_assoc();
		$_SESSION['user_login_session_id'] =  $getLoggedInDetails['id'];
        $_SESSION['user_login_session_name'] = $getLoggedInDetails['user_full_name'];
        $_SESSION['user_login_session_email'] = $getLoggedInDetails['user_email'];
        $_SESSION['timestamp'] = time();
        $updateCart = "UPDATE `grocery_cart` SET user_id='".$_SESSION['user_login_session_id']."' WHERE session_cart_id = '".$_SESSION['CART_TEMP_RANDOM']."'";
		$updateCart1 = $conn->query($updateCart);

        if($_SESSION['wallet_id'] == "") {
			$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
			$random1 = substr($string1,0,3);
			$string2 = str_shuffle('1234567890');
			$random2 = substr($string2,0,3);
			$contstr = "MYSER-WALLET_";
			$_SESSION['wallet_id'] = $contstr.$random1.$random2;
		}
		$wallet_id = $_SESSION['wallet_id'];
		$user_id = $_SESSION['user_login_session_id'];
		$created_at = date("Y-m-d h:i:s");
		$amount = 0;
		$sqlInwallet = "INSERT INTO `user_wallet`(`wallet_id`, `user_id`, `amount`, `created_at`) VALUES ('$wallet_id','$user_id','$amount','$created_at')";
		$sqlInwallet1 = $conn->query($sqlInwallet);

        $dataem = $getLoggedInDetails["user_email"];

        $user_password = decryptPassword($getLoggedInDetails["user_password"]);
		//$to = "srinivas@lanciussolutions.com";
		$to = $dataem;
		//$from = $getSiteSettingsData1["email"];
		$subject = "Myservent - Groceries ";
		$message = '';		
		$message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Welcome To Myservant</h1>
			  <p>A very special welcome to you <span style="color:#fe6003;">'.$getLoggedInDetails["user_full_name"].'</span>, Thank you for joining myservant.com!</p>
				<p>Your pasword is <span style="color:#fe6003;">'.$user_password.'</span></p>
				<p>Please keep it secret, keep it safe!</p>
				<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
				<p>Warm Regards,<br>The Myservant Team </p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
			</div>

			</body>';

		//echo $message; die;
		//$sendMail = sendEmail($to,$subject,$message,$from);
		$name = "My Servant";
		$from = $getSiteSettingsData["from_email"];
		$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
        $headers .= 'From: '.$name.'<'.$from.'>'. "\r\n";
        mail($to, $subject, $message, $headers);

		echo $getnoRows;
	} else {
		echo $getnoRows;
	}
}
?>