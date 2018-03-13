<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

$user_mobile = $_POST['phone'];
$mobile_otp = rand(1000, 9999); //Your message to send, Add URL encoding here.
//$mobile_otp = "7896";
$message = urlencode('OTP from MyServant is '.$mobile_otp.' . Do not share it with any one.'); // Message text required to deliver on mobile number
$sendSMS = sendMobileSMS($message,$user_mobile);
$message = "";        
$selOTP = getAllDataWhere('user_mobile_otp','user_mobile',$user_mobile);    
$getNoRows = $selOTP->num_rows; 

$mobOtpSave = "UPDATE user_mobile_otp SET mobile_otp = '$mobile_otp' WHERE user_mobile = '$user_mobile' ";
$saveOTP = $conn->query($mobOtpSave);

if($saveOTP === TRUE) {
	echo 1;
} else {
	echo 0;
}
?>