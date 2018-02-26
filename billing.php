<?php include_once 'meta.php';?>
<style>
.order-tracking{
	padding: 65px 50px 84px;
}
.order-tracking h1{
	margin-bottom:12px;
}
.order-tracking h3{
	line-height:30px;
}
.table th, td{
	border-bottom:1px solid #ddd;
}
td{
	text-align:left;
	
}
th{
	border-bottom:1px solid #ddd !important;
	font-size:15px !important;
}
td p{
	line-height:30px;
}
@media screen and (max-width: 480px) and (min-width: 320px){
.table{
	width:100%!important;
}
.order-tracking {
    padding: 65px 10px 84px;
}
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
								<a href="index.php" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">Billing</a>
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-tracking background">
			<div class="container">
				<div class="row">
				<div class="col-md-3 col-sm-3">
				</div>
					<div class="col-md-6 col-sm-6">
						<div class="order-tracking">
							<div class="title">
								<h3><img src="images/logos/logo1.png"></h3>
								<h1>Thanks for the purchase</h1>
								<h3>Your order has been placed successfully. Below are the details of your purchase.</h3>
							</div><!-- /.title -->
							<div class="tracking-content">
								<img src="images/icon-receipt.png">
								
								 <table class="table">
								<thead>
								  <tr>
									<th>Invoice #52342</th>
									<th></th>
									<th style="text-align:right">20th Aug 2017</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>Apple iPhone 6S	</td>
									<td style="text-align:center">1</td>
									<td style="text-align:right">₹ 699.00</td>
								  </tr>
								   <tr>
									<td>Apple iPhone 6S	</td>
									<td style="text-align:center">1</td>
									<td style="text-align:right">₹ 699.00</td>
								  </tr>
								   <tr>
									<td>Apple iPhone 6S	</td>
									<td style="text-align:center">1</td>
									<td style="text-align:right">₹ 699.00</td>
								  </tr>
								</tbody>
								<tbody>
								  <tr>
									<td><p>Subtotal</p>
									<p>Tax</p>
									<p>Shipping</p></td>
									<td style="text-align:center"><p>4</p>
									<p>10%</p>
									<p></p></td>
									<td style="text-align:right"><p>$ 735.96</p>
									<p>$ 73.60</p>
									<p>$ 9.99</p></td>
								  </tr>
								   <tr>
									<td style="border-bottom:0px"><h3><b>Total</b></h3></td>
									<td style="border-bottom:0px"></td>
									<td style="text-align:right;border-bottom:0px"><h3><b>$ 876.96</b></h3></td>
								  </tr>
								  
								</tbody>
							  </table>
							   <table class="table">
								<thead>
								  <tr>
									<th>Shipping Address</th>
									<th></th>
									<th style="text-align:right">Billing Address</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td><p>Tony Stark</p>
									<p>22 23rd Street</p>
									<p>San Francisco </p>
									<p>CA 94107</p></td>
									<td style="text-align:center"></td>
									<td style="text-align:right"><p>Tony Stark</p>
									<p>22 23rd Street</p>
									<p>San Francisco </p>
									<p>CA 94107</p></td>
								  </tr>
								  
								</tbody>
								
							  </table>
							  <button type="submit" class="contact" style="background-color:#fe6003">Back To Shop</button>
							</div><!-- /.tracking-content -->
						</div><!-- /.order-tracking -->
					</div><!-- /.col-md-12 -->
					<div class="col-md-3 col-sm-3">
				</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-tracking -->

		<section class="flat-row flat-iconbox style1 background">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Free Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/order.png" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/payment.png" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/return.png" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->
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