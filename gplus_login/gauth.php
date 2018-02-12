<?php
//session_start();

include('../admin_includes/config.php');
include('../admin_includes/common_functions.php');
require_once('settings.php');
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		//Get email and user info		
		$getUserEmail = $user_info['emails'][0]['value'];
		$getUserName  = $user_info['displayName'];
		//echo $user_info['displayName'];
		//echo '<pre>';print_r($user_info); echo '</pre>'; die;
		$getUserSelData =  "SELECT * FROM users WHERE user_email='$getUserEmail' AND lkp_status_id = 0";
		$getLoginData = $conn->query($getUserSelData);
		$getLoggedInDetails = $getLoginData->fetch_assoc();
		$getNoOfUsers = $getLoginData->num_rows;
		if($getNoOfUsers > 0) {

			$last_login_visit = date("Y-m-d h:i:s");
	    	$login_count = $getLoggedInDetails['login_count']+1;
	    	$sql = "UPDATE `users` SET login_count='$login_count', last_login_visit='$last_login_visit' WHERE user_email = '$getUserEmail' ";
	    	$row = $conn->query($sql);
	        $_SESSION['user_login_session_id'] =  $getLoggedInDetails['id'];
	        $_SESSION['user_login_session_name'] = $getLoggedInDetails['user_full_name'];
	        $_SESSION['user_login_session_email'] = $getLoggedInDetails['user_email'];
	        $_SESSION['timestamp'] = time();
	        header('Location: ../index.php');

		} else {

			$user_full_name = $getUserName;
			$user_email = $user_info['emails'][0]['value'];
			$user_mobile = "";
			$user_password = "";	
			$lkp_status_id = 0; //0-active, 1- inactive
			$login_count = 1;
			$last_login_visit = date("Y-m-d h:i:s");
			$lkp_register_device_type_id=1; //1- web, 2- android, 3-ios
			$user_login_type = 3; //1-Normal, 2-Facebook,3-googleplus
			$user_register_service_id = 3;
			$created_at = date("Y-m-d h:i:s");

			//Save User Data
			$saveUser = saveUser($user_full_name, $user_email, $user_mobile, $user_password,$lkp_status_id,$login_count,$last_login_visit,$lkp_register_device_type_id,$user_login_type,'',$user_register_service_id,$created_at);
			$getUserSelData =  "SELECT * FROM users WHERE user_email='$user_email' AND lkp_status_id = 0";
			$getLoginData = $conn->query($getUserSelData);
			$getLoggedInDetails = $getLoginData->fetch_assoc();
			$_SESSION['user_login_session_id'] =  $getLoggedInDetails['id'];
	        $_SESSION['user_login_session_name'] = $getLoggedInDetails['user_full_name'];
	        $_SESSION['user_login_session_email'] = $getLoggedInDetails['user_email'];
	        $_SESSION['timestamp'] = time();
	        //Save wallet Data
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

	        header('Location: ../index.php');
		}
		
		// Now that the user is logged in you may want to start some session variables
		//$_SESSION['logged_in'] = 1;

		// You may now want to redirect the user to the home page of your website
		// header('Location: home.php');
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>