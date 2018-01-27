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
									</form>
									<div class="checkbox">
										<input type="checkbox" id="popup-not-show" name="category">
										<label for="popup-not-show">Don't show this popup again</label>
									</div>
								</div>
							</div>
							<div class="popup-image">
								<img src="images/banner_boxes/popup.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						
					</div>
				</div>
			</div>
		</div>

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
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="slider owl-carousel-11">
								<?php $getBanners = "SELECT * FROM grocery_banners WHERE lkp_status_id = 0";
								$getBannersData = $conn->query($getBanners);
								while($getBannersData1 = $getBannersData->fetch_assoc()) { 
									if($getBannersData1['type'] == 1) {
										$banner_id = $getBannersData1['category_id'];
									} else {
										$banner_id = $getBannersData1['sub_category_id'];
									}
								if($getBannersData1['banner_image_type'] == 1) { ?>
								<div class="slider-item style1">
									<div class="item-image">
										<a href="results.php?id=<?php echo $getBannersData1['id']; ?>"><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt=""></a>
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } else { ?>
								<div class="slider-item style1">
									<div class="item-image">
										<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } } ?>
							</div>
						</div>
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
								<a href="http://testproject.cmrenterprises.co.in/grcry/food_new/index.php" title="" target="_blank">
									<img src="images/banner_boxes/6.jpeg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="http://testproject.cmrenterprises.co.in/grcry/Services/index.php" title="" target="_blank">
									<img src="images/banner_boxes/5.jpeg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-banner-box -->
                
<?php 
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
	$lkp_city_id = $getCities1['id'];
}
$getTags = "SELECT * FROM grocery_tags WHERE lkp_status_id = 0 AND id IN (SELECT tag_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC LIMIT 0,4";
$tagNames = $conn->query($getTags);
?>

<?php while($tagNames1 = $tagNames->fetch_assoc()) { ?>
		<section class="flat-imagebox">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="product-tab style2">
								<ul class="tab-list">
									<li class="active"><?php echo $tagNames1['tag_name']; ?></li>
									
								</ul>
							</div><!-- /.product-tab -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
					<div class="box-product">
						<div class="row">
                             <?php 
                            	$tagId= $tagNames1['id'];
								$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = 1)) ORDER BY id DESC LIMIT 0,8";
									$getProducts1 = $conn->query($getProducts);
								while($productDetails = $getProducts1->fetch_assoc()) { 
									$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails['id']);
									$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails['id']);
									$categoryName = getIndividualDetails('grocery_category','id',$productDetails['grocery_category_id']);
									$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
									$allGetPrices1 = $conn->query($getPrices1);
									$getPrc1 = $allGetPrices1->fetch_assoc();
								?>
							<div class="col-sm-6 col-lg-3">
								<div class="product-box style4">
									<div id="div1" class="popup_<?php echo $productDetails['id']; ?>">
										<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
										<p style="color:white">Product Name : <?php echo $getProductName['product_name']; ?></p>
									</div>
									<div class="imagebox">
										<span class="item-new">NEW</span>
										<div class="box-image">
											<a href="#" title="">
												<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="">
											</a>
											
										</div><!-- /.box-image -->
										<div class="box-content">
											<div class="cat-name">
												<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $categoryName['category_name']; ?></a>
											</div>
											<div class="product-name">
												<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a>
											</div>
											<div class="product_name">
											<?php 
											$prodid = $productDetails['id'];
									 		$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='$prodid' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
									 		$allGetPrices = $conn->query($getPrices);
							 				?>
												<select onchange="get_price(this.value,'na10');" id="get_pr_price_<?php echo $prodid; ?>" class="s-w form-control" data-product-id="<?php echo $prodid; ?>">
												<?php while($getPrc = $allGetPrices->fetch_assoc() ) { ?>
			                                      <option value="<?php echo $getPrc['id']; ?>,<?php echo $getPrc['selling_price']; ?>"><?php echo $getPrc['weight_type']; ?> - Rs.<?php echo $getPrc['selling_price']; ?> </option>
			                                    <?php } ?>								  
			                                    </select>
											</div>
										
											<div class="price_<?php echo $productDetails['id']; ?>">
												<span class="sale"><?php echo 'Rs : ' . $getPrc1['selling_price']; ?></span>
												<?php if($getPrc1['offer_type'] == 1) { ?>
													<span class="regular"><?php echo 'Rs : ' . $getPrc1['mrp_price']; ?></span>
												<?php } ?>
											</div>
										</div><!-- /.box-content -->
										<div class="box-bottom">
										<div class="row">
										<div class="col-sm-5 col-xs-12">
										<div class="quanlity">
										<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity"type="number" style="height:45px">
											</div>							
										</div>
										<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
											<div class="btn-add-cart mrgn_lft">
												<a href="#" title="" onClick="show_cart(<?php echo $productDetails['id']; ?>)" style="width:115%">
													<img src="images/icons/add-cart.png" alt="">Add to Cart
												</a>
											</div>
											</div>
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
								
							</div><!-- /.col-sm-6 col-lg-3 -->
							<?php } ?>
						</div><!-- /.row -->
						
					</div><!-- /.box-product -->
					<div class="divider10"></div>
				</div><!-- /.container -->
		</section><!-- /.flat-imagebox -->
