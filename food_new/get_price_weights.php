<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if (isset($_POST['weight_type_inc_id']) && isset($_POST['product_id'])){
	$weightTypeIncrementId =$_POST['weight_type_inc_id']; 
	$productId =$_POST['product_id']; 
	$getAddData = "SELECT * FROM food_product_weight_prices WHERE weight_type_id = '$weightTypeIncrementId' AND product_id='$productId' ";
	$getSelData = $conn->query($getAddData);
	$getWeightPrices = $getSelData->fetch_assoc();
	echo $getWeightPrices['admin_price'] . ",". $getWeightPrices['weight_type_id'] . "," . $getWeightPrices['product_id'];
}



