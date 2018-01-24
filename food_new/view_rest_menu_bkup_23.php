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
    <style>
.selectdiv {
position: relative; 
}

select::-ms-expand {
display: none;
}

.selectdiv select {
-moz-appearance: none;
appearance: none;
/* Add some styling */
display: block;
height: 32px;
float: right;
margin: 5px 0px;
padding: 0px 2px;
font-size: 13px;
line-height: 1.75;
color: #333;
background-color: #ffffff ;
background-image: none;
border: 1px solid #fe6003 ;
-ms-word-break: normal;
word-break: normal;
}
</style>
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
<?php $getRestKey = decryptpassword($_GET['key']); ?>
<?php //$getRestKey = 3; ?>
<?php 
if($_SESSION['CART_TEMP_RANDOM'] == "") {
    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];

if($_SESSION['session_restaurant_id']!= $getRestKey) {
	$sessionRestId = $_SESSION['session_restaurant_id'];
    $delCart = "DELETE FROM food_cart WHERE session_cart_id='$session_cart_id' AND restaurant_id = '$sessionRestId' ";
    $conn->query($delCart);

    $delCartIng = "DELETE FROM food_update_cart_ingredients WHERE session_cart_id='$session_cart_id'";
    $conn->query($delCartIng);
}
?>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="#0"><?php echo $getFoodVendorsBann['restaurant_name']; ?></a></li>                
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<?php if($getCategory->num_rows > 0) { ?>

 <?php    

    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
        $user_session_id = $_SESSION['user_login_session_id'];
        $cartItems1 = "SELECT * FROM food_cart WHERE user_id = '$user_session_id' OR session_cart_id='$session_cart_id' ";
        $cartItems = $conn->query($cartItems1);
    } else {
        $cartItems = getAllDataWhere('food_cart','session_cart_id',$session_cart_id);
    } 
?>

