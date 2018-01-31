<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['orderNo']) )  {

		$order_id = $_REQUEST['orderNo'];
        $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
        $getOrdersData3 = $conn->query($getOrders1);
        $response["lists"] = array();
        $orderData = getIndividualDetails('food_orders','order_id',$order_id);
        $response["delivery_charges"] = $orderData["delivery_charges"];
        $response["service_tax"] = $orderData["service_tax"];
        $response["orderTotal"] = $orderData["order_total"];
        $response["totalItemCount"] = $getOrdersData3->num_rows;
        $response["order_date"] = $orderData["created_at"];
        while($getOrdersData2 = $getOrdersData3->fetch_assoc()) {
        	$lists = array();
        	$getCategories = getIndividualDetails('food_category','id',$getOrdersData2['category_id']);
            $getProducts = getIndividualDetails('food_products','id',$getOrdersData2['product_id']);
            $getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
            $lists["productName"] = $getProducts["product_name"];
            $lists["categoryName"] = $getCategories["category_name"];
            $lists["weightType"] = $getItemWeights["weight_type"];
            $lists["itemQuantity"] = $getOrdersData2["item_quantity"];
            $lists["itemPrice"] = $getOrdersData2["item_price"];
            array_push($response["lists"], $lists);	
        }       
		
		$response["success"] = 0;
		$response["message"] = "Success";				
		
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