<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
	
	//Save Order function here
	$coupon_code = $_POST["coupon_code"];
	$coupon_code_type = $_POST["coupon_code_type"];
	$discount_money = $_POST["discount_money"];
	//echo "<pre>"; print_r($_POST); die;
	$payment_group = $_POST["pay_mn"];
	$order_date = date("Y-m-d h:i:s");
	$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
	$random1 = substr($string1,0,3);
	$string2 = str_shuffle('1234567890');
	$random2 = substr($string2,0,3);
	$contstr = "MYSER-FOOD";
	$order_id = $contstr.$random1.$random2;
	$service_tax = $_POST["service_tax"];
	$itemCount = count($_POST["product_id"]);
	//Saving user id and coupon id
	$user_id = $_SESSION['user_login_session_id'];
	$payment_status = 2; //In progress
	$country = 99;		
	$_SESSION['order_last_session_id'] = $order_id;
	$dev_type = $_POST["dev_type"];
	if($dev_type == 1) {
		$delivery_charges = '0';
	} else {
		$delivery_charges = $_POST["delivery_charge"];
	}

	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];

	for($i=0;$i<$itemCount;$i++) {
		//Generate sub randon id
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$date = date("ymdhis");
		$contstr = "MYSERVANT-GR";
		$sub_order_id = $contstr.$random1.$random2.$date;
		$orders = "INSERT INTO grocery_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `address`, `lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `lkp_pincode_id`, `lkp_location_id`, `order_note`, `category_id`, `sub_cat_id`, `product_id`, `item_weight_type_id`, `item_price`, `item_quantity`, `sub_total`, `order_total`, `coupen_code`, `coupen_code_type`, `discout_money`,  `payment_method`,`lkp_payment_status_id`,`delivery_type_id`,`service_tax`,`delivery_charges`, `order_id`,`order_sub_id`, `created_at`) VALUES ('$user_id','".$_POST["first_name"]."','".$_POST["last_name"]."', '".$_POST["email"]."','".$_POST["mobile"]."','".$_POST["address"]."','".$_POST["lkp_state_id"]."','".$_POST["lkp_district_id"]."','".$_POST["lkp_city_id"]."','".$_POST["lkp_pincode_id"]."','".$_POST["lkp_area_id"]."','".$_POST["order_note"]."','" . $_POST["category_id"][$i] . "','" . $_POST["sub_cat_id"][$i] . "','" . $_POST["product_id"][$i] . "','".$_POST['product_weight'][$i]."','" . $_POST["product_price"][$i] . "','" . $_POST["product_quantity"][$i] . "','".$_POST["sub_total"]."','".$_POST["order_total"]."',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','$dev_type','".$_POST["service_tax"]."','$delivery_charges', '$order_id','$sub_order_id','$order_date')";
		$groceryOrders = $conn->query($orders);
	} 
	if($groceryOrders == TRUE) {
		//cod 
		header("Location: ordersuccess.php?odi=".$order_id."&pay_stau=2");				
	} elseif ($payment_group == 2) {
		//online 
		header("Location: PayUMoney_form.php?odi=".$order_id."&pay_stau=2");
	} else {
		header("Location: ordersuccess.php?odi=".$order_id."&pay_stau=1");
	}			
}
?>