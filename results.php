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
		<?php 
		if($_SESSION['city_name'] == '') {
            $lkp_city_id = 1;
        } else {
            $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
            $lkp_city_id = $getCities1['id'];
        }
        if ($_GET['id']) {
        	$id = $_GET['id'];
        	$offerProducts = getIndividualDetails('grocery_banners','id',$id);
	        $min_percentage = $offerProducts['min_percentage'];
	        $max_percentage = $offerProducts['max_percentage'];
	        $type = $offerProducts['type'];
	        $offer_type = $offerProducts['banner_image_type'];
        } elseif ($_GET['offer_id']) {
        	$id = $_GET['offer_id'];
        	$offerProducts = getIndividualDetails('grocery_offer_module','id',$id);
		    $min_percentage = $offerProducts['min_offer_percentage'];
		    $max_percentage = $offerProducts['max_offer_percentage'];
		    $type = $offerProducts['offer_level'];
		    $offer_type = $offerProducts['offer_type'];
        }
        $category_id = $offerProducts['category_id'];
        $sub_category_id = $offerProducts['sub_category_id'];
        if($id) {
        	if($offer_type == 1) {
        		$offer_percentage = ' AND (offer_percentage BETWEEN '.$min_percentage.' AND '.$max_percentage.')';
        	} else {
        		$offer_percentage = '';
        	}
        	if($type == 1) {
        		$getCategories = getIndividualDetails('grocery_category','id',$category_id);
				$getName = $getCategories['category_name'];
        		$getProducts = "SELECT * from grocery_products WHERE grocery_category_id = '$category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage) ORDER BY id DESC";
				$getProducts1 = $conn->query($getProducts);
				$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_category_id = '$category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage) ORDER BY id DESC";
				$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
        	} else {
        		$getSubCategories = getIndividualDetails('grocery_sub_category','id',$sub_category_id);
				$getName = $getSubCategories['sub_category_name'];
				$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = '$sub_category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage) ORDER BY id DESC";
				$getProducts1 = $conn->query($getProducts);
				$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_sub_category_id = '$sub_category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage) ORDER BY id DESC";
				$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
        	}
		} elseif($category_id = $_GET['cat_id']) {
			$getProducts = getIndividualDetails('grocery_category','id',$category_id);
			$getName = $getProducts['category_name'];
			$getProducts = "SELECT * from grocery_products WHERE grocery_category_id = $category_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC";
			$getProducts1 = $conn->query($getProducts);
			$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_category_id = $category_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC";
			$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
		} elseif($sub_category_id = $_GET['sub_cat_id']) {
			$getProducts = getIndividualDetails('grocery_sub_category','id',$sub_category_id);
			$getName = $getProducts['sub_category_name'];
			$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = $sub_category_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC";
			$getProducts1 = $conn->query($getProducts);
			$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_sub_category_id = $sub_category_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC";
			$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
		} elseif(isset($_GET['brand_id'])) {
			$brand_id = $_GET['brand_id'];
			$getBrands = getIndividualDetails('grocery_brands','id',$brand_id);
			$getName = $getBrands['brand_name'];
			$getProducts = "SELECT grocery_product_bind_brands.brand_id,grocery_product_bind_brands.product_id, grocery_products.id,grocery_products.grocery_category_id,grocery_products.grocery_sub_category_id,grocery_products.product_description,grocery_products.lkp_status_id FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id AND grocery_product_bind_brands.brand_id = '$brand_id' WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC";
			$getProducts1 = $conn->query($getProducts);
			$getProductsTotalDetails = "SELECT grocery_product_bind_brands.brand_id,grocery_product_bind_brands.product_id, grocery_products.id,grocery_products.grocery_category_id,grocery_products.grocery_sub_category_id,grocery_products.product_description,grocery_products.lkp_status_id FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id AND grocery_product_bind_brands.brand_id = '$brand_id' WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC";
			$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
		} elseif(isset($_GET['tagId'])) {
			$tagId = $_GET['tagId'];
			$getTags = getIndividualDetails('grocery_tags','id',$tagId);
			$getName = $getTags['tag_name'];
			$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC";
			$getProducts1 = $conn->query($getProducts);
			$getProductsTotalDetails = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC";
			$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
		}
		//echo $getProducts;
		?>
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="index.php" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<?php if(isset($category_id) && !empty($category_id)) { 
								$getCategories = getIndividualDetails('grocery_category','id',$category_id);
								$getCategoryName = $getCategories['category_name']; ?>
							<li class="trail-item">
								<?php echo $getCategoryName; ?>
							</li>
							<?php } elseif(isset($sub_category_id) && !empty($sub_category_id)) { 
								$getSubCategories = getIndividualDetails('grocery_sub_category','id',$sub_category_id);
								$getSubCategoryName = $getSubCategories['sub_category_name'];
								$getCategories = getIndividualDetails('grocery_category','id',$getSubCategories['grocery_category_id']);
								$getCategoryName = $getCategories['category_name'];
								?>
							<li class="trail-item">
								<a href="results.php?cat_id=<?php echo $getSubCategories['grocery_category_id'] ?>" title=""><?php echo $getCategoryName; ?></a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<?php echo $getSubCategoryName; ?>
							</li>
							<?php } elseif(isset($_GET['brand_id'])) { ?>
							<li class="trail-item">
								<?php echo $getBrands['brand_name']; ?>
							</li>
							<?php } elseif(isset($_GET['tagId'])) { ?>
							<li class="trail-item">
								<?php echo $getTags['tag_name']; ?>
							</li>
							<?php } ?>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<?php if($getProducts1->num_rows > 0) { ?>
		<main id="shop">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4"><br>
						<?php include_once 'filter_new.php'; ?>
						<!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<div class="main-shop">
							
							<div class="wrap-imagebox">
								<div class="flat-row-title">
									<h3><?php echo $getName; ?></h3>
									<!-- <span>
										Showing 1–15 of 20 results
									</span> -->
									<div class="clearfix"></div>
								</div>
								<div class="sort-product">
									<ul class="icons">
										<li class="list-1">
											<img src="images/icons/list-1.png" alt="">
										</li>
										<li class="list-2">
											<img src="images/icons/list-2.png" alt="">
										</li>
									</ul>
									<div class="sort">
										<form id="popularity">
											<?php if($_GET['cat_id']) { ?>
												<input type="hidden" name="category_id" value="<?php echo $_GET['cat_id']; ?>">
											 <?php } elseif($_GET['sub_cat_id']) { ?>
												<input type="hidden" name="sub_category_id" value="<?php echo $_GET['sub_cat_id']; ?>">
											<?php } elseif($_GET['offer_id']) { 
												$getOffers = getIndividualDetails('grocery_offer_module','id',$_GET['offer_id']);
												if($getOffers['offer_level'] == 1) { ?>
													<input type="hidden" name="category_id" value="<?php echo $getOffers['category_id']; ?>">
												<?php } elseif($getOffers['offer_level'] == 2) { ?>
													<input type="hidden" name="sub_category_id" value="<?php echo $getOffers['sub_category_id']; ?>">
												<?php } ?>
											<?php } elseif($_GET['id']) { 
												$getBanners = getIndividualDetails('grocery_banners','id',$_GET['id']);
												if($getBanners['type'] == 1) { ?>
													<input type="hidden" name="category_id" value="<?php echo $getBanners['category_id']; ?>">
												<?php } elseif($getBanners['type'] == 2) { ?>
													<input type="hidden" name="sub_category_id" value="<?php echo $getBanners['sub_category_id']; ?>">
												<?php } ?>
											<?php } elseif($_GET['tagId']) { ?>
												<input type="hidden" name="tagId" value="<?php echo $_GET['tagId']; ?>">
											<?php } elseif($_GET['brand_id']) { ?>
												<input type="hidden" name="brand_id" value="<?php echo $_GET['brand_id']; ?>">
											<?php } ?>
											<div class="popularity">
												<select name="popularity" class="item_filter" id="sort">
													<option value="">Sort by popularity</option>
													<option value="recent">Sort by recent</option>
													<option value="low_high">Price low to high</option>
													<option value="high_low">Price high to low</option>
													<option value="a_z">Sort by A to Z</option>
												</select>
											</div>
											<!-- <div class="showed">
												<select name="showed">
													<option value="">Show 20</option>
													<option value="">Show 15</option>
													<option value="">Show 10</option>
													<option value="">Show 15</option>
												</select>
											</div> -->
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="tab-product">
									<div class="row sort-box" id="all_rows">
									<?php 
									while($getProductDetails = $getProducts1->fetch_assoc()) { 
										$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductDetails['id']);
										$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductDetails['id']);
										$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price ";
										$allGetPrices1 = $conn->query($getPrices1);
										$getPrc1 = $allGetPrices1->fetch_assoc();
									?>	
										<div class="col-lg-4 col-sm-6">
											<div class="product-box">
												<div id="cart_popup_<?php echo $getProductDetails['id']; ?>" class="snackbar">
													<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
													<p>PRODUCT NAME: <?php echo $getProductNames['product_name']; ?> </p> 
												</div>
												<div class="imagebox">
														<a href="single_product.php?product_id=<?php echo $getProductDetails['id'];?>" title="">
															<img class="img_wiht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'] ?>" alt="">
														</a>
													<div class="box-content">
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $getProductDetails['id'];?>" title=""><?php echo $getProductNames['product_name']; ?></a>
														</div>
														<div class="product_name">
														<?php 
														$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price ";
							 							$getProductPrices = $conn->query($getPrices);
														?> 
														<select  onchange="get_price(this.value,'na10');" class="s-w form-control" id="get_pr_price_<?php echo $getProductDetails['id']; ?>">
															<?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>,<?php echo $getProductDetails['id']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
														</div>
														<div class="price_<?php echo $getProductDetails['id']; ?>">
															<span class="sale"><?php echo 'Rs : ' . $getPrc1['selling_price']; ?></span>
															<?php if($getPrc1['offer_type'] == 1) { ?>
																<span class="regular"><?php echo 'Rs : ' . $getPrc1['mrp_price']; ?></span>
															<?php } ?>
														</div>
													</div><!-- /.box-content -->
													<input type="hidden" id="cat_id_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_category_id']; ?>">
													<input type="hidden" id="sub_cat_id_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_sub_category_id']; ?>">
													<input type="hidden" id="pro_name_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductNames['product_name']; ?>">
													<div class="box-bottom">
													<div class="row">
														<div class="col-sm-5 col-xs-12">
														<div class="quanlity">
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $getProductDetails['id']; ?>" type="number" style="height:45px">
														</div>							
														</div>
														<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
														<div class="btn-add-cart mrgn_lft">
														<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $getProductDetails['id']; ?>)" style="width:115%">
														<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
														</div>
														</div>
														</div>
														<div class="compare-wishlist">
												<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $getProductDetails['id']; ?>)" href="javascript:void(0)" <?php } ?> >
													<?php if(!isset($_SESSION['user_login_session_id'])) { 
														?>
														<img src="images/icons/wishlist.png" alt=""> Wishlist
													<?php } else { 
														$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$getProductDetails['id']);
														?>
														<?php if($getCountWishLsit == 0) { ?>
															<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $getProductDetails['id']; ?>" alt=""> Wishlist
														<?php } else {  ?>
															<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $getProductDetails['id']; ?>"> Wishlist
														<?php } ?>
														
													<?php } ?>
												</a>
											</div>
													</div><!-- /.box-bottom -->
												</div><!-- /.imagebox -->
											</div>
										</div><!-- /.col-lg-4 col-sm-6 -->
										<?php } ?>
									</div>
									<div class="sort-box" id="all_rows_grid">
									<?php 
									while($getProductsTotalDetails2 = $getProductsTotalDetails1->fetch_assoc()) { 
										$getProductImages1 = getIndividualDetails('grocery_product_bind_images','product_id',$getProductsTotalDetails2['id']);
										$getProductNames1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsTotalDetails2['id']);
									?>
									<?php $productPrice = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsTotalDetails2['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price ";
			 							$productPrice1 = $conn->query($productPrice);
			 							$productPrice2 = $productPrice1->fetch_assoc();
			 						?>

									<input type="hidden" id="cat_id1_<?php echo $getProductsTotalDetails2['id']; ?>" value="<?php echo $getProductsTotalDetails2['grocery_category_id']; ?>">
									<input type="hidden" id="sub_cat_id1_<?php echo $getProductsTotalDetails2['id']; ?>" value="<?php echo $getProductsTotalDetails2['grocery_sub_category_id']; ?>">
									<input type="hidden" id="pro_name1_<?php echo $getProductsTotalDetails2['id']; ?>" value="<?php echo $getProductNames1['product_name']; ?>">
										<div class="product-box style3">
											<div id="cart_popup1_<?php echo $getProductsTotalDetails2['id']; ?>" class="snackbar">
												<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
												<p>PRODUCT NAME: <?php echo $getProductNames1['product_name']; ?> </p> 
											</div>
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="single_product.php?product_id=<?php echo $getProductsTotalDetails2['id'];?>" title="">
														<img class="n_wdht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages1['image'] ?>" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<div class="product-name">
														<a href="single_product.php?product_id=<?php echo $getProductsTotalDetails2['id'];?>" title=""><?php echo $getProductNames1['product_name']; ?></a>
													</div>
													<!-- <div class="status">
														Availablity: In stock
													</div> -->
													<div class="info">
														<p style="text-align:justify">
															<?php echo $getProductNames1['product_description']; ?>
														</p>
													</div>
												</div><!-- /.box-content -->
												<div class="box-price">
													<div class="product_name">
														<?php 
														$getDet = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsTotalDetails2['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price ";
							 							$getProductPrices1 = $conn->query($getDet);
														?> 
														<select class="s-w form-control" id="get_pr_price1_<?php echo $getProductsTotalDetails2['id']; ?>" onchange="get_price(this.value,'na10');">
                                                            <?php while($getPrices1 = $getProductPrices1->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPrices1['id']; ?>,<?php echo $getPrices1['selling_price']; ?>,<?php echo $getProductsTotalDetails2['id']; ?>"><?php echo $getPrices1['weight_type']; ?> - Rs.<?php echo $getPrices1['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
														</div>
														<div class="price_<?php echo $getProductsTotalDetails2['id']; ?>">
															<span class="sale"><?php echo 'Rs : ' . $productPrice2['selling_price']; ?></span>
															<?php if($productPrice2['offer_type'] == 1) { ?>
																<span class="regular"><?php echo 'Rs : ' . $productPrice2['mrp_price']; ?></span>
															<?php } ?>
														</div>
														<div class="row">
													<div class="col-sm-5">
													<div class="quanlity" style="margin-top:5px">
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity1_<?php echo $getProductsTotalDetails2['id']; ?>" type="number" style="height:45px">
														</div>
													</div>
													<div class="col-sm-7">
													<div class="btn-add-cart mrgn_lft" style="margin-top:-20px;margin-left:-20px">
														<a href="javascript:void(0)" title="" onClick="show_cart1(<?php echo $getProductsTotalDetails2['id']; ?>)" style="width:100%">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													</div>
													</div>
													<div class="compare-wishlist">
														<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList1(<?php echo $getProductsTotalDetails2['id']; ?>)" href="javascript:void(0)" <?php } ?> >
															<?php if(!isset($_SESSION['user_login_session_id'])) { ?>
																<img src="images/icons/wishlist.png" alt=""> Wishlist
															<?php } else { 
																$getCountWishLsit1 = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$getProductsTotalDetails2['id']);
																?>
																<?php if($getCountWishLsit1 == 0) { ?>
																	<img src="images/icons/wishlist.png" id="change_wishlist_img1_<?php echo $getProductsTotalDetails2['id']; ?>" alt=""> Wishlist
																<?php } else {  ?>
																	<img src="images/icons/1.png" alt="" id="change_wishlist_img1_<?php echo $getProductsTotalDetails2['id']; ?>"> Wishlist
																<?php } ?>
															<?php } ?>
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
							
						</div><!-- /.main-shop -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->
		<?php } else { ?>
		<div class="row" style="padding-bottom:30px">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
		<center><img src="images/thumb.png" style="padding-top:50px"></center><br>
       <h3 style="text-align:center">Sorry..!! No Items Found.</h3>
	   <p style="text-align:center;margin:15px">Please click on the 'Continue Shopping' button below for items</p>
    		<center><a href="index.php"><button type="submit" class="contact" style="background-color:#FE6003">Continue Shopping</button></a></center>
	   </div>
	   <div class="col-sm-4">
		</div>
	   </div>
		<?php } ?>
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
		<script type="text/javascript">
			function get_price(product_id) {
				//alert(product_id);
				//var pro_id = $(this).attr("data-product-id");
				//alert(pro_id);
				var split = product_id.split(",");
				var productId = split[2];	
				var productWeightType = split[0];				
				$.ajax({
				  type:'post',
				  url:'get_price.php',
				  data:{
				     product_id:productWeightType,       
				  },
				  success:function(data) {
				    //alert(data);
				    $('.price_'+productId).html(data);
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
				var product_quantity = $('#product_quantity_'+ProductId).val();

	   			$.ajax({
			      type:'post',
			      url:'save_cart.php',
			      data:{		        
			        productId:ProductId,catId:catId,subCatId:subCatId,product_name:productName,productPrice:productPrice,productWeightType:productWeightType,product_quantity:product_quantity,
			      },
			      success:function(response) {
			      	//window.location.href = "shop_cart.php";
			      	var x = document.getElementById("cart_popup_"+ProductId);
				    x.className = "snackbar show1";
				    setTimeout(function(){ x.className = x.className.replace("show1", ""); }, 1000);
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
			function show_cart1(productId) {
				var catId = $('#cat_id1_'+productId).val();
				var subCatId = $('#sub_cat_id1_'+productId).val();
				var productName = $('#pro_name1_'+productId).val();
				var product = $('#get_pr_price1_'+productId).val();
				var split = product.split(",");
				var productWeightType = split[0];
				var productPrice = split[1];
				var product_quantity = $('#product_quantity1_'+productId).val();

	   			$.ajax({
			      type:'post',
			      url:'save_cart.php',
			      data:{		        
			        productId:productId,catId:catId,subCatId:subCatId,product_name:productName,productPrice:productPrice,productWeightType:productWeightType,product_quantity:product_quantity,
			      },
			      success:function(response) {
			      	//window.location.href = "shop_cart.php";
			      	var x = document.getElementById("cart_popup1_"+productId);
				    x.className = "snackbar show1";
				    setTimeout(function(){ x.className = x.className.replace("show1", ""); }, 1000);
			      }
			    });
			    $.ajax({
				  type:'post',
				  url:'header_cart_page.php',
				  data:{
				     cart_id:productId,
				  },
				  success:function(data) {
				    $('.header_cart').html(data);
				  }

				 });
			}
		</script>
	<script>
        var categories,brand,category_id,sub_category_id,offer_id,banner_id,sorting,brand_id,tagId;
        $(function(){
            // $('.item_filter').click(function(){
            $('.item_filter').on('click change',function(event) {
                categories = multiple_values('categories');
                brand  = multiple_values('brand');
                price  = multiple_values('price');
                category_id = $("#category_id").val();
                sub_category_id = $("#sub_category_id").val();
                offer_id = $("#offer_id").val();
                banner_id = $("#banner_id").val();
                brand_id = $("#brand_id").val();
                tagId = $("#tagId").val();
                sorting = $("#sort").val();
                $.ajax({
                    url:"filter_products.php",
                    type:'post',
                    data:{categories:categories,brand:brand,category_id:category_id,sub_category_id:sub_category_id,offer_id:offer_id,banner_id:banner_id,price:price,sorting:sorting,brand_id:brand_id,tagId:tagId},
                    success:function(result){
                    	$('#all_rows').html(result);
                    }
                });
                $.ajax({
                    url:"filter_products_grid.php",
                    type:'post',
                    data:{categories:categories,brand:brand,category_id:category_id,sub_category_id:sub_category_id,offer_id:offer_id,banner_id:banner_id,price:price,sorting:sorting,brand_id:brand_id,tagId:tagId},
                    success:function(result){
                    	$('#all_rows_grid').html(result);
                    }
                });
            });
        });    
        
        function multiple_values(inputclass){
            var val = new Array();
            $("."+inputclass+":checked").each(function() {
                val.push($(this).val());
            });
            return val;
        }
    </script>
<?php include "search_js_script.php"; ?>
</body>	
</html>