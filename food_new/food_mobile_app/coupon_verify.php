<?php 
error_reporting(0);
include "../../admin_includes/config.php";
//Set Array for list
$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (!empty($_REQUEST['promoCode']) && !empty($_REQUEST['userId'])) {

		$promo_code= $_REQUEST['promoCode'];
		$user_id= $_REQUEST['userId'];

		$sqCheck = "SELECT * FROM food_orders WHERE coupen_code = '$promo_code' AND user_id = '$user_id' ";
		$checkPromo = $conn->query($sqCheck);
		$getCheckcpn = $checkPromo->num_rows;

		if($getCheckcpn == 0) {

			$sql="SELECT * FROM food_coupons WHERE coupon_code = '$promo_code' AND lkp_status_id = 0  ";
			$getCn = $conn->query($sql);
			$getCnt = $getCn->num_rows;
			$row = $getCn->fetch_assoc();
			if($getCnt > 0) {
				$response["price_type_id"] = $row['price_type_id'];
				$response["discount_price"] = $row['discount_price'];
				$response["success"] = 0;
				$response["message"] = "Success.";
			} else {
				$response["success"] = 1;
				$response["message"] = "Your Enterered Invalid Coupon!.";
			}

		} else {
			$response["success"] = 4;
			$response["message"] = "Already Your Used this Coupon!.";
		}
		

	} else {
		$response["success"] = 2;
		$response["message"] = "Required Fields Missings!";

	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";

}
echo json_encode($response);

?>