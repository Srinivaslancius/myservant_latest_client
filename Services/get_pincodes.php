<?php
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
if(!empty($_POST["lkp_city_id"])) {
	$query ="SELECT * FROM lkp_pincodes WHERE lkp_status_id = 0 AND lkp_city_id = '" . $_POST["lkp_city_id"] . "' AND id IN (SELECT pincodes FROM availability_of_locations WHERE lkp_status_id = 0)";
	$results = $conn->query($query);
?>
	<option value="">Select Pincode</option>
<?php
	foreach($results as $pincodes) {
?>
	<option value="<?php echo $pincodes["id"]; ?>"><?php echo $pincodes["pincode"]; ?></option>
<?php
	}
}
?>
