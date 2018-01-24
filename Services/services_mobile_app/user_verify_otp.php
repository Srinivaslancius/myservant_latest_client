<?php 
error_reporting(0);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userName']) && !empty($_REQUEST['userMobile']) && !empty($_REQUEST['userEmail']) && !empty($_REQUEST['userPassword']) && !empty($_REQUEST['mobileOTP']) && !empty($_REQUEST['registerDeviceTypeId']) && !empty($_REQUEST['mobileToken']) ) {

		$sql="SELECT * FROM user_mobile_otp WHERE user_mobile='".$_REQUEST['userMobile']."' AND mobile_otp='".$_REQUEST['mobileOTP']."' ";
		$getCn = $conn->query($sql);
		$getCnt = $getCn->num_rows;

		if($getCnt > 0) {

			$mobile_otp = $_REQUEST['mobileOTP'];		
			$user_full_name = $_REQUEST['userName'];
			$user_email = $_REQUEST['userEmail'];
			$user_mobile = $_REQUEST['userMobile'];
			$user_password = encryptPassword($_REQUEST['userPassword']);	
			$lkp_status_id = 0; //0-active, 1- inactive
			$login_count = 1;
			$last_login_visit = date("Y-m-d h:i:s");
			$lkp_register_device_type_id= $_REQUEST['registerDeviceTypeId']; //1- web, 2- android, 3-ios
			$user_login_type = 1; //1-Normal, 2-Facebook,3-twitter
			$user_register_service_id = 1;
			$created_at = date("Y-m-d h:i:s");
			$mobile_token = $_REQUEST['mobileToken'];

			$saveUser = saveUser($user_full_name, $user_email, $user_mobile, $user_password,$lkp_status_id,$login_count,$last_login_visit,$lkp_register_device_type_id,$user_login_type,$mobile_token,$user_register_service_id,$created_at);

			$response["success"] = 0;
			$response["message"] = "OTP Verified.";

		} else {
			$response["success"] = 1;
			$response["message"] = "Please enter valid OTP.";

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