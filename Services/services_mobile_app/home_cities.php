<?php 
error_reporting(1);
include "../../admin_includes/config.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='GET'){

	$getStates1 = "SELECT * from lkp_cities WHERE id IN (SELECT lkp_city_id FROM availability_of_locations WHERE lkp_status_id = 0) AND lkp_status_id = '0'";
	$getStates = $conn->query($getStates1);
	if ($getStates->num_rows > 0) {
			$response["lists"] = array();
			while($row = $getStates->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["cityId"] = $row["id"];
		    	$lists["cityName"] = $row["city_name"];		    			    	
				array_push($response["lists"], $lists);		 
			}
			$response["success"] = 0;
			$response["message"] = "Success";				
	} else {
	    $response["success"] = 1;
	    $response["message"] = "No Records found";	   
	}
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>