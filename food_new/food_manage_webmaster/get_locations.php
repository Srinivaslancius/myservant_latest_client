<?php
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
if(!empty($_POST["lkp_pincode_id"])) {
	$query ="SELECT * FROM lkp_locations WHERE lkp_status_id = 0 AND lkp_pincode_id = '" . $_POST["lkp_pincode_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select Location</option>
<?php
	foreach($results as $locations) {
?>
	<option value="<?php echo $locations["id"]; ?>"><?php echo $locations["location_name"]; ?></option>
<?php
	}
}
?>
