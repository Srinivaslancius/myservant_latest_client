<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && !empty($_REQUEST['first_name']) && !empty($_REQUEST['last_name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile']) && !empty($_REQUEST['state']) && !empty($_REQUEST['district']) && !empty($_REQUEST['city']) && !empty($_REQUEST['postal_code']) && !empty($_REQUEST['location']) && !empty($_REQUEST['address']) ) {

		$payment_status = 2; //In progress
		$country = 99;
			
		$payment_group = $_REQUEST["payment_group"];
		$order_date = date("Y-m-d h:i:s");
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$contstr = "MYSER-FOOD";
		$order_id = $contstr.$random1.$random2;
		$service_tax = $_REQUEST["service_tax"];
		//$servicesCount = count($_REQUEST["service_id"]);
		//Saving user id and coupon id
		$user_id = $_REQUEST["user_id"];
		$payment_status = 2; //In progress

		$food_category_id = array();
	    $food_category_id = explode(',', $_REQUEST["food_category_id"]);
	    
	    $food_item_id = array();
	    $food_item_id = explode(',', $_REQUEST["food_item_id"]);
	    
	    $item_weight_type_id = array();
	    $item_weight_type_id = explode(',', $_REQUEST["item_weight_type_id"]);
	    
	    $item_price = array();
	    $item_price= explode(',', $_REQUEST["item_price"]);

	    $item_quantity = array();
	    $item_quantity= explode(',', $_REQUEST["item_quantity"]);

	    

		$food_item_idcnt = count($food_item_id);
		
		for($i=0;$i<$food_item_idcnt;$i++) {
			//Generate sub randon id

			$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
			$random1 = substr($string1,0,3);
			$string2 = str_shuffle('1234567890');
			$random2 = substr($string2,0,3);
			$date = date("ymdhis");
			$contstr = "MYSER-SERVICES";
			$sub_order_id = $contstr.$random1.$random2.$date;
			$orders = "INSERT INTO food_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `address`, `country`, `postal_code`, `city`, `order_note`, `category_id`, `product_id`, `item_weight_type_id`, `order_vendor_price`, `item_price`, `item_quantity`,`restaurant_id`, `sub_total`, `order_total`, `payment_method`,`lkp_payment_status_id`,`delivery_type_id`,`service_tax`,`delivery_charges`, `order_id`,`order_sub_id`, `created_at`) VALUES ('$user_id','".$_REQUEST["firstname_order"]."','".$_REQUEST["lastname_order"]."', '".$_REQUEST["email_order"]."','".$_REQUEST["tel_order"]."','".$_REQUEST["address_order"]."','$country','".$food_category_id[$i] . "','" . $food_item_id[$i] . "','" . $item_weight_type_id[$i] . "','".$getItemPriceDatils['vendor_price']."','" . $item_price[$i] . "','" . $item_quantity[$i] . "','".$_REQUEST["restaurant_id"]."','".$_REQUEST["sub_total"]."','".$_REQUEST["order_total"]."','$payment_group','$payment_status','$dev_type','".$_REQUEST["service_tax"]."','$delivery_charges', '$order_id','$sub_order_id','$order_date')";				

			if ($conn->query($orders) === TRUE) {
	            // check the conditions for query success or not
	            $response["success"] = 0;            
	            $response["message"] = "Save Successfully";   
	            $response["order_id"] = $order_id;      
	        } else {
	            // fail query insert problem
	            $response["success"] = 2;
	            $response["message"] = "Oops! An error occurred.";                      
	        }

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