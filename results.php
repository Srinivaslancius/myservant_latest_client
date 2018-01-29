<?php include_once 'meta.php';?>
<style>
#div1{
width:90%;
height:auto;
display:none;
background: rgba(0,0,0,0.8);
border:1px solid #DCDCDC;
border-radius:10px;
padding:20px;
z-index:9999;
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
        		$getProducts = "SELECT * from grocery_products WHERE grocery_category_id = '$category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage)";
				$getProducts1 = $conn->query($getProducts);
				$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_category_id = '$category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage)";
				$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
        	} else {
        		$getSubCategories = getIndividualDetails('grocery_sub_category','id',$sub_category_id);
				$getName = $getSubCategories['sub_category_name'];
				$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = '$sub_category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage)";
				$getProducts1 = $conn->query($getProducts);
				$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_sub_category_id = '$sub_category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage)";
				$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
        	}
		} elseif($product_id = $_GET['cat_id']) {
			$getProducts = getIndividualDetails('grocery_category','id',$product_id);
			$getName = $getProducts['category_name'];
			$getProducts = "SELECT * from grocery_products WHERE grocery_category_id = $product_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
			$getProducts1 = $conn->query($getProducts);
			$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_category_id = $product_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
			$getProductsTotalDetails1 = $conn->query($getProductsTotalDetails);
		} elseif($product_id = $_GET['sub_cat_id']) {
			$getProducts = getIndividualDetails('grocery_sub_category','id',$product_id);
			$getName = $getProducts['sub_category_name'];
			$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = $product_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
			$getProducts1 = $conn->query($getProducts);
			$getProductsTotalDetails = "SELECT * from grocery_products WHERE grocery_sub_category_id = $product_id AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
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
							<li class="trail-item">
								<a href="#" title=""><?php echo $getName; ?></a>
							</li>
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
						<?php include_once 'filters.php'; ?>
						<!-- /.sidebar -->
					</div><!-- /.col-lg-3 col-md-4 -->
					<div class="col-lg-9 col-md-8">
						<div class="main-shop">
							
							<div class="wrap-imagebox">
								<div class="flat-row-title">
									<h3><?php echo $getName; ?></h3>
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
												<option value="">Recent</option>
												<option value="">Price low to high</option>
												<option value="">Sort by popularity</option>
											</select>
										</div>
										<div class="showed">
											<select name="showed">
												<option value="">Show 20</option>
												<option value="">Show 15</option>
												<option value="">Show 10</option>
												<option value="">Show 15</option>
											</select>
										</div>
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
												<div id="div1" class="cart_popup_<?php echo $getProductDetails['id']; ?>">
													<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
													<p style="color:white">Product Name : <?php echo $getProductNames['product_name']; ?></p>
												</div>
												<div class="imagebox">
														<a href="single_product.php?product_id=<?php echo $getProductDetails['id'];?>" title="">
															<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'] ?>" alt="" style="width:264px; height:210px">
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
														
														<a href="#" class="wishlist" title="">
															<img src="images/icons/wishlist.png" alt="">Wishlist
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
											<div id="div1" class="cart_popup_<?php echo $getProductsTotalDetails2['id']; ?>">
												<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
												<p style="color:white">Product Name : <?php echo $getProductNames1['product_name']; ?></p>
											</div>
											<div class="imagebox style1 v3">
												<div class="box-image">
													<a href="single_product.php?product_id=<?php echo $getProductsTotalDetails2['id'];?>" title="">
														<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages1['image'] ?>" alt="" style="width:264px; height:210px">
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
														<a href="javascript:void(0)" title="" onClick="show_cart1(<?php echo $getProductsTotalDetails2['id']; ?>)">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
													</div>
													</div>
													
													<div class="compare-wishlist">
														
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
							
						</div><!-- /.main-shop -->
					</div><!-- /.col-lg-9 col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</main><!-- /#shop -->
		<?php } else { ?>
		<h1 style="text-align:center;margin:15px;color: #FE6003;">No Items Found.</h1>
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
			      	$(".cart_popup_"+ProductId).fadeIn(2000);
			      	setTimeout(function() {
					    $(".cart_popup_"+ProductId).fadeOut('fast');
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
			      	$(".cart_popup_"+productId).fadeIn(2000);
			      	setTimeout(function() {
					    $(".cart_popup_"+productId).fadeOut('fast');
					}, 2000);
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
			$(document).on('change','.categories',function(){
			   $.ajax({
			      type: 'post',
			      url: 'category_filters.php',
			      data: $("#category_filters").serialize(),
			      success: function (response) {
			      //alert(response);
			      $('#all_rows').html(response);		  
			      }
				});

				$.ajax({
			      type: 'post',
			      url: 'category_filters_grid.php',
			      data: $("#category_filters").serialize(),
			      success: function (response) {
			      //alert(response);
			      $('#all_rows_grid').html(response);		  
			      }
				});
			});
		</script>
		<script type="text/javascript">
			$(document).on('change','.brand_filters',function(){
			   $.ajax({
			      type: 'post',
			      url: 'load_brands_products.php',
			      data: $("#check_filter_form").serialize(),
			      success: function (response) {
			      //alert(response);
			      $('#all_rows').html(response);		  
			      }
				});

				$.ajax({
			      type: 'post',
			      url: 'load_brands_products_grid.php',
			      data: $("#check_filter_form").serialize(),
			      success: function (response) {
			      //alert(response);
			      $('#all_rows_grid').html(response);		  
			      }
				});
			});
		</script>
		<script type="text/javascript">
			$(document).on('change','.check_price_type',function(){
			   $.ajax({
			     type: "POST",
			     url: 'price_filters.php',
			     data: $("#search_form").serialize(),
			     success: function(response)
			     {                  
			        //alert(response);
			        $('#all_rows').html(response);
			     }               
			   });
			  $.ajax({
			     type: "POST",
			     url: 'price_filters_grid.php',
			     data: $("#search_form").serialize(),
			     success: function(response)
			     {                  
			        //alert(response);
			        $('#all_rows_grid').html(response);
			     }               
			   });
			});
		</script>

</body>	
</html>