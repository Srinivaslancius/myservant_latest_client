<?php 
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_login_session_id'];
if($_SESSION['CART_TEMP_RANDOM'] == "") {
    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
$groceryOrders1 = "SELECT * FROM food_orders WHERE  order_id = '$order_id' AND user_id = '$user_id' "; 
$groceryOrdersData1 = $conn->query($groceryOrders1);
while ($OrderDetails = $groceryOrdersData1->fetch_assoc()) {
	$ProductId = $OrderDetails['product_id'];
    $ProductWeighType = $OrderDetails['item_weight_type_id'];
    $restId = $OrderDetails['restaurant_id'];
    $itemPrevQuantity = $OrderDetails['item_quantity'];
    $ProductCategoryId = $OrderDetails['category_id'];
    $created_at = date('Y-m-d H:i:s');
    $getFirstPrice1 = "SELECT * FROM food_product_weight_prices WHERE product_id = '$ProductId' AND  weight_type_id='$ProductWeighType' ";
    $getFirstPrice =  $conn->query($getFirstPrice1);
    $getPrice = $getFirstPrice->fetch_assoc();
    $ProductPrice = round($getPrice['admin_price']);

	$selCnt = "SELECT * FROM food_cart WHERE food_item_id = '$ProductId' AND item_price='$ProductPrice' AND item_weight_type_id='$ProductWeighType' AND session_cart_id = '$session_cart_id' AND restaurant_id ='$restId' AND user_id = '$user_id'";
	$getCountSel = $conn->query($selCnt);
	$getQun = $getCountSel->fetch_assoc();
	if($getCountSel->num_rows > 0) {
		$item_quantity = $getQun['item_quantity']+1;
		$saveItems = "UPDATE food_cart SET item_quantity = '$item_quantity' WHERE food_item_id = '$ProductId' AND item_price='$ProductPrice' AND item_weight_type_id='$ProductWeighType' AND session_cart_id = '$session_cart_id' AND user_id = '$user_id'";
	} else {
		$saveItems = "INSERT INTO `food_cart`(`session_cart_id`,`user_id`, `food_item_id`, `item_price`, `item_quantity`, `item_weight_type_id`, `restaurant_id`, `food_category_id`, `created_at`) VALUES ('$session_cart_id','$user_id','$ProductId','$ProductPrice','$itemPrevQuantity', '$ProductWeighType', '$restId', '$ProductCategoryId', '$created_at')";
	}
	$saveCart = $conn->query($saveItems);
}
//echo $saveItems; die;
header("Location:cart.php");
?>