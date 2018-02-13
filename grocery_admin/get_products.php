<?php
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
if(!empty($_POST["sub_category_id"])) {
	$query ="SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '" . $_POST["sub_category_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">-- Select Product --</option>
<?php
	foreach($results as $products) {
		$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$products['id']);
?>
	<option value="<?php echo $products["id"]; ?>"><?php echo $getProductName["product_name"]; ?></option>
<?php
	}
}
?>
