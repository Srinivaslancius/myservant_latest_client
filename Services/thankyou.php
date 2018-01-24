<?php ob_start(); ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once 'meta.php';?>   

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
    <link href="layerslider/css/layerslider.css" rel="stylesheet">
    <!-- REVOLUTION SLIDER CSS -->
	<style>
	.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom:0px solid #ddd;
	background-color:#f8f8f8;
	font-weight:normal;
	font-size:13px;
	padding-bottom:0px;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
 
    line-height: 1.42857143;
    vertical-align: top;
   border-top: 0px solid #ddd;
  
}
.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 2px solid #ddd;
}
.table>tbody>tr>td{
	border-bottom:0px;
}
	.table {
     border-top: 1px solid #ddd;
}
.table>thead{
	  border-bottom:1px solid #ddd;
}
.box_style_1{
	border:0px;
	padding:0px;
}
.box_style_1 h3.inner{
	background-color:#fe6003;
}
.box_style_1 h3.inner {
    margin: -30px -31px 30px;
	height:50px;
	
}
.table>thead>tr>th>p{
	line-height:5px;
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
    if(!empty($getTestimonialsBanner['image'])) { ?>  
        <div class="row">
          <img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getTestimonialsBanner['image'] ?>" class="img-responsive" style="width:100%; height:400px;">
        </div>
      <?php } else { ?>
        <div class="row">
          <img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
        </div>
      <?php }?>
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

            <?php
                header( "refresh:10;url=index.php" );
                 if($_SESSION['user_login_session_id'] == '') {
                    header ("Location: logout.php");
                }
                $orderId = $_GET['odi'];
                $orderData =getAllDataWhere('services_orders','order_id',$orderId);
                $getservicesOrders = $orderData->fetch_array();
            ?>
        <div class="container" style="margin-top:-70px">        
           <div class="row">            
            <div class="col-sm-3"></div>
           <div class="col-sm-6">
                    <div id="login">
					<div class="box_style_1">
						<h3 class="inner" style="text-align:left">Order Confirmed!</h3>
						
					   <center><span class="icon-ok-circled2" style="color:#fe6003;;font-size:150px;font-weight:normal"></span></center>
                        <div class="text-center"><h2 style="color:#333"><strong>Thank You!</strong></h2>
						  <p style="text-align:center"><b>Your order has been received</b><br>Your Order No is: <b><?php echo $orderId; ?></b><br>Name: <b><?php echo $getservicesOrders['first_name'];?></b><br>Order Total: Rs.<b> <?php echo $getservicesOrders['order_total'];?></b><br>Billing & Shipping Information: <?php echo $getservicesOrders['address']; ?><br>You will be redirected to the Home in 10 seconds.<br></p>
                        </div>
                    </div>
                </div></div>
            <div class="col-sm-3"></div>    
            
                <div class="col-sm-1">
                </div>
                
           </div>
            
  </div>
  
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