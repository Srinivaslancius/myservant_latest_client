<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['menuItemId']) && isset($_REQUEST['itemId']) && !empty($_REQUEST['itemWeightTypeId']) && isset($_REQUEST['itemPrice']) && !empty($_REQUEST['itemQuantity']) && !empty($_REQUEST['restaurantId']) ) {
		
		$user_id = $_REQUEST['userId'];
		$session_cart_id = 1234;
		$category_id = $_REQUEST['menuItemId'];
		$itemId = $_REQUEST['itemId'];
		$itemWeightTypeId = $_REQUEST['itemWeightTypeId'];
		$item_price = $_REQUEST['itemPrice'];
		$item_quantity = $_REQUEST['itemQuantity'];	
		$restaurant_id = $_REQUEST['restaurantId'];
		//$service_quantity = 1;
		$created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);	 		

		$saveItems = "INSERT INTO `food_cart`(`user_id`, `session_cart_id`, `food_category_id`, `food_item_id`, `item_weight_type_id`, `item_price`, `item_quantity`, `restaurant_id`, `created_at`) VALUES ('$user_id','$session_cart_id','$category_id','$itemId','$itemWeightTypeId','$item_price','$item_quantity','$restaurant_id','$created_at')";		
		
		if($conn->query($saveItems) === TRUE) {

			$getCartData = getAllDataWhere('food_cart','user_id',$user_id); 
			$response["cartCount"] = $getCartData->num_rows;
			//$response["cartId"] = $conn->insert_id;
			$response["itemWeightTypeId"] = $_REQUEST['itemWeightTypeId'];
			$response["itemId"] = $_REQUEST['itemId'];
		    $response["success"] = 0;
		    $response["message"] = "Success";
		} else {

		    $response["success"] = 1;
		    $response["message"] = "Error";
		}
	    
	          
	} else {
	    $response["success"] = 2;
	    $response["message"] = "Required field(s) is missing";
	}
	
}  else {

	$response["success"] = 4;
	$response["message"] = "Invalid request";
}

echo json_encode($response);

?>