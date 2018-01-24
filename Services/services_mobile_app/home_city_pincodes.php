<?php 
error_reporting(1);
include "../../admin_includes/config.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

    if (isset($_REQUEST['cityId']) && !empty($_REQUEST['cityId'])  ) {

    	$query ="SELECT * FROM lkp_pincodes WHERE lkp_status_id = 0 AND lkp_city_id = '" . $_REQUEST["cityId"] . "' AND id IN (SELECT pincodes FROM availability_of_locations WHERE lkp_status_id = 0)";
		$results = $conn->query($query);
		$response["lists"] = array();
		while($row = $results->fetch_assoc()) {
			$lists = array();
		    $lists["pincodeId"] = $row["id"];
		    $lists["cityPincode"] = $row["pincode"];
		    array_push($response["lists"], $lists);	
		}
		$response["success"] = 0;
		$response["message"] = "Success";	

	} else {
		//If post params empty return below error
		$response["success"] = 3;
	    $response["message"] = "Required field(s) is missing";	    
	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>