<?php
include "../admin_includes/config.php";

if(isset($_POST['cartId']) && isset($_POST['productId']) && isset($_POST['cartSessionId']) ) {

    $cartId = $_POST['cartId'];
    $productId = $_POST['productId'];
    $cartSessionId = $_POST['cartSessionId'];
	$getAddons = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '$productId' AND cart_id='$cartId' AND session_cart_id = '$cartSessionId'";
	$getAddonData = $conn->query($getAddons);
	while($getadcartItems = $getAddonData->fetch_assoc() ) {
		 echo $getadcartItems['item_ingredient_name'] . ":". $getadcartItems['item_ingredient_price'];
	}
}
