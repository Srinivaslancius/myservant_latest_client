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
								<a href="food_orders.php" title="">Food Orders</a>
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

$getOrders = "SELECT * FROM food_orders WHERE order_id='$order_id'";
$getOrdersData = $conn->query($getOrders);
$getOrdersData1 = $getOrdersData->fetch_assoc();

$getSiteSettingsData = getIndividualDetails('food_site_settings','id',1);

$getRestaurants = getIndividualDetails('food_vendors','id',$getOrdersData1['restaurant_id']);

$getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$getOrdersData1['payment_method']);

$orderStatus = getIndividualDetails('lkp_food_order_status','id',$getOrdersData1['lkp_order_status_id']);

$paymentStatus = getIndividualDetails('lkp_payment_status','id',$getOrdersData1['lkp_payment_status_id']);

$getAddOnsPrice = "SELECT * FROM food_order_ingredients WHERE order_id = '$order_id'";
$getAddontotal = $conn->query($getAddOnsPrice);
$getAddontotalCount = $getAddontotal->num_rows;
$getAdstotal = 0;
while($getAdTotal = $getAddontotal->fetch_assoc()) {
    $getAdstotal += $getAdTotal['item_ingredient_price'];
}

$service_tax = $getOrdersData1['sub_total']*$getSiteSettingsData['service_tax']/100;

if($getOrdersData1['delivery_charges'] == '0') {
	$order_type = "Take Away";
	$delivery_charges = 0;
} else {
	$order_type = "Delivery";
	$delivery_charges = $getOrdersData1['delivery_charges'];
}

 ?>	 
        			<table class="table" style="border:1px solid #ddd;width:100%">
            		<tbody>
		  <tr>
			<td colspan="2" style="padding-left:20px">
			<h3>Order Information</h3><br>
			<p>Restaurant Name: <?php echo $getRestaurants['restaurant_name']; ?></p>
			<p>Payment Method: <?php echo $getpaymentTypes['status']; ?></p>
			<p>Order Type: <?php echo $order_type; ?></p>
			<p>Order Status: <?php echo $orderStatus['order_status']; ?></p>
			<p>Payment Status: <?php echo $paymentStatus['payment_status']; ?></p></td>
			<td colspan="2"></td>
			<td colspan="2">
			<h3>Shipping Address</h3><br>
			<p><?php echo $getOrdersData1['first_name']; ?></p>
			<p><?php echo $getOrdersData1['email']; ?></p>
			<p><?php echo $getOrdersData1['mobile']; ?></p>
			<p><?php echo $getOrdersData1['address']; ?></p>
			<p><?php echo $getOrdersData1['postal_code']; ?></p></td>
			<td></td>
		  </tr>
		  <?php $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
		$getOrdersData3 = $conn->query($getOrders1); ?>
		  <tr>
			<td colspan="2">PRODUCT NAME</td>
	        <td colspan="2">CUSINE TYPE</td>
	        <td>ITEM WEIGHT</td>
	        <td>QUANTITY</td>
	        <td>PRICE</td>			
		  </tr>
		  <?php while($getOrdersData2 = $getOrdersData3->fetch_assoc()) { 
      	$getCategories = getIndividualDetails('food_category','id',$getOrdersData2['category_id']);
      	$getProducts = getIndividualDetails('food_products','id',$getOrdersData2['product_id']);
      	$getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
      ?>
		   <tr>
			<td  colspan="2"><p><?php echo $getProducts['product_name'] ?></p></td>
			<td  colspan="2"><?php echo  $getCategories['category_name']?></td>
	        <td><?php echo $getItemWeights['weight_type'] ?></td>
			<td><?php echo $getOrdersData2['item_quantity'] ?></td>
			<td><?php echo $getOrdersData2['item_price'] ?></td>
			
		  </tr>
		  <?php  } ?>
		    <tr style="background-color:#f2f2f2">
        <td colspan="5"></td>
		<td>
		<p>Subtotal:</p>
		<p>Tax:</p>
		<?php if($getOrdersData1['delivery_charges'] != '0') { ?>
		<p>Delivery Charges:</p>
		<?php } ?>
		<?php if($getAddontotalCount > 0) { ?>
		<p>Ingredients Price:</p>
		<?php } ?>
		<?php if($getOrdersData1['coupen_code'] != '') { ?>
		<p>Discount:</p>
		<?php } ?>
		<p style="color:#f26226">Grand Total:</p>
		</td>
		<td style="color:#f26226"><p>Rs. <?php echo $getOrdersData1['sub_total']?></p>
		<p>Rs. <?php echo $service_tax.'('.$getSiteSettingsData['service_tax'].'%)' ?></p>
		<?php if($getOrdersData1['delivery_charges'] != '0') { ?>
		<p>Rs. <?php echo $delivery_charges?></p>
		<?php } ?>
		<?php if($getAddontotalCount > 0) { ?>
		<p>Rs. <?php echo $getAdstotal?></p>
		<?php } ?>
		<?php if($getOrdersData1['coupen_code'] != '') { ?>
		<p>Rs. <?php echo $getOrdersData1['discout_money']?>(<span style="color:green">Coupon Applied.</span>)</p>
		<?php } ?>
		<p>Rs. <?php echo $getOrdersData1['order_total']?></p></td>
		
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

</body>	
</html>