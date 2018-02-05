<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
if(!empty($_POST['coupon_code']) && !empty($_POST['cart_total']))  {
	//echo "<pre>"; print_r($_POST); die;
	$coupon_code = $_POST['coupon_code'];
	$cart_total = $_POST['cart_total'];
	$getCouponType = getIndividualDetails('grocery_coupons','coupon_code',$coupon_code);
	if($getCouponType['coupon_type'] == 1) {
		$sql="SELECT * FROM grocery_coupons WHERE coupon_code='$coupon_code' AND (now() BETWEEN coupon_start_date AND coupon_end_date) AND lkp_status_id = 0 AND category_id IN (SELECT category_id FROM grocery_cart WHERE user_id = '".$_SESSION['user_login_session_id']."') AND coupon_code NOT IN (SELECT coupen_code FROM grocery_orders WHERE user_id = '".$_SESSION['user_login_session_id']."')";
	} elseif($getCouponType['coupon_type'] == 2) {
		$sql="SELECT * FROM grocery_coupons WHERE coupon_code='$coupon_code' AND (now() BETWEEN coupon_start_date AND coupon_end_date) AND lkp_status_id = 0 AND sub_category_id IN (SELECT sub_category_id FROM grocery_cart WHERE user_id = '".$_SESSION['user_login_session_id']."') AND coupon_code NOT IN (SELECT coupen_code FROM grocery_orders WHERE user_id = '".$_SESSION['user_login_session_id']."')";
	} elseif($getCouponType['coupon_type'] == 3) {
		$sql="SELECT * FROM grocery_coupons WHERE coupon_code='$coupon_code' AND (now() BETWEEN coupon_start_date AND coupon_end_date) AND lkp_status_id = 0 AND coupon_code NOT IN (SELECT coupen_code FROM grocery_orders WHERE user_id = '".$_SESSION['user_login_session_id']."')";
	}
	$getCouponPrice = $conn->query($sql);
	$getCouponPriceData = $getCouponPrice->fetch_assoc();
	
	if($getCouponPrice->num_rows > 0) {
		if($getCouponPriceData['price_type_id'] == 1) {
			$discount_price = $getCouponPriceData['discount_price'] * 1;
			if($discount_price >= $cart_total) {
				echo 1;
			} else{
				$cartTotal = ($cart_total - $discount_price);
				echo $cartTotal.",".-$discount_price.",".$discount_price.",".$getCouponPriceData['price_type_id'];
			}
		} else {
			$discount_price = ($cart_total/100) * $getCouponPriceData['discount_price'];
			if($discount_price >= $cart_total) {
				echo 1;
			} else{
				$cartTotal = ($cart_total - $discount_price);
				echo $cartTotal.",".-$discount_price.",".$discount_price.",".$getCouponPriceData['price_type_id'];
			}
		}
		
	} else {
		echo 0;
	}
}
?>