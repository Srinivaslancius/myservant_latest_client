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
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								All Products
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><br>
		<section class="flat-row flat-imagebox">
			<div class="container">
				<?php 
					if($_SESSION['city_name'] == '') {
					    $lkp_city_id = 1;
					} else {
					    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
						$lkp_city_id = $getCities1['id'];
					}
					$getCategories1 = "SELECT * FROM grocery_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_category_id FROM grocery_sub_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
					$getCategories = $conn->query($getCategories1); ?>
				<?php while($getCategoriesData = $getCategories->fetch_assoc()) { ?>		
				<h2 style="margin-top:20px"><a href="results.php?cat_id=<?php echo $getCategoriesData['id']; ?>"><?php echo $getCategoriesData['category_name']; ?></a></h2><br>
				<ul class="products_lst">
					<?php $getSubCategories = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id ='".$getCategoriesData['id']."' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC";
					$getSubCategories1 = $conn->query($getSubCategories); ?>
					<?php while($getSubCategoriesData = $getSubCategories1->fetch_assoc()) { ?>
					<li><a href="results.php?sub_cat_id=<?php echo $getSubCategoriesData['id']; ?>"><?php echo $getSubCategoriesData['sub_category_name']; ?></a></li>
					<?php } ?>			
				</ul>
				<div class="part1">
					<div class="row">
					<?php $getAllSubCategories = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id ='".$getCategoriesData['id']."' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC";
					$getAllSubCategories1 = $conn->query($getAllSubCategories); ?>
					<?php while($getAllSubCategoriesData = $getAllSubCategories1->fetch_assoc()) { ?>
						<div class="col-sm-3">
						<h4><a href="results.php?sub_cat_id=<?php echo $getAllSubCategories['id']; ?>"><?php echo $getAllSubCategoriesData['sub_category_name']; ?></h4>
						<ul class="sub_prdct">
							<?php
							$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '".$getAllSubCategoriesData['id']."' AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)  ORDER BY id DESC LIMIT 0,3";
							$getProducts1 = $conn->query($getProducts);
							while($getProductsData = $getProducts1->fetch_assoc()) { 
								$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsData['id']);?>
							<li><a href="single_product.php?product_id=<?php echo $getProductsData['id']; ?>"><?php echo $getProductNames['search_tags']; ?></a></li>
							<?php } ?>
						</ul>
						</div>
					<?php } ?>
					</div>
				</div>
			<?php } ?>
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
		<?php include "search_js_script.php"; ?>
</body>	
</html>