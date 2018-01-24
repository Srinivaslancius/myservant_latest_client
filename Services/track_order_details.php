<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
	<?php $getContentPageData = getAllDataWhere('services_content_pages','id',1);
		  $getAboutUsData = $getContentPageData->fetch_assoc();
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
.bs-wizard {
    width: 100%;
    margin: auto;
}
.bs-wizard>.bs-wizard-step {
    padding: 0;
    position: relative;
}
@media only screen and (max-width: 767px)

.bs-wizard>.bs-wizard-step .bs-wizard-stepnum {
    font-size: 12px;
}

.bs-wizard>.bs-wizard-step .bs-wizard-stepnum {
    font-size: 16px;
    margin-bottom: 5px;
}

.text-center {
    text-align: center;
}
 * {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.bs-wizard>.bs-wizard-step:first-child>.progress {
    left: 50%;
    width: 50%;
	    background-color: #228B22;
}

.bs-wizard>.bs-wizard-step>.progress {
    position: relative;
    border-radius: 0;
    height: 8px;
    box-shadow: none;
    margin: 23px 0;
	background-color: #228B22;
}

.progress {
    height: 20px;
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
}
.bs-wizard>.bs-wizard-step>.bs-wizard-dot {
    position: absolute;
    width: 30px;
    height: 30px;
    display: block;
    background: #228B22;
    top: 45px;
    left: 50%;
    margin-top: -15px;
    margin-left: -15px;
    border-radius: 50%;
}
html * {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.bs-wizard>.bs-wizard-step:first-child.active>.progress>.progress-bar {
    width: 0;
}

.bs-wizard>.bs-wizard-step.active>.progress>.progress-bar {
    width: 50%;
}

.bs-wizard>.bs-wizard-step>.progress>.progress-bar {
    width: 0;
    box-shadow: none;
   background: #228B22;
}

.progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    background-color: #337ab7;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;
}
.btn_order{
	border:1px solid #155599 !important;
	color:#155599 !important;
	background-color:transparent !important;
	padding-top:14px !important;
	padding-bottom:14px !important;
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
				if(isset($getAboutUsData['image'])) { ?> 	
				<div class="row">
					<img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getAboutUsData['image'] ?>" alt="<?php echo $getAboutUsData['title'];?>" class="img-responsive">
				</div>
			<?php } else { ?>
				<div class="row">
					<img src="img/slides/slide_1.jpg" class="img-responsive">
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
    	<?php $order_id = $_GET['token'];
              $orderDetails ="SELECT * FROM services_orders WHERE order_sub_id ='$order_id' ORDER BY id DESC";
              $orderDetails1 = $conn->query($orderDetails);
              $orderData = $orderDetails1->fetch_assoc();
        ?>
			<div class="container margin_60">
			<div class="main_title">
				<h2>Order <span> Tracking</span>  Details</h2>
							
			</div>

			<div class="row">
                           
				<div class="col-md-12 wow fadeIn" data-wow-delay="0.3s">
					<div class="feature">
					<div class="row">
					<div class="col-sm-4">
					<h4 style="color:#f26226;">ORDER DETAILS</h4><br>
					<div class="row">
					<div class="col-sm-4">
					<p>Order ID</p>
					</div>
					<div class="col-sm-8">
					<p><?php echo $orderData['order_id'];?></p>
					</div>
					<div class="col-sm-4">
					<p>Order Date</p>
					</div>
					<div class="col-sm-8">
					<p><?php echo $orderData['created_at'];?></p>
					</div>
					<div class="col-sm-4">
					<p>Total Amount</p>
					</div>
					<div class="col-sm-8">
					<p><?php echo $orderData['order_total'];?></p>
					</div>
					
					</div>
					
					</div>
					<div class="col-sm-4">
					<h4 style="color:#f26226;">ADDRESS</h4><br>
					<p><b><?php echo $orderData['first_name'];?></b></p>
					<p><?php echo $orderData['address'];?></p>
					<p></p>
					<p>Phone: <?php echo $orderData['mobile'];?></p>
					</div>
					<div class="col-sm-4">
					<h4 style="color:#f26226;">MANAGE ORDER</h4><br>
					<!-- <p style="color:#2874f0;"><span class="icon-doc-text-inv"></span> REQUEST INVOICE <span class="icon-help-circled"></span></p> -->
					<a href="contactus.php" style="color:#2874f0;"><span class="icon-help-circled"></span> NEED HELP ?</a>
					</div>
					</div>
					
					</div>
				</div> 
				<?php $serviceData = getAllDataWhereWithActive('services_group_service_names','id' ,$orderData['service_id']); error_reporting(1);
                                        $serviceDetails = $serviceData->fetch_assoc(); ?>
				<div class="col-md-12 wow fadeIn" data-wow-delay="0.3s">
					<div class="feature" style="min-height:250px">    	
				<div clas="row">
				<div class="col-sm-2" style="line-height:10px">
				<h4 style="color:#f26226;"><?php echo $serviceDetails['group_service_name'];?></h4><br>
				
				</div>
				<?php $getOrderOrderStatus = "SELECT * FROM lkp_order_status";
					  $getOrderOrderStatus1 = $conn->query($getOrderOrderStatus);
				?>

				<div class="col-sm-10">
				<div class="bs-wizard">
				 <?php while ($orderStatusData = $getOrderOrderStatus1->fetch_assoc())	{
				 	$status_id = $orderStatusData['id'];
					$getServiceOrdersData ="SELECT * FROM services_orders WHERE	order_sub_id ='$order_id' AND lkp_order_status_id = '$status_id' "; 
				 	$getServiceOrdersData1 = $conn->query($getServiceOrdersData);
				 	$getServiceOrdersData2 = $getServiceOrdersData1->fetch_assoc();
				?>
				 
                <div class="col-lg-4 col-md-4 col-sm-4 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum" style="color:#f26226;"><?php echo $orderStatusData['order_status']; ?></div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#0" class="bs-wizard-dot" id="btn_loan" onClick="showDetails(<?php echo $orderStatusData['id'] ?>)"></a>
					<?php 
					
				 ?>	
				  <div class="text"id="details-block-<?php echo $orderStatusData['id']?>" style="display:none;" style="font-size:10px">
					<p><?php echo $orderStatusData['order_status']; ?></p>
					<div class="row">
					<div class="col-sm-4">
					<p><?php echo $getServiceOrdersData2['created_at']; ?></p>
					
					</div>
					
					<div class="col-sm-4">
					<p><?php echo $getServiceOrdersData2['address']; ?></p>
					
					</div>
										
					</div>
					</div> 
					</div>					
                	<?php } ?>



            
               
				 </div>
				
				 
				</div>
							
					</div>
				</div>
				</div>                  
			</div>
			<!-- End row -->			
			<hr>			
		</div>
		<!-- End white_bg -->
		
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
	<script>
		var showDetails = function(value){			
				if(value == 1){
					$('#details-block-1').show().addClass('animated fadeInUp');
					$('#details-block-2, #details-block-3').hide();					
				}else if(value == 2){
					$('#details-block-1, #details-block-3').hide();
					$('#details-block-2').show().addClass('animated fadeInUp');					
				}else if(value == 3){
					$('#details-block-1, #details-block-2').hide();
					$('#details-block-3').show().addClass('animated fadeInUp');	
				}							
			};		
	</script>
</body>

</html>