<?php } ?>

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
								<a href="http://testproject.cmrenterprises.co.in/grcry/food_new/index.php" title="" target="_blank">
									<img src="images/banner_boxes/6.jpeg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="http://testproject.cmrenterprises.co.in/grcry/Services/index.php" title="" target="_blank">
									<img src="images/banner_boxes/5.jpeg" alt="" width="360px" height="200px">
								</a>
							</div><!-- /.inner-box -->
						</div><!-- /.banner-box -->
					</div><!-- /.col-md-4 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-banner-box -->

<?php 
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
	$lkp_city_id = $getCities1['id'];
}
$getsubCats = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND make_it_popular=1 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC LIMIT 0,6";
$getSubCat = $conn->query($getsubCats);
?>

<section class="flat-imagebox style2 background">
	<div class="container">
		<dl class="accordion1">
		<?php while($getSubCatnames = $getSubCat->fetch_assoc()) { ?>
		  <dt class="accordion__title1"><?php echo $getSubCatnames['sub_category_name']; ?></dt>
		  <dd class="accordion__content1">
    		<div class="row">
						<?php 
							$subCAtId = $getSubCatnames['id'];
							$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id ='$subCAtId' ORDER BY id DESC LIMIT 0,8";
							$getProducts1 = $conn->query($getProducts);
							while($productDetails = $getProducts1->fetch_assoc()) { 
							$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails['id']);
							$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails['id']);
							$categoryName = getIndividualDetails('grocery_category','id',$productDetails['grocery_category_id']);
							$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							$allGetPrices1 = $conn->query($getPrices1);
							$getPrc1 = $allGetPrices1->fetch_assoc();
						?>
						<div class="col-lg-3 col-sm-6">
							<div class="product-box">
								<div id="div1" class="popup_<?php echo $productDetails['id']; ?>">
									<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
									<p style="color:white">Product Name : <?php echo $getProductName['product_name']; ?></p>
								</div>
								<div class="imagebox">
									<span class="item-new">NEW</span>																		
											<a href="single_product.php" title="">
												<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="">
											</a>																													
									<div class="box-content">
										<div class="cat-name">
											<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a>
										</div>
										<div class="product_name">
											<?php 
											$prodid = $productDetails['id'];
									 		$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='$prodid' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
									 		$allGetPrices = $conn->query($getPrices);
							 				?>
											<select onchange="get_price(this.value,'na10');" id="get_pr_price_<?php echo $prodid; ?>" class="s-w form-control" data-product-id="<?php echo $prodid; ?>">
											<?php while($getPrc = $allGetPrices->fetch_assoc() ) { ?>
		                                      <option value="<?php echo $getPrc['id']; ?>,<?php echo $getPrc['selling_price']; ?>"><?php echo $getPrc['weight_type']; ?> - Rs.<?php echo $getPrc['selling_price']; ?> </option>
		                                    <?php } ?>								  
		                                    </select>
										</div>
										<div class="price_<?php echo $productDetails['id']; ?>">
											<span class="sale"><?php echo 'Rs : ' . $getPrc1['selling_price']; ?></span>
											<?php if($getPrc1['offer_type'] == 1) { ?>
												<span class="regular"><?php echo 'Rs : ' . $getPrc1['mrp_price']; ?></span>
											<?php } ?>
										</div>
									</div>
									<div class="box-bottom">
										<div class="btn-add-cart">
											<a href="#" title="" onClick="show_cart(<?php echo $productDetails['id']; ?>)">
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

