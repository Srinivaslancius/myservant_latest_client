<?php
include "../admin_includes/config.php";

if(isset($_POST['rest_name']) && isset($_POST['message_contact']) && isset($_POST['rating']) ) {

	//echo "<pre>"; print_r($_POST); die;

	$rating_number = $_POST['rating'];
	$user_id = $_POST['user_id'];
	$order_id = $_POST['order_id'];
	$message = $_POST['message_contact'];
	$restaurant_id = $_POST['restaurant_id'];
	$created = date("Y-m-d H:i:s");
	$query = "INSERT INTO food_order_rating (rating_number,user_id,order_id,message,restaurant_id,created) VALUES('$rating_number','$user_id','$order_id','$message','$restaurant_id','$created')";
    $insert = $conn->query($query);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>