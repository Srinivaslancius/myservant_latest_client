<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_login_session_id'];
if($_SESSION['CART_TEMP_RANDOM'] == "") {
    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
$groceryOrders1 = "SELECT * FROM grocery_orders WHERE  order_id = '$order_id' AND user_id = '$user_id' AND product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0)"; 
$groceryOrdersData1 = $conn->query($groceryOrders1);
while ($OrderDetails = $groceryOrdersData1->fetch_assoc()) {
	$category_id = $OrderDetails['category_id'];
	$sub_category_id = $OrderDetails['sub_cat_id'];
	$product_id = $OrderDetails['product_id'];
	$product_price = $OrderDetails['item_price'];
	$product_quantity = $OrderDetails['item_quantity'];
	$product_weight_type = $OrderDetails['item_weight_type_id'];
	$created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
	$city_id = 1;
	$device_id = 1;
	$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$OrderDetails['product_id']);
	$product_name = $getProductName['product_name'];

	$selCnt = "SELECT * FROM grocery_cart WHERE product_id='$product_id' AND product_weight_type = '$product_weight_type' AND session_cart_id='$session_cart_id' AND user_id = '$user_id' ";
	$getCountSel = $conn->query($selCnt);
	$getQun = $getCountSel->fetch_assoc();

	if($getCountSel->num_rows > 0) {
		$product_quantity = $getQun['product_quantity']+1;
		$saveItems = "UPDATE grocery_cart SET product_quantity='$product_quantity' WHERE product_id='$product_id' AND product_weight_type = '$product_weight_type' AND session_cart_id='$session_cart_id'";
	} else {
		$saveItems = "INSERT INTO `grocery_cart`(`user_id`, `session_cart_id`, `category_id`, `sub_category_id`, `product_id`, `product_name`, `product_price`, `product_weight_type`,`product_quantity`, `lkp_city_id`, `created_at`,`device_id`,`reward_points`) VALUES ('$user_id','$session_cart_id','$category_id','$sub_category_id','$product_id','$product_name','$product_price','$product_weight_type','$product_quantity','$city_id','$created_at','$device_id','')";
	}
	$saveCart = $conn->query($saveItems);
}
//echo $saveItems; die;
header("Location:shop_cart.php");
?>