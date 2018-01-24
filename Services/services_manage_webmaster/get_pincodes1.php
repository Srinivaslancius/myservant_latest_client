<?php
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
if(!empty($_POST["lkp_city_id"])) {
	$query ="SELECT * FROM lkp_pincodes WHERE lkp_status_id = 0 AND lkp_city_id = '" . $_POST["lkp_city_id"] . "'";
	$results = $conn->query($query);
?>
<h4>Pincodes</h4>
<?php
	foreach($results as $pincodes) {
	$id = $pincodes['id'];
echo "<input type='checkbox' name='lkp_pincode_id[]' value='$id' required>". $pincodes["pincode"]."&nbsp;";
	}
}
?>
