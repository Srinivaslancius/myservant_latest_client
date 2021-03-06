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
								New Arraivals
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<?php
			$lkp_city_id = 1;
    		$getFilters = "SELECT * FROM grocery_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_category_id FROM grocery_sub_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
    		$getGroFilters = $conn->query($getFilters);
    	?>

		<main id="shop">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="sidebar ">
							<div class="widget widget-categories">
								<div class="widget-title">
									<h3>Categories<span></span></h3>
								</div>
								<ul class="cat-list style1 widget-content">
									<?php while($filtCat =  $getGroFilters->fetch_assoc() ) { ?>
									<li>
										<span><?php echo $filtCat['category_name']; ?></span>
										<?php $subCat = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id ='".$filtCat['id']."' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC "; $getSubs = $conn->query($subCat); ?>
										<ul class="cat-child box-checkbox">
											<?php while($getSubCatName = $getSubs->fetch_assoc() ) { ?>
												<li class="check-box">
													<input type="checkbox" id="sub_cat_id<?php echo $getSubCatName['id']; ?>" name="categories[]" class="item_filter categories" value="<?php echo $getSubCatName['id']; ?>">
													<label for="sub_cat_id<?php echo $getSubCatName['id']; ?>"><?php echo $getSubCatName['sub_category_name']; ?></label>
												</li>
											<?php } ?>
										</ul>
									</li>
									<?php } ?>									
								</ul><!-- /.cat-list -->
							</div><!-- /.widget-categories -->
							

							<?php								
				    		$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
				    		$getAllBrands = $conn->query($getBrnds);
					    	?>

							<div class="widget widget-brands">
								<div class="widget-title">
									<h3>Brands<span></span></h3>
								</div>
								
									<div class="widget-content">
									<form id="check_filter_form">									
										<ul class="box-checkbox scroll">
											<?php while($getAllBrandsNames = $getAllBrands->fetch_assoc() ) { ?>
											<li class="check-box">
												<input type="checkbox" id="checkbox<?php echo $getAllBrandsNames['id']; ?>" name="brands_filt[]" class="item_filter brand" value="<?php echo $getAllBrandsNames['id']; ?>">
												<label for="checkbox<?php echo $getAllBrandsNames['id']; ?>"><?php echo $getAllBrandsNames['brand_name']; ?></label>
											</li>	
											<?php } ?>									
										</ul>
										</form>
									</div>
								
							</div>
							
							
							<div class="widget widget-price">
								<div class="widget-title">
									<h3>Price<span></span></h3>
									<div style="height: 2px"></div>
								</div>
								
									<div class="widget-content">
									<form id="search_form">									
										<ul class="box-checkbox scroll">
											<li class="check-box">
												<input type="checkbox" class="item_filter price" id="check1" name="price[]" value="0 - 500">
												<label for="check1">0 - 500/-</label>
											</li>
											<li class="check-box">
												<input type="checkbox" class="item_filter price" id="check2" name="price[]" value="500 - 1000">
												<label for="check2">500 - 1000/-</label>
											</li>
											<li class="check-box">
												<input type="checkbox" class="item_filter price" id="check3" name="price[]" value="1000 - 1500">
												<label for="check3">1000 - 1500/-</label>
											</li>
											<li class="check-box">
												<input type="checkbox" class="item_filter price" id="check4" name="price[]" value="1500 - 2000">
												<label for="check4">1500 - 2000/-</label>
											</li>
											<li class="check-box">
												<input type="checkbox" class="item_filter price" id="check5" name="price[]" value="2000 - 2500">
												<label for="check5">2000 - 2500/-</label>
											</li>
											<li class="check-box">
												<input type="checkbox" class="item_filter price" id="check6" name="price[]" value="2500 - 3000">
												<label for="check6">2500 - 3000/-</label>
											</li>
										</ul>
										</form>
									</div>
								
							</div><!-- /.widget widget-color -->
						</div><!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
