<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['pincodeId'])  ) {

		$response["lists"] = array();
		$getLocs = getAllDataWhere('lkp_locations','lkp_pincode_id',$_REQUEST['pincodeId']); 
		while($row = $getLocs->fetch_assoc()) {
			$lists = array();
	    	$lists["locationId"] = $row["id"];
	    	$lists["locationName"] = $row["location_name"];		    	    	
			array_push($response["lists"], $lists);	
		}
		//Success
		$response["success"] = 0;
	    $response["message"] = "Success";

	}   else {

	    $response["success"] = 2;
	    $response["message"] = "Required field(s) is missing";
	}	
	
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>