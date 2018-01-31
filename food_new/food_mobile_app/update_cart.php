<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response = array();

if (isset($_REQUEST['userId']) && !empty($_REQUEST['itemId']) && !empty($_REQUEST['itemWeightTypeId'])  ) {
	//echo "<pre>"; print_r($_REQUEST); die;

	$user_id = $_REQUEST['userId'];
	//$cart_id = $_REQUEST['cartId'];	
	$item_quantity = $_REQUEST['itemQuantity'];	 
	$itemId = $_REQUEST['itemId'];
	$itemWeightTypeId = $_REQUEST['itemWeightTypeId'];
	
	if($item_quantity!= 0 ) {

		$updateq = "UPDATE food_cart SET item_quantity = '$item_quantity' WHERE user_id='$user_id' AND food_item_id='$itemId' AND item_weight_type_id='$itemWeightTypeId' ";
		if($conn->query($updateq) === TRUE) {

		    //$getCartFoodData = getAllDataWhere('food_cart','user_id',$user_id); 
		    $getSelQu = "SELECT * FROM food_cart WHERE user_id='$user_id' ";
		    $getCartFoodData = $conn->query($getSelQu);
		    $response["cartCount"] = $getCartFoodData->num_rows;
		    $response["itemWeightTypeId"] = $_REQUEST['itemWeightTypeId'];
			$response["itemId"] = $_REQUEST['itemId'];
		    $response["success"] = 0;
		    $response["message"] = "Success";
		} else {

		    $response["success"] = 1;
		    $response["message"] = "Error";
		}   

	} else {

		$delCart = "DELETE FROM food_cart WHERE user_id='$user_id' AND food_item_id='$itemId' AND item_weight_type_id='$itemWeightTypeId' ";
		$conn->query($delCart);

		$getSelQu = "SELECT * FROM food_cart WHERE user_id='$user_id' ";
		    $getCartFoodData = $conn->query($getSelQu);
		    $response["cartCount"] = $getCartFoodData->num_rows;

		$response["success"] = 0;
		$response["message"] = "Delete Item Successfully";
	}
	 
          
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);

?>