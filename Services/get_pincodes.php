<?php
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
if(!empty($_POST["lkp_city_id"])) {
	$getPincodes = getAllDataWhere('availability_of_locations','lkp_status_id',0);
	while($getPincodes1 = $getPincodes->fetch_assoc()) {
		$pincodeDetails .= $getPincodes1['pincodes'].',';
	}
	$pincodeDetails1 = rtrim(wordwrap($pincodeDetails,40,"<br />\n"),",");
	$query ="SELECT * FROM lkp_pincodes WHERE lkp_status_id = 0 AND lkp_city_id = '" . $_POST["lkp_city_id"] . "' AND id IN ($pincodeDetails1)";
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
