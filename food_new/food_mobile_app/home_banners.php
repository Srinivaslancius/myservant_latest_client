<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$result = getAllDataWhere('food_banners','lkp_status_id','0');
	if ($result->num_rows > 0) {
			$response["lists"] = array();
			while($row = $result->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["id"] = $row["id"];
		    	$lists["title"] = $row["title"];		    	
		    	$lists["banner"] = $base_url."uploads/food_banner_images/".$row["banner"];			
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