<?php
include_once('../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
if(!empty($_POST["lkp_area_id"])) {
	$query ="SELECT * FROM grocery_lkp_sub_areas WHERE lkp_status_id = 0 AND lkp_area_id = '" . $_POST["lkp_area_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select Sub Location</option>
<?php
	foreach($results as $sublocations) {
?>
	<option value="<?php echo $sublocations["id"]; ?>"><?php echo $sublocations["sub_area_name"]; ?></option>
<?php
	}
}
?>
