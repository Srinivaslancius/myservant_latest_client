<?php 
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";

$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
	//Save Ratings in database
	if (isset($_REQUEST['userName']) && !empty($_REQUEST['userEmail']) && isset($_REQUEST['userMobile']) && !empty($_REQUEST['message'])  ) {

		$userName = $_REQUEST["userName"];
	    $userEmail = $_REQUEST["userEmail"];
	    $userMobile = $_REQUEST["userMobile"];
	    $message = $_REQUEST["message"];
	    $created_at = date("Y-m-d h:i:s");
	    //Get user password
    	//echo "succes"; die;

    	$result = "INSERT INTO `customer_enquirers`(`first_name`, `customer_email`, `customer_phone`, `enquiry_details`, `device_type_id`, `created_at`) VALUES ('$userName', '$userEmail' , '$userMobile', '$message', '2', '$created_at')";
		if ($conn->query($result) === TRUE) {
            // check the conditions for query success or not
            $response["success"] = 0;            
            $response["message"] = "Data submitted successfully!.";            
        } else {     	
            // fail query insert problem
            $response["success"] = 1;
            $response["message"] = "Oops! An error occurred.";                      
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