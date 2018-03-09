<?php include_once 'meta.php';?>
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
								Grocery Orders
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
                      <h3 class="nomargin_top">Grocery Orders</h3>
                    </div>
                      <div class="panel-body">
                     <div class="table-responsive">	
					<?php $uid=$_SESSION['user_login_session_id'];
                    $getOrders = "SELECT * from grocery_orders WHERE user_id = '$uid' GROUP BY order_id ORDER BY id DESC"; 
                    $getOrders1 = $conn->query($getOrders);
                    if($getOrders1->num_rows > 0) { 
                    while($orderData = $getOrders1->fetch_assoc()) { ?>					 
        			<table class="table" style="border:1px solid #ddd;width:100%">
					
            		<thead>
            		  <tr>
					  
            			<th>Order PLACED</th>
            			<th>Order Price</th>
            			<th>SHIP TO</th>
            			<th>ORDER ID</th>
						<th>ACTION</th>
            		  </tr>
            		</thead>
            		<tbody>
            		  <tr>
					  
					  <td><?php echo changeDateFormat1($orderData['created_at']); ?>	</td>
            			<td>Rs.<?php echo $orderData['order_total']; ?></td>
            			<td><?php echo $orderData['first_name']; ?><br><?php echo $orderData['address']; ?></td>
            			<td><?php echo $orderData['order_id']; ?></td>
						<td><a href="order_details.php?order_id=<?php echo $orderData['order_id']; ?>"><button class="button1">View Details</button></a>
						<?php 
                        if($orderData['lkp_order_status_id'] != 3 && $orderData['lkp_order_status_id'] != 2) {
                        if($orderData['assign_delivery_id'] == '0' || $orderData['assign_delivery_id'] == '') { ?>
                        <a href="cancel_order.php?order_id=<?php echo $orderData['order_id']; ?>" onclick="return confirm('Are you sure you want to cancel?')"><button class="button1">Cancel Order</button></a>
                        <?php } } ?>
                        <?php if($orderData['lkp_order_status_id'] == 2 || $orderData['lkp_payment_status_id'] == 1) { ?>
                        <a href="reorder.php?order_id=<?php echo $orderData['order_id']; ?>"><button class="button1">Re Order</button></td>
                        <?php } ?>
            		  </tr>
            		  
            		</tbody>
					
        	     </table>
				  <?php } } else { ?>
                     <h3 style="text-align:center;color:#fe6003;">No Orders Found</h3>
                <?php } ?>
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