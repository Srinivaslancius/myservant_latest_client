<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$result = getAllRestaruntsWithProducts('0','','');
	if ($result->num_rows > 0) {
			$response["lists"] = array();
			while($row = $result->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["id"] = $row["id"];
		    	$lists["restaurantName"] = $row["restaurant_name"];
		    	$lists["restaurantDesc"] = strip_tags($row["description"]);		 
		    	$lists["restaurantAddress"] = strip_tags($row["restaurant_address"]);	   	
		    	$lists["restaurantTimings"] = strip_tags($row["working_timings"]);
		    	$lists["restaurantLogo"] = $base_url."uploads/food_vendor_logo/".$row["logo"];			
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