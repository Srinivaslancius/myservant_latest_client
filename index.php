<?php include_once 'meta.php';?>
<style>

.flat-banner-box {
    padding: 25px 0 10px;
}
a.mask {
    text-decoration: none;
    overflow: hidden;
    display: block;
    padding-bottom: 10px;
	border-radius: 10px;
}
.storeimgcapt1 {
    background-color: rgba(0,0,0,0.8);
    text-align: center;
    color: #fff;
    padding: 12px 0px;
    position: relative;
    margin-top: -40px;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
	border-radius: 10px;
}
.flat-imagebox.style1{
	margin-bottom:-125px;
}
.order-tracking {
  text-align:left;
    padding: 10px 70px 80px;
  
}
.order-tracking h4 {
    font-size: 16px;
	line-height:25px;
}
.order-tracking h2,h4,p {
	margin-bottom:20px;
}
.input-group-addon.one{
	background-color:#099E44;
	color:white;
	font-size:15px;
}
.input-group-addon{
	font-size:15px;
}

select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], input[type="email"]
{
	border:1px solid #e5e5e5;
	height: 42px;
}
.imagebox.one_ht{
	margin-top:15px;
	margin-bottom:15px;
}
.button6 {
    background-color: #099E44;
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
  
    cursor: pointer;
	height:36px;
}
#ui-id-1{
	display:block;
}
</style>
<?php 
	if(isset($_POST['news_letter'])) {
		$email = $_POST['email'];
		$created_at = date("Y-m-d h:i:s");
		$_SESSION['news_letter_email'] = $_POST['email'];
		$addNewsLetter = "INSERT INTO `grocery_news_letter`(`email`, `created_at`) VALUES ('$email','$created_at')";
		$addNewsLetter1 = $conn->query($addNewsLetter);
		echo "<script>alert('Thank you for Joining. You will be the first to know about new releases,giveaways & offers. Stay tuned.');</script>";
		//header('Location: index.php');
	} elseif($_GET['key']) {
		$_SESSION['news_letter_email'] = 1;
	}
