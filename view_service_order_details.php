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
								<a href="service_orders.php" title="">Service Orders</a>
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
					<?php 
        $id = $_GET['id'];
		$getOrdersData1 = getIndividualDetails('services_orders','id',$id);
		$ordersCount1 = getAllDataWhere('services_orders','order_id',$getOrdersData1['order_id']);
		$ordersCount2 = $ordersCount1->num_rows;
		$getServiceNamesData = getIndividualDetails('services_group_service_names','id',$getOrdersData1['service_id']);
		$getPaymentMethodData = getIndividualDetails('lkp_payment_types','id',$getOrdersData1['payment_method']);
		$getOrderStataus = getIndividualDetails('lkp_order_status','id',$getOrdersData1['lkp_order_status_id']);
		$getSiteSettingsData = getIndividualDetails('services_site_settings','id',1);
		$getPincodes = getIndividualDetails('lkp_pincodes','id',$getOrdersData1['postal_code']);
		if($getOrdersData1['coupon_code'] == '') {
			$discount_money = 0;
		} else {
			$discount_money = $getOrdersData1['discount_money']/$ordersCount2;
		}
		if($getOrdersData1['service_price_type_id'] == 1) {
			$service_tax = 0;
		} else {
			$service_tax = $getOrdersData1['order_price']*$getOrdersData1['service_quantity']*$getSiteSettingsData['service_tax']/100;
		}
		$order_price = ($getOrdersData1['order_price']*$getOrdersData1['service_quantity'])+($service_tax-$discount_money);
		$sub_total = $getOrdersData1['order_price']*$getOrdersData1['service_quantity'];
		?>	 
        			<table class="table" style="border:1px solid #ddd;width:100%">
            		<tbody>
		  <tr>
			<td colspan="2" style="padding-left:20px">
			<h3>Order Information</h3><br>
			<p>Order Sub Id: <?php echo $getOrdersData1['order_sub_id'];?></p>
			<p>Order Date:: <?php echo $getOrdersData1['created_at'];?></p>
			<p>Payment method: <?php echo $getPaymentMethodData['status'];?></p>
			<p>Order Status: <?php echo $getOrderStataus['order_status'];?></p>
			<p>Note: <?php echo $getOrdersData1['service_provider_note'];?></p></td>
			<td colspan="2"></td>
			<td colspan="2">
			<h3>Shipping Address</h3><br>
			<p><?php echo $getOrdersData1['first_name'] ?></p>
			<p><?php echo $getOrdersData1['email'] ?></p>
			<p><?php echo $getOrdersData1['mobile'] ?></p>
			<p><?php echo $getOrdersData1['address'] ?></p>
			<p><?php echo $getPincodes['pincode'] ?></td>
		  </tr>
		  <tr>
			<td><h5>SERVICE NAME</h5></td>
			<td><h5>ORDER PRICE</h5></td>
			<td><h5>QUANTITY</h5></td>
			<td><h5>SELECTED DATE</h5></td>
			<td><h5>SELECTED TIME</h5></td>
			<td></td>
		  </tr>
		   <tr>
			<td><p><?php echo $getServiceNamesData['group_service_name'] ?></p></td>
			<td><p><?php echo $getOrdersData1['order_price'] ?></p></td>
			<td><p><?php echo $getOrdersData1['service_quantity'] ?></p></td>
			<td><p><?php echo $getOrdersData1['service_selected_date'] ?></p></td>
			<td><p><?php echo $getOrdersData1['service_selected_time'] ?></p></td>
			<td></td>
		  </tr>
		  <tr style="background-color:#f2f2f2">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><p>Subtotal:</p>
			<p>Tax:</p>
			<p style="color:#fe6003;">Grand Total:</p></td>
			<td><p style="color:#fe6003;">Rs. <?php echo $sub_total ?></p>
			<p style="color:#fe6003;">Rs. <?php echo $service_tax ?>(<?php echo $getSiteSettingsData['service_tax'] ?>%)</p>
			
				<p style="color:#fe6003;">Rs. <?php echo $order_price ?></p>
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