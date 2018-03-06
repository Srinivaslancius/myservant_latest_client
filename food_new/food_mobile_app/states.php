<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$response["lists"] = array();
	$getStates = getAllDataWithStatus('lkp_states','0');
	while($row = $getStates->fetch_assoc()) {
		$lists = array();
    	$lists["stateId"] = $row["id"];
    	$lists["stateName"] = $row["state_name"];		    	    	
		array_push($response["lists"], $lists);	
	}
	//Success
	$response["success"] = 0;
    $response["message"] = "Success";
	
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>