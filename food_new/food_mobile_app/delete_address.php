<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['user_id']) && !empty($_REQUEST['address_id']) && !empty($_REQUEST['address_id'])  ) {
	//echo "<pre>"; print_r($_REQUEST); die;

	$user_id = $_REQUEST['user_id'];
	//$cart_id = $_REQUEST['cartId'];	
	$address_id = $_REQUEST['address_id'];	 
	
	$updateq = "DELETE FROM food_add_address WHERE user_id='$user_id' AND id='$address_id' ";
	if($conn->query($updateq) === TRUE) {
	    
	    $response["success"] = 0;
        $response["message"] = "Success";
	} else {

	    $response["success"] = 1;
	    $response["message"] = "Error";
	}   
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>