<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['restaurantId']) && !empty($_REQUEST['restaurantId']))  {

		$getCategory = getFoodCategoryByRestId('food_products','restaurant_id',$_REQUEST['restaurantId']);
		if ($getCategory->num_rows > 0) {
				$response["lists"] = array();
				while($row = $getCategory->fetch_assoc()) {

					$getCatName = getIndividualDetails('food_category','id',$row['category_id']);
					//Chedck the condioton for emptty or not		
					$lists = array();
					$lists["restaurantId"] = $_REQUEST['restaurantId'];
			    	$lists["categoryMenuId"]   = $getCatName["id"];			    	
			    	$lists["categoryMenuName"] = $getCatName["category_name"];
			    	$lists["categoryMenuDesc"] = strip_tags($getCatName["category_description"]);	 		    	
			    	$lists["categoryMenuImage"] = $base_url."uploads/food_category_images/".$getCatName["category_image"];
			    	array_push($response["lists"], $lists);		
				}
				
				$response["success"] = 0;
				$response["message"] = "Success";				
		} else {
		    $response["success"] = 1;
		    $response["message"] = "No Records found";	   
		}
	} else {
		$response["success"] = 2;
		$response["message"] = "Required field(s) is missing";
	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";

}
echo json_encode($response);

?>