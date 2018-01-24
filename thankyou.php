<?php ob_start(); ?>
<?php include_once 'meta.php';?>
	<body class="header_sticky">
	<div class="boxed">
		<div class="overlay"></div>
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

		<?php
		header( "refresh:10;url=index.php" );
		if($_SESSION['user_login_session_id'] == '') {
		    header ("Location: logout.php");
		} 
		?>
		<?php 
		$user_session_id = $_SESSION['user_login_session_id'];
		$order_session_id = $_SESSION['order_last_session_id'];
		$placedOrders = "SELECT * FROM grocery_orders WHERE user_id = '$user_session_id' AND order_id='$order_session_id' ";
		$placeOrder = $conn->query($placedOrders);
		?> 

		<?php
		$orderData =getAllDataWhere('grocery_orders','order_id',$order_session_id);
		$getAddOrder = $orderData->fetch_array();
		?>

		<section class="flat-error">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-2">
					</div><!-- /.col-md-2 -->
					<div class="col-md-8 col-sm-8">
						<div class="wrap-error center">
							<div class="header-error" style="margin-bottom:30px">
								
								<h1>Thank You for placing the order with my servant</h1>
								<p>We will send you the order details with delivery dates shortly!</p>
							</div><!-- /.header-error -->
							<table class="table" style="border: 1px solid #ddd;width:70%;margin-left:15%">
							<thead>
							  <tr style="background-color:#e5e5e5">
								<th style="text-align:center">PRODUCT</th>
								<th style="text-align:center">QUANTITY</th>
								<th style="text-align:center">PRICE</th>
							  </tr>
							</thead>
							<tbody>
							<?php while ($getPlaceOrders = $placeOrder->fetch_assoc()) { 
								$cartTotal += $getPlaceOrders['item_quantity']*$getPlaceOrders['item_price'];
								$getProductDetails= getIndividualDetails('grocery_product_name_bind_languages','product_id',$getPlaceOrders['product_id']);
								$delivery_charges = $getPlaceOrders['delivery_charges'];
								$service_tax = $getPlaceOrders['service_tax'];
								$order_total = $getPlaceOrders['order_total'];
							?>
							  <tr>
								<td><?php echo $getProductDetails['product_name']; ?></td>
								<td><?php echo $getPlaceOrders['item_quantity']; ?></td>
								<td>Rs : <?php echo $getPlaceOrders['item_price']; ?></td>
							  </tr>
							<?php } ?>
							  <tr>
								<td style="font-size:14px;color:#fe6003">Sub Total</td>
								<td></td>
								<td style="font-size:14px;color:#fe6003">Rs : <?php echo $cartTotal; ?>/-</td>
							  </tr>
							  <tr>
								<td style="font-size:14px;color:#fe6003">GST</td>
								<td></td>
								<td style="font-size:14px;color:#fe6003">Rs : <?php echo $service_tax; ?>/-</td>
							  </tr>
							  <tr>
								<td style="font-size:14px;color:#fe6003">Delivery Charges</td>
								<td></td>
								<td style="font-size:14px;color:#fe6003">Rs : <?php echo $delivery_charges; ?>/-</td>
							  </tr>
							  <tr style="background-color:black">
								<td style="font-size:14px;color:#fff">Total</td>
								<td></td>
								<td style="font-size:14px;color:#fff">Rs : <?php echo $order_total; ?>/-</td>
							  </tr>
							</tbody>
						  </table>
							
					</div><!-- /.col-md-8 -->
					<div class="col-md-2 col-sm-2">
					</div><!-- /.col-md-2 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-error -->

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

	</body>	
</html>