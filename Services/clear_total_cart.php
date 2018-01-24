<?php
ob_start();
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

$user_id = $_SESSION['user_login_session_id'];
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];

$qry = "DELETE FROM services_cart WHERE session_cart_id ='$session_cart_id' OR user_id = '$user_id' ";
$result = $conn->query($qry);
header("Location: cart.php");
?>