<?php 
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
//Cart id generating using sessions
if($_SESSION['CART_TEMP_RANDOM'] == "") {

	$_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
if($_SESSION['user_login_session_id'] == "") {

		$user_id = 0;
} else {
        $user_id = $_SESSION['user_login_session_id'];
}

$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
$category_id = $_POST['services_cat_id'];
$sub_cat_id = $_POST['services_sub_cat_id'];
$group_id = $_POST['services_group_id'];
$service_price = $_POST['service_price'];
$services_service_id = $_POST['services_service_id'];
$service_price_type_id = $_POST['service_price_type_id'];
$created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
$service_selected_time = date('H:i:s', strtotime($created_at));
$service_selected_date = date("Y-m-d h:i:s");

$checkCartItems = "SELECT * FROM services_cart WHERE group_id = '$group_id' AND service_id='$services_service_id' AND session_cart_id = '$session_cart_id'";
$getCartCount = $conn->query($checkCartItems);
$getTotalCount = $getCartCount->num_rows;
if($getTotalCount > 0) {
	echo $getTotalCount;
} else {
	$saveItems = "INSERT INTO `services_cart`(`user_id`, `session_cart_id`, `service_category_id`, `service_sub_category_id`, `group_id`, `service_id`, `services_price_type_id`, `service_price`,`service_selected_date`, `service_selected_time`, `created_at`) VALUES ('$user_id','$session_cart_id','$category_id','$sub_cat_id','$group_id','$services_service_id','$service_price_type_id','$service_price','$service_selected_date','$service_selected_time','$created_at')";
	$saveCart = $conn->query($saveItems);
	echo $getTotalCount;
} 

?>