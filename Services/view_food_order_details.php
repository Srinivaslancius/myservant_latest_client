<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
	<?php $getContentPageData = getAllDataWhere('services_content_pages','id',9);
		  $getPartnersBanner = $getContentPageData->fetch_assoc();
	?>
	<?php $getAllAboutDataData = getAllDataWhere('services_content_pages','id',1);
		  $getAboutDataData = $getAllAboutDataData->fetch_assoc();
	?>
	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/base.css" rel="stylesheet">
        <link href="site_launch/css/style.css" rel="stylesheet">

	<!-- REVOLUTION SLIDER CSS -->
	<link href="layerslider/css/layerslider.css" rel="stylesheet">
	<link href="css/dash_board.css" rel="stylesheet">
	<link rel="stylesheet" href="css/marquee.css">
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
.table>thead>tr>td h3,h5 {
	color:#fe6003;
}
.table>thead>tr>td p{
	line-height:10px;
}
</style>

</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
	 <header id="plain">
		<?php include_once './top_header.php';?>
		<!-- End top line-->

		<div class="container">
                    <?php include_once './menu.php';?>
		</div>
		<!-- container -->
                
        </header>
	<!-- End Header -->

	<main>
		<!-- Slider -->
		 <div class="container-fluid page-title">
			<?php  
				  if(!empty($getPartnersBanner['image'])) { ?> 	
					<div class="row">
						<img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getPartnersBanner['image'] ?>" alt="<?php echo $getPartnersBanner['title'];?>" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php } else { ?>
					<div class="row">
						<img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php }?>
    	</div>
    	
		<div class="content">
			  <?php include_once './news_scroll.php';?> 
			</div>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li><a href="food_orders.php">Food Orders</a>
					</li>
					<li>Order Details</li>
				</ul>
			</div>
		</div>
		<div class="container margin_60">
<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
     </div><!-- End col-md-3 -->
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
        <div class="col-md-9 col-sm-9">
        <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Food Orders</h3>
                    </div>
                      <div class="panel-body">
                     <div class="table-responsive">	
								 
        			<table class="table" style="border:1px solid #ddd;width:100%">
            		<tbody>
		  <tr>
			<td colspan="2" style="padding-left:20px">
			<h3>Order Information</h3>
			<p>Restaurant Name: <?php echo $getRestaurants['restaurant_name']; ?></p>
      <p>Payment Method: <?php echo $getpaymentTypes['status']; ?></p>
      <p>Order Type: <?php echo $order_type; ?></p>
      <p>Order Status: <?php echo $orderStatus['order_status']; ?></p>
      <p>Payment Status: <?php echo $paymentStatus['payment_status']; ?></p></td>
			<td></td>
			<td colspan="2">
			<h3>Shipping Address</h3>
			<p><?php echo $getOrdersData1['first_name']; ?></p>
      <p><?php echo $getOrdersData1['email']; ?></p>
      <p><?php echo $getOrdersData1['mobile']; ?></p>
      <p><?php echo $getOrdersData1['address']; ?></p>
      <p><?php echo $getOrdersData1['postal_code']; ?></p></td>
	  
		  </tr>
      <?php $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
    $getOrdersData3 = $conn->query($getOrders1); ?>
		  <tr>
			<td><h5>ITEM NAME</h5></td>
			<td><h5>CUSINE TYPE</h5></td>
			<td><h5>ITEM WEIGHT</h5></td>
			<td><h5>QUANTITY</h5></td>
			<td><h5>PRICE</h5></td>
			
		  </tr>
      <?php while($getOrdersData2 = $getOrdersData3->fetch_assoc()) { 
        $getCategories = getIndividualDetails('food_category','id',$getOrdersData2['category_id']);
        $getProducts = getIndividualDetails('food_products','id',$getOrdersData2['product_id']);
        $getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
      ?>
		   <tr>
			<td><p><?php echo $getProducts['product_name'] ?></p></td>
			<td><p><?php echo  $getCategories['category_name']?></p></td>
			<td><p><?php echo $getItemWeights['weight_type'] ?></p></td>
			<td><p><?php echo $getOrdersData2['item_quantity'] ?></p></td>
			<td><p><?php echo $getOrdersData2['item_price'] ?></p></td>
	     
		  </tr>
      <?php  } ?>
		   <tr style="background-color:#f2f2f2">
        <td colspan="3"></td>
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
			<!-- End row -->						
		</div>
		<?php include_once 'our_associate_partners.php';?>
		<!-- End section -->

	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	
	<!-- Common scripts -->
	<script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>

	<!-- Specific scripts -->
	<script src="layerslider/js/greensock.js"></script>
	<script src="layerslider/js/layerslider.transitions.js"></script>
	<script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
	<script src="js/theia-sticky-sidebar.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			'use strict';
			$('#layerslider').layerSlider({
				autoStart: true,
				responsive: true,
				responsiveUnder: 1280,
				layersContainer: 1170,
				skinsPath: 'layerslider/skins/'
					// Please make sure that you didn't forget to add a comma to the line endings
					// except the last line!
			});
		});
	</script>
	<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>

</body>

</html>