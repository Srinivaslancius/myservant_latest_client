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
		<div class="container margin_60">
<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
     </div><!-- End col-md-3 -->
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
        <div class="col-md-9 col-sm-9">
        <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Services Orders</h3>
                    </div>
                      <div class="panel-body">
                     <div class="table-responsive">	
								 
        			<table class="table" style="border:1px solid #ddd;width:100%">
            		<tbody>
		  <tr>
			<td colspan="2" style="padding-left:20px">
			<h3>Order Information</h3>
			<p>Order Sub Id: <?php echo $getOrdersData1['order_sub_id'];?></p>
			<p>Order Date:: <?php echo $getOrdersData1['created_at'];?></p>
			<p>Payment method: <?php echo $getPaymentMethodData['status'];?></p>
			<p>Order Status: <?php echo $getOrderStataus['order_status'];?></p>
			<p>Note: <?php echo $getOrdersData1['service_provider_note'];?></p></td>
			<td colspan="2"></td>
			<td colspan="2">
			<h3>Shipping Address</h3>
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
			<td><h5></h5></td>
		  </tr>
		   <tr>
			<td><p><?php echo $getServiceNamesData['group_service_name'] ?></p></td>
			<td><p><?php echo $getOrdersData1['order_price'] ?></p></td>
			<td><p><?php echo $getOrdersData1['service_quantity'] ?></p></td>
			<td><p><?php echo $getOrdersData1['service_selected_date'] ?></p></td>
			<td><p><?php echo $getOrdersData1['service_selected_time'] ?></p></td>
			<td><p></p></td>
		  </tr>
		   <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><p>Subtotal:</p>
			<p>Tax:</p>
			<p style="color:#fe6003;">Grand Total:</p></td>
			<td><p style="color:#fe6003;">Rs. <?php echo $sub_total ?>
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