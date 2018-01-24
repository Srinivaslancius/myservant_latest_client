<?php
//ob_start();
require_once dirname( __FILE__ ) . '/payu.php';

function payment_success() {
	/* Payment success logic goes here. */
	//echo "Congratulations !! The Payment is successful.";		
	header("Location: ordersuccess.php?pay_stau=1");
}

function payment_failure() {
	/* Payment failure logic goes here. */
	//echo "We are sorry. The Payment has failed";
	header("Location: orderfailure.php");
}


/* Payments made easy. */

if ( count( $_POST ) ) 
	pay_page( array ('key' => '71tFEF', 'txnid' => $_POST['txnid'], 'amount' => $_POST['amount'],
			'firstname' => $_POST['firstname'], 'email' => $_POST['email'], 'phone' => $_POST['phone'],
			'productinfo' => $_POST['productinfo'], 'surl' => 'payment_success', 'furl' => 'payment_failure'), 
			'B0Gnqt1g' );

/* Merchant Page. ( All the html code ) */

else {

?>

	<form method='POST' name="hdfc_pay_form" style="display:none">		
		<input name='key' type='text' value='71tFEF'>
		<input name='txnid' type='text' value='<?php echo uniqid( "srinivas_" );?>'>						
		<input name='amount' type='text' value='1'>
		<input name='firstname' type='text' value='srinivas'>
		<input name='email' type='text' value='srinivas@lanciussolutions.com'>
		<input name='phone' type='text' value='1234567890'>
		<input name='productinfo' type='text' value='Just another test site'>			
		<input type="submit" value="Submit">
	</form>
	
<?php }

/* And we are done. */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" language="javascript">
document.hdfc_pay_form.submit();
$(function() {
$(".preload").fadeOut(2000, function() {
    $(".content").fadeIn(1000);        
	});
});
	
</script>
<div class="preload"><img src="http://i.imgur.com/KUJoe.gif">
</div>
<style type="text/css">
.content {display:none;}
.preload { width:100px;
    height: 100px;
    position: fixed;
    top: 50%;
    left: 50%;}

</style>