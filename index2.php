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

		<div class="popup-newsletter">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						
					</div>
					<div class="col-sm-8">
						<div class="popup">
							<span></span>
							<div class="popup-text">
								<h2>Join our newsletter and <br />get discount!</h2>
								<p class="subscribe">Subscribe to the newsletter to receive updates about new products.</p>
								<div class="form-popup">
									<form action="#" class="subscribe-form" method="get" accept-charset="utf-8">
										<div class="subscribe-content">
											<input type="text" name="email" class="subscribe-email" placeholder="Your E-Mail">
											<button type="submit"><img src="images/icons/right-2.png" alt=""></button>
										</div>
									</form><!-- /.subscribe-form -->
									<div class="checkbox">
										<input type="checkbox" id="popup-not-show" name="category">
										<label for="popup-not-show">Don't show this popup again</label>
									</div>
								</div><!-- /.form-popup -->
							</div><!-- /.popup-text -->
							<div class="popup-image">
								<img src="images/product/other/my.jpg" alt="">
							</div><!-- /.popup-text -->
						</div><!-- /.popup -->
					</div><!-- /.col-sm-8 -->
					<div class="col-sm-2">
						
					</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.popup-newsletter -->

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

		<section class="flat-row flat-slider style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="slider owl-carousel-15">
						<?php for($i=0; $i<4; $i++) {?>
							<div class="slider-item style8">
								<div class="item-text">
									<div class="header-item">
										<p>Enhanced Technology</p>
										<h2 class="name">Live a better day</h2>
										<p>
											The ship set ground on the shore of this uncharted desert isle <br />with Gilligan the Skipper too the millionaire and his story.  
										</p>
									</div>
									<div class="content-item">
										<div class="price">
											<span class="sale"> ₹1.999.99</span>
											<div class="clearfix"></div>
										</div>
										<div class="regular">
											 ₹2.500.99
										</div>
										<span class="btn-shop">
											<a href="#" title="">SHOP NOW <img src="images/icons/right-3.png" alt=""></a>
										</span>
									</div>
								</div>
								<div class="item-image">
									<img src="images/slider/1.png" alt="">
								</div>
								<div class="clearfix"></div>
							</div><!-- /.slider-item style8 -->
							<?php } ?>
						</div><!-- /.slider owl-carousel-15 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-slider -->
