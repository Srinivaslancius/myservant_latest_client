<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userName']) && !empty($_REQUEST['userMobile']) && !empty($_REQUEST['userEmail']) && !empty($_REQUEST['userPassword']) ) {

		$checkMobOrEmail = "SELECT * FROM users WHERE user_email = '".$_REQUEST['userEmail']."' OR user_mobile = '".$_REQUEST['userMobile']."' ";
		$checkUseCount = $conn->query($checkMobOrEmail);
		$getCnt = $checkUseCount->num_rows;

		if($getCnt > 0) {
			$response["success"] = 1;
			$response["message"] = "User already exists!";

		} else {

			$userMobile = $_REQUEST['userMobile'];
			//$mobile_otp = rand(1000, 9999); //Your message to send, Add URL encoding here.
	        $mobile_otp = "1234";
			$selOTP = getAllDataWhere('user_mobile_otp','user_mobile',$userMobile);	
			$getNoRows = $selOTP->num_rows;

			if($getNoRows > 0) {
				$mobOtpSave = "UPDATE user_mobile_otp SET mobile_otp = '$mobile_otp' WHERE user_mobile = '$userMobile' ";				
			} else {
				$mobOtpSave = "INSERT INTO `user_mobile_otp`(`user_mobile`, `mobile_otp`) VALUES ('$userMobile', '$mobile_otp') ";				
			}
			//echo $mobOtpSave; die;
			$saveOTP = $conn->query($mobOtpSave);
			$response["success"] = 0;
			$response["message"] = "OTP Sent to ur mobile number.";

		}

	} else {
		$response["success"] = 2;
		$response["message"] = "Required Fields Missings!";

	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";

}
echo json_encode($response);

?>