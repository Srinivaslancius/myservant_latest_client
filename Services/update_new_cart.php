<?php 
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
//if(isset($_POST["login_cart_id"]) && $_POST["login_cart_id"]!="") {

if(isset($_POST["submit"]) && $_POST["submit"]!="") {

	$cartCount = count($_POST["cart_inc_id"]);	
	for($i=0;$i<$cartCount;$i++) {

		//echo "<pre>"; print_r($_POST); die;
		$serviceDate=date_create($_POST["service_visit_date"][$i]);
		$getServiceDate=date_format($serviceDate,"Y-m-d");
		$service_quantity = $_POST["service_quantity"][$i];
		$service_selected_time = date('H:i:s', strtotime($_POST["service_visit_time"][$i]));

		$updateq = "UPDATE services_cart SET service_selected_date = '" . $getServiceDate . "',service_selected_time = '" . $service_selected_time . "', service_quantity ='" . $service_quantity."' WHERE id = '" . $_POST["cart_inc_id"][$i] . "'";
		$result = $conn->query($updateq);

		if(isset($_POST["login_cart_id"]) && $_POST["login_cart_id"]!="") {
			header('Location: login.php?cart_id='.$_POST["login_cart_id"].'');
		} else {

			$updateCart = "UPDATE `services_cart` SET user_id='".$_SESSION['user_login_session_id']."' WHERE session_cart_id = '".$_SESSION['CART_TEMP_RANDOM']."'";
			$updateCart1 = $conn->query($updateCart);
			header('Location: checkout.php');
		}

	}
}
//}
?>