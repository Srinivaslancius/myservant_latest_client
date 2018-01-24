<?php include_once 'meta.php';?>
<style>
.owl-theme .owl-dots .owl-dot span {
    width: 13px;
    height: 13px;
    border-radius: 50%;
    border: 2px solid #ffffff;
    margin: 6px;
    display: block;
    position: relative;
    -webkit-backface-visibility: visible;
    -webkit-transition: opacity 200ms ease;
    -moz-transition: opacity 200ms ease;
    -ms-transition: opacity 200ms ease;
    -o-transition: opacity 200ms ease;
}
.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
    border-color: #ffffff;
}
.owl-theme .owl-dots .owl-dot.active span:after, .owl-theme .owl-dots .owl-dot:hover span:after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
  background-color: #ffffff;
    width: 5px;
    height: 5px;
    border-radius: 50%;
}
</style>
<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		<!-- Preloader -->
		<!-- <div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div> --><!-- /.preloader -->

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

		<section class="flat-row flat-slider">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="slider owl-carousel">
						<?php $getBanners = "SELECT * FROM grocery_banners WHERE lkp_status_id = 0";
						$getBannersData = $conn->query($getBanners); ?>
						<?php while($getBannersData1 = $getBannersData->fetch_assoc()) { ?>
							<div class="slider-item style2">
								<div class="item-image">
									<!--<div class="sale-off">
										60 % <span>sale</span>
									</div>-->
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt="">
								</div>
								<div class="clearfix"></div>
							</div><!-- /.slider -->
							<?php } ?>
						</div><!-- /.slider -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-slider -->
		
         <section class="flat-row flat-banner-box">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/3.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/4.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/3.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="#" title="">
									<img src="images/banner_boxes/4.jpg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-banner-box -->
<!-- /.flat-banner-box -->
<section class="flat-imagebox style2 background">
			<div class="container">

			<dl class="accordion">
<?php 
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
	$lkp_city_id = $getCities1['id'];
}
$getTags = "SELECT * FROM grocery_tags WHERE lkp_status_id = 0 AND id IN (SELECT tag_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id";
$tagNames = $conn->query($getTags);
?>

<?php while($tagNames1 = $tagNames->fetch_assoc()) { ?>
								
  <dt class="accordion__title"><?php echo $tagNames1['tag_name']; ?></dt>
  <dd class="accordion__content">
    <div class="row">
						<?php 
						$tag_id =  $tagNames1['id'];
						$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tag_id' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1)) ORDER BY id DESC LIMIT 0,6";
						$getProducts1 = $conn->query($getProducts);
						while($productDetails = $getProducts1->fetch_assoc()) { 
							$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails['id']);
							$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails['id']);
							$categoryName = getIndividualDetails('grocery_category','id',$productDetails['grocery_category_id']);
							$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							$allGetPrices = $conn->query($getPrices);
							$getPrc = $allGetPrices->fetch_assoc();
						?> 
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div class="imagebox">
									<span class="item-new">NEW</span>																		
											<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a>

									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a>
										</div>
									
										<div class="price">
											<span class="sale"><?php echo 'Rs : ' . $getPrc['selling_price']; ?></span>
												<span class="regular"><?php echo 'Rs : ' . $getPrc['mrp_price']; ?></span>
										</div>
									</div>
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										
									</div>
								</div>
							</div>								
						</div>
						<?php } ?>
					</div>
  </dd>
  <?php } ?>
</dl>
			</div>
			</section>