<div class="container margin_60_35">
		<div class="row">
        
			<div class="col-md-3">
                <p><a onclick="history.go(-1);" class="btn_side">Back to search</a></p>
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
		            <input type="hidden" id="product_id" value="<?php echo $productId; ?>" class="product_id">  
		            <input type="hidden" id="rest_id" value="<?php echo $getRestKey; ?>" class="rest_id">   			
						<td>
                        	<figure class="thumb_menu_list"><img src="<?php echo $base_url . 'uploads/food_product_images/'.$getItemsByCategory['product_image']; ?>" alt="<?php echo $getItemsByCategory['product_name']; ?>" ></figure>
							<h5><?php echo $i; ?>. <?php echo $getItemsByCategory['product_name']; ?></h5>
							<p>
								<?php echo $getItemsByCategory['specifications']; ?>
							</p>
						</td>
						<td>
							<?php $getFirstPrice =  getIndividualDetails('food_product_weight_prices','product_id',$productId); ?>
							<strong id="get_price_<?php echo $productId; ?>">Rs. <?php echo $getFirstPrice['product_price']; ?></strong>							
						</td>


						<td>
							<div class="selectdiv">
							<label>
							<input type="hidden" id="item_price_<?php echo $productId; ?>" name="item_price" value="<?php echo $getFirstPrice['product_price']; ?>">
							<input type="hidden" id="item_category_id_<?php echo $productId; ?>" name="item_category_id" value="<?php echo $getItemsByCategory['category_id']; ?>">
							<?php $getWeightTypes = getAllDataWhere('food_product_weight_prices','product_id',$productId); ?>
							<select name="item_weight_type" id="item_weight_type_<?php echo $productId; ?>" class="get_product_id" data-key-product-id="<?php echo $productId?>" >
		                      <?php while($getWeightType = $getWeightTypes->fetch_assoc()) {  ?>
		                      <?php $getWeight =  getIndividualDetails('food_product_weights','id',$getWeightType['weight_type_id']); ?>
		                          <option value="<?php echo $getWeightType['weight_type_id']; ?>"><?php echo $getWeight['weight_type']; ?></option>
		                      <?php } ?>
		                   </select>
							</label>
							</div>
						</td>
						<td id="view_add_cart_btn_">
							<!-- <a class="btn_full" data-key="<?php echo $productId; ?>"  style="width:74px;">Add</a> -->

							<?php 
							$weIgId = $getFirstPrice['weight_type_id'];
							$getcnt = "SELECT * FROM food_cart WHERE food_item_id = '$productId' AND item_weight_type_id = '$weIgId' AND session_cart_id = '$session_cart_id'";
							$getCountItems = $conn->query($getcnt);
							$getIndProducartCount = $getCountItems->fetch_assoc();
							if($getIndProducartCount['item_quantity']!= '') {
								$getOnloadProductCount = $getIndProducartCount['item_quantity'];
							} else {
								$getOnloadProductCount = 0;
							}
							?>

							<a href="#0" class="remove_item"> <i class="icon_minus_alt remove_cart_item" data-key="<?php echo $productId; ?>" data-key-check="remove"></i> <a/><span id="cart_count_inc_<?php echo $productId; ?>"> <?php echo $getOnloadProductCount; ?> </span>
							<a href="#0" class="remove_item"> <i class="icon_plus_alt2 add_cart_item" data-key="<?php echo $productId; ?>"></i> <a/>
							<!-- <i class="icon_plus_alt2 add_cart_item" data-key="<?php echo $productId; ?>" data-key-price="25"></i> -->
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
					<div id="cart_box">		
						<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>			
						<span id="mycart">
						</span>
						<hr>						
                        <a href="cart.php" class="btn_full order_now">Order now <i class="icon-left"></i></a>
                        						
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
$(".add_cart_item, .remove_cart_item").click(function(){

	var ProductId = $(this).attr("data-key");
	//var ProductPrice = $(this).attr("data-key-price");
	var ProductPrice = $('#item_price_'+ProductId).val();	
	var ProductWeighType = $('#item_weight_type_'+ProductId).val();
	var restaurantId = $('#rest_id').val();
	var ProductCategoryId = $('#item_category_id_'+ProductId).val();	

	var removeItemCheck = $(this).attr("data-key-check");
	if(removeItemCheck == "remove") {
	    var removeItemCheckPro = 1;
	} else {
		var removeItemCheckPro = 0;
	}
	  $.ajax({
	  type:'post',
	  url:'save_item_cart.php',
	  data:{
	     item_id:ProductId,
	     item_price:ProductPrice,
	     item_weight:ProductWeighType,	     
	     item_remove:removeItemCheckPro,
	     rest_id:restaurantId,
	     item_cat_id:ProductCategoryId,
	  },
	  success:function(response) {  
      	$('.order_now').removeAttr("style");
      	document.getElementById("mycart").innerHTML=response;
	    //$("#mycart").slideToggle();
	  }
	 });

	$.ajax({
	  type:'post',
	  url:'get_cart_count.php',
	  data:{
	     item_id:ProductId,
	     //item_price:ProductPrice,
	     item_weight:ProductWeighType,
	  },
	  success:function(response) {
	  	//alert(response);
	  	var data = response.split(",");	
	  	var ProductUniqId = data[1];
	  	if(data[0]!=0)	 {
	  		var totalProItemsCnt = data[0];
	  	} else {
	  		var totalProItemsCnt = 0;		  		
	  	}	  	
		$('#cart_count_inc_'+ProductUniqId).html(totalProItemsCnt);	    
	    //$("#mycart").slideToggle();
	  }
	});
}); 

 $(function() {
	$('.get_product_id').change(function() {

		var productId = $(this).attr('data-key-product-id');		
		var weightTypeIncId = $(this).val();
		$.ajax({
		  type:'post',
		  url:'get_price_weights.php',
		  data:{
		  	 product_id : productId,
		     weight_type_inc_id:weightTypeIncId,		     
		  },
		  success:function(response) {
			  var data = response.split(",");
			  var ProductUniqId = data[2];
			  $('#get_price_'+ProductUniqId).html("Rs. "+data[0]);
			  $('#item_price_'+ProductUniqId).val(data[0]);
			}
		});

		$.ajax({
		  type:'post',
		  url:'get_cart_count.php',
		  data:{
		  	 item_id : productId,
		     item_weight:weightTypeIncId,		     
		  },
		  success:function(response) {
		    var data = response.split(",");	
		  	var ProductUniqId = data[1];
		  	if(data[0]!=0)	 {
		  		var totalProItemsCnt = data[0];
		  	} else {
		  		var totalProItemsCnt = 0;		  		
		  	}
			$('#cart_count_inc_'+ProductUniqId).html(totalProItemsCnt);
		  }
		});
	
	})
});

function show_cart() {
	var restaurantId = $('#rest_id').val();

    $.ajax({
      type:'post',
      url:'show_cart_items.php',
      data:{
        showcart:"cart",
        rest_id:restaurantId,
      },
      success:function(response) {
      	//alert(response);        	
        document.getElementById("mycart").innerHTML=response;   
        //alert($('#cart_count_items').val());
      	var myVar = $('#cart_count_items').val();
      	if(typeof myVar=="undefined") {
      		$('.order_now').css({"pointer-events": "none", "cursor": "not-allowed", "background-color": "#d4d4d4"});
      	} else {		
      	}     
        //$("#mycart").slideToggle();
      }
     });   
}

</script>

</body>

<?php include "search_js_script.php"; ?>
</html>