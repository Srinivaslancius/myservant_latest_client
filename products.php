<?php include_once 'meta.php';?>
<body class="header_sticky">
	<div class="boxed style2">

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

		<section class="flat-breadcrumb">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="#" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">Products</a>
								
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><br>
		<section class="flat-row flat-imagebox">
			<div class="container">				
				<div class="row">
				<?php 
				if($_SESSION['city_name'] == '') {
                    $lkp_city_id = 1;
                } else {
                    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
					$lkp_city_id = $getCities1['id'];
                }
				$getCategories1 = "SELECT * FROM grocery_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_category_id FROM grocery_sub_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
				$getCategories = $conn->query($getCategories1);
				while($getCategoriesDeatils = $getCategories->fetch_assoc()) { ?>
					<div class="col-md-6 col-lg-4">
						<div class="imagebox style1 v1" style="border:2px solid #FE6003; margin-bottom:5px">
							<div class="box-image">
								<a href="#" title="">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_category_web_image/'.$getCategoriesDeatils['category_web_image'] ?>" alt="">
								</a>
							</div><!-- /.box-image -->
							<div class="box-content">
								<div class="cat-name">
									<a href="results.php?cat_id=<?php echo $getCategoriesDeatils['id']; ?>" title="" style="color:#FE6003"><?php echo $getCategoriesDeatils['category_name']; ?></a>
								</div>
								<ul class="cat-list">
									<?php $getSubCategories = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id ='".$getCategoriesDeatils['id']."' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC LIMIT 0,4";
									$getSubCategories1 = $conn->query($getSubCategories);
									while($getSubCategoriesData = $getSubCategories1->fetch_assoc()) { 
										?>
									<li><a href="results.php?sub_cat_id=<?php echo $getSubCategoriesData['id']; ?>" title=""><?php echo $getSubCategoriesData['sub_category_name']; ?></a></li>
									<?php } ?>
								</ul>
								<!--<div class="btn-more">
									<a href="#" title="">See all</a>
								</div>-->
							</div><!-- /.box-content -->
						</div><!-- /.imagebox style1 -->
					</div><!-- /.col-md-6 col-lg-4 -->
				<?php } ?>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><br><br>
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
		<script type="text/javascript" src="javascript/isotope.pkgd.min.js"></script>
		<script type="text/javascript" src="javascript/imagesloaded.pkgd.min.js"></script>
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