<?php $getTodayDeals = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND deal_start_date = CURDATE() AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)";
$getTodayDeals1 = $conn->query($getTodayDeals);
if($getTodayDeals1->num_rows > 0) { ?>
		<section class="flat-imagebox style1">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					
						<div class="flat-row-title">
						<div class="row">
						<div class="col-md-2">
							<h3>Today Deals</h3>
						</div>
							<div class="col-md-10">
						<div class="counter">									
									<div class="counter-content">										
										<div class="count-down">											
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
								</div>
								</div>
								</div>
						

					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="row ">
					<div class="col-md-12 owl-carousel-10">
                       <?php while($todayDeals = $getTodayDeals1->fetch_assoc()) {
                       	$getCategoryName = getIndividualDetails('grocery_category','id',$todayDeals['grocery_category_id']);
                   		$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$todayDeals['id']);
                   		$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$todayDeals['id']);
                   		?>
						<div class="owl-carousel-item">
                        <input type="hidden" id="deal_date" value="<?php echo $todayDeals['deal_start_date'];?>">     
						<div class="product-box style1">
							<div id="div1" class="popup_<?php echo $todayDeals['id']; ?>">
								<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
								<p style="color:white">Product Name : <?php echo $getProductName['product_name']; ?></p>
							</div>
								<div class="imagebox style1">
									<div class="box-image">
										<a href="#" title="">
											<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'] ?>" alt="">
										</a>
									</div><!-- /.box-image -->
									<div class="box-content">
										<div class="cat-name">
											<a href="#" title=""><?php echo $getCategoryName['category_name']; ?></a>
										</div>
										<div class="product-name">
											<a href="#" title=""><?php echo $getProductName['product_name']; ?></a>
										</div>
										<?php 
										 	$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$todayDeals['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										 	$allGetPrices = $conn->query($getPrices);
										 ?>
										<div class="product_name">
										<select class="s-w form-control" id="get_pr_price_<?php echo $prodid; ?>" onchange="get_price(this.value,'na10');" data-product-id="<?php echo $prodid; ?>">
											<?php while($getPrc = $allGetPrices->fetch_assoc() ) { ?>
                                            <option value="<?php echo $getPrc['id']; ?>,<?php echo $getPrc['selling_price']; ?>"><?php echo $getPrc['weight_type']; ?> - Rs.<?php echo $getPrc['selling_price']; ?> </option>
	                                    <?php } ?>
                                          </select>
										</div>
										<?php 
										 	$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$todayDeals['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										 	$allGetPrices = $conn->query($getPrices);
										 	$getPrc1 = $allGetPrices->fetch_assoc();
										 ?>
										<div class="price_<?php echo $todayDeals['id']; ?>">
											<span class="regular"><?php echo 'Rs.' . $getPrc1['mrp_price']; ?></span>
											<span class="sale"><?php echo 'Rs.' . $getPrc1['selling_price'] . '.00'; ?></span>
										</div>
									</div><!-- /.box-content -->
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
											<a href="#" title="" onClick="show_cart(<?php echo $todayDeals['id']; ?>)">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
									</div><!-- /.box-bottom -->
								</div><!-- /.imagebox style1 -->
							</div><!-- /.product-box style1 -->
							
						</div><!-- /.owl-carousel-item -->
                      <?php } ?>
					</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-imagebox style1 -->
		<?php } ?>

		
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

<?php 
	$getFreeShippingData = getIndividualDetails('grocery_content_pages','id',4);
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
		<script type="text/javascript" src="javascript/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/tether.min.js"></script>
		<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
		<script type="text/javascript" src="javascript/waypoints.min.js"></script>
		<!-- <script type="text/javascript" src="javascript/jquery.circlechart.js"></script> -->
		<script type="text/javascript" src="javascript/easing.js"></script>
<script type="text/javascript" src="javascript/jquery.zoom.min.js"></script>
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
	
	
<script>
		if($(window).width() > 768){

		// Hide all but first tab content on larger viewports
		$('.accordion__content1:not(:first)').hide();

		// Activate first tab
		$('.accordion__title1:first-child').addClass('active');

		} else {
		  
		// Hide all content items on narrow viewports
		$('.accordion__content1').hide();
		};

		// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
		$( ".accordion__content1" ).wrapInner( "<div class='overflow-scrolling'></div>" );

		// The clicking action
		$('.accordion__title1').on('click', function() {
		$('.accordion__content1').hide();
		$(this).next().show().prev().addClass('active').siblings().removeClass('active');
		});


		</script>
		<script type="text/javascript">
			function get_price(product_id) {
				//alert(product_id);
				var pro_id = $('#get_pr_price_'+product_id).data("product-id");
				alert(pro_id);
				$.ajax({
				  type:'post',
				  url:'get_price.php',
				  data:{
				     product_id:product_id,       
				  },
				  success:function(data) {
				    //alert(data);
				    $('.price_'+product_id).html(data);
				  }
				});
			}
			function show_cart(ProductId) {
				var catId = $('#cat_id_'+ProductId).val();
				var subCatId = $('#sub_cat_id_'+ProductId).val();
				var productName = $('#pro_name_'+ProductId).val();
				var product = $('#get_pr_price_'+ProductId).val();
				var split = product.split(",");
				var productWeightType = split[0];
				var productPrice = split[1];
				var product_quantity = 1;

	   			$.ajax({
			      type:'post',
			      url:'save_cart.php',
			      data:{		        
			        productId:ProductId,catId:catId,subCatId:subCatId,product_name:productName,productPrice:productPrice,productWeightType:productWeightType,product_quantity:product_quantity,
			      },
			      success:function(response) {
			      	//window.location.href = "shop_cart.php";
			      	$(".popup_"+ProductId).fadeIn(1000);
			      	setTimeout(function() {
					    $(".popup_"+ProductId).fadeOut('fast');
					}, 2000);
			      }
			    });
			    $.ajax({
				  type:'post',
				  url:'header_cart_page.php',
				  data:{
				     cart_id:ProductId,
				  },
				  success:function(data) {
				    $('.header_cart').html(data);
				  }

				 });
			}
		</script>
</body>	
</html>