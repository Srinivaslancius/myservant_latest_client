<?php
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
if(!empty($_POST["services_category_id"])) {
	$query ="SELECT * FROM services_sub_category WHERE lkp_status_id = 0 AND services_category_id = '" . $_POST["services_category_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select Sub Category</option>
<?php
	foreach($results as $sub_category) {
?>
	<option value="<?php echo $sub_category["id"]; ?>"><?php echo $sub_category["sub_category_name"]; ?></option>
<?php
	}
}
?>
