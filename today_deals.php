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
								<?php 
								if($_SESSION['city_name'] == '') {
								    $lkp_city_id = 1;
								} else {
								    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
									$lkp_city_id = $getCities1['id'];
								}
								$getBanners = "SELECT * FROM grocery_banners WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id'";
								$getBannersData = $conn->query($getBanners);
								while($getBannersData1 = $getBannersData->fetch_assoc()) { 
								if($getBannersData1['type'] == 3) {
								?>
								<div class="slider-item style1">
									<div class="item-image">
										<a href="single_product.php?id=<?php echo $getBannersData1['id']; ?>"><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt=""></a>
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } else { ?>
								<div class="slider-item style1">
									<div class="item-image">
										<a href="results.php?id=<?php echo $getBannersData1['id']; ?>"><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt=""></a>
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } } ?>
							</div>
						</div>
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-slider -->

			<?php $getOffers = "SELECT * FROM grocery_offer_module WHERE lkp_status_id = 0 ORDER BY id LIMIT 2";
			$getOffers1 = $conn->query($getOffers); ?>
			
                
<?php $getTodayDeals = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND deal_start_date = CURDATE() AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
$getTodayDeals1 = $conn->query($getTodayDeals);
if($getTodayDeals1->num_rows > 0) { ?>


		<section class="flat-imagebox">
				<div class="container">
					
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
													00
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
								</div>
								</div>
								</div>
					<div class="box-product">
						<div class="row">
                             <?php while($todayDeals = $getTodayDeals1->fetch_assoc()) {
                       	$getCategoryName = getIndividualDetails('grocery_category','id',$todayDeals['grocery_category_id']);
                   		$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$todayDeals['id']);
                   		$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$todayDeals['id']);
                   		?>
						<input type="hidden" id="count_down_date" value="<?php echo date('Y/m/d', time()+86400);?>">
							<div class="col-sm-4 col-lg-3">
								<div class="product-box style4">
									<div id="div1" class="cart_popup_<?php echo $todayDeals['id']; ?>">
										<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
										<p style="color:white">Product Name : <?php echo $getProductName['product_name']; ?></p>
									</div>
									<div class="imagebox">
										<span class="item-new">NEW</span>
										<div class="box-image">
										<a href="single_product.php?product_id=<?php echo $todayDeals['id']; ?>" title="">
			
												<img class="img_wiht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'] ?>" alt="">
											</a>
											
										</div><!-- /.box-image -->
										<div class="box-content">
											<!--<div class="cat-name">
												<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $categoryName['category_name']; ?></a>
											</div>-->
											<div class="product-name" style="margin-top:25px">
												<a href="single_product.php?product_id=<?php echo $todayDeals['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a>
											</div>
											<?php 
											$prodid = $todayDeals['id'];
										 	$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$todayDeals['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										 	$allGetPrices = $conn->query($getPrices);
										 	?>
											<div class="product_name">
										<select class="s-w form-control" id="get_pr_price_<?php echo $prodid; ?>" onchange="get_price(this.value,'na10');">
											<?php while($getPrc = $allGetPrices->fetch_assoc() ) { ?>
                                            <option value="<?php echo $getPrc['id']; ?>,<?php echo $getPrc['selling_price']; ?>,<?php echo $prodid; ?>"><?php echo $getPrc['weight_type']; ?> - Rs.<?php echo $getPrc['selling_price']; ?> </option>
	                                    <?php } ?>
                                          </select>
										</div>
										<?php 
										 	$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$todayDeals['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										 	$allGetPrices = $conn->query($getPrices);
										 	$getPrc1 = $allGetPrices->fetch_assoc();
										 ?>
										 
											<div class="price_<?php echo $todayDeals['id']; ?>">
											<span class="sale"><?php echo 'Rs.' . $getPrc1['selling_price'] . '.00'; ?></span>
											<?php if($getPrc1['offer_type'] == 1) { ?>
												<span class="regular"><?php echo 'Rs.' . $getPrc1['mrp_price']; ?></span>
											<?php } ?>
										</div>
										</div><!-- /.box-content -->
										<div class="box-bottom">
											<div class="row">
												<div class="col-sm-5 col-xs-12">
													<div class="quanlity">
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $todayDeals['id']; ?>" type="number" style="height:45px">
													</div>							
												</div>
												<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
													<div class="btn-add-cart mrgn_lft">
														<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $todayDeals['id']; ?>)" style="width:115%">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
												</div>
											</div>
											<div class="compare-wishlist">
												<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $todayDeals['id']; ?>)" href="javascript:void(0)" <?php } ?> >
													<?php if(!isset($_SESSION['user_login_session_id'])) { 
														?>
														<img src="images/icons/wishlist.png" alt=""> Wishlist
													<?php } else { 
														$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$todayDeals['id']);
														?>
														<?php if($getCountWishLsit == 0) { ?>
															<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $todayDeals['id']; ?>" alt=""> Wishlist
														<?php } else {  ?>
															<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $todayDeals['id']; ?>"> Wishlist
														<?php } ?>
														
													<?php } ?>
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
				//alert(product_quantity);

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
		</script>
</body>	
</html>