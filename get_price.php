<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

if (isset($_POST['product_id'])){
	$product_id = $_POST['product_id'];
$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE id ='$product_id' AND lkp_status_id = 0 AND lkp_city_id ='1' ";
$allGetPrices1 = $conn->query($getPrices1);
$getPrc1 = $allGetPrices1->fetch_assoc();
echo'<div class="sale">
			Rs. '.$getPrc1['selling_price'].' .00
			<input type="hidden" id="pro_price" value="'.$getPrc1['selling_price'].'">
			<input type="hidden" id="pro_weight_type_id" value="'.$getPrc1['id'].'">';
			if($getPrc1['offer_type'] == 1) {
				echo'<span style="text-decoration:line-through;font-size:16px;color:#838383;">(Rs.'.$getPrc1['mrp_price'].')</span>';
			}
		echo'</div>';
}