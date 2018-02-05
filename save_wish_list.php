<?php 
include "admin_includes/config.php";

if($_SESSION['user_login_session_id'] == "") {
 		$user_id = 0;
} else {
        $user_id = $_SESSION['user_login_session_id'];
}

if (isset($_POST['product_id']) && isset($_POST['productWeightType']) ){

	$product_id = $_POST['product_id'];	
	$productWeightType = $_POST['productWeightType'];	

	$getSql = "SELECT * FROM grocery_save_wishlist WHERE user_id='$user_id' AND product_id='$product_id' AND weight_type_id='$productWeightType' ";
	$getRemovePro = $conn->query($getSql);
	$getNoOfRows = $getRemovePro->num_rows;
	if($getNoOfRows > 0) {
		$delSql = "DELETE FROM grocery_save_wishlist WHERE user_id='$user_id' AND product_id='$product_id' AND weight_type_id='$productWeightType' ";
		$conn->query($delSql);
		//echo "Removed from your Wishlist";
		echo 0;
	} else {
		$sqlSavePro = "INSERT INTO `grocery_save_wishlist`(`user_id`, `product_id`, `weight_type_id`) VALUES ('$user_id','$product_id','$productWeightType')";	
		$conn->query($sqlSavePro);
		//echo "Added to your Wishlist";
		echo 1;
	}	

}