?>
<!-- Sending SMS or Email of App links -->
<?php
  $getSiteSettingsData1 = getIndividualDetails('grocery_site_settings','id','1'); 
  if(isset($_POST['text_app_link'])) {
    $user_mobile = $_POST["user_mobile"];
    $message1 = urlencode('Heres the link you requested to download the My Servant app.
          Android app link: '.$getSiteSettingsData1["android_app_link"].'
            Apple app link: '.$getSiteSettingsData1["apple_app_link"].'');
    //echo $message; die;
    sendMobileSMS($message1,$user_mobile);
  } elseif(isset($_POST['email_app_link'])) {
    $to = $_POST["user_email"];
    //$from = $getSiteSettingsData1["email"];
    $subject = "Myservent - App Links";
    $message = '';    
    $message .= '<body>
      <div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
      <header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
       <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
      </header>
      <article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
          <h1 style="color:#fe6003">Welcome To Myservant</h1>
          <p>Heres the link you requested to download the My Servant app.</p>
          <p>Android app link: '.$getSiteSettingsData1["android_app_link"].'</p>
          <p>Apple app link: '.$getSiteSettingsData1["apple_app_link"].'</p>
        <p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
        <p>Warm Regards,<br>The Myservant Team </p>
      </article>
      <footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
      </div>

      </body>';
    //echo $message; die;
    $name = "My Servant";
    $from = $getSiteSettingsData1["from_email"];
    $resultEmail = sendEmail($to,$subject,$message,$from,$name);
  }
?>
<body class="header_sticky">
	<div class="boxed">
		<div class="overlay"></div>
		<?php if($_SESSION['news_letter_email'] == '') { ?>
		<!-- <div class="popup-newsletter">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
					</div>
					<div class="col-sm-8">
						<div class="popup">
							<a href="index.php?key=<?php echo encryptPassword(1); ?>"><span></span></a>
							<div class="popup-text">
								<h2>Join our newsletter and <br />get discount!</h2>
								<p class="subscribe">Subscribe to the newsletter to receive updates about new products.</p>
								<div class="form-popup">
									<form action="" class="subscribe-form" method="post" accept-charset="utf-8" autocomplete="off">
										<div class="subscribe-content">
											<input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  id="user_email" class="subscribe-email" placeholder="Your E-Mail" required>
											<button name="news_letter" type="submit"><img src="images/icons/right-2.png" alt=""></button>
										</div>
									</form>
									<!-- <div class="checkbox">
										<input type="checkbox" id="popup-not-show" name="category">
										<label for="popup-not-show">Don't show this popup again</label>
									</div> -->
								<!-- </div>
							</div>
							<div class="popup-image">
								<img src="images/product/other/my.jpg" alt="">
							</div>
						</div>
					</div>
					<div class="col-sm-2">
					</div>
				</div>
			</div>
		</div> -->
		<?php } ?>

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
										<a href="single_product.php?id=<?php echo $getBannersData1['id']; ?>"><img title="<?php echo $getBannersData1['title']; ?>" src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt=""></a>
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } elseif ($getBannersData1['type'] == 0) { ?>
								<div class="slider-item style1">
									<div class="item-image">
										<a href="<?php echo $getBannersData1['link']; ?>" target="_blank"><img title="<?php echo $getBannersData1['title']; ?>" src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt=""></a>
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } else { ?>
								<div class="slider-item style1">
									<div class="item-image">
										<a href="results.php?id=<?php echo $getBannersData1['id']; ?>"><img title="<?php echo $getBannersData1['title']; ?>" src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt=""></a>
									</div>
									<div class="clearfix"></div>
								</div><!-- /.slider-item style1 -->
								<?php } } ?>
							</div>
						</div>
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-slider -->
			<?php $getOtherServicesData ="SELECT * FROM myservant_other_services WHERE id=2";
			$getOtherServices = $conn->query($getOtherServicesData);
			$getOtherServices1 = $getOtherServices->fetch_assoc();
			?>
			<?php $getOtherServicesFoodData ="SELECT * FROM myservant_other_services WHERE id=3";
			$getOtherServicesFood = $conn->query($getOtherServicesFoodData);
			$getOtherServicesFood1 = $getOtherServicesFood->fetch_assoc();
			?>
			<section class="flat-row flat-banner-box">
			<div class="container">
			<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
							<div class="banner-box">
							<div class="inner-box">
                        <a href="<?php echo $base_url; ?>Services/index.php" class="mask" target="_blank">
                           <img width="100%" class="img-responsive zoom-img" src="<?php echo $base_url . 'grocery_admin/uploads/other_services_web_images/'.$getOtherServices1['web_image']; ?>" alt="<?php echo $getOtherServices1['title']; ?>">
                           <div class="storeimgcapt1"><?php echo $getOtherServices1['title']; ?></div>
                        </a>
						</div>
						</div>
                     </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
					<div class="banner-box">
							<div class="inner-box">
                        <a href="<?php echo $base_url; ?>food_new/index.php" class="mask" target="_blank">
                           <img width="100%" class="img-responsive zoom-img" src="<?php echo $base_url . 'grocery_admin/uploads/other_services_web_images/'.$getOtherServicesFood1['web_image']; ?>" alt="<?php echo $getOtherServicesFood1['title']; ?>">
                           <div class="storeimgcapt1"><?php echo $getOtherServicesFood1['title']; ?></div>
                        </a>
						</div>
						</div>
                     </div>
                     
                  </div>
				<!-- <div class="row">
			<div class="col-md-12">
				<div class="flat-row-title">
					<h3><?php echo $getSiteSettingsData1['offers_heading1']; ?></h3>
				</div>
			</div>
		</div> -->
				<!--<div class="row">
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="<?php echo $base_url; ?>food_new/index.php" title="">
									<img src="images/banner_boxes/6.jpeg" alt="" width="360px" height="200px">
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="banner-box">
							<div class="inner-box">
								<a href="<?php echo $base_url; ?>Services/index.php" title="">
									<img src="images/banner_boxes/5.jpeg" alt="" width="360px" height="200px">
								</a>
						</div>
					</div>
				</div>-->
			</div><!-- /.container -->
		</section><!-- /.flat-banner-box -->
                
