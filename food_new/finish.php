<?php ob_start(); ?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- Radio and check inputs -->
    <link href="css/skins/square/grey.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	<div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    <!-- Header ================================================== -->
    <header>
        <?php include_once './header.php';?>
    </header>
    <!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
    	 <h1>Confirmed</h1>
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#0">Home</a></li>
                <li><a href="#0">Place Order</a></li>
                <li>Thank You</li>
            </ul>
            
        </div>
    </div><!-- Position -->
<?php
header( "refresh:10;url=index.php" );
if($_SESSION['user_login_session_id'] == '') {
    header ("Location: logout.php");
} 
?>
<?php 
$user_session_id = $_SESSION['user_login_session_id'];
$order_session_id = $_SESSION['order_last_session_id'];
$placedOrders = "SELECT * FROM food_orders WHERE user_id = '$user_session_id' AND order_id='$order_session_id' ";
$placeOrder = $conn->query($placedOrders);
?> 

<?php
$orderData =getAllDataWhere('food_orders','order_id',$order_session_id);
$getAddOrder = $orderData->fetch_array();
?>
<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<div class="box_style_2">
				<h2 class="inner">Order confirmed!</h2>
				<div id="confirm">
					<i class="icon_check_alt2"></i>
					<h3>Thank you!</h3>
					<p style="text-align:center">Your Order No is: <strong><?php echo $order_session_id; ?></strong></p>
					<p style="text-align:center">You will be redirected to the Home in 10 seconds.</p>  
					<p>
                        <b>Delivery Address: </b> <?php echo $getAddOrder['address']; ?>
					</p>
				</div>
				<h4>Summary</h4>
				<table class="table table-striped nomargin">
				<tbody>
				<?php $cartTotal = 0; $service_tax = 0; $discountMoney = 0;
					while ($getPlaceOrders = $placeOrder->fetch_assoc()) { 
						$restaurant_id = $getPlaceOrders['restaurant_id'];				
					if($getPlaceOrders['discout_money']!=0) { $discountMoney = $getPlaceOrders['discout_money']; } ?>
				<?php $getProductDetails= getIndividualDetails('food_products','id',$getPlaceOrders['product_id']); ?>
				<tr>
					<td>
						<strong> <?php echo $getPlaceOrders['item_quantity']; ?> x </strong> <?php echo $getProductDetails['product_name']; ?>
					</td>
					<td>
						<strong>Rs. <?php echo $getPlaceOrders['item_price']; ?></strong>
					</td>
					<td>
						<strong class="pull-right">Rs. <?php echo $getPlaceOrders['item_price']*$getPlaceOrders['item_quantity']; ?></strong>
						<?php  $cartTotal += $getPlaceOrders['item_price']*$getPlaceOrders['item_quantity']; ?>
					</td>
				</tr>
				<?php } ?>
				
				
				</tbody>
				</table>
				<hr>
					<table class="table table_summary">
					<tbody>
					<tr>
						<td>
							 Subtotal <span class="pull-right">Rs.<?php echo $cartTotal; ?></span>
						</td>
					</tr>
					<?php
		            $getAddOnsPrice = "SELECT * FROM food_order_ingredients WHERE order_id = '$order_session_id'";
		            $getAddontotal = $conn->query($getAddOnsPrice);
		            $getAdstotal = 0;
		            while($getAdTotal = $getAddontotal->fetch_assoc()) {
		                $getAdstotal += $getAdTotal['item_ingredient_price'];
		              }
					$getDeliveryCharge = getIndividualDetails('food_orders','order_id',$order_session_id);	
					$delCharge = 0;				
					if($getDeliveryCharge['delivery_charges']!=0) { $delCharge = $getDeliveryCharge['delivery_charges']; ?>
					<tr>
						<td>
							 Delivery fee <span class="pull-right">Rs.<?php echo $delCharge; ?></span>
						</td>
					</tr>
					<?php }  ?>
					<?php $service_tax += ($getFoodSiteSettingsData['service_tax']/100)*$cartTotal; ?>
                    <tr>
						<td>
							 Service Tax <span class="pull-right">Rs.<?php echo $service_tax; ?>(<?php echo $getFoodSiteSettingsData['service_tax'] ; ?>%)</span>
						</td>
					</tr>
					<?php if($getAdstotal!=0) { ?>
		            <tr>
		                <td>Extra Add On's Price <span class="pull-right">Rs. <?php echo $getAdstotal; ?></span></td>
		            </tr>
					<?php } ?>
					<?php 			
					if($discountMoney!=0) { ?>
		            <tr>
		                <td>Discount Money <span class="pull-right">Rs. <?php echo $discountMoney; ?></span></td>
		            </tr>
					<?php } ?>					
					<tr>
						<td class="total total_confirm">
							 TOTAL <span class="pull-right">Rs. <?php echo $cartTotal+$service_tax+$delCharge+$getAdstotal-$discountMoney; ?></span>
							 <?php $order_total = $cartTotal+$service_tax+$delCharge+$getAdstotal-$discountMoney; ?> 
							 <?php unset($_SESSION['order_last_session_id']); ?>
						</td>
					</tr>
					</tbody>
					</table>
			</div>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
	<footer>
            <?php include_once 'footer.php';?>
    </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

</body>
</html>