<?php 
$getCategoriesNames = "SELECT * FROM grocery_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_category_id FROM grocery_sub_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id LIMIT 0,5";
$getCategoriesNames1 = $conn->query($getCategoriesNames);
?>
<!--Tabbination for Most popular product starts here -->
<section class="flat-imagebox style2 background">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="product-wrap">
								<div class="product-tab style1">
									<ul class="tab-list">
										<?php while($getCategoriesNamesData = $getCategoriesNames1->fetch_assoc()) { ?>
										<li class="<?php if($getCategoriesNamesData['id'] == 1) { echo 'active'; } ?>"><?php echo $getCategoriesNamesData['category_name']; ?></li>
										<?php } ?>
									</ul><!-- /.tab-list -->
								</div><!-- /.product-tab style1 -->
								<div class="tab-item">
									<div class="row">
										<?php 
											$products = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = 3 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1) ORDER BY id DESC LIMIT 0,6";
										$products1 = $conn->query($products);
										while($productsData = $products1->fetch_assoc()) { 
											$ProductName1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productsData['id']);
											$ProductImage1 = getIndividualDetails('grocery_product_bind_images','product_id',$productsData['id']);
											$category1 = getIndividualDetails('grocery_category','id',$productsData['grocery_category_id']);
											$prices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
											$allprices1 = $conn->query($prices);
											$Prc1 = $allprices1->fetch_assoc();
										?>	
										<div class="box-6">
											<div class="product-box">
												<div class="imagebox style2  v1">
													<div class="box-image">
														<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title="">
															<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$ProductImage1['image']; ?>" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $category1['category_name']; ?></a>
														</div>
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $ProductName1['product_name']; ?></a>
														</div>
														<div class="price">
															<span class="sale"><?php echo 'Rs : ' . $Prc1['selling_price']; ?></span>
															<span class="regular"><?php echo 'Rs : ' . $Prc1['mrp_price']; ?></span>
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
											</div><!-- /.product-box line style1 -->
										</div><!-- /.box-6 -->
										<?php } ?>
									</div><!-- /.row -->
									<div class="row">
										<?php 
											$products = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = 6 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1) ORDER BY id DESC LIMIT 0,6";
										$products1 = $conn->query($products);
										while($productsData = $products1->fetch_assoc()) { 
											$ProductName1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productsData['id']);
											$ProductImage1 = getIndividualDetails('grocery_product_bind_images','product_id',$productsData['id']);
											$category1 = getIndividualDetails('grocery_category','id',$productsData['grocery_category_id']);
											$prices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
											$allprices1 = $conn->query($prices);
											$Prc1 = $allprices1->fetch_assoc();
										?>	
										<div class="box-6 <?php if($productsData['id'] == 3) { echo 'big'; } ?>">
											<div class="product-box line style1">
												<div class="imagebox style2">
													<div class="box-image">
														<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title="">
															<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$ProductImage1['image']; ?>" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $category1['category_name']; ?></a>
														</div>
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $ProductName1['product_name']; ?></a>
														</div>
														<div class="price">
															<span class="sale"><?php echo 'Rs : ' . $Prc1['selling_price']; ?></span>
															<span class="regular"><?php echo 'Rs : ' . $Prc1['mrp_price']; ?></span>
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
											</div><!-- /.product-box line style1 -->
										</div><!-- /.box-6 -->
										<?php } ?>
									</div><!-- /.row -->
									<div class="row">
										<?php 
											$products = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = 8 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1) ORDER BY id DESC LIMIT 0,6";
										$products1 = $conn->query($products);
										while($productsData = $products1->fetch_assoc()) { 
											$ProductName1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productsData['id']);
											$ProductImage1 = getIndividualDetails('grocery_product_bind_images','product_id',$productsData['id']);
											$category1 = getIndividualDetails('grocery_category','id',$productsData['grocery_category_id']);
											$prices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
											$allprices1 = $conn->query($prices);
											$Prc1 = $allprices1->fetch_assoc();
										?>	
										<div class="box-6 <?php if($productsData['id'] == 3) { echo 'big'; } ?>">
											<div class="product-box line style1">
												<div class="imagebox style2">
													<div class="box-image">
														<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title="">
															<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$ProductImage1['image']; ?>" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $category1['category_name']; ?></a>
														</div>
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $ProductName1['product_name']; ?></a>
														</div>
														<div class="price">
															<span class="sale"><?php echo 'Rs : ' . $Prc1['selling_price']; ?></span>
															<span class="regular"><?php echo 'Rs : ' . $Prc1['mrp_price']; ?></span>
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
											</div><!-- /.product-box line style1 -->
										</div><!-- /.box-6 -->
										<?php } ?>
									</div><!-- /.row -->
									<div class="row">
										<?php 
											$products = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = 9 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1) ORDER BY id DESC LIMIT 0,6";
										$products1 = $conn->query($products);
										while($productsData = $products1->fetch_assoc()) { 
											$ProductName1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productsData['id']);
											$ProductImage1 = getIndividualDetails('grocery_product_bind_images','product_id',$productsData['id']);
											$category1 = getIndividualDetails('grocery_category','id',$productsData['grocery_category_id']);
											$prices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
											$allprices1 = $conn->query($prices);
											$Prc1 = $allprices1->fetch_assoc();
										?>	
										<div class="box-6 <?php if($productsData['id'] == 3) { echo 'big'; } ?>">
											<div class="product-box line style1">
												<div class="imagebox style2">
													<div class="box-image">
														<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title="">
															<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$ProductImage1['image']; ?>" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $category1['category_name']; ?></a>
														</div>
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $ProductName1['product_name']; ?></a>
														</div>
														<div class="price">
															<span class="sale"><?php echo 'Rs : ' . $Prc1['selling_price']; ?></span>
															<span class="regular"><?php echo 'Rs : ' . $Prc1['mrp_price']; ?></span>
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
											</div><!-- /.product-box line style1 -->
										</div><!-- /.box-6 -->
										<?php } ?>
									</div><!-- /.row -->
									<div class="row">
										<?php 
											$products = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = 10 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1) ORDER BY id DESC LIMIT 0,6";
										$products1 = $conn->query($products);
										while($productsData = $products1->fetch_assoc()) { 
											$ProductName1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productsData['id']);
											$ProductImage1 = getIndividualDetails('grocery_product_bind_images','product_id',$productsData['id']);
											$category1 = getIndividualDetails('grocery_category','id',$productsData['grocery_category_id']);
											$prices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
											$allprices1 = $conn->query($prices);
											$Prc1 = $allprices1->fetch_assoc();
										?>	
										<div class="box-6 <?php if($productsData['id'] == 3) { echo 'big'; } ?>">
											<div class="product-box line style1">
												<div class="imagebox style2">
													<div class="box-image">
														<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title="">
															<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$ProductImage1['image']; ?>" alt="">
														</a>
													</div><!-- /.box-image -->
													<div class="box-content">
														<div class="cat-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $category1['category_name']; ?></a>
														</div>
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $productsData['id']; ?>" title=""><?php echo $ProductName1['product_name']; ?></a>
														</div>
														<div class="price">
															<span class="sale"><?php echo 'Rs : ' . $Prc1['selling_price']; ?></span>
															<span class="regular"><?php echo 'Rs : ' . $Prc1['mrp_price']; ?></span>
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
											</div><!-- /.product-box line style1 -->
										</div><!-- /.box-6 -->
										<?php } ?>
									</div><!-- /.row -->
									
									
								</div><!-- /.tab-item -->
							</div><!-- /.product-wrap -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-imagebox -->
			<script type="text/javascript" src="javascript/jquery.min.js"></script>
			<?php 
		if($_SESSION['city_name'] == '') {
            $lkp_city_id = 1;
        } else {
            $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
			$lkp_city_id = $getCities1['id'];
        }
		$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND deal_start_date != '0000-00-00' AND deal_end_date != '0000-00-00' AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)";
		$productDetails = $conn->query($getProducts); 
		if($productDetails->num_rows > 0) {
		?>
            <section class="flat-imagebox style3">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-2">
						<?php 
							while($productDetails1 = $productDetails->fetch_assoc()) { 
							$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails1['id']);
							$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails1['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
						 	$allGetPrices = $conn->query($getPrices);
						 	$getPrc1 = $allGetPrices->fetch_assoc();
						 	$deal_start_date = $productDetails1['deal_start_date'];
						 	$deal_end_date = date_create($productDetails1['deal_end_date']);
						 	$getSetFormat = date_format($deal_end_date,"Y/m/d");
						?>

						<script type="text/javascript">
						(function(factory) {
						    "use strict";
						    if (typeof define === "function" && define.amd) {
						        define(["jquery"], factory);
						    } else {
						        factory(jQuery);
						    }
						})(function($) {
							//alert();
						    "use strict";
						    var instances = [],
						        matchers = [],
						        defaultOptions = {
						            precision: 100,
						            elapse: true,
						            defer: false
						        };
						    matchers.push(/^[0-9]*$/.source);
						    matchers.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
						    matchers.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
						    matchers = new RegExp(matchers.join("|"));

						    function parseDateString(dateString) {
						    	//alert(dateString);
						        if (dateString instanceof Date) {
						            return dateString;
						        }
						        if (String(dateString).match(matchers)) {
						            if (String(dateString).match(/^[0-9]*$/)) {
						                dateString = Number(dateString);
						            }
						            if (String(dateString).match(/\-/)) {
						                dateString = String(dateString).replace(/\-/g, "/");
						            }
						            return new Date(dateString);
						        } else {
						            throw new Error("Couldn't cast `" + dateString + "` to a date object.");
						        }
						    }
					    var DIRECTIVE_KEY_MAP = {
					        Y: "years",
					        m: "months",
					        n: "daysToMonth",
					        d: "daysToWeek",
					        w: "weeks",
					        W: "weeksToMonth",
					        H: "hours",
					        M: "minutes",
					        S: "seconds",
					        D: "totalDays",
					        I: "totalHours",
					        N: "totalMinutes",
					        T: "totalSeconds"
					    };

					    function escapedRegExp(str) {
					        var sanitize = str.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
					        return new RegExp(sanitize);
					    }

					    function strftime(offsetObject) {
					        return function(format) {
					            var directives = format.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
					            if (directives) {
					                for (var i = 0, len = directives.length; i < len; ++i) {
					                    var directive = directives[i].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
					                        regexp = escapedRegExp(directive[0]),
					                        modifier = directive[1] || "",
					                        plural = directive[3] || "",
					                        value = null;
					                    directive = directive[2];
					                    if (DIRECTIVE_KEY_MAP.hasOwnProperty(directive)) {
					                        value = DIRECTIVE_KEY_MAP[directive];
					                        value = Number(offsetObject[value]);
					                    }
					                    if (value !== null) {
					                        if (modifier === "!") {
					                            value = pluralize(plural, value);
					                        }
					                        if (modifier === "") {
					                            if (value < 10) {
					                                value = "0" + value.toString();
					                            }
					                        }
					                        format = format.replace(regexp, value.toString());
					                    }
					                }
					            }
					            format = format.replace(/%%/, "%");
					            return format;
					        };
					    }

							    function pluralize(format, count) {
							        var plural = "s",
							            singular = "";
							        if (format) {
							            format = format.replace(/(:|;|\s)/gi, "").split(/\,/);
							            if (format.length === 1) {
							                plural = format[0];
							            } else {
							                singular = format[0];
							                plural = format[1];
							            }
							        }
							        if (Math.abs(count) > 1) {
							            return plural;
							        } else {
							            return singular;
							        }
							    }
							    var Countdown = function(el, finalDate, options) {
							        this.el = el;
							        this.$el = $(el);
							        this.interval = null;
							        this.offset = {};
							        this.options = $.extend({}, defaultOptions);
							        this.instanceNumber = instances.length;
							        instances.push(this);
							        this.$el.data("countdown-instance", this.instanceNumber);
							        if (options) {
							            if (typeof options === "function") {
							                this.$el.on("update.countdown", options);
							                this.$el.on("stoped.countdown", options);
							                this.$el.on("finish.countdown", options);
							            } else {
							                this.options = $.extend({}, defaultOptions, options);
							            }
							        }
							        this.setFinalDate('<?php echo $getSetFormat; ?>');
							        //alert('<?php echo $getSetFormat; ?>');
							        if (this.options.defer === false) {
							            this.start();
							        }
							    };
							    $.extend(Countdown.prototype, {
							        start: function() {
							            if (this.interval !== null) {
							                clearInterval(this.interval);
							            }
							            var self = this;
							            this.update();
							            this.interval = setInterval(function() {
							                self.update.call(self);
							            }, this.options.precision);
							        },
							        stop: function() {
							            clearInterval(this.interval);
							            this.interval = null;
							            this.dispatchEvent("stoped");
							        },
							        toggle: function() {
							            if (this.interval) {
							                this.stop();
							            } else {
							                this.start();
							            }
							        },
							        pause: function() {
							            this.stop();
							        },
							        resume: function() {
							            this.start();
							        },
							        remove: function() {
							            this.stop.call(this);
							            instances[this.instanceNumber] = null;
							            delete this.$el.data().countdownInstance;
							        },
							        setFinalDate: function(value) {
							            this.finalDate = parseDateString(value);
							        },
							        update: function() {
							            if (this.$el.closest("html").length === 0) {
							                this.remove();
							                return;
							            }
							            var hasEventsAttached = $._data(this.el, "events") !== undefined,
							                now = new Date(),
							                newTotalSecsLeft;
							            newTotalSecsLeft = this.finalDate.getTime() - now.getTime();
							            newTotalSecsLeft = Math.ceil(newTotalSecsLeft / 1e3);
							            newTotalSecsLeft = !this.options.elapse && newTotalSecsLeft < 0 ? 0 : Math.abs(newTotalSecsLeft);
							            if (this.totalSecsLeft === newTotalSecsLeft || !hasEventsAttached) {
							                return;
							            } else {
							                this.totalSecsLeft = newTotalSecsLeft;
							            }
							            this.elapsed = now >= this.finalDate;
							            this.offset = {
							                seconds: this.totalSecsLeft % 60,
							                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
							                hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
							                days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
							                daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
							                daysToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 % 30.4368),
							                weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
							                weeksToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7) % 4,
							                months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
							                years: Math.abs(this.finalDate.getFullYear() - now.getFullYear()),
							                totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
							                totalHours: Math.floor(this.totalSecsLeft / 60 / 60),
							                totalMinutes: Math.floor(this.totalSecsLeft / 60),
							                totalSeconds: this.totalSecsLeft
							            };
							            if (!this.options.elapse && this.totalSecsLeft === 0) {
							                this.stop();
							                this.dispatchEvent("finish");
							            } else {
							                this.dispatchEvent("update");
							            }
							        },
							        dispatchEvent: function(eventName) {
							            var event = $.Event(eventName + ".countdown");
							            event.finalDate = this.finalDate;
							            event.elapsed = this.elapsed;
							            event.offset = $.extend({}, this.offset);
							            event.strftime = strftime(this.offset);
							            this.$el.trigger(event);
							        }
							    });
							    $.fn.countdown = function() {
							        var argumentsArray = Array.prototype.slice.call(arguments, 0);
							        return this.each(function() {
							            var instanceNumber = $(this).data("countdown-instance");
							            if (instanceNumber !== undefined) {
							                var instance = instances[instanceNumber],
							                    method = argumentsArray[0];
							                if (Countdown.prototype.hasOwnProperty(method)) {
							                    instance[method].apply(instance, argumentsArray.slice(1));
							                } else if (String(method).match(/^[$A-Z_][0-9A-Z_$]*$/i) === null) {
							                    instance.setFinalDate.call(instance, method);
							                    instance.start();
							                } else {
							                    $.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, method));
							                }
							            } else {
							                new Countdown(this, argumentsArray[0], argumentsArray[1]);
							            }
							        });
							    };
							});
						</script>
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
		<?php } ?>     
			<div class="divider20"></div>
 	<section class="flat-imagebox style4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="flat-row-title">
							<h3>Our Brands</h3>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="owl-carousel-3">
						<?php $getAllBrandLogos=  getAllDataWithStatus('grocery_brand_logos',0); 
						while($getBrandLogosData = $getAllBrandLogos->fetch_assoc()) { ?>
						
							<div class="imagebox style4">
								<div class="box-image">
									<a href="<?php echo $getBrandLogosData['link'] ?>" title="">
										<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_brand_logos/'.$getBrandLogosData['brand_logo'] ?>" alt="<?php echo $getBrandLogosData['link'] ?>">
									</a>
								</div><!-- /.box-image -->
								
							</div><!-- /.imagebox style4 -->
							<?php } ?>
							
						</div><!-- /.owl-carousel-3 -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style4 -->
 		<div class="divider20"></div>

