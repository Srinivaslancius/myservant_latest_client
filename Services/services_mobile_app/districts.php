<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['stateId'])  ) {

		$response["lists"] = array();
		$getDistricts = getAllDataWhere('lkp_districts','lkp_state_id',$_REQUEST['stateId']); 
		while($row = $getDistricts->fetch_assoc()) {
			$lists = array();
	    	$lists["districtId"] = $row["id"];
	    	$lists["districtName"] = $row["district_name"];		    	    	
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