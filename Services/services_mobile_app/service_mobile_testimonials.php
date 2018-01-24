<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$getTestominalsData = getAllDataWithStatusLimit('services_testimonials',0,'','');
	if ($getTestominalsData->num_rows > 0) {
			$response["lists"] = array();
			while($row = $getTestominalsData->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["id"] = $row["id"];
		    	$lists["title"] = $row["title"];	
		    	$lists["description"] = strip_tags($row["description"]);
		    	$lists["image"] = $base_url."uploads/services_testimonials_images/".$row["image"];
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