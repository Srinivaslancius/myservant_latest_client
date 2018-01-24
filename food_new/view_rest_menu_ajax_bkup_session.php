<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- Radio and check inputs -->
    <link href="css/skins/square/grey.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="show_cart()">

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	<div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    <!-- Header ================================================== -->
    <header>
        <?php include_once 'header.php';?>
    </header>
<!-- End Header =============================================== -->
<?php //echo "srinu". $getRestKey = decryptpassword($_GET['key']); ?>
<?php $getRestKey = 3; ?>
<?php $getCategory = getFoodCategoryByRestId('food_products','restaurant_id',$getRestKey); ?>
<?php $getFoodVendorsBann = getIndividualDetails('food_vendors','id',$getRestKey); ?>
<!-- SubHeader =============================================== -->
<section class="parallax-window" data-parallax="scroll" <?php if($getFoodVendorsBann['vendor_banner']!='') { ?>data-image-src="<?php echo $base_url . 'uploads/food_vendor_Banner/'.$getFoodVendorsBann['vendor_banner']; ?>" <?php } else { ?> data-image-src="img/sub_header_home.jpg" <?php } ?>data-natural-width="1400" data-natural-height="470">
    <div id="subheader">
	<div id="sub_content">
    	<div id="thumb"><img src="<?php echo $base_url . 'uploads/food_vendor_logo/'.$getFoodVendorsBann['logo']; ?>" alt="<?php echo $getMostPopualrRestaurants['restaurant_name']; ?>"></div>
	         <div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#">Read 98 reviews</a></small>)</div>
	        <h1><?php echo $getFoodVendorsBann['restaurant_name']; ?></h1>
	        <div><em><?php echo $getFoodVendorsBann['description']; ?></em></div>
	        <div><i class="icon_pin"></i> <?php echo $getFoodVendorsBann['restaurant_address']; ?> </div>
    </div><!-- End sub_content -->
