<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['referEmail'])  ) {

			$refer_email = $_REQUEST['referEmail'];
			$user_id = $_REQUEST['userId'];
			$string2 = str_shuffle('1234567890');
			$referal_code = substr($string2,0,5);
			$getEmail1 = "SELECT * FROM users WHERE user_email LIKE '$refer_email'";
			$getEmail = $conn->query($getEmail1);
			$getEmailDeatils = $getEmail->fetch_assoc();
			$created_at = date('Y-m-d H:i:s');
			//Generate sub randon id
			if($getEmail->num_rows == 0) {

				$sql = "INSERT INTO grocery_refer_a_friend (`refered_user_id`,`refer_email_id`,`created_at`,`referal_code`) VALUES ('$user_id','$refer_email','$created_at','$referal_code')";
				if ($conn->query($sql) === TRUE) {
		            // check the conditions for query success or not
		            $response["success"] = 0;            
		            $response["message"] = "Thank You. Your recommendation has been sent to '$refer_email' ";   
		            
		        } else {
		            // fail query insert problem
		            $response["success"] = 1;
		            $response["message"] = "Oops! An error occurred.";                      
		        }
			} else {
				$response["success"] = 2;
		        $response["message"] = "Sorry! You Cant refered this Mail.";     
			}

			

		
		

	} else {

		$response["success"] = 2;
    	$response["message"] = "Required field(s) is missing";		
	}
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}

echo json_encode($response);

?>