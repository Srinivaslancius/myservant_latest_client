<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['category_id']) && isset($_REQUEST['product_id']) && !empty($_REQUEST['product_weight_type']) && isset($_REQUEST['product_price']) && !empty($_REQUEST['product_quantity']) && !empty($_REQUEST['product_name']) && !empty($_REQUEST['sub_category_id']) && !empty($_REQUEST['lkp_city_id'])) {
		
		$user_id = $_REQUEST['userId'];
		$session_cart_id = 1234;
		$category_id = $_REQUEST['category_id'];
		$product_id = $_REQUEST['product_id'];
		$product_weight_type = $_REQUEST['product_weight_type'];
		$product_price = $_REQUEST['product_price'];
		$product_quantity = $_REQUEST['product_quantity'];	
		$product_name = $_REQUEST['product_name'];
		$sub_category_id = $_REQUEST['sub_category_id'];
		$lkp_city_id = $_REQUEST['lkp_city_id'];
		//$service_quantity = 1;
		$created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);	 		

		$saveItems = "INSERT INTO `grocery_cart`(`user_id`, `session_cart_id`, `category_id`, `product_id`, `product_weight_type`, `product_price`, `product_quantity`, `product_name`, `sub_category_id`,`lkp_city_id`, `created_at`) VALUES ('$user_id','$session_cart_id','$category_id','$product_id','$product_weight_type','$product_price','$product_quantity','$product_name','$sub_category_id','$lkp_city_id','$created_at')"; 
		if($conn->query($saveItems) === TRUE) {

			$getCartData = getAllDataWhere('grocery_cart','user_id',$user_id); 
			$response["cartCount"] = $getCartData->num_rows;
			//$response["cartId"] = $conn->insert_id;
			$response["product_weight_type"] = $_REQUEST['product_weight_type'];
			$response["product_id"] = $_REQUEST['product_id'];
$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$_REQUEST['product_id']);
$lists["productImage"] = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'];
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