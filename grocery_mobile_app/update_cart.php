<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId']) && !empty($_REQUEST['product_id']) && !empty($_REQUEST['product_weight_type'])) {
	//echo "<pre>"; print_r($_REQUEST); die;

	$user_id = $_REQUEST['userId'];
	//$cart_id = $_REQUEST['cartId'];	
	$product_quantity = $_REQUEST['product_quantity'];	 
	$product_id = $_REQUEST['product_id'];
	$product_weight_type = $_REQUEST['product_weight_type'];
	
	if($item_quantity != 0 ) {

		$updateq = "UPDATE grocery_cart SET product_quantity = '$product_quantity' WHERE user_id='$user_id' AND product_id='$product_id' AND product_weight_type='$product_weight_type' ";
		if($conn->query($updateq) === TRUE) {

		    $getCartFoodData = getAllDataWhere('grocery_cart','user_id',$user_id); 
		    $response["cartCount"] = $getCartFoodData->num_rows;
		    $response["product_weight_type"] = $_REQUEST['product_weight_type'];
			$response["product_id"] = $_REQUEST['product_id'];
		    $response["success"] = 0;
		    $response["message"] = "Success";
		} else {

		    $response["success"] = 1;
		    $response["message"] = "Error";
		}   

	} else {

		$delCart = "DELETE FROM food_cart WHERE id='$cart_id' ";
		$conn->query($delCart);

		$response["success"] = 0;
		$response["message"] = "Success";
	}
	 
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>