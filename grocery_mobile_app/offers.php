<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	$getOffers = $getOffers = "SELECT * FROM grocery_offer_module WHERE lkp_status_id = 0 ORDER BY id LIMIT 2";
	$result = $conn->query($getOffers); 

	if ($result->num_rows > 0) {
			$response["lists"] = array();
			while($row = $result->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["offerId"] = $row["id"];
		    	//$lists["title"] = $row["title"];		    	
		    	$lists["offerImage"] = $base_url."grocery_admin/uploads/grocery_offer_module_image/".$row["image"];			
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