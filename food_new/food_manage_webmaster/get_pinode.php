<?php
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
if(!empty($_POST["id"])) {
	$query ="SELECT * FROM food_lkp_locations WHERE lkp_status_id = 0 AND id = '" . $_POST["id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select Pincode</option>
<?php
	foreach($results as $pincode) {
?>
	<option value="<?php echo $pincode["id"]; ?>"><?php echo $pincode["location_pincode"]; ?></option>
<?php
	}
}
?>
