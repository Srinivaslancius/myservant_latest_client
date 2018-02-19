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
	<link rel="stylesheet" href="css/marquee.css">


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
			<div class="content">
			  <?php include_once './news_scroll.php';?> 
			</div>
                <div id="position">
			<div class="container">
				<ul>
					<li><a href="#">Home</a>
					</li>
					<li><a href="#">Category</a>
					</li>
					<li>Track Order</li>
				</ul>
			</div>
		</div>

			<div class="container margin_60">
		  <div class="main_title">
				<h2>Track <span>Your</span> Order</h2>
							
			</div>
			<p style="text-align:center">Enter E-mail address and order Id to track your order summary</p>	
			<div class="row">
			<div class="col-md-3 col-sm-3">
			</div>
				<div class="col-md-6 col-sm-6">
						<div id="message-contact"></div>
						<form method="post" action="" id="contactform" name="contactform"> 	
										<div class="form-group">
										<label>Email Address*</label>
										<input type="email" id="email_contact" name="email_contact" class="form-control" placeholder="Enter Email" required>
									</div>							
									<div class="form-group">
										<label>Order ID*</label>
										<input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="Enter ID" required>
									</div>
								<div class="row">
								<div class="col-md-6">									
									<input type="submit" value="Submit" class="btn_1" id="submit-contact">
								</div>
							</div>									
							<!-- End row -->							
															
						</form><br>
					
				</div>
				<div class="col-md-3 col-sm-3">
			</div>
				
			</div>
			
			<!-- End row -->
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

</body>

</html>