<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$cur_time=date("Y-m-d");
	$getOffers = $getOffers = "SELECT * FROM grocery_offer_zone WHERE lkp_status_id = 0 AND offer_end_date > '$cur_time'";
	$result = $conn->query($getOffers); 

	if ($result->num_rows > 0) {
			$response["lists"] = array();
			while($row = $result->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["offerId"] = $row["id"];
		    	$lists["offer_end_date"] = $row["offer_end_date"];		    	
		    	$lists["offerImage"] = $base_url."grocery_admin/uploads/grocery_offer_zone_images/".$row["offer_image"];
		    	$lists["min_offer_percentage"] = $row["min_offer_percentage"];			
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