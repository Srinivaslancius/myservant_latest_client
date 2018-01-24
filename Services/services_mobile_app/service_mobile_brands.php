<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$getBrands = getAllDataWithStatus('services_brand_logos','0');
	if ($getBrands->num_rows > 0) {
			$response["lists"] = array();
			while($row = $getBrands->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();		    	
		    	$lists["image"] = $base_url."uploads/services_brand_logos/".$row["brand_logo"];
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