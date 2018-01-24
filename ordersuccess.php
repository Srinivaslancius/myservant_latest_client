<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
//Order id generating using sessions

if(isset($_SESSION['order_last_session_id']) && $_SESSION['order_last_session_id']!="") {
	$payment_status = $_GET['pay_stau']; //success
	$order_id = $_SESSION['order_last_session_id'];
	$user_id = $_SESSION['user_login_session_id'];
	$updateOrderStatus = "UPDATE grocery_orders SET lkp_payment_status_id = '$payment_status' WHERE user_id = '$user_id' AND order_id='$order_id' ";
	$conn->query($updateOrderStatus);

	$getWalletAmount = getIndividualDetails('grocery_orders','order_id',$_SESSION['order_last_session_id']);
	$getAmount = getIndividualDetails('user_wallet','wallet_id',$_SESSION['wallet_id']);
	if($getWalletAmount['wallet_amount'] != '') {
		if($getAmount['amount'] > $getWalletAmount['wallet_amount']) {
			$amount = $getAmount['amount'] - $getWalletAmount['wallet_amount'];
		} else {
			$amount = 0;
		}
		$updateWalletAmount = "UPDATE user_wallet SET amount = '$amount' WHERE user_id = '$user_id' ";
		$conn->query($updateWalletAmount);

		$description = "Money Debited for placing Order";
		$updated_date = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
		$insertTransaction = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `debit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('".$_SESSION['wallet_id']."','$user_id','".$getWalletAmount['wallet_amount']."','$description','$payment_status','$updated_date')";
		$conn->query($insertTransaction);
	}

	//after placing order that item will delete in cart
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
	
	$delCart ="DELETE FROM grocery_cart WHERE user_id = '$user_id' OR session_cart_id='$session_cart_id' ";
	$conn->query($delCart);

	header("Location: thankyou.php?odi=".$order_id."");
}
?>
