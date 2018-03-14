<?php 
ob_start();
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

if(isset($_POST["submit"]) && $_POST["submit"]!="") {
	
	//Save Order function here
	$coupon_code = $_POST["coupon_code"];
	$coupon_code_type = $_POST["coupon_code_type"];
	$discount_money = $_POST["discount_money"];
	$coupon_id = $_POST["coupon_id"];
	$coupon_device_type = $_POST["coupon_device_type"];
	//echo "<pre>"; print_r($_POST); die;
	$payment_group = $_POST["pay_mn"];
	$order_date = date("Y-m-d h:i:s");
	$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
	$random1 = substr($string1,0,3);
	$string2 = str_shuffle('1234567890');
	$random2 = substr($string2,0,3);
	$contstr = "MYSER-GR";
	$order_id = $contstr.$random1.$random2;
	$service_tax = $_POST["service_tax"];
	$itemCount = count($_POST["product_id"]);
	$reward_points = $_POST["reward_points"];
	$product_reward_points = $_POST["product_reward_points"];
	//Saving user id and coupon id
	$user_id = $_SESSION['user_login_session_id'];
	$payment_status = 2; //In progress
	$country = 99;		
	$_SESSION['order_last_session_id'] = $order_id;
	$_SESSION['payment_service_type'] = 3; //Groceries
	$delivery_charges = $_POST["delivery_charges"];
	$delivery_date = date("Y-m-d",strtotime($_POST["delivery_slot_date"]));
	$delivery_time = $_POST["delivery_time"];

	if($_POST['lkp_sub_area_id'] == 0) {
		$lkp_sub_area_id = '';
	} else {
		$lkp_sub_area_id = $_POST['lkp_sub_area_id'];
	}

	$order_total = $_POST['order_total'];
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    if($_POST['walletid'] == 1) {
	    $wallet_id = $_SESSION['wallet_id'];
	    if($_POST['wallet_amount'] > $_POST['orderTotalwithoutWallet']) {
	    	$wallet_amount = $_POST["orderTotalwithoutWallet"]-$_POST["discount_money"];
	    } else {
	    	$wallet_amount = $_POST['wallet_amount'];
	    }
	} else {
		$wallet_id = '';
	    $wallet_amount = '';
	}

	for($i=0;$i<$itemCount;$i++) {
		//Generate sub randon id
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$date = date("ymdhis");
		$contstr = "MYSERVANT-GR";
		$sub_order_id = $contstr.$random1.$random2.$date;
		$orders = "INSERT INTO grocery_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `address`, `lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `lkp_pincode_id`, `lkp_location_id`, `lkp_sub_location_id`, `order_note`, `category_id`, `sub_cat_id`, `product_id`, `item_weight_type_id`, `item_price`, `item_quantity`, `sub_total`, `order_total`, `coupen_code`, `coupen_code_type`, `discout_money`,  `payment_method`,`lkp_payment_status_id`,`service_tax`,`delivery_charges`,`delivery_slot_date`,`delivery_time`, `order_id`,`order_sub_id`,`wallet_id`,`wallet_amount`, `created_at`, `reward_points`, `product_reward_points`, `coupon_id`, `coupon_device_type`) VALUES ('$user_id','".$_POST["first_name"]."','".$_POST["last_name"]."', '".$_POST["email"]."','".$_POST["mobile"]."','".$_POST["address"]."','".$_POST["lkp_state_id"]."','".$_POST["lkp_district_id"]."','".$_POST["lkp_city_id"]."','".$_POST["lkp_pincode_id"]."','".$_POST["lkp_area_id"]."','$lkp_sub_area_id','".$_POST["order_note"]."','" . $_POST["category_id"][$i] . "','" . $_POST["sub_cat_id"][$i] . "','" . $_POST["product_id"][$i] . "','".$_POST['product_weight'][$i]."','" . $_POST["product_price"][$i] . "','" . $_POST["product_quantity"][$i] . "','".$_POST["sub_total"]."','".$_POST["order_total"]."',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','".$_POST["service_tax"]."','$delivery_charges','$delivery_date','$delivery_time', '$order_id','$sub_order_id','$wallet_id','$wallet_amount','$order_date','$reward_points','" . $_POST["product_reward_points"][$i] . "','$coupon_id','$coupon_device_type')"; 
		$groceryOrders = $conn->query($orders);
	} 
	if($payment_group == 1) {
		//cod 
		header("Location: ordersuccess.php?odi=".$order_id."&pay_stau=2");				
	} elseif ($payment_group == 2) {
		//online Payu money
		header("Location: PayUMoney_form.php?odi=".$order_id."&pay_stau=2");
	} elseif($payment_group == 3) {
		//online hdfc money
		header("Location: HDFC/hdfc_new_form.php");
	} elseif($payment_group == 4) {
		//online paytm money
		header("Location: PaytmKit/TxnTest.php?pay_key=".encryptPassword($order_total)."");
	} else {
		header("Location: ordersuccess.php?odi=".$order_id."&pay_stau=1");
	}			
} else {
	header("Location: failure.php");
}
?>