<!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<div class="main-shop">
							<div class="slider owl-carousel-16">
								<?php $getBanners = "SELECT * FROM grocery_banners WHERE lkp_status_id = 0";
								$getBannersData = $conn->query($getBanners); ?>
								<?php while($getBannersData1 = $getBannersData->fetch_assoc()) { ?>
								<div class="slider-item style9">
									<div class="item-image">
										<img title="<?php echo $getBannersData1['title']; ?>" src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt="">
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style9 -->
								<?php } ?>
								
							</div><!-- /.slider -->
							<div class="wrap-imagebox">
								<div class="flat-row-title">
									<h3>Offer Products</h3>
									
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
											<select name="popularity" class="item_filter" id="sort">
												<option value="">Sort by popularity</option>
												<option value="recent">Sort by recent</option>
												<option value="low_high">Price low to high</option>
												<option value="high_low">Price high to low</option>
												<option value="a_z">Sort by A to Z</option>
											</select>
										</div>										
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="tab-product">
									<div class="row sort-box" id="all_rows">
									<?php 
									if($_SESSION['city_name'] == '') {
	                                    $lkp_city_id = 1;
	                                } else {
	                                    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
	            						$lkp_city_id = $getCities1['id'];
	                                }
									$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)  ORDER BY id DESC LIMIT 0,10";
										$getProducts1 = $conn->query($getProducts);
									while($getProductsData = $getProducts1->fetch_assoc()) {
									$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsData['id']);
									$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductsData['id']);
									$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price";
									$allGetPrices1 = $conn->query($getPrices1);
									$getPrc1 = $allGetPrices1->fetch_assoc();
									?>
									<input type="hidden" id="row_no" value="10">
										<div class="col-lg-4 col-md-6 col-sm-6" >
											<div class="product-box">
												<div id="cart_popup_<?php echo $getProductsData['id']; ?>" class="snackbar">
													<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
													<p>PRODUCT NAME: <?php echo $getProductNames['product_name']; ?> </p> 
												</div>
												<div class="imagebox">
												
														<a href="single_product.php?product_id=<?php echo $getProductsData['id'];?>" title="">
															<img class="img_wiht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'] ?>" alt="">
														</a>
														
													<div class="box-content">
														<!--<div class="cat-name">
															<a href="#" title="">Monthly Saving Pack 4</a>
														</div>-->
														<div class="product-name">
															<a href="single_product.php?product_id=<?php echo $getProductsData['id'];?>" title=""><?php echo $getProductNames['product_name']; ?></a>
														</div>
														<div class="product_name">
														<?php 
														$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price";
							 							$getProductPrices = $conn->query($getPrices);
														?>
														<select onchange="get_price(this.value,'na10');" class="s-w form-control" id="get_pr_price_<?php echo $getProductsData['id']; ?>">;
                                                            	<?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                                                            	<option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>,<?php echo $getProductsData['id']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
                                                            <?php } ?>
                                                        </select>
														</div>
														<div class="price_<?php echo $getProductsData['id']; ?>">
															<span class="sale"><?php echo 'Rs : ' . $getPrc1['selling_price']; ?></span>
															<?php if($getPrc1['offer_type'] == 1) { ?>
																<span class="regular"><?php echo 'Rs : ' . $getPrc1['mrp_price']; ?></span>
															<?php } ?>
														</div>
													</div><!-- /.box-content -->
													<input type="hidden" id="cat_id_<?php echo $getProductsData['id']; ?>" value="<?php echo $getProductsData['grocery_category_id']; ?>">
													<input type="hidden" id="sub_cat_id_<?php echo $getProductsData['id']; ?>" value="<?php echo $getProductsData['grocery_sub_category_id']; ?>">
													<input type="hidden" id="pro_name_<?php echo $getProductsData['id']; ?>" value="<?php echo $getProductNames['product_name']; ?>">
													<div class="box-bottom">
													<div class="row">
														<div class="col-sm-5 col-xs-12">
														<div class="quanlity">
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $getProductsData['id']; ?>" type="number" style="height:45px">
														</div>							
														</div>
														<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
														<div class="btn-add-cart mrgn_lft">
															<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $getProductsData['id']; ?>)" style="width:115%">
																<img src="images/icons/add-cart.png" alt="">Add to Cart
															</a>
														</div>
														</div>
														</div>
														<div class="compare-wishlist">
															<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $getProductsData['id']; ?>)" href="javascript:void(0)" <?php } ?> >
																<?php if(!isset($_SESSION['user_login_session_id'])) { 
																	?>
																	<img src="images/icons/wishlist.png" alt=""> Wishlist
																<?php } else { 
																	$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$getProductsData['id']);
																	?>
																	<?php if($getCountWishLsit == 0) { ?>
																		<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $getProductsData['id']; ?>" alt=""> Wishlist
																	<?php } else {  ?>
																		<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $getProductsData['id']; ?>"> Wishlist
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
									$getProducts1 = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)  ORDER BY id DESC LIMIT 0,10";
										$getProducts11 = $conn->query($getProducts1);
									while($getProductsData1 = $getProducts11->fetch_assoc()) {
									$getProductNames1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsData1['id']);
									$getProductImages1 = getIndividualDetails('grocery_product_bind_images','product_id',$getProductsData1['id']);
									$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData1['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
									$allGetPrices1 = $conn->query($getPrices1);
									$getPrc2 = $allGetPrices1->fetch_assoc(); ?>
										<div class="product-box style3">
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="single_product.php?product_id=<?php echo $getProductsData1['id'];?>" title="">
														<img class="img_wiht"src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages1['image'] ?>" alt="">
													</a>
													
												</div><!-- /.box-image -->
												<div id="cart_popup1_<?php echo $getProductsData1['id']; ?>" class="snackbar">
													<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
													<p>PRODUCT NAME: <?php echo $getProductNames1['product_name']; ?> </p> 
												</div>
												<div class="box-content">
													<div class="product-name">
														<a href="single_product.php?product_id=<?php echo $getProductsData1['id'];?>" title=""><?php echo $getProductNames1['product_name']; ?></a>
													</div>
													<div class="status">
														Availablity: In stock
													</div>
													<div class="info">
														<p>
															<?php echo $getProductNames1['product_description']; ?>
														</p>
													</div>
													
												</div><!-- /.box-content -->
												<input type="hidden" id="cat_id1_<?php echo $getProductsData1['id']; ?>" value="<?php echo $getProductsData1['grocery_category_id']; ?>">
												<input type="hidden" id="sub_cat_id1_<?php echo $getProductsData1['id']; ?>" value="<?php echo $getProductsData1['grocery_sub_category_id']; ?>">
												<input type="hidden" id="pro_name1_<?php echo $getProductsData1['id']; ?>" value="<?php echo $getProductNames1['product_name']; ?>">

												<div class="box-price">
													<div class="product_name">
														<?php 
														$getPrices2 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData1['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							 							$getProductPrices2 = $conn->query($getPrices2);
														?>
															<select class="s-w form-control" id="get_pr_price1_<?php echo $getProductsData1['id']; ?>" onchange="get_price(this.value);">';
                                                            	<?php while($getPricesDetails2 = $getProductPrices2->fetch_assoc()) { ?>
                                                            	<option value="<?php echo $getPricesDetails2['id']; ?>,<?php echo $getPricesDetails2['selling_price']; ?>,<?php echo $getProductsData1['id']; ?>"><?php echo $getPricesDetails2['weight_type']; ?> - Rs.<?php echo $getPricesDetails2['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
														  
														</div>
														<div class="price_<?php echo $getProductsData1['id']; ?>">
															<span class="sale"><?php echo 'Rs : ' . $getPrc2['selling_price']; ?></span>
															<?php if($getPrc2['offer_type'] == 1) { ?>
																<span class="regular"><?php echo 'Rs : ' . $getPrc2['mrp_price']; ?></span>
															<?php } ?>
														</div>
													<div class="row">
													<div class="col-sm-5">
														<div class="quanlity" style="margin-top:5px">
															<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity1_<?php echo $getProductsData1['id']; ?>" type="number" style="height:45px">
														</div>
													</div>
													<div class="col-sm-7">
													<div class="btn-add-cart mrgn_lft" style="margin-top:-20px;margin-left:-20px;">
														<a href="javascript:void(0)" title="" onClick="show_cart1(<?php echo $getProductsData1['id']; ?>)" style="width:100%">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													</div>
													</div>
													<div class="compare-wishlist">
														<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList1(<?php echo $getProductsData1['id']; ?>)" href="javascript:void(0)" <?php } ?> >
															<?php if(!isset($_SESSION['user_login_session_id'])) { ?>
																<img src="images/icons/wishlist.png" alt=""> Wishlist
															<?php } else { 
																$getCountWishLsit1 = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$getProductsData1['id']);
																?>
																<?php if($getCountWishLsit1 == 0) { ?>
																	<img src="images/icons/wishlist.png" id="change_wishlist_img1_<?php echo $getProductsData1['id']; ?>" alt=""> Wishlist
																<?php } else {  ?>
																	<img src="images/icons/1.png" alt="" id="change_wishlist_img1_<?php echo $getProductsData1['id']; ?>"> Wishlist
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

			function show_cart(ProductId) {
				var catId = $('#cat_id_'+ProductId).val();
				var subCatId = $('#sub_cat_id_'+ProductId).val();
				var productName = $('#pro_name_'+ProductId).val();
				var product = $('#get_pr_price_'+ProductId).val();
				var split = product.split(",");
				var productWeightType = split[0];
				var productPrice = split[1];
				var product_quantity = $('#product_quantity_'+ProductId).val();;
				//alert(productWeightType);

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
				//alert(product_quantity);
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
		<script type="text/javascript">
		    $(window).scroll(function ()
		    {
			  if($(document).height() <= $(window).scrollTop() + $(window).height())
			  {
				loadmore();
			  }
		    });

		    function loadmore()
		    {
		      var val = document.getElementById("row_no").value;
		      $.ajax({
		      type: 'post',
		      url: 'total_products.php',
		      data: {
		       getresult:val
		      },
		      success: function (response) {
			  var content = document.getElementById("all_rows");
		      content.innerHTML = content.innerHTML+response;

		      // We increase the value by 10 because we limit the results by 10
		      document.getElementById("row_no").value = Number(val)+10;
		      }
		      });
		    }
		    $(window).scroll(function ()
		    {
			  if($(document).height() <= $(window).scrollTop() + $(window).height())
			  {
				loadmore1();
			  }
		    });

		    function loadmore1()
		    {
		      var val = document.getElementById("row_no").value;
		      $.ajax({
		      type: 'post',
		      url: 'total_products_grid.php',
		      data: {
		       getresult:val
		      },
		      success: function (response) {
			  var content = document.getElementById("all_rows_grid");
		      content.innerHTML = content.innerHTML+response;

		      // We increase the value by 10 because we limit the results by 10
		      document.getElementById("row_no").value = Number(val)+10;
		      }
		      });
		    }
		</script>
		<script type="text/javascript">
			function get_price(product_id) {
				//alert(product_id);
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
		</script>
		<script>
	        var categories,brand,sorting;
	        $(function(){
	            //$('.item_filter').click(function(){
	            $('.item_filter').on('click change',function(event) {
	                categories = multiple_values('categories');
	                brand  = multiple_values('brand');
	                price  = multiple_values('price');
	                sorting = $("#sort").val();
	                $.ajax({
	                    url:"filter_products.php",
	                    type:'post',
	                    data:{categories:categories,brand:brand,price:price,sorting:sorting},
	                    success:function(result){
	                        $('#all_rows').html(result);
	                    }
	                });
	                $.ajax({
	                    url:"filter_products_grid.php",
	                    type:'post',
	                    data:{categories:categories,brand:brand,price:price,sorting:sorting},
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