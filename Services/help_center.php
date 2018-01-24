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

	<!-- CSS -->
	<link href="css/base.css" rel="stylesheet">

	<!-- Radio and check inputs -->
	<link href="css/skins/square/grey.css" rel="stylesheet">

	<!-- REVOLUTION SLIDER CSS -->
	<link href="layerslider/css/layerslider.css" rel="stylesheet">

	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>
.accordion-box .accordion .accord-btn {
    position: relative;
    display: block;
    min-height: 40px;
    line-height: 30px;
    padding: 10px 0px 5px;
    color: #2f2f31;
    cursor: pointer;
    margin-bottom: 10px;
}
</style>
</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->
	<!-- End Preload -->

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
		<div class="container-fluid page-title">
		<div class="row">
			<?php include_once './common_slider.php';?>
		</div>
    </div>
		<!-- Position -->
			<div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li>Help Center</li>
				</ul>
			</div>
		</div>
		<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
                </div>
		<div class="container margin_60">

			<div class="row">
				
				<!--End aside -->
				<div class="col-lg-12 col-md-12" id="faq">
					 <div class="main_title">
				<h2>Help<span> Center</span></h2>				
				</div>
					<div class="panel-group" id="accordion">
						<?php $getHelpCentersData = getAllDataWhere('service_faqs','lkp_status_id',0); 
                  		while($getHelpCenters = $getHelpCentersData->fetch_assoc()) { ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
		                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $getHelpCenters['id'];?>"><?php echo $getHelpCenters['title'];?><i class="indicator pull-right  <?php if($getHelpCenters['id']==1) { echo "icon-minus"; } else { echo "icon-plus";  } ?>"></i></a>
		                      </h4>
							</div>
							<div id="collapse<?php echo $getHelpCenters['id'];?>" class="panel-collapse collapse  <?php if($getHelpCenters['id']==1) { echo "in"; } ?>">
								<div class="panel-body"><?php echo $getHelpCenters['description'];?></div>
							</div>
						</div><br>
						<?php } ?>
					</div>




				</div>
				<!-- End col lg-9 -->
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
		
		
		<!-- End white_bg -->

		
		<!-- End section -->

		<?php include_once 'our_associate_partners.php';?>
	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->
	<!-- End footer -->

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon_set_1_icon-78"></i>
			</button>
		</form>
	</div><!-- End Search Menu -->

	<!-- Common scripts -->
	<script src="../cdn-cgi/scripts/0e574bed/cloudflare-static/email-decode.min.js"></script>
	
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>

	<!-- Specific scripts -->
	<!-- Cat nav mobile -->
	<script src="js/cat_nav_mobile.js"></script>
	<script>
		$('#cat_nav').mobileMenu();
	</script>

	<!-- Validation purpose add scripts -->
	<!-- Specific scripts for slider-->
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