<?php 
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
	$lkp_city_id = $getCities1['id'];
}
$i = 0;
$getTags = "SELECT * FROM grocery_tags WHERE lkp_status_id = 0 AND id IN (SELECT tag_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC";
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
									<a href="results.php?tagId=<?php echo $tagNames1['id']; ?>"><li class="active pull-right" style="bottom:17px;"><button type="submit" class="contact" style="background-color: #FE6003;height:41px;">View All</button></li></a>
								</ul>
							</div><!-- /.product-tab -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
					<div class="box-product">
						<div class="row">
                             <?php 
                            	$tagId= $tagNames1['id'];
								$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC LIMIT 0,8";
									$getProducts1 = $conn->query($getProducts);
								while($productDetails = $getProducts1->fetch_assoc()) { 
									$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails['id']);
									$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails['id']);
									$categoryName = getIndividualDetails('grocery_category','id',$productDetails['grocery_category_id']);
									$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
									$allGetPrices1 = $conn->query($getPrices1);
									$getPrc1 = $allGetPrices1->fetch_assoc();
								?>
							<input type="hidden" id="cat_id_<?php echo $productDetails['id']; ?>" value="<?php echo $productDetails['grocery_category_id']; ?>">
							<input type="hidden" id="sub_cat_id_<?php echo $productDetails['id']; ?>" value="<?php echo $productDetails['grocery_sub_category_id']; ?>">
							<input type="hidden" id="pro_name_<?php echo $productDetails['id']; ?>" value="<?php echo $getProductName['product_name']; ?>">
							<div class="col-sm-4 col-lg-3">
								<div class="product-box style4">
									<div id="cart_popup_<?php echo $productDetails['id']; ?>" class="snackbar">
										<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
										<p>PRODUCT NAME: <?php echo $getProductName['product_name']; ?> </p> 
									</div>
									<div class="imagebox">
										<span class="item-new">NEW</span>
										<div class="box-image">
										<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title="">
												<img class="img_wiht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="">
											</a>											
										</div><!-- /.box-image -->										
										<div class="box-content">
											<!--<div class="cat-name">
												<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $categoryName['category_name']; ?></a>
											</div>-->
											<div class="product-name" style="margin-top:25px">
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
			                                      <option value="<?php echo $getPrc['id']; ?>,<?php echo $getPrc['selling_price']; ?>,<?php echo $prodid; ?>"><?php echo $getPrc['weight_type']; ?> - Rs.<?php echo $getPrc['selling_price']; ?> </option>
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
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $productDetails['id']; ?>" type="number" style="height:45px">
													</div>							
												</div>
												<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
													<div class="btn-add-cart mrgn_lft">
														<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $productDetails['id']; ?>)" style="width:115%">
															<img src="images/icons/add-cart.png" alt="">Add to Cart
														</a>
													</div>
												</div>
											</div>										
											<div class="compare-wishlist">
												<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $productDetails['id']; ?>)" href="javascript:void(0)" <?php } ?> >
													<?php if(!isset($_SESSION['user_login_session_id'])) { 
														?>
														<img src="images/icons/wishlist.png" alt=""> Wishlist
													<?php } else { 
														$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$productDetails['id']);
														?>
														<?php if($getCountWishLsit == 0) { ?>
															<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $productDetails['id']; ?>" alt=""> Wishlist
														<?php } else {  ?>
															<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $productDetails['id']; ?>"> Wishlist
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
<?php if (++$i % 2 === 0 ) { 
	if($i == 2) {
		$limit = 0;
	} else {
		$limit = $limit+4;
	} 
?>
<?php $getOfferModules = "SELECT * FROM grocery_offer_module WHERE lkp_status_id = 0 ORDER BY id LIMIT 4 OFFSET $limit ";
$getOfferModules1 = $conn->query($getOfferModules); ?>
<?php if($getOfferModules1->num_rows > 0) { ?>
<section class="flat-row flat-banner-box">
	<div class="container">
		<!-- <div class="row">
			<div class="col-md-12">
				<div class="flat-row-title">
					<h3><?php echo $getSiteSettingsData1['offers_heading2']; ?></h3>
				</div>
			</div>
		</div> -->
		<div class="row">
			<?php while($getOfferModulesData = $getOfferModules1->fetch_assoc()) { ?>
			<div class="col-md-3">
				<div class="banner-box">
					<div class="inner-box">
						<a href="results.php?offer_id=<?php echo $getOfferModulesData['id']; ?>" title="">
							<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_module_image/'.$getOfferModulesData['image'] ?>" alt="">
						</a>
					</div><!-- /.inner-box -->
				</div><!-- /.banner-box -->
			</div><!-- /.col-md-4 -->
			<?php } ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.flat-banner-box -->
<?php } } } ?>

