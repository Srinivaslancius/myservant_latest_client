<?php
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
if(!empty($_POST["cat_id"])) {
	$query ="SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id = '" . $_POST["cat_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">-- Select Sub Category --</option>
<?php
	foreach($results as $subcategories) {
?>
	<option value="<?php echo $subcategories["id"]; ?>"><?php echo $subcategories["sub_category_name"]; ?></option>
<?php
	}
}
?>
