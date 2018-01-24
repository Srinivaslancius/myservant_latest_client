<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userMobile']) && !empty($_REQUEST['userPassword'])  ) {

		 	$user_email = $_REQUEST['userMobile'];
		    $user_password = encryptPassword($_REQUEST['userPassword']);
		    $getLoginData = userLogin($user_email,$user_password);
		    //Set variable for session
		    if($getLoggedInDetails = $getLoginData->fetch_assoc()) {
		    	$last_login_visit = date("Y-m-d h:i:s");
		    	$login_count = $getLoggedInDetails['login_count']+1;
		    	$sql = "UPDATE `users` SET login_count='$login_count', last_login_visit='$last_login_visit' WHERE user_email = '$user_email' OR user_mobile = '$user_email' ";
		    	$row = $conn->query($sql);		 
		    	$response["userId"] = $getLoggedInDetails['id'];
		    	$response["userName"] = $getLoggedInDetails['user_full_name'];
		    	$response["userEmail"] = $getLoggedInDetails['user_email'];
		    	$response["userMobile"] = $getLoggedInDetails['user_mobile'];
		    	$response["success"] = 0;
				$response["message"] = "Success!.";
			} else {

				$response["success"] = 1;
				$response["message"] = "Please enter valid credentails!";
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