</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#0">Home</a></li>
                <li><a href="#0">Category</a></li>
                <li>Page active</li>
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<?php if($getCategory->num_rows > 0) { ?>
<div class="container margin_60_35">
		<div class="row">
        
			<div class="col-md-3">
                <p><a href="list.php" class="btn_side">Back to search</a></p>
				<div class="box_style_1">
					<ul id="cat_nav">						
						<?php while($getCatList = $getCategory->fetch_assoc() ) { ?>
							<li><a href="#<?php echo $getCatList['category_id']; ?>" class="active"><?php $getCatName = getIndividualDetails('food_category','id',$getCatList['category_id']); echo $getCatName['category_name']; ?><span>(<?php echo getProductsCountByCat('food_products','category_id',$getCatList['category_id'],'restaurant_id',$getRestKey); ?>)</span></a></li>
						<?php } ?>
					</ul>
				</div><!-- End box_style_1 -->
                
				<div class="box_style_2 hidden-xs" id="help">
					<i class="icon_lifesaver"></i>
					<h4>Need <span>Help?</span></h4>
					<a href="tel:<?php echo $getFoodVendorsBann['vendor_mobile']; ?>" class="phone">+91- <?php echo $getFoodVendorsBann['vendor_mobile']; ?></a>
					<small>Monday to Friday <?php echo $getFoodVendorsBann['working_timings']; ?></small>
				</div>
			</div><!-- End col-md-3 -->
            <?php $getCategory1 = getFoodCategoryByRestId('food_products','restaurant_id',$getRestKey); ?>            

			<div class="col-md-6">
				<div class="box_style_2" id="main_menu">
                        <h2 class="inner">Menu <span class="pull-right">
                        <!-- <label style="color: #fff;"><input name="mobile" type="checkbox" value="" class="icheck">Veg </label> --></span></h2>

                    <?php while($getCatList1 = $getCategory1->fetch_assoc() ) { ?>
                    <hr>
					<h3 class="nomargin_top" id="<?php echo $getCatList1['category_id']; ?>"><?php $getCatName = getIndividualDetails('food_category','id',$getCatList1['category_id']); echo $getCatName['category_name']; ?></h3>
					<p>
					<?php echo $getCatName['category_description']; ?>
					</p>
					<table class="table table-striped cart-list">
						<thead>
						<tr>
							<th>
								 Item
							</th>
							<th>
								 Price
							</th>
							<th>
								 Order
							</th>
						</tr>
						</thead>
					<tbody>
					<?php 
						$getItemsByCat = getFoodItemsByCategory('food_products','restaurant_id',$getRestKey,'category_id',$getCatName['id']);	
						$i=1; while($getItemsByCategory = $getItemsByCat->fetch_assoc() ) {
						$productId = $getItemsByCategory['id'];
		            ?>
		            <input type="hidden" id="item<?php echo $productId; ?>_name" value="<?php echo $getItemsByCategory['product_name']; ?>">
		            <input type="hidden" id="item<?php echo $productId; ?>_id" value="<?php echo $productId; ?>">
    				
					<tr class="items" id="item<?php echo $productId; ?>">
						<td>
                        	<figure class="thumb_menu_list"><img src="<?php echo $base_url . 'uploads/food_product_images/'.$getItemsByCategory['product_image']; ?>" alt="<?php echo $getItemsByCategory['product_name']; ?>" ></figure>
							<h5><?php echo $i; ?>. <?php echo $getItemsByCategory['product_name']; ?></h5>
							<p>
								<?php echo $getItemsByCategory['specifications']; ?>
							</p>
						</td>
						<td>
							<?php $getFirstPrice =  getIndividualDetails('food_product_weight_prices','product_id',$productId); ?>
							<strong>Rs. <?php echo $getFirstPrice['product_price']; ?></strong>
							<input type="hidden" id="item<?php echo $productId; ?>_price" value="<?php echo $getFirstPrice['product_price']; ?>">
						</td>
						<td class="options">
						
	                        <div class="dropdown dropdown-options">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
	                            <div class="dropdown-menu">
	                                <h5>Select an option</h5>
	                                <?php $getSelectOptions =  getAllDataWhere('food_product_weight_prices','product_id',$productId); ?>
	                                <?php while($getItemPrices = $getSelectOptions->fetch_assoc() ) { ?>
		                                <label>
		                                	<?php $getWeight = getIndividualDetails('food_product_weights','id',$getItemPrices['weight_type_id']); ?>
		                                <input type="radio" name="options_1" required value="<?php echo $getItemPrices['weight_type_id']; ?>"><?php echo $getWeight['weight_type'];  ?><span>+ Rs. <?php echo $getItemPrices['product_price']; ?></span>
		                                </label>
		                            <?php } ?>
	                               
	                                <h5>Add ingredients</h5>

	                                <?php $getIngOptions =  getAllDataWhere('food_product_ingredient_prices','product_id',$productId); ?>
	                                <?php while($getItemIngoptions = $getIngOptions->fetch_assoc() ) { ?>
		                                <label>
		                                <input type="checkbox" value=""><?php $getWeight = getIndividualDetails('food_ingredients','id',$getItemIngoptions['ingredient_name_id']); echo $getWeight['ingredient_name'];  ?><span>+ Rs. <?php echo $getItemIngoptions['ingredient_price']; ?></span>
		                                </label>
		                            <?php } ?>
		                            <a href="#0" class="add_to_basket add_cart_item" data-key="<?php echo $productId; ?>" onclick="cart('item<?php echo $productId; ?>')">Add to cart</a>
	                            </div>
	                        </div>	                    

                    </td>
					</tr>
                        <?php $i++; } ?>
					</tbody>

					</table>
					<?php } ?>

				</div><!-- End box_style_1 -->
			</div><!-- End col-md-6 -->
            
			<div class="col-md-3" id="sidebar">
            <div class="theiaStickySidebar">
				<div id="cart_box" >
					<h3>Your order <i class="icon_cart_alt pull-right" ></i>(<input type="button" id="total_items" value="0">)</h3>
					
					<table class="table table_summary">
					<tbody id="mycart">
						
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> Enchiladas
						</td>
						<td>
							<strong class="pull-right">Rs. 11</strong>
						</td>
					</tr>
					
					</tbody>
					</table>
					<hr>
					<div class="row" id="options_2">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
						</div>
					</div><!-- Edn options 2 -->
                    
					<hr>
					<table class="table table_summary">
					<tbody>
					<tr>
						<td>
							 Subtotal <span class="pull-right">Rs. 56</span>
						</td>
					</tr>
					<tr>
						<td>
							 Delivery fee <span class="pull-right">Rs. 10</span>
						</td>
					</tr>
					<tr>
						<td class="total">
							 TOTAL <span class="pull-right">Rs. 66</span>
						</td>
					</tr>
					</tbody>
					</table>
					<hr>
					<a class="btn_full" href="cart.php">Order now</a>
				</div><!-- End cart_box -->
                </div><!-- End theiaStickySidebar -->
			</div><!-- End col-md-3 -->
            
		</div><!-- End row -->
</div><!-- End container -->
<?php } else { ?>
<div class="container margin_60_35">
	<div class="row">
		No Items found
	</div>
</div>
<?php } ?>
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
    <footer>
        <?php include_once 'footer.php';?>
    </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script  src="js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<script>
$('#cat_nav a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top - 70
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});
</script>

<script type="text/javascript">

    $(document).ready(function(){

      $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          total_cart_items:"totalitems"
        },
        success:function(response) {
          document.getElementById("total_items").value=response;
        }
      });

    });

    function cart(id)
    {
	  var ele=document.getElementById(id);
	  //var img_src=ele.getElementsByTagName("img")[0].src;
	  var product_id=document.getElementById(id+"_id").value;
	  var name=document.getElementById(id+"_name").value;
	  var price=document.getElementById(id+"_price").value;	  
	  
	  $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          //item_src:img_src,
          item_name:name,
          item_price:price,
          item_id:product_id
        },
        success:function(response) {     	
          document.getElementById("total_items").value=response;
          document.getElementById("mycart").innerHTML=response;
        }
      });

      $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
        showcart:"cart"
      },
      success:function(response) {
      	//alert(response);  
        document.getElementById("mycart").innerHTML=response;
        //$("#mycart").slideToggle();
      }
     });
	
    }

    function show_cart()
    {
      $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
        showcart:"cart"
      },
      success:function(response) {
      	//alert(response);  
        document.getElementById("mycart").innerHTML=response;
        //$("#mycart").slideToggle();
      }
     });

    }
	
</script>

</body>
</html>