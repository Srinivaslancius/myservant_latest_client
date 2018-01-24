<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
if(!empty($_POST['coupon_code']) && !empty($_POST['cart_total']))  {
	//echo "<pre>"; print_r($_POST); die;
	$coupon_code = $_POST['coupon_code'];
	$cart_total = $_POST['cart_total'];
	$sql="SELECT * FROM food_coupons WHERE coupon_code='$coupon_code' AND lkp_status_id = 0";
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