<?php include_once 'meta.php';?>
<style>

#div1{
width:90%;
height:auto;
display:none;
background: rgba(0,0,0,0.8);
border:1px solid #DCDCDC;
border-radius:30px;
padding:20px;
z-index:999;
position:absolute;
}

</style>
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
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="#" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">Offer Zone</a>								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>HOT DEALS<span></span></h3>
								</div>
								<div class="widget widget-banner">
								<div class="banner-box">
									<div class="inner-box">
									<div class="box-image owl-carousel-1">
										<a href="#" title="">
											<img src="images/product/other/my.jpg" alt="">
										</a>
										<a href="#" title="">
										<img src="images/product/other/my.jpg" alt="">
										</a>
									</div>
									</div>
								</div>
							</div><!-- /.widget widget-banner -->
							</div><br>
							<div class="widget widget-price">
								<div class="widget-title">
									<h3>Price<span></span></h3>
								</div>
								<div class="widget-content">
									<p>Price</p>
									<div class="price search-filter-input">
                                        <div id="slider-range" class="price-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" ></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span></div>
                                        <p class="amount">
                                          <input type="text" id="amount" disabled="">
                                        </p>
                                   </div>
								</div>
							</div><!-- /.widget widget-price -->
							<div class="widget widget-products">
								<div class="widget-title">
									<h3>SPECIAL OFFER<span></span></h3>
								</div>
								<ul class="product-list widget-content">
									<li>
										<div class="img-product">
											<a href="#" title="">
												<img src="images/product/other/my.jpg" alt="" style="width:100px;height:100px">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="#" title="">Combo Offer</a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale"> ₹2990.00</span>
											</div>
										</div>
									</li>	
									<li>
										<div class="img-product">
											<a href="#" title="">
												<img src="images/product/other/my.jpg" alt="" style="width:100px;height:100px">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="#" title="">Combo Offer</a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale"> ₹2990.00</span>
											</div>
										</div>
									</li>	
									<li>
										<div class="img-product">
											<a href="#" title="">
												<img src="images/product/other/my.jpg" alt="" style="width:100px;height:100px">
											</a>
										</div>
										<div class="info-product">
											<div class="name">
												<a href="#" title="">Combo Offer</a>
											</div>
											<div class="queue">
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="price">
												<span class="sale"> ₹2990.00</span>
											</div>
										</div>
									</li>	
								</ul>
							</div><br>
							<div class="widget widget-banner">
								<div class="banner-box">
									<div class="inner-box">
									<div class="box-image owl-carousel-1">
										<a href="#" title="">
											<img src="images/product/other/10.png" alt="">
										</a>
										<a href="#" title="">
											<img src="images/product/other/10.png" alt="">
										</a>
									</div>
									</div>
								</div>
							</div><!-- /.widget widget-banner -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					
					<div class="col-lg-9 col-md-8">
						<div class="main-shop">
							<div class="slider owl-carousel-16">
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name" style="font-size:60px">Mansoon Offer</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="images/product/other/my.jpg" alt="" style="width:201px; height:212px">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								<div class="slider-item style9">
									<div class="item-text">
										<div class="header-item">
											<p>You can build the banner for other category</p>
											<h2 class="name" style="font-size:60px">Mansoon Offer</h2>
										</div>
									</div>
									<div class="item-image">
										<img src="images/product/other/my.jpg" alt="" style="width:201px; height:212px">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								
							</div><!-- /.slider -->
							<div class="wrap-imagebox">
								<div class="flat-row-title">
									<h3>Offer products</h3>
									<span>
										Showing 1–15 of 20 results
									</span>
									<div class="clearfix"></div>
								</div>
								<div class="sort-product">
									<ul class="icons">
										<li>
											<img src="images/icons/list-1.png" alt="">
										</li>
										<li>
											<img src="images/icons/list-2.png" alt="">
										</li>
									</ul>
									<div class="sort">
										<div class="popularity">
											<select name="popularity">
												<option value="">Sort by popularity</option>
												<option value="">Sort by popularity</option>
												<option value="">Sort by popularity</option>
												<option value="">Sort by popularity</option>
											</select>
										</div>
										<div class="showed">
											<select name="showed">
												<option value="">Show 15</option>
												<option value="">Show 15</option>
												<option value="">Show 15</option>
												<option value="">Show 15</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="tab-product">
									<div class="row sort-box">
									<?php for($i=0; $i<12; $i++) {?>
										<div class="col-lg-4 col-sm-6">
											<div class="product-box">
											<div id="div1">
								
					<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
					<p style="color:white">Product Name : Instant Brue</p>
					
					</div>
												<div class="imagebox">
												
														<a href="single_product.php" title="">
															<img src="images/product/other/mys.jpg" alt="" style="width:264px; height:210px">
														</a>
														
													<div class="box-content">
														<!--<div class="cat-name">
															<a href="#" title="">Monthly Saving Pack 4</a>
														</div>-->
														<div class="product-name">
															<a href="single_product.php" title="">Monthly Saving Pack 4</a>
														</div>
														<div class="product_name">
														<select class="s-w form-control" id="na1q_qty0" onchange="get_price(this.value,'na10');">
                                                            <option value="6180">Combo Pack - Rs.2999.00 </option>
                                                          </select>
														</div>
															<!--<select class="form-control" id="sel1" style="height:40px; font-size:13px; width:100px">
															<option>combo pack-Rs.2999.00</option>
														  </select>-->
													<!--	<div class="price">
															<span class="sale">$2,009.00</span>
															
														</div>-->
													</div><!-- /.box-content -->
													
													<div class="box-bottom">
														<div class="btn-add-cart">
															<a href="#" title="">
																<img src="images/icons/add-cart.png" alt="">Add to Cart
															</a>
														</div>
														
													</div><!-- /.box-bottom -->
													
													
												</div><!-- /.imagebox -->
											</div>
											
										</div><!-- /.col-lg-4 col-sm-6 -->
										<?php } ?>
									</div>
									<div class="sort-box">
									<?php for($i=0; $i<5; $i++) {?>
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="single_product.php" title="">
														<img src="images/product/other/my.jpg" alt="" style="width:264px; height:210px">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="product-name">
														<a href="single_product.php" title="">Monthly Saving Pack 4</a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															Toor Dal - 2 kg, Urad Dal White - 500gm, Chana Dal - 500gm, Urad Gota Whole - 2kg,
															Bombay Rava - 500gm, Red Wheat - 500gm, Wheet Flour - 1kg, Chilli Powder - 250gm,
															Turmeric Powder -100gm, Jeera -100gm, Mustard Seeds - 250gm.

														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="product_name">
														<select class="s-w form-control" id="na1q_qty0" onchange="get_price(this.value,'na10');">
                                                            <option value="6180">Combo Pack - Rs.2999.00 </option>
                                                          </select>
														</div>
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
												</div><!-- /.box-price -->
											</div><!-- /.imagebox -->
										</div><!-- /.product-box -->
										<?php } ?>
										<div style="height: 9px;"></div>
									</div>
								</div>
							</div><!-- /.wrap-imagebox -->
							<div class="blog-pagination">
								<span>
									Showing 1–15 of 20 results
								</span>
								<ul class="flat-pagination style1">
									<li class="prev">
										<a href="#" title="">
											<img src="images/icons/left-1.png" alt="">Prev Page
										</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">01</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">02</a>
									</li>
									<li class="active">
										<a href="#" class="waves-effect" title="">03</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">04</a>
									</li>
									<li class="next">
										<a href="#" title="">
											Next Page<img src="images/icons/right-1.png" alt="">
										</a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div><!-- /.blog-pagination -->
						</div><!-- /.main-shop -->
					</div><!-- /.col-lg-9 col-md-8 -->
					
				</div><!-- /.row -->
				
			</div><!-- /.container -->
		</main><!-- /#shop -->
		<footer>
			<?php include_once 'footer.php';?>
		</footer><!-- /footer -->

		<section class="footer-bottom">
			<?php include_once 'footer_bottom.php';?>
		</section><!-- /.footer-bottom -->

	</div><!-- /.boxed -->

		<!-- Javascript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<script>
$(document).ready(function(){
    $(".btn-add-cart").click(function(){
        $("#div1").fadeIn(1000);
       
    });
});
</script>
</body>	
</html>