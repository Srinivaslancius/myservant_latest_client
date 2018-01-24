<?php
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
$getSiteSettings = getAllDataWhere('services_site_settings','id','1'); 
$getSiteSettingsData = $getSiteSettings->fetch_assoc();

if(!empty($_POST['check_active_id']) && !empty($_POST['check_active_id']))  {
	//echo "<pre>"; print_r($_POST); die;
	$check_active_id = $_POST['check_active_id'];
	$send_status = $_POST['send_status'];
	$current_status = $_POST['current_status'];

	$sql="UPDATE service_provider_registration SET lkp_status_id = '$send_status' WHERE id='$check_active_id' ";
	if($conn->query($sql) === TRUE){
		$succ = "1";
	} else {
		$succ = "0";
	}
	$getServiceProvider = "SELECT * FROM service_provider_registration WHERE id = '$check_active_id' ";
	$getServiceProvider1 = $conn->query($getServiceProvider);
	$getServiceProviderData = $getServiceProvider1->fetch_assoc();

		if($getServiceProviderData['lkp_status_id'] == 0) {
		$to = $getServiceProviderData["email"];
		$from = $getSiteSettingsData["orders_email"];
		$subject = "Myservent - Service Provider ";
		$message = '';
		$message .= '<body>
		 	<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
		 	<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
		 	 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData["logo"].' class="logo-responsive"></center>
		 	</header>
		 	<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
		 	  <h1 style="color:#fe6003">Greetings From Myservant</h1>
		 	  <p>Dear <span style="color:#fe6003;">'.$getServiceProviderData['name'].'</span>,</p>
		 		<p>Now You Are in Active State. So you can start your Services now.</span></p>
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
	echo $succ;
}
?>