<?php 
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
	$lkp_city_id = $getCities1['id'];
}
$getsubCats = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND make_it_popular=1 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC LIMIT 0,6";
$getSubCat = $conn->query($getsubCats);
?>

<section class="flat-imagebox style2 background">
	<div class="container">
		<dl class="accordion1">
		<?php while($getSubCatnames = $getSubCat->fetch_assoc()) { ?>
		  <dt class="accordion__title1"><?php echo $getSubCatnames['sub_category_name']; ?></dt>
		  <dd class="accordion__content1">
		  <div class="row">
									<div class="col-md-3 col-sm-6">
									<?php 
										$subCAtId = $getSubCatnames['id'];
										$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id ='$subCAtId' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC LIMIT 0,2";
										$getProducts1 = $conn->query($getProducts);
										while($productDetails = $getProducts1->fetch_assoc()) { 
										$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails['id']);
										$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails['id']);
										$categoryName = getIndividualDetails('grocery_category','id',$productDetails['grocery_category_id']);
										$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										$allGetPrices1 = $conn->query($getPrices1);
										$getPrc1 = $allGetPrices1->fetch_assoc();
									?>
										<input type="hidden" id="cat_id_<?php echo $productDetails['id']; ?>" value="<?php echo $productDetails['grocery_category_id']; ?>">
										<input type="hidden" id="sub_cat_id_<?php echo $productDetails['id']; ?>" value="<?php echo $productDetails['grocery_sub_category_id']; ?>">
										<input type="hidden" id="pro_name_<?php echo $productDetails['id']; ?>" value="<?php echo $getProductName['product_name']; ?>">
										<div class="product-box">
											<div id="cart_popup_<?php echo $productDetails['id']; ?>" class="snackbar">
												<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
												<p>PRODUCT NAME: <?php echo $getProductName['product_name']; ?> </p> 
											</div>
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title="">
														<img class="img_whgt" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="">

													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<!--<div class="cat-name">
														<a href="#" title=""><?php echo $categoryName['category_name']; ?></a>
													</div>-->
													<div class="product-name">
														<a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a>
													</div>
													<div class="product_name">
														<?php 
														$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							 							$getProductPrices = $conn->query($getPrices);
														?> 
														<select  onchange="get_price(this.value,'na10');" class="s-w form-control" id="get_pr_price_<?php echo $productDetails['id']; ?>">
															<?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>,<?php echo $productDetails['id']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
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
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $productDetails['id']; ?>" type="number" style="height:45px;padding:15px">
														</div>							
														</div>
														<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
														<div class="btn-add-cart mrgn_lft">
															<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $productDetails['id']; ?>)" title="" style="width:115%;font-size: 13px;">
															<img src="images/icons/add-cart.png" alt="" >Add to Cart
														</a>
														</div>
														</div>
														</div>
														<div class="compare-wishlist">
												<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $productDetails['id']; ?>)" href="javascript:void(0)" <?php } ?> >
													<?php if(!isset($_SESSION['user_login_session_id'])) { 
														?>
														<img src="images/icons/wishlist.png" alt=""> Wishlist
													<?php } else { 
														$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$productDetails['id']);
														?>
														<?php if($getCountWishLsit == 0) { ?>
															<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $productDetails['id']; ?>" alt=""> Wishlist
														<?php } else {  ?>
															<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $productDetails['id']; ?>"> Wishlist
														<?php } ?>
														
													<?php } ?>
												</a>
											</div>
													</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->

									<?php 
										$subCAtId = $getSubCatnames['id'];
										$getProducts2 = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id ='$subCAtId' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC LIMIT 2,1";
										$getProducts2 = $conn->query($getProducts2);
										while($productDetails2 = $getProducts2->fetch_assoc()) { 
										$getProductName2 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails2['id']);
										$getProductImage2 = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails2['id']);
										$categoryName2 = getIndividualDetails('grocery_category','id',$productDetails2['grocery_category_id']);
										$getPrices2 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails2['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										$allGetPrices2 = $conn->query($getPrices2);
										$getPrc2 = $allGetPrices2->fetch_assoc();
									?>
									<input type="hidden" id="cat_id_<?php echo $productDetails2['id']; ?>" value="<?php echo $productDetails2['grocery_category_id']; ?>">
									<input type="hidden" id="sub_cat_id_<?php echo $productDetails2['id']; ?>" value="<?php echo $productDetails2['grocery_sub_category_id']; ?>">
									<input type="hidden" id="pro_name_<?php echo $productDetails2['id']; ?>" value="<?php echo $getProductName2['product_name']; ?>">
									<div class="col-md-6">
										<div class="product-box">
											<div id="cart_popup_<?php echo $productDetails2['id']; ?>" class="snackbar">
												<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
												<p>PRODUCT NAME: <?php echo $getProductName2['product_name']; ?> </p> 
											</div>
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php?product_id=<?php echo $productDetails2['id']; ?>" title="">
														<img class="img_htwdth" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage2['image']; ?>" alt="">

													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<!--<div class="cat-name">
														<a href="#" title=""><?php echo $categoryName2['category_name']; ?></a>
													</div>-->
													<div class="product-name">
														<a href="single_product.php?product_id=<?php echo $productDetails2['id']; ?>" title=""><?php echo $getProductName2['product_name']; ?></a>
													</div>
													<div class="product_name">
														<?php 
														$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails2['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							 							$getProductPrices = $conn->query($getPrices);
														?> 
														<select  onchange="get_price(this.value,'na10');" class="s-w form-control" id="get_pr_price_<?php echo $productDetails2['id']; ?>">
															<?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>,<?php echo $productDetails2['id']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
													</div>
													<div class="price_<?php echo $productDetails2['id']; ?>">
														<span class="sale"><?php echo 'Rs : ' . $getPrc2['selling_price']; ?></span>
														<?php if($getPrc2['offer_type'] == 1) { ?>
															<span class="regular"><?php echo 'Rs : ' . $getPrc2['mrp_price']; ?></span>
														<?php } ?>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="row">
														<div class="col-sm-5 col-xs-12">
															<div class="quanlity">
															<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $productDetails2['id']; ?>" type="number" style="height:45px;text-align:center">
															</div>							
														</div>
														<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
															<div class="btn-add-cart mrgn_lft">
																<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $productDetails2['id']; ?>)" title="" style="width:100%">
																	<img src="images/icons/add-cart.png" alt="" >Add to Cart
																</a>
															</div>
														</div>
													</div>
													<div class="compare-wishlist">
														<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $productDetails2['id']; ?>)" href="javascript:void(0)" <?php } ?> >
															<?php if(!isset($_SESSION['user_login_session_id'])) { 
																?>
																<img src="images/icons/wishlist.png" alt=""> Wishlist
															<?php } else { 
																$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$productDetails2['id']);
																?>
																<?php if($getCountWishLsit == 0) { ?>
																	<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $productDetails2['id']; ?>" alt=""> Wishlist
																<?php } else {  ?>
																	<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $productDetails2['id']; ?>"> Wishlist
																<?php } ?>
																
															<?php } ?>
														</a>
													</div>
												</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
									</div><!-- /.col-md-6 -->
									<?php } ?>
									<div class="col-md-3 col-sm-6">
										<?php 
										$subCAtId = $getSubCatnames['id'];
										$getProducts3 = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id ='$subCAtId' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id') ORDER BY id DESC LIMIT 3,2";
										$getProducts3 = $conn->query($getProducts3);
										while($productDetails3 = $getProducts3->fetch_assoc()) { 
										$getProductName3 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails3['id']);
										$getProductImage3 = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails3['id']);
										$categoryName3 = getIndividualDetails('grocery_category','id',$productDetails3['grocery_category_id']);
										$getPrices3 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails3['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
										$allGetPrices3 = $conn->query($getPrices3);
										$getPrc3 = $allGetPrices3->fetch_assoc();
									?>
										<input type="hidden" id="cat_id_<?php echo $productDetails3['id']; ?>" value="<?php echo $productDetails3['grocery_category_id']; ?>">
										<input type="hidden" id="sub_cat_id_<?php echo $productDetails3['id']; ?>" value="<?php echo $productDetails3['grocery_sub_category_id']; ?>">
										<input type="hidden" id="pro_name_<?php echo $productDetails3['id']; ?>" value="<?php echo $getProductName3['product_name']; ?>">
										<div class="product-box">
											<div id="cart_popup_<?php echo $productDetails3['id']; ?>" class="snackbar">
												<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
												<p>PRODUCT NAME: <?php echo $getProductName3['product_name']; ?> </p> 
											</div>
											<div class="imagebox style2">
												<div class="box-image">
													<a href="single_product.php?product_id=<?php echo $productDetails3['id']; ?>" title="">

														<img class="img_whgt"src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage3['image']; ?>" alt="">
													</a>
												</div><!-- /.box-image -->
												<div class="box-content">
													<!--<div class="cat-name">
														<a href="#" title=""><?php echo $categoryName3['category_name']; ?></a>
													</div>-->
													<div class="product-name">
														<a href="single_product.php?product_id=<?php echo $productDetails3['id']; ?>" title=""><?php echo $getProductName3['product_name']; ?></a>
													</div>
													<div class="product_name">
														<?php 
														$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails3['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
							 							$getProductPrices = $conn->query($getPrices);
														?> 
														<select  onchange="get_price(this.value,'na10');" class="s-w form-control" id="get_pr_price_<?php echo $productDetails3['id']; ?>">
															<?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                                                            <option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>,<?php echo $productDetails3['id']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
                                                            <?php } ?>
                                                          </select>
													</div>
													<div class="price_<?php echo $productDetails3['id']; ?>">
														<span class="sale"><?php echo 'Rs : ' . $getPrc3['selling_price']; ?></span>
														<?php if($getPrc3['offer_type'] == 1) { ?>
															<span class="regular"><?php echo 'Rs : ' . $getPrc3['mrp_price']; ?></span>
														<?php } ?>
													</div>
												</div><!-- /.box-content -->
												<div class="box-bottom">
													<div class="row">
														<div class="col-sm-5 col-xs-12">
														<div class="quanlity">
														<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $productDetails3['id']; ?>" type="number" style="height:45px;padding:15px">
														</div>							
														</div>
														<div class="col-sm-7 col-xs-12" style="margin-left:-20px">
														<div class="btn-add-cart mrgn_lft">
															<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $productDetails3['id']; ?>)" title="" style="width:115%;font-size: 13px;">
															<img src="images/icons/add-cart.png" alt="" >Add to Cart
														</a>
														</div>
														</div>
														</div>
														<div class="compare-wishlist">
															<a  class="wishlist" <?php if(!isset($_SESSION['user_login_session_id'])) { ?> href="login.php" <?php } else { ?> onClick="addWishList(<?php echo $productDetails3['id']; ?>)" href="javascript:void(0)" <?php } ?> >
																<?php if(!isset($_SESSION['user_login_session_id'])) { 
																	?>
																	<img src="images/icons/wishlist.png" alt=""> Wishlist
																<?php } else { 
																	$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$productDetails3['id']);
																	?>
																	<?php if($getCountWishLsit == 0) { ?>
																		<img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $productDetails3['id']; ?>" alt=""> Wishlist
																	<?php } else {  ?>
																		<img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $productDetails3['id']; ?>"> Wishlist
																	<?php } ?>
																	
																<?php } ?>
															</a>
														</div>
													</div><!-- /.box-bottom -->
											</div><!-- /.imagebox style2 -->
										</div><!-- /.product-box -->
										<?php } ?>
									</div><!-- /.col-md-3 col-sm-6 -->
								</div><!-- /.row -->
    		<!--<div class="row">
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
											<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $productDetails['id']; ?>)">
												<img src="images/icons/add-cart.png" alt="">Add to Cart
											</a>
										</div>
										
									</div>
								</div>
							</div>	
						</div>
						<?php } ?>
					</div>-->
  			</dd> 
  			<?php } ?>
		</dl>
	</div>