<?php $getFreeShippingData = getIndividualDetails('grocery_content_pages','id',4);

$getOnlineOrderData = getIndividualDetails('grocery_content_pages','id',5);

$getPaymentsData = getIndividualDetails('grocery_content_pages','id',6);

$getReturnPolicydataData = getIndividualDetails('grocery_content_pages','id',7);
?>
		<section class="flat-iconbox">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getFreeShippingData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getFreeShippingData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getFreeShippingData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getOnlineOrderData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getOnlineOrderData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getOnlineOrderData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getPaymentsData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getPaymentsData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getPaymentsData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getReturnPolicydataData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getReturnPolicydataData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getReturnPolicydataData['description']; ?></p>
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
	   	

		<script type="text/javascript" src="javascript/main.js"></script>
<script>
		if($(window).width() > 768){

// Hide all but first tab content on larger viewports
$('.accordion__content:not(:first)').hide();

// Activate first tab
$('.accordion__title:first-child').addClass('active');

} else {
  
// Hide all content items on narrow viewports
$('.accordion__content').hide();
};

// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
$( ".accordion__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

// The clicking action
$('.accordion__title').on('click', function() {	
$('.accordion__content').hide();
$(this).next().show().prev().addClass('active').siblings().removeClass('active');
});

</script>
		
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


</body>	
</html>