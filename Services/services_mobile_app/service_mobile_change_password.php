<?php 
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";

$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
	//Save Ratings in database
	if (isset($_REQUEST['oldPassword']) && !empty($_REQUEST['oldPassword']) && isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && isset($_REQUEST['newPassword']) && !empty($_REQUEST['newPassword']) ) {

		$user_id = $_REQUEST["userId"];
	    $opassword = $_REQUEST["oldPassword"];
	   $npassword = encryptPassword($_REQUEST["newPassword"]);
	    //Get user password
	    $row = getIndividualDetails('users','id',$_REQUEST['userId']);

	    if(decryptPassword($row['user_password']) ==  $opassword) {
	    	//echo "succes"; die;
	    	$result = "UPDATE `users` SET `user_password`='$npassword' WHERE `id`='$user_id'";
			if ($conn->query($result) === TRUE) {
	            // check the conditions for query success or not
	            $response["success"] = 0;            
	            $response["message"] = "Password updated successfully!.";            
	        } else {     	
	            // fail query insert problem
	            $response["success"] = 1;
	            $response["message"] = "Oops! An error occurred.";                      
	        }

	    } else {
	    	$response["success"] = 2;
	        $response["message"] = "Please enter correct old password.";  
	    }

	} else {
		//If post params empty return below error
		$response["success"] = 3;
	    $response["message"] = "Required field(s) is missing";	    
	}
	
} else {

	$response["success"] = 4;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>