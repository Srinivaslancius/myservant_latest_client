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
		if($product_id = $_GET['cat_id']) {
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
									?>	
										<div class="col-lg-4 col-sm-6">
											<div class="product-box">
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
														$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							 							$getProductPrices = $conn->query($getPrices);
														?> 
														<select class="s-w form-control" id="get_pr_price_<?php echo $getProductDetails['id']; ?>" onchange="get_price(this.value,'na10');">
															<?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
														</div>
													</div><!-- /.box-content -->
													<input type="hidden" id="cat_id_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_category_id']; ?>">
													<input type="hidden" id="sub_cat_id_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_sub_category_id']; ?>">
													<input type="hidden" id="pro_name_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductNames['product_name']; ?>">
													<div class="box-bottom">
														<div class="btn-add-cart">
															<a href="#" title="" onClick="show_cart(<?php echo $getProductDetails['id']; ?>)">
																<img src="images/icons/add-cart.png" alt="">Add to Cart
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
									<?php $productPrice = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsTotalDetails2['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
			 							$productPrice1 = $conn->query($productPrice);
			 							$productPrice2 = $productPrice1->fetch_assoc();
			 						?>

									<input type="hidden" id="cat_id1_<?php echo $getProductsTotalDetails2['id']; ?>" value="<?php echo $getProductsTotalDetails2['grocery_category_id']; ?>">
									<input type="hidden" id="sub_cat_id1_<?php echo $getProductsTotalDetails2['id']; ?>" value="<?php echo $getProductsTotalDetails2['grocery_sub_category_id']; ?>">
									<input type="hidden" id="pro_name1_<?php echo $getProductsTotalDetails2['id']; ?>" value="<?php echo $getProductNames['product_name']; ?>">
										<div class="product-box style3">
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
														 $getProductPrices1 = getAllDataWhereWithActive('grocery_product_bind_weight_prices','product_id',$getProductsTotalDetails2['id']);
														?> 
														<select class="s-w form-control" id="get_pr_price1_<?php echo $getProductsTotalDetails2['id']; ?>" onchange="get_price(this.value,'na10');">
                                                            <?php while($getPrices1 = $getProductPrices1->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPrices1['id']; ?>,<?php echo $getPrices1['selling_price']; ?>"><?php echo $getPrices1['weight_type']; ?> - Rs.<?php echo $getPrices1['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
														</div>
													<div class="btn-add-cart">
														<a href="#" title="" onClick="show_cart(<?php echo $getProductsTotalDetails2['id']; ?>)">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
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
				var product_quantity = 1;

	   			$.ajax({
			      type:'post',
			      url:'save_cart.php',
			      data:{		        
			        productId:ProductId,catId:catId,subCatId:subCatId,product_name:productName,productPrice:productPrice,productWeightType:productWeightType,product_quantity:product_quantity,
			      },
			      success:function(response) {
			      	window.location.href = "shop_cart.php";
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
				var product_quantity = 1;

	   			$.ajax({
			      type:'post',
			      url:'save_cart.php',
			      data:{		        
			        productId:productId,catId:catId,subCatId:subCatId,product_name:productName,productPrice:productPrice,productWeightType:productWeightType,product_quantity:product_quantity,
			      },
			      success:function(response) {
			      	window.location.href = "shop_cart.php";
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