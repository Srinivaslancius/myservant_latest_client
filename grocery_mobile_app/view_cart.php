<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId'])  ) {
	
	$user_id = $_REQUEST['userId'];
	$response["lists"] = array();
	$getCartFoodData = getAllDataWhere('grocery_cart','user_id',$user_id); 
	if ($getCartFoodData->num_rows > 0) {

		while($row = $getCartFoodData->fetch_assoc()) {
			$lists = array();
			$lists["cartId"] = $row["id"];	
			$lists["product_id"]    = $row["product_id"];
			$lists["product_quantity"] = $row["product_quantity"];	
			$lists["product_price"] = $row["product_price"];	
			$lists["category_id"] = $row["category_id"];
			$lists["product_name"] = $row["product_name"];
			$lists["sub_category_id"] =  $row['sub_category_id'];
	    	$lists["product_weight_type"] =  $row['product_weight_type'];	
	    	$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$row["product_id"]);
			$lists["productImage"] = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'];
			//get products weights and product weight type names with prices
	    	$getPriceDetails = getAllDataWhere('grocery_product_bind_weight_prices','product_id',$row["product_id"]);
	    	$getPriceDet = array();
	    	while($getPriceDet = $getPriceDetails->fetch_assoc()) {		    		
	    		$lists["offer_type"] .=  $getPriceDet['offer_type'] .",";
	    		$lists["offer_percentage"] .=  $getPriceDet['offer_percentage'] .",";
	    		$lists["mrp_price"] .=  $getPriceDet['mrp_price'] .",";
	    		$lists["sellingPrice"] .=  $getPriceDet['selling_price'] .",";
	    		$lists["priceTypeId"] .=  $getPriceDet['id'] .",";			    	
	    		$lists["weightType"] .=  $getPriceDet['weight_type'] .",";		    		
	    	}

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