<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

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
		$contstr = "MYSER-GR";
		$order_id = $contstr.$random1.$random2;
		$service_tax = $_REQUEST["service_tax"];
		$delivery_charges = 0;//For static as per harish comments
		//$servicesCount = count($_REQUEST["service_id"]);
		//Saving user id and coupon id
		$user_id = $_REQUEST["user_id"];
		$payment_status = 2; //In progress

		
	    $product_id = array();
	    $product_id = explode(',', $_REQUEST["product_id"]);

	    $category_id = array();
	    $category_id = explode(',', $_REQUEST["category_id"]);

	    $sub_cat_id = array();
	    $sub_cat_id = explode(',', $_REQUEST["sub_cat_id"]);

	    $product_weight = array();
	    $product_weight = explode(',', $_REQUEST["product_weight"]);

	    $product_price = array();
	    $product_price = explode(',', $_REQUEST["product_price"]);

	    $product_quantity = array();
	    $product_quantity = explode(',', $_REQUEST["product_quantity"]);
	    

		$product_id_cnt = count($product_id);
		
		for($i=0;$i<$product_id_cnt;$i++) {
			//Generate sub randon id

			$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
			$random1 = substr($string1,0,3);
			$string2 = str_shuffle('1234567890');
			$random2 = substr($string2,0,3);
			$date = date("ymdhis");
			$contstr = "MYSERVANT-GR";
			$sub_order_id = $contstr.$random1.$random2.$date;
			$orders = "INSERT INTO grocery_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `address`, `lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `lkp_pincode_id`, `lkp_location_id`, `order_note`, `category_id`, `sub_cat_id`, `product_id`, `item_weight_type_id`, `item_price`, `item_quantity`, `sub_total`, `order_total`, `coupen_code`, `coupen_code_type`, `discout_money`,  `payment_method`,`lkp_payment_status_id`,`service_tax`,`delivery_charges`, `order_id`,`order_sub_id`,`wallet_id`,`wallet_amount`, `created_at`) VALUES ('$user_id','".$_REQUEST["first_name"]."','".$_REQUEST["last_name"]."', '".$_POST["email"]."','".$_POST["mobile"]."','".$_REQUEST["address"]."','".$_REQUEST["state"]."','".$_REQUEST["district"]."','".$_REQUEST["city"]."','".$_REQUEST["postal_code"]."','".$_REQUEST["location"]."','".$_REQUEST["order_note"]."','" . $category_id[$i] . "','" . $sub_cat_id[$i] . "','" . $product_id[$i] . "','".$product_weight[$i]."','" . $product_price[$i] . "','" . $product_quantity[$i] . "','".$_REQUEST["sub_total"]."','".$_REQUEST["order_total"]."',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','".$_REQUEST["service_tax"]."','$delivery_charges', '$order_id','$sub_order_id','$wallet_id','$wallet_amount','$order_date')";

			if ($conn->query($orders) === TRUE) {
	            // check the conditions for query success or not
	            $response["success"] = 0;            
	            $response["message"] = "Save Successfully";   
	            $response["order_id"] = $order_id;      
	        } else {
	            // fail query insert problem
	            $response["success"] = 1;
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