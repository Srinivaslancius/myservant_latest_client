<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId'])  ) {
	
	$user_id = $_REQUEST['userId'];
	$response["lists"] = array();
	$getCartFoodData = getAllDataWhere('food_cart','user_id',$user_id); 
	if ($getCartFoodData->num_rows > 0) {

		while($row = $getCartFoodData->fetch_assoc()) {
			$lists = array();
			$lists["cartId"] = $row["id"];	
			$lists["productId"]    = $row["food_item_id"];
			$lists["itemQuantity"] = $row["item_quantity"];	
			$lists["itemPrice"] = $row["item_price"];	
			$lists["categoryId"] = $row["food_category_id"];
			$lists["restaurantId"] = $row["restaurant_id"];
			$restName= getIndividualDetails('food_vendors','id',$row['restaurant_id']);
			$lists["restaurantName"] = $restName["restaurant_name"];
			$proName= getIndividualDetails('food_products','id',$row['food_item_id']);
			$lists["productName"] = $proName['product_name'];		
			$getPriceDetails = getIndividualDetails('food_product_weight_prices','weight_type_id',$row["item_weight_type_id"]);	
			$getWeights = getIndividualDetails('food_product_weights','id',$getPriceDetails['weight_type_id']);
			$lists["weightTypeId"] =  $row['item_weight_type_id'];
	    	$lists["weightType"] =  $getWeights['weight_type'];	

			array_push($response["lists"], $lists);
		}
	$response["success"] = 0;
	$response["message"] = "Success";

	} else {

		$response["success"] = 1;
	    $response["message"] = "No items in your cart!";	   
	}	
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>