<section class="flat-row flat-banner-box">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/3.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/4.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/3.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-banner-box -->

		<section class="flat-imagebox">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-list">
								<li class="active">New Arrivals</li>
								<li>Featured</li>
								<li>Top Selling</li>
							</ul>
						</div><!-- /.product-tab -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="box-product">
					<div class="row">
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
					</div><!-- /.row -->
					<div class="row">
					<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
					</div><!-- /.row -->
					<div class="row">
					<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
					<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>
									 <ul class="box-image owl-carousel-1">
									 <?php for($i=0; $i<3; $i++) { ?>
										<li>
											<a href="single_product.php" title="">
												<img src="images/product/other/1.png" alt="">
											</a>
										</li>
										<?php } ?>
										
									</ul><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php" title="">Brue Instant</a>
										</div>
									<!--	<div class="product-name">
											<a href="#" title="">Apple iPad Mini<br />G2356</a>
										</div>-->
										<div class="price">
											<span class="sale"> ₹200.00</span>
											<span class="regular"> ₹250.00</span>
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox -->
							</div>	
						</div><!-- /.col-lg-3 col-sm-6 -->
					</div><!-- /.row -->
				</div><!-- /.box-product -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox -->

	<!--	<section class="flat-imagebox style1">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>New Arraivals</h3>
						</div>
					</div>
				</div>
				<div class="row ">
					<div class="col-md-12 owl-carousel-10">
						<div class="owl-carousel-item">
						<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
						<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>						
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>				
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
						<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>						
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
						<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>					
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>						
							<?php } ?>
							
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="owl-carousel-item">
							<?php for($i=0; $i<2; $i++) {?>
							<div class="product-box style1">
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="images/product/other/new.png" alt="">
										</a>
									</div>
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title="">Bru</a>
										</div>
										<div class="product-name">
											<a href="#" title="">Instant Bru</a>
										</div>
										<div class="price">
											<span class="regular">₹200.00</span>
											<span class="sale">₹250.00</span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="compare-wishlist">
											<a href="#" class="compare" title="">
												<img src="images/icons/compare.png" alt="">Compare
											</a>
											<a href="#" class="wishlist" title="">
												<img src="images/icons/wishlist.png" alt="">Wishlist
											</a>
										</div>
										<div class="btn-add-cart">
											<a href="#" title="">
												Add to Cart
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>-->
		<section class="flat-imagebox style2 background">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="product-wrap">
							<div class="product-tab style1">
								<ul class="tab-list">
									<li class="active">Fruits&Vegitables </li>
									<li>Bread&Dairy </li>
									<li>Bevarages</li>
									<li>Personal Care</li>
									<li>Household</li>
									<li>Eggs, Meat&Fish </li>
								</ul><!-- /.tab-list -->
							</div><!-- /.product-tab style1 -->
							<div class="tab-item">
								<div class="row">
									<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2 v1">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/fruit.png" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Apples </a>
													</div>
													<div class="product-name">
														<a href="#" title="">Beats Solo<br />HD</a>
													</div>
													<div class="price">
														<span class="sale"> ₹100.00</span>
														<span class="regular"> ₹200.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
									<div class="col-md-3 col-sm-6">
									<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box style2">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/sta.png" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Strawberries</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale">₹250.00</span>
														<span class="regular">₹300.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									<div class="col-md-3 col-sm-6">
										<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box style2">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/sta.png" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Strawberries</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale">₹250.00</span>
														<span class="regular">₹300.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
								</div><!-- /.row -->
								<div class="row">
									<div class="col-md-3 col-sm-6">
									<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:342px;height:435px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Bread&bakery </a>
													</div>
													
													<div class="price">
														<span class="sale">₹1,999.00</span>
														<span class="regular">₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
									<div class="col-md-3 col-sm-6">
										<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
								</div><!-- /.row -->
								<div class="row">
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:342px;height:435px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Bread&bakery </a>
													</div>
													
													<div class="price">
														<span class="sale">₹1,999.00</span>
														<span class="regular">₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
								</div><!-- /.row -->
								<div class="row">
								<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:342px;height:435px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Bread&bakery </a>
													</div>
													
													<div class="price">
														<span class="sale">₹1,999.00</span>
														<span class="regular">₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
								</div><!-- /.row -->
								<div class="row">
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									
								<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:342px;height:435px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Bread&bakery </a>
													</div>
													
													<div class="price">
														<span class="sale">₹1,999.00</span>
														<span class="regular">₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
								</div><!-- /.row -->
								<div class="row">
								
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									
									<div class="col-md-3 col-sm-6">
												<?php for($i=0; $i<2; $i++) {?>
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:87px;height:177px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">bread</a>
													</div>
													<!--<div class="product-name">
														<a href="#" title="">Apple iPad Mini<br />G2356</a>
													</div>-->
													<div class="price">
														<span class="sale"> ₹1,250.00</span>
														<span class="regular"> ₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
									
								<div class="col-md-6">
										<div class="product-box">
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/b.jpg" alt="" style="width:342px;height:435px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="cat-name">
														<a href="#" title="">Bread&bakery </a>
													</div>
													
													<div class="price">
														<span class="sale">₹1,999.00</span>
														<span class="regular">₹2,999.00</span>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="btn-add-cart">
														<a href="#" title="">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													<div class="compare-wishlist">
														<a href="#" class="compare" title="">
															<img src="images/icons/compare.png" alt="">Compare
														</a>
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
								</div><!-- /.row -->
							</div><!-- /.tab-item -->
						</div><!-- /.product-wrap -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style2 -->

		<section class="flat-imagebox style3">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-2">
						<?php for($i=0; $i<2; $i++) {?>
							<div class="box-counter">
								<div class="counter">
									<span class="special">Super Sale</span>
									<div class="counter-content">
										<p>There are many variations of passages of Lorem Ipsum available, but the majorited have suffered alteration.</p>
										<div class="count-down">
											<div class="square">
												<div class="numb">
													14
												</div>
												<div class="text">
													DAYS
												</div>
											</div>
											<div class="square">
												<div class="numb">
													09
												</div>
												<div class="text">
													HOURS
												</div>
											</div>
											<div class="square">
												<div class="numb">
													48
												</div>
												<div class="text">
													MINS
												</div>
											</div>
											<div class="square">
												<div class="numb">
													23
												</div>
												<div class="text">
													SECS
												</div>
											</div>
										</div><!-- /.count-down -->
									</div><!-- /.counter-content -->
								</div><!-- /.counter -->
								<div class="product-item">
									<div class="imagebox style3">
										<div class="box-image save">
											<a href="single_product.php" title="">
												<img src="images/product/other/soap.jpg" alt="" style="width:600px;height:352px">
											</a>
											<span>Save $85.00</span>
										</div><!-- /.box-image -->
										<div class="box-content" style="text-align:center">
											<div class="product-name">
												<a href="#" title="">Medimix soaps</a>
											</div>
											<div class="price">
												<span class="sale">$2,299.00</span>
												<span class="regular">$2,999.00</span>
											</div>
										</div>
										<div class="box-bottom" style="text-align:center">
											<div class="btn-add-cart">
												<a href="#" title="">
													<img src="images/icons/add-cart.png" alt="">Add to Cart
												</a>
											</div>
											<div class="compare-wishlist">
												<a href="#" class="compare" title="">
													<img src="images/icons/compare.png" alt="">Compare
												</a>
												<a href="#" class="wishlist" title="">
													<img src="images/icons/wishlist.png" alt="">Wishlist
												</a>
											</div>
										</div><!-- /.box-bottom -->
									</div><!-- /.imagbox style3 -->
								</div><!-- /.product-item -->
							</div><!-- /.box-counter -->
							<?php } ?>
						</div><!-- /.owl-carousel-2 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style3 -->

		<section class="flat-imagebox style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>New Arraivals</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-3">
						<?php for($i=0; $i<12; $i++) {?>
							<div class="imagebox style4">
								<div class="box-image">
									<a href="single_product.php" title="">
										<img src="images/product/other/1.png" alt="">
									</a>
								</div><!-- /.box-image -->
								<div class="box-content">
									<div class="cat-name">
										<a href="#" title="">Bru</a>
									</div>
									<div class="product-name">
										<a href="#" title="">Instant Coffee</a>
									</div>
									<div class="price">
										<span class="sale"> ₹50.00</span>
										<span class="regular">₹ 2,999.00</span>
									</div>
								</div><!-- /.box-content -->
							</div><!-- /.imagebox style4 -->
							<?php } ?>
						</div><!-- /.owl-carousel-3 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style4 -->


		<section class="flat-iconbox">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Free Shipping</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Free Shipping On Order Over ₹500</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/order.png" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Free return products in 30 days</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/payment.png" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Secure System</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/return.png" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p>Free return products in 30 days</p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->

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
		<!-- <script type="text/javascript" src="javascript/jquery.circlechart.js"></script> -->
		<script type="text/javascript" src="javascript/easing.js"></script>
		<script type="text/javascript" src="javascript/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="javascript/owl.carousel.js"></script>
		<script type="text/javascript" src="javascript/smoothscroll.js"></script>
		<!-- <script type="text/javascript" src="javascript/jquery-ui.js"></script> -->
		<script type="text/javascript" src="javascript/jquery.mCustomScrollbar.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="javascript/waves.min.js"></script> 
		<script type="text/javascript" src="javascript/jquery.countdown.js"></script>

		<script type="text/javascript" src="javascript/main.js"></script>

</body>	
</html>