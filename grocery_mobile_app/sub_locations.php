<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['locationId'])  ) {

		$response["lists"] = array();
		$getLocs = getAllDataWhere('grocery_lkp_sub_areas','lkp_area_id',$_REQUEST['locationId']); 
		while($row = $getLocs->fetch_assoc()) {
			$lists = array();
	    	$lists["locationId"] = $row["id"];
	    	$lists["locationName"] = $row["sub_area_name"];		    	    	
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