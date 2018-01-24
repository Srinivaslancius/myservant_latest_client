<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['restaurantId']) && !empty($_REQUEST['restaurantId']) && !empty($_REQUEST['categoryId'])) {

		$getItemsByCat = getFoodItemsByCategory('food_products','restaurant_id',$_REQUEST['restaurantId'],'category_id',$_REQUEST['categoryId']);
		if ($getItemsByCat->num_rows > 0) {
				$response["lists"] = array();
				while($row = $getItemsByCat->fetch_assoc()) {

					$productId = $row['id'];
					$getCatName = getIndividualDetails('food_category','id',$row['category_id']);
					//Chedck the condioton for emptty or not		
					$lists = array();
					$lists["productId"]    = $productId;
			    	$lists["productName"]   = $row["product_name"];	
			    	$lists["productDesc"] = strip_tags($row["specifications"]); 		    	
			    	$lists["productImage"] = $base_url."uploads/food_product_images/".$row["product_image"];
			    	$lists["categoryName"] = $getCatName["category_name"];
			    	//get products weights and product weight type names with prices
			    	$getPriceDetails = getAllDataWhere('food_product_weight_prices','product_id',$productId);
			    	$getPriceDet = array();
			    	while($getPriceDet = $getPriceDetails->fetch_assoc()) {
			    		$lists["price"] .=  round($getPriceDet['admin_price']) .",";
			    		$lists["priceTypeId"] .=  $getPriceDet['id'] .",";
				    	$getWeights = getIndividualDetails('food_product_weights','id',$getPriceDet['weight_type_id']);
				    	$lists["weightTypeId"] .=  $getWeights['id'] .",";
			    		$lists["weightType"] .=  $getWeights['weight_type'] .",";		    		
			    	}

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