<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && !empty($_REQUEST['first_name']) && !empty($_REQUEST['last_name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile']) && !empty($_REQUEST['state']) && !empty($_REQUEST['district']) && !empty($_REQUEST['city']) && !empty($_REQUEST['postal_code']) && !empty($_REQUEST['location']) && !empty($_REQUEST['address']) ) {

		$first_name = $_REQUEST["first_name"];
		$last_name = $_REQUEST["last_name"];
		$email = $_REQUEST["email"];
		$mobile = $_REQUEST["mobile"];
		$state = $_REQUEST["state"];
		$district = $_REQUEST["district"];
		$city = $_REQUEST["city"];
		$postal_code=$_REQUEST["postal_code"];
		$location = $_REQUEST["location"];
		$address = $_REQUEST["address"];
		$order_note = $_REQUEST["order_note"];
		$sub_total = $_REQUEST["sub_total"];
		$order_total = $_REQUEST["order_total"];		
		$payment_group = $_REQUEST["payment_group"];
		$order_date = date("Y-m-d h:i:s");
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$contstr = "MYSER-SERVICES";
		$order_id = $contstr.$random1.$random2;
		$service_tax = $_REQUEST["service_tax"];
		//$servicesCount = count($_REQUEST["service_id"]);
		//Saving user id and coupon id
		$user_id = $_REQUEST["user_id"];
		$payment_status = 2; //In progress

		$category_id = array();
	    $category_id = explode(',', $_REQUEST["category_id"]);
	    
	    $sub_cat_id = array();
	    $sub_cat_id = explode(',', $_REQUEST["sub_cat_id"]);
	    
	    $group_id = array();
	    $group_id = explode(',', $_REQUEST["group_id"]);
	    
	    $service_id = array();
	    $service_id= explode(',', $_REQUEST["service_id"]);

	    $service_price_type_id = array();
	    $service_price_type_id= explode(',', $_REQUEST["service_price_type_id"]);

	    $service_price = array();
	    $service_price= explode(',', $_REQUEST["service_price"]);

	    $service_quantity = array();
	    $service_quantity= explode(',', $_REQUEST["service_quantity"]);

	    $service_selected_date = array();
	    $service_selected_date= explode(',', $_REQUEST["service_selected_date"]);

	    $service_selected_time = array();
	    $service_selected_time= explode(',', $_REQUEST["service_selected_time"]);

		$serviceCount = count($service_id);
		
		for($i=0;$i<$serviceCount;$i++) {
			//Generate sub randon id
			$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
			$random1 = substr($string1,0,3);
			$string2 = str_shuffle('1234567890');
			$random2 = substr($string2,0,3);
			$date = date("ymdhis");
			$contstr = "MYSER-SERVICES";
			$sub_order_id = $contstr.$random1.$random2.$date;
			$orders = "INSERT INTO services_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `state`, `district`, `city`, `postal_code`, `location`, `address`, `order_note`, `category_id`, `sub_category_id`,  `group_id`, `service_id`, `service_price_type_id`,`service_price`,`order_price`,`service_quantity`, `service_selected_date`, `service_selected_time`, `sub_total`, `order_total`,  `payment_method`,`lkp_payment_status_id`,`service_tax`, `order_id`,`order_sub_id`, `created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$state','$district','$city','$postal_code','$location','$address','$order_note','" . $category_id[$i] . "','" . $sub_cat_id[$i] . "','" . $group_id[$i] . "','" . $service_id[$i] . "','" . $service_price_type_id[$i] . "','" . $service_price[$i] . "','" . $service_price[$i] . "','" . $service_quantity[$i] . "','" . $service_selected_date[$i] . "','" . $service_selected_time[$i] . "','$sub_total','$order_total','$payment_group','$payment_status','$service_tax', '$order_id','$sub_order_id','$order_date')";		

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