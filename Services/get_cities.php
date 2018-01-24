<?php
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
if(!empty($_POST["lkp_country_id"])) {
	$query ="SELECT * FROM lkp_cities WHERE lkp_status_id = 0 AND lkp_country_id = '" . $_POST["lkp_country_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select City</option>
<?php
	foreach($results as $cities) {
?>
	<option value="<?php echo $cities["id"]; ?>"><?php echo $cities["city_name"]; ?></option>
<?php
	}
}
?>
