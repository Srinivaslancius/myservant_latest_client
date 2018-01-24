<?php
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
if(!empty($_POST["services_sub_category_id"])) {
	$query ="SELECT * FROM services_groups WHERE lkp_status_id = 0 AND services_sub_category_id = '" . $_POST["services_sub_category_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select Group</option>
<?php
	foreach($results as $groups) {
?>
	<option value="<?php echo $groups["id"]; ?>"><?php echo $groups["group_name"]; ?></option>
<?php
	}
}
?>
