<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
include "../../admin_includes/food_common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['orderId']) )  {

		$order_id = $_REQUEST['orderId'];
		$orderData = getIndividualDetails('food_orders','order_id',$order_id);
        $getRestaurants = getIndividualDetails('food_vendors','id',$orderData['restaurant_id']);
        $getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$orderData['payment_method']);
        $orderStatus = getIndividualDetails('lkp_food_order_status','id',$orderData['lkp_order_status_id']);
        $paymentStatus = getIndividualDetails('lkp_payment_status','id',$orderData['lkp_payment_status_id']);
        $getSiteSettingsData = getIndividualDetails('food_site_settings','id',1);
        $service_tax = $orderData['sub_total']*$getSiteSettingsData['service_tax']/100;
        $getAddOnsPrice = "SELECT * FROM food_order_ingredients WHERE order_id = '$order_id'";
        $getAddontotal = $conn->query($getAddOnsPrice);
        $getAddontotalCount = $getAddontotal->num_rows;
        $getAdstotal = 0;
        while($getAdTotal = $getAddontotal->fetch_assoc()) {
            $getAdstotal += $getAdTotal['item_ingredient_price'];
        }
        if($orderData['delivery_charges'] == '0') {
          $order_type = "Take Away";
        } else {
          $order_type = "Delivery";
        }

        $lists["restaurantName"] = $getRestaurants['restaurant_name']; 
        $lists["paymentMethod"] = $getpaymentTypes['status'];
        $lists["orderType"] = $order_type;
        $lists["orderStatus"] = $orderStatus['order_status'];
        $lists["paymentStatus"] = $paymentStatus['payment_status'];
        $lists["restaurantName"] = $orderData['first_name'] . ',' . $orderData['email'] . ','. $orderData['mobile'] . ',' . $orderData['address'] . ','. $orderData['postal_code'];

        if($orderData['delivery_charges'] != '0') {
        	$lists["deliveryCharges"] = $orderData['delivery_charges'];
        }

        if($getAddontotalCount > 0) {
        	$lists["getAdonstotal"] = $getAdstotal;
        }

        $lists["orderTotal"] = $orderData['order_total'];

        $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
        $getOrdersData3 = $conn->query($getOrders1);
        while($getOrdersData2 = $getOrdersData3->fetch_assoc()) {
        	$lists = array();
        	$getCategories = getIndividualDetails('food_category','id',$getOrdersData2['category_id']);
            $getProducts = getIndividualDetails('food_products','id',$getOrdersData2['product_id']);
            $getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
            $lists["productName"] = $getProducts["product_name"];
            $lists["categoryName"] = $getCategories["category_name"];
            $lists["weightType"] = $getItemWeights["weight_type"];
            $lists["itemQuantity"] = $getProducts["item_quantity"];
            $lists["itemPrice"] = $getProducts["item_price"];
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