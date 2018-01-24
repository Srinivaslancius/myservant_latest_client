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

<?php $getAboutUsData = getIndividualDetails('grocery_content_pages','id',1) ?>
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
								<a href="about.php" title=""><?php echo $getAboutUsData['title'];?></a>
								
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		
		<section class="flat-about">
			<div class="container">
				
				<div class="title" style="text-align:justify">
								
				<?php echo $getAboutUsData['description'];?>	
				</div>
				<br>

								
							
			</div><!-- /.container -->
		</section><!-- /.flat-about -->
	
		<?php $getTestimonialsData = getAllDataWithStatus('grocery_testimonials','0'); ?>
		<section class="flat-testimonial">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h3>Testimonials</h3>
						</div>
						<div class="testimonial owl-carousel-17">
							<?php while($getTestimonials = $getTestimonialsData->fetch_assoc()) { ?>
							<div class="testimonial-item">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_testimonials/'.$getTestimonials['image'] ?>" alt="<?php echo $getTestimonials['name']; ?>">
								</div>
								<div class="content">
									<div class="name">
										<?php echo $getTestimonials['name']; ?>
									</div>
									<p>
										<?php echo $getTestimonials['testimonial']; ?>
									</p>
								</div>
							</div><!-- /.testimonial-item -->
							<?php } ?>
						
						</div><!-- /.testimonial owl-carousel -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-testimonial -->

		<!--<section class="flat-row flat-brand style2">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h3>Partners</h3>
						</div>
						<ul class="owl-carousel-9">
							<?php $getBrandlogosData = getAllDataWithStatus('grocery_brand_logos','0'); ?>
							<?php while($getBrandlogos = $getBrandlogosData->fetch_assoc()) { ?>
							<li >
								<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_brand_logos/'.$getBrandlogos['brand_logo'] ?>" width="200px" height="150px">
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</section>-->

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

</body>	
</html>