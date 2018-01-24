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
<style>
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom:0px;
	color:#fe6003;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 6px;
    line-height: 1.42857143;
    vertical-align: top;
   border-top: 1px solid #ddd;
}
.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 5px 9px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {
	background-color:#fe6003;
 padding: 5px 12px;
} 
ul#cat_nav li a#active, ul#cat_nav li a.active, ul#cat_nav li a:hover {
    background: #fe6003;
    color: white;
}
ul#cat_nav li a#active, ul#cat_nav li a.active, ul#cat_nav li a:hover {
    background: #fe6003;
    color: white;
}
ul#cat_nav li a span {
    font-size: 20px;
   
}
ul#cat_nav li a span:hover{
	color:white;
}
ul#cat_nav li a span#active {
   background-color:#fe6003;
   color:white;
}
h5{
	color:#fe6003;
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
<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
                </div>
                <div id="position">
			<div class="container">
				<ul>
					<li><a href="#">Home</a>
					</li>
					<li><a href="#">Category</a>
					</li>
					<li>Page active</li>
				</ul>
			</div>
		</div>
		<div class="container margin_60">
		<div class="main_title">
				<h2>Order Details</h2>				
			</div>
			<div class="row">			
					<div class="feature">
					<div class="row">
        
        <aside class="col-lg-3 col-md-4 col-sm-4">
           <div class="box_style_cat">
       		<?php include_once 'my_dashboard_strip.php';?>
            </div>
        </aside>       
		<div class="col-lg-9 col-md-8 col-sm-8">
			<div class="row">
			<div class="col-sm-1">
			</div>
		<div class="col-sm-11 col-xs-12">
		<div class="table-responsive">		
			<table class="table" style="border:1px solid #ddd;width:90%">
		<!--<thead>
		  <tr>
			<th></th>
			<th></th>
			<th colspan="2"><h3>ORDER DETAILS</h3></th>
			<th></th>
			<th></th>
		  </tr>
		</thead>-->
		<tbody>
		  <tr>
			<td colspan="2" style="padding-left:20px">
			<h3>Order Information</h3>
			<p>Restaurant Name:</p>
			<p>Payment Method:</p>
			<p>Order Type:</p>
			<p>Order Status:</p>
			<p>Payment Status:</p></td>
			<td colspan="2"></td>
			<td colspan="2">
			<h3>Shipping Address</h3>
			<p>srinu</p>
			<p>srinivas@lanciussolutions.com</p>
			<p>7894561235</p>
			<p>test</p>
			<p>345345</p></td>
		  </tr>
		  <tr>
			<td><h5>ITEM NAME</h5></td>
			<td><h5>CUSINE TYPE</h5></td>
			<td><h5>ITEM WEIGHT</h5></td>
			<td><h5>QUANTITY</h5></td>
			<td><h5>PRICE</h5></td>
			<td><h5>TOTAL</h5></td>
		  </tr>
		   <tr>
			<td><p>Chicken Biryani</p></td>
			<td><p>MAIN COURSES1</p></td>
			<td><p>Extra Large</p></td>
			<td><p>1</p></td>
			<td><p>800</p></td>
			<td><p>800</p></td>
		  </tr> 
		   <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><p>Subtotal:</p>
			<p>Tax:</p>
			<p style="color:#fe6003;">Grand Total:</p></td>
			<td><p style="color:#fe6003;">Rs. 4200</p>
			<p style="color:#fe6003;">Rs. 420(10 %)</p>
				<p style="color:#fe6003;">Rs. 4620</p>
		</td>
		  </tr>
		</tbody>
	  </table>
	  </div>
</div>	  
        </div><!-- End col-lg-9-->
        </div>
	</div>
					</div>      
			</div>
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

</body>

</html>