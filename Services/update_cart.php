<?php 
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if(isset($_POST["cartId"]) && $_POST["cartId"]!="") {
	
		$serviceDate=date_create($_POST["filed_value"]);
		$getServiceDate=date_format($serviceDate,"Y-m-d");
		$service_quantity = $_POST["service_quantity"];
		$service_selected_time = date('H:i:s', strtotime($_POST["service_visit_time"]));

		if($_POST['field_clause'] == 'date') {
			$fieldname = "service_selected_date = '" . $getServiceDate . "'";
		} elseif($_POST['field_clause'] == 'time') {
			$fieldname = "service_selected_time = '" . $service_selected_time . "'";
		} elseif($_POST['field_clause'] == 'quantity') {
			$fieldname = "service_quantity = '" . $service_quantity . "'";
		}

		$updateq = "UPDATE services_cart SET  ".$fieldname." WHERE id = '" . $_POST["cartId"] . "'";
		$result = $conn->query($updateq);	
}

?>