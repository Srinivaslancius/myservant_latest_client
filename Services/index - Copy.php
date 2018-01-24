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

	<!-- REVOLUTION SLIDER CSS -->
	<link href="layerslider/css/layerslider.css" rel="stylesheet">
	<!-- For brands slider -->
	<script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>

</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
	<header>
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
		<div id="full-slider-wrapper">
                    <?php include_once './slider.php';?>
		</div>
		<!-- End layerslider -->
                <div class="container-fluid marg10 search_back">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
			<div id="newsletter_wp" >
                            <form method="post" action="sub_categories.php" id="newsletter" name="newsletter"  autocomplete="off">
							<div class="row">
                                                            
                            	<div class="col-md-9 first-nogutter">
                                    <div class="col-md-4 padd0">
                                        
								<div class="form-group">
									<?php $getCategoriesData = getAllDataWithActiveRecent('services_category'); ?>
									<select name="id" class="form-control">
										<?php while($row = $getCategoriesData->fetch_assoc()) {  ?>
				                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
				                       <?php } ?>
									</select>
								</div>
							
                                    </div>
                                    <div class="col-md-8 padd0">
                                	<input name="category_name" id="category_name" type="text" placeholder="Search your related service" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 nogutter">
                                	<button type="submit" name="search" class="btn-check" id="submit-newsletter">Search</button>
                                </div>
                             </div>                            	
                            </form>
                     <div id="message-newsletter"></div>
                         
                        </div><!-- End newsletter_wp -->	
                    </div><!-- End row -->
                    <div class="col-md-2"></div>
                </div>
                </div>
		<div class="container margin_60">

			<div class="main_title">
				<h2>Our <span>Services</span> Categories</h2>
				
			</div>
			<?php $getCategoriesData = getAllDataWithStatusLimit('services_category',0,0,12); ?>
			<div class="row">
                 <?php  while($getAllCategoriesData = $getCategoriesData->fetch_assoc()) { ?> 
				<div class="col-md-2 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
					<div class="tour_container">
						<div class="ribbon_3 popular"><!-- <span>Popular</span> --></div>
						<div class="img_container padd15">
                           <a href="sub_categories.php?key=<?php echo encryptPassword($getAllCategoriesData['id']); ?>">
                           <img src="<?php echo $base_url . 'uploads/services_category_images/'.$getAllCategoriesData['category_image'] ?>" class="img-responsive" alt="<?php echo $getAllCategoriesData['category_name']; ?>" style="width:64px; height:64px;">
						</div>
						<div class="tour_title">
							<h3><?php echo $getAllCategoriesData['category_name']; ?></h3>
						</div>
						</a>
					</div>
					<!-- End box tour -->
				</div>
                  <?php } ?>  
			</div>
			<!-- End row -->
			<p class="text-center add_bottom_30">
				<a href="services.php" class="btn_1 medium"><i class="icon-eye-7"></i>View all our Services</a>
			</p>

			<hr>

			<div class="main_title">
				<h2>Our <span>Associate</span> Partners</h2>
				
			</div>

			<div class="row">
                <?php $getServiceProvider =  getServicesProviderDataLimit(0,6); ?>
                <?php  while($getAllgetServiceProvider = $getServiceProvider->fetch_assoc()) { ?> 
				<div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
					<div class="feature">
						 <i class="icon_set_1_icon-57"></i> 
					<!--	<img src="<?php echo $base_url . 'uploads/service_provider_business_logo/'.$getAllgetServiceProvider['logo'] ?>" class="img-responsive" alt="<?php echo $getAllgetServiceProvider['company_name']; ?>" style="width:65px; height:65px;">-->
						<h3><span><?php echo $getAllgetServiceProvider['company_name']; ?></span></h3>
						<p>
							<?php echo substr(strip_tags($getAllgetServiceProvider['description']), 0,200);?>
						</p>
					</div>
				</div>
                <?php } ?>      	      
			</div>
			<!-- End row -->
			<!-- End row -->
			<p class="text-center nopadding">
				<a href="partners.php" class="btn_1 medium"><i class="icon-eye-7"></i>View all</a>
			</p>
		</div>
		<!-- End container -->

		<?php include_once 'our_associate_partners.php';?>

		<!-- Brnds Start here -->
		<div class="container margin_0">
			<div class="main_title">
				<h2>Our <span>Brands</span></h2>				
			</div>
			  <?php include_once 'brands.php';?>
		</div><br><br>
		<!-- End Brnds here -->

	</main>
	<!-- End main -->

	<footer class="revealed">
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	
	<!-- Common scripts -->
	
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
(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // https://getbootstrap.com/javascript/#carousel
  $('#carousel123').carousel({ interval: 2000 });
  $('#carouselABC').carousel({ interval: 3600 });
}());

(function(){
  $('.carousel-showmanymoveone .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<6;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());
</script>

</body>

</html>