</section>

<?php $getTodayDeals = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND deal_start_date = CURDATE() AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
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


						<input type="hidden" id="cat_id_<?php echo $todayDeals['id']; ?>" value="<?php echo $todayDeals['grocery_category_id']; ?>">
						<input type="hidden" id="sub_cat_id_<?php echo $todayDeals['id']; ?>" value="<?php echo $todayDeals['grocery_sub_category_id']; ?>">
						<input type="hidden" id="pro_name_<?php echo $todayDeals['id']; ?>" value="<?php echo $getProductName['product_name']; ?>">

                        <input type="hidden" id="count_down_date" value="<?php echo date('Y/m/d', time()+86400);?>">     
						<div class="product-box style1">
							<div id="cart_popup_<?php echo $todayDeals['id']; ?>" class="snackbar">
								<p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
								<p>PRODUCT NAME: <?php echo $getProductName['product_name']; ?> </p> 
							</div>
								<div class="imagebox style1">
									<div class="box-image">
										<a href="single_product.php?product_id=<?php echo $todayDeals['id']; ?>" title="">
											<img class="T_wdht"src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'] ?>" alt="">
										</a>
									</div><!-- /.box-image -->
									<div class="box-content">
										<!--<div class="cat-name">
											<a href="#" title=""><?php echo $getCategoryName['category_name']; ?></a>
										</div>-->
										<div class="product-name">
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

										<div class="quanlity">
										<input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $todayDeals['id']; ?>" type="number" style="height:45px">
										</div>
									</div><!-- /.box-content -->
									<div class="box-bottom">
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
										<div class="btn-add-cart">
											<a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $todayDeals['id']; ?>)">
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
				<?php 
				$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
		    	$getAllBrands = $conn->query($getBrnds);
				while($getBrandsData = $getAllBrands->fetch_assoc()) { ?>
				
					<div class="imagebox style4">
						<div class="box-image">
							<a href="results.php?brand_id=<?php echo $getBrandsData['id']; ?>" title="">
								<img class="img_hw"src="<?php echo $base_url . 'grocery_admin/uploads/grocery_brands_web_logo/'.$getBrandsData['web_logo'] ?>" alt="">
							</a>
						</div><!-- /.box-image -->
						
					</div><!-- /.imagebox style4 -->
					<?php } ?>
					
				</div><!-- /.owl-carousel-3 -->
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.flat-imagebox style4 -->
<section class="flat-imagebox style2 background">
	<div class="container">
		<div class="order-tracking">
			<img src="images/logos/logo1.png"><br><br>
			<div class="row">
				<div class="col-sm-5">
					<img src="images/foodM.png" class="img-responsive">
				</div>
				<div class="col-sm-6">
					<h2>Looking for the Food Feed? Get the app!</h2>
					<h4>Follow foodies to see their reviews and photos in your Feed, and discover great new restaurants!</h4>
					<p>We'll send you a link, open it on your phone to download the app</p>
					<form method="post">
							<div class="input-group">
							  	<span class="input-group-addon">+91</span>
							  	<input type="tel" name="user_mobile" id="user_mobile"  placeholder="Enter Your Mobile Number" maxlength="10" pattern="[0-9]{10}" required class="form-control valid_mobile_num">
							  	<span class="input-group-addon one"><button class="button6" type="submit" name="text_app_link" value="text_app_link">Text App link</button></span>
							</div>
						</form>
					<div class="imagebox one_ht">
						<div class="box-content">
							<div class="cat-name">
								<a href="" title=""><b>(OR)</b></a>
							</div>											
						</div>
					</div>
					<form method="post">
	  					<div class="input-group">
						  	<input type="email" name="user_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  id="user_email" placeholder="Enter Your Email Id" class="form-control" required>
					  		<span class="input-group-addon one"><button class="button6" type="submit" name="email_app_link" value="email_app_link">Email App link</button></span>
						</div>
	  				</form><br>
					<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo $getSiteSettingsData1['apple_app_link'] ?>" target="_blank" title=""><img src="images/product/applestore.png"></a>
						</div>
						<div class="col-sm-4">
							<a href="<?php echo $getSiteSettingsData1['android_app_link'] ?>" target="_blank" title=""><img src="images/product/googleplay.png"></a>
						</div>
						<div class="col-sm-4"></div>
					</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
	</div>
</section>
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
		</script>
	
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>    
 <!-- Auto complete home page search -->           
<script type="text/javascript">
$(document).ready(function() {
    
    //autocomplete
    $(".auto").autocomplete({
    	source: function(request, response) {
	    $.ajax({
	      url: "get_product_names.php",
	      dataType: "json",
	      data: request,                    
	      success: function (data) {
	        // No matching result
	        if (!data || data.length == 0) {
	          response([{ label: 'No results found.', val: -1}]);
	        }
	        else {
	          response(data);
	        }
	      }});
	    },
        // source: "get_product_names.php",
        minLength: 2,
    	select: function(event, ui) {
    		$('#search_form').submit();
    	}
	});
});
</script>

</body>	
</html>