<?php include_once 'meta.php';?>
	<style>
	.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 2px 11px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {
	background-color:#fe6003;
 padding: 5px 12px;
} 

	</style>

	

<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div><!-- /.preloader -->
		<section id="header" class="header">
			<div class="header-top">
			<?php include_once 'top_header.php';?>
			</div><!-- /.header-top -->
			<div class="header-middle">
			<?php include_once 'middle_header.php';?>
			</div><!-- /.header-middle -->
			<div class="header-bottom">
			<?php include_once 'bottom_header.php';?>
			</div><!-- /.header-bottom -->
		</section><!-- /#header -->
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								My Wallet
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<?php if($_SESSION['user_login_session_id'] == '') {
			header ("Location: logout.php");
		}
		?>
		<section class="flat-term-conditions">
			<div class="container">
				<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
     </div><!-- End col-md-3 -->
        
        <div class="col-sm-9">       	 
         
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">My Wallet</h3>
                    </div>
                      <div class="panel-body">
                     <div class="table-responsive">				 
        			<table class="table" style="border:1px solid #ddd;width:100%">
            		<thead>
            		  <tr>
            			<th></th>
            			<th></th>
            			<th></th>
            			<th></th>
						<th></th>
            		  </tr>
            		</thead>
            		<?php 

					if(isset($_POST["submit"]) && $_POST["submit"]!="") {

						//echo "<pre>"; print_r($_POST); die;

						$user_id = $_SESSION['user_login_session_id'];
						$wallet_id = $_SESSION['wallet_id'];
						$credit_amnt = $_POST['amnt'];						
						$description = "Money Added in Wallet";
						$updated_date = date('Y-m-d H:i:s');

            			$sqlInwallet = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `credit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('$wallet_id','$user_id','$credit_amnt','$description','2','$updated_date')";
            			if($conn->query($sqlInwallet) === TRUE) {
            				$last_id = $conn->insert_id;
            				$_SESSION['last_id'] = $last_id;
            				// header("Location: PayUMoney_form_wallet.php?key=".$last_id."");
            				header("Location: PaytmKit_wallet/TxnTest.php?pay_key=".encryptPassword($credit_amnt)."");
            			}
            		}
            		$user_id = $_SESSION['user_login_session_id'];
					$wallet_id = $_SESSION['wallet_id'];
            		$getwalletAmount = "SELECT * FROM user_wallet WHERE user_id = '$user_id' AND wallet_id = '$wallet_id'";
            		$getwalletAmount1 = $conn->query($getwalletAmount);
            		$getwalletAmountDetails = $getwalletAmount1->fetch_assoc();
            		if($getwalletAmountDetails['amount'] == '') {
            			$amount = 0;
            		} else {
            			$amount = $getwalletAmountDetails['amount'];
            		}
            		?> 
            		<form method="post" autocomplete="off">       		
            		<tbody>
            		  <tr>
            			<td><img src="images/dashboard/wallet.png"></td>
            			<td><b>Rs : <?php echo $amount; ?>/-</b><br>Your Wallet Balance</td>
            			<td colspan="2"><input type="text" class="valid_mobile_num wallet_amount" name="amnt" placeholder="Enter amount to be added in your wallet" onblur="minAmount()" required></td>						
						<td><button class="button1" type="submit" name="submit" value="submit">Add Money to Wallet</button></td>
            		  </tr>            		  
            		</tbody>
            		</form>
					
        	     </table>
				  </div>
				  </div>
				   <div class="panel-body">
		<section class="flat-imagebox style2 background">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="product-wrap">
							<div class="product-tab style1">
								<ul class="tab-list">
									<li class="active">Credit Transcations</li>
									<li>Debit Transcations</li>
									<li>Failed Transcations</li>
								</ul><!-- /.tab-list -->
							</div><!-- /.product-tab style1 -->
							<?php 
		            		$uid = $_SESSION["user_login_session_id"];
		            		$UpdateWallet = "SELECT * FROM user_wallet_transactions WHERE lkp_payment_status_id = 1 AND user_id='$uid' AND credit_amnt!=0";
		            		$UpDateWallet1 = $conn->query($UpdateWallet);
		            		?>
							<div class="tab-item">
								<div class="row">
									<div class="col-md-12">
										<?php if($UpDateWallet1->num_rows > 0) { ?>
									 	<div class="table-responsive">	
											<table class="table" style="border:1px solid #ddd;width:95%;margin-left:20px">
							            		<thead>
							            		  <tr>
							            			<th>MERCHANT NAME</th>
							            			<th>CREDIT AMOUNT</th>
							            			<th>STATUS</th>
													<th>COMMENT</th>
													<th>DATE</th>
							            		  </tr>
							            		</thead>
							            		<tbody>
							            		<?php 
							            		while($UpDateWallet2 = $UpDateWallet1->fetch_assoc()) {
							            		$getUserDetails = getIndividualDetails('users','id',$UpDateWallet2['user_id']);
							            		$PaymentStatus = getIndividualDetails('lkp_payment_status','id',$UpDateWallet2['lkp_payment_status_id']);
							            		?>
							            		  <tr style="border-bottom:1px solid #ddd">
							            			<td><b><?php echo $getUserDetails['user_full_name']; ?></b></td>
							            			<td>Rs. <?php echo $UpDateWallet2['credit_amnt']; ?> </td>
													<td><?php echo $PaymentStatus['payment_status']; ?></td>
													<td><?php echo $UpDateWallet2['description']; ?></td>
													<td><?php echo changeDateFormat1($UpDateWallet2['updated_date']); ?></td>
							            		  </tr>
											       <?php } ?>
												  <!--<tr>
							            			<td><b>Cashback Received</b><br>paytm for Order #CASH-676607643 Paytm Cash Txn ID 17376641204 2018-01-09 09:39:13 PM</td>
							            			<td></td>
							            			<td>Rs : 5/-</td>
													<td>SUCCESS</td>
													<td>Order #4419408824 of Reacharge of Airtel Mobile 730214...(Promocode:GETS)</td>
							            		  </tr>-->
							            		</tbody>
							        	    </table>
										</div><!-- /.col-md-6 -->
										<?php } else { ?>
					            		  <h3 style="text-align:center">No Transactions Found.</h3>
								       	<?php }?>
									</div><!-- /.row -->
								</div>
								<?php 
			            		$uid = $_SESSION["user_login_session_id"];
			            		$UpdateWallets = "SELECT * FROM user_wallet_transactions WHERE lkp_payment_status_id = 1 AND user_id='$uid' AND debit_amnt!=0";
			            		$UpDateWallets1 = $conn->query($UpdateWallets);
			            		?>
								<div class="row">
									<div class="col-md-12">
										<?php if($UpDateWallets1->num_rows > 0) {  ?>
										 <div class="table-responsive">
											<table class="table" style="border:1px solid #ddd;width:95%;margin-left:20px">
							            		<thead>
							            		  <tr>
							            			<th>MERCHANT NAME</th>
							            			<th>DEBIT AMOUNT</th>
							            			<th>STATUS</th>
													<th>COMMENT</th>
													<th>DATE</th>
							            		  </tr>
							            		</thead>
							            		<tbody>
							            		<?php 
							            		while($UpDateWallets2 = $UpDateWallets1->fetch_assoc()) {
							            		$getUserDetails1 = getIndividualDetails('users','id',$UpDateWallets2['user_id']);
							            		$PaymentStatus1 = getIndividualDetails('lkp_payment_status','id',$UpDateWallets2['lkp_payment_status_id']);
							            		?>
							            		  <tr style="border-bottom:1px solid #ddd">
							            			<td><b><?php echo $getUserDetails1['user_full_name']; ?></b></td>
							            			<td>Rs. <?php echo $UpDateWallets2['debit_amnt']; ?> </td>
													<td><?php echo $PaymentStatus1['payment_status']; ?></td>
													<td><?php echo $UpDateWallets2['description']; ?></td>
													<td><?php echo changeDateFormat1($UpDateWallets2['updated_date']); ?></td>
							            		  </tr>
											       <?php }?>
												  <!--<tr>
							            			<td><b>Cashback Received</b><br>paytm for Order #CASH-676607643 Paytm Cash Txn ID 17376641204 2018-01-09 09:39:13 PM</td>
							            			<td></td>
							            			<td>Rs : 5/-</td>
													<td>SUCCESS</td>
													<td>Order #4419408824 of Reacharge of Airtel Mobile 730214...(Promocode:GETS)</td>
							            		  </tr>-->
							            		</tbody>
        	     							</table>
										</div><!-- /.col-md-6 -->
										<?php } else { ?>
					            		  <h3 style="text-align:center">No Transactions Found.</h3>
								       	<?php }?>
									</div><!-- /.row -->
								</div><!-- /.tab-item -->
								<?php 
			            		$uid = $_SESSION["user_login_session_id"];
			            		$UpdateWallets = "SELECT * FROM user_wallet_transactions WHERE lkp_payment_status_id != 1 AND user_id='$uid'";
			            		$UpDateWallets1 = $conn->query($UpdateWallets);
			            		?>
								<div class="row">
									<div class="col-md-12">
										<?php if($UpDateWallets1->num_rows > 0) {
										?>
										 <div class="table-responsive">
											<table class="table" style="border:1px solid #ddd;width:95%;margin-left:20px">
							            		<thead>
							            		  <tr>
							            			<th>MERCHANT NAME</th>
							            			<th>AMOUNT</th>
							            			<th>STATUS</th>
													<th>COMMENT</th>
													<th>DATE</th>
							            		  </tr>
							            		</thead>
							            		<tbody>
							            		<?php 
							            		while($UpDateWallets2 = $UpDateWallets1->fetch_assoc()) {
							            		if($UpDateWallets2['credit_amnt'] != '0' && $UpDateWallets2['credit_amnt'] != '0') {
													$amount = $UpDateWallets2['credit_amnt'];
												} elseif($UpDateWallets2['debit_amnt'] != '0' && $UpDateWallets2['debit_amnt'] != '0') {
													$amount = $UpDateWallets2['debit_amnt'];
												}
							            		$getUserDetails1 = getIndividualDetails('users','id',$UpDateWallets2['user_id']);
							            		$PaymentStatus1 = getIndividualDetails('lkp_payment_status','id',$UpDateWallets2['lkp_payment_status_id']);
							            		?>
							            		  <tr style="border-bottom:1px solid #ddd">
							            			<td><b><?php echo $getUserDetails1['user_full_name']; ?></b></td>
							            			<td>Rs. <?php echo $amount; ?> </td>
													<td><?php echo $PaymentStatus1['payment_status']; ?></td>
													<td><?php echo $UpDateWallets2['description']; ?></td>
													<td><?php echo changeDateFormat1($UpDateWallets2['updated_date']); ?></td>
							            		  </tr>
											       <?php }?>
												  <!--<tr>
							            			<td><b>Cashback Received</b><br>paytm for Order #CASH-676607643 Paytm Cash Txn ID 17376641204 2018-01-09 09:39:13 PM</td>
							            			<td></td>
							            			<td>Rs : 5/-</td>
													<td>SUCCESS</td>
													<td>Order #4419408824 of Reacharge of Airtel Mobile 730214...(Promocode:GETS)</td>
							            		  </tr>-->
							            		</tbody>
        	     							</table>
										</div><!-- /.col-md-6 -->
										<?php } else { ?>
					            		  <h3 style="text-align:center">No Transactions Found.</h3>
								       	<?php }?>
									</div><!-- /.row -->
								</div><!-- /.tab-item -->
							</div><!-- /.product-wrap -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div>
		</section><!-- /.flat-imagebox style2 -->
        	  </div>
                      </div>
                  </div>
                
                </div>
    </div><!-- End row -->
			</div><!-- /.container -->
		</section><!-- /.flat-term-conditions -->
<footer>
			<?php include_once 'footer.php';?>
		</footer><!-- /footer -->

		<section class="footer-bottom">
			<?php include_once 'footer_bottom.php';?>
		</section><!-- /.footer-bottom -->
	</div><!-- /.boxed -->

		<!-- Javascript -->
		<script type="text/javascript" src="javascript/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/tether.min.js"></script>
		<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
		<script type="text/javascript" src="javascript/waypoints.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.circlechart.js"></script>
		<script type="text/javascript" src="javascript/easing.js"></script>
		<script type="text/javascript" src="javascript/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="javascript/owl.carousel.js"></script>
		<script type="text/javascript" src="javascript/smoothscroll.js"></script>
		<script type="text/javascript" src="javascript/jquery-ui.js"></script>
		<script type="text/javascript" src="javascript/jquery.mCustomScrollbar.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="javascript/waves.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.countdown.js"></script>
		<script type="text/javascript" src="javascript/main.js"></script>
		<script type="text/javascript">
			function minAmount() {
				if($(".wallet_amount").val() < 100) {
					//alert("Minimum Rs. 100 need to add in Wallet");
					$(".wallet_amount").val('');
				}
			}
		</script>
		<?php include "search_js_script.php"; ?>
</body>	
</html>