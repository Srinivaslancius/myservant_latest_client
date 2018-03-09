<?php include_once 'meta.php';?>
	<style>
	.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom:0px;
	color:#fe6003;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
   border-top: 1px solid #ddd;
}
.table>tbody>tr>td h3,h5{
	color:#fe6003;
}
.table>tbody>tr>td p{
	line-height:30px;
}
	.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 2px 19px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
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
								<a href="index.php" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="grocery_orders.php" title="">Grocery Orders</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								Order_details
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

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
		                  	<h3 class="nomargin_top">Order Details</h3>
		                </div>
		              	<div class="panel-body">
		                 	<div class="table-responsive">	
							<?php $order_id = $_GET['order_id'];
							    $groceryOrders1 = "SELECT * FROM grocery_orders WHERE  order_id = '$order_id' "; 
							    $groceryOrdersData1 = $conn->query($groceryOrders1);
							    $i=1; 
							    $OrderDetails = $groceryOrdersData1->fetch_assoc();
							    $getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1);
							    $getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$OrderDetails['payment_method']);
							    $paymentStatus = getIndividualDetails('lkp_payment_status','id',$OrderDetails['lkp_payment_status_id']);
							    $orderStatus = getIndividualDetails('lkp_order_status','id',$OrderDetails['lkp_order_status_id']);
							    $service_tax = $OrderDetails['sub_total']*$getSiteSettingsData['service_tax']/100;
								if($OrderDetails['delivery_charges'] == '0') {
								  $delivery_charges = 0;
								} else {
								  $delivery_charges = $OrderDetails['delivery_charges'];
								}
		                    ?>
			        			<table class="table" style="border:1px solid #ddd;width:100%">
				            		<tbody>
									  <tr>
										<td colspan="2" style="padding-left:20px">
											<h3>Order Information</h3><br>
											<p>Order Id:<?php echo $OrderDetails['order_id']; ?></p>
											<p>Delivery Slot Date: <?php echo changeDateFormat($OrderDetails['delivery_slot_date']);?></p>
											<p>Delivery Slot Time: <?php echo $OrderDetails['delivery_time'];?></p>
											<p>Payment Method:<?php echo $getpaymentTypes['status']; ?></p>
											<p>Order Status: <?php echo $orderStatus['order_status']; ?></p>
											<p>Payment Status:  <?php echo $paymentStatus['payment_status']; ?></p>
										</td>
										<td colspan="2">
											<h3>Shipping Address</h3><br>
											<p><?php echo $OrderDetails['first_name']; ?></p>
										    <p><?php echo $OrderDetails['email']; ?></p>
										    <p><?php echo $OrderDetails['mobile']; ?></p>
										    <p><?php echo $OrderDetails['address']; ?></p>
										    <p><?php echo $OrderDetails['postal_code']; ?></p>
										</td>
									  </tr>
									  <tr>
										<td><h5>ITEM NAME</h5></td>
										<td><h5>CATEGORY</h5></td>
										<td><h5>QUANTITY</h5></td>
										<td><h5>PRICE</h5></td>
									  </tr>
									  <?php $getOrders1 = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
							    		$getOrdersData3 = $conn->query($getOrders1); ?>
								    	<?php while($getOrdersData2 = $getOrdersData3->fetch_assoc()) { 
								    	$getProducts = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getOrdersData2['product_id']);
								        $getCategories = getIndividualDetails('grocery_category','id',$getOrdersData2['category_id']);
								        $getProducts1 = getIndividualDetails('grocery_products','id',$getOrdersData2['product_id']);
								        $getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
								      	?>
									   <tr>
										<td><p><?php echo $getProducts['product_name'] ?></p></td>
										<td><p><?php echo  $getCategories['category_name']?></p></td>
										<td><p><?php echo $getOrdersData2['item_quantity'] ?></p></td>
										<td><p><?php echo $getOrdersData2['item_price'] ?></p></td>
									  </tr>
									  <?PHP } ?>
									  <tr style="background-color:#f2f2f2">
										<td colspan="2"></td>
										<td><p>Subtotal:</p>
										<p>Tax:</p>
										<p>Delivery Charges</p>
										<p style="color:#fe6003;">Grand Total:</p></td>
										<td><p style="color:#fe6003;">Rs. <?php echo $OrderDetails['sub_total'];  ?></p>
										<p style="color:#fe6003;">Rs. <?php echo $OrderDetails['service_tax'].'('.$getSiteSettingsData['service_tax'].'%)' ?></p>
										<p style="color:#fe6003;">Rs. <?php echo $OrderDetails['delivery_charges'];  ?></p>
										<p style="color:#fe6003;">Rs. <?php echo $OrderDetails['order_total'];  ?></p></td>
									  </tr>
									</tbody>
			        			</table>
		        	  		</div>
		              	</div>
		          	</div>
		        </div><!-- End panel-group -->
		    </div><!-- End col-md-9 -->
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
<?php include "search_js_script.php"; ?>
</body>	
</html>