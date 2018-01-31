<?php ob_start(); ?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html style="overflow-x:hidden">
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

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	
    <!-- Header ================================================== -->
    <header>
        <?php include_once './header.php';?>
    </header>
    <style>
/* The container */
.radiob {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.radiob input {
    position: absolute;
    opacity: 0;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radiob:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.radiob input:checked ~ .checkmark {
    background-color: #555;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.radiob input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.radiob .checkmark:after {
 left: 9px;
    top: 6px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
#options_2 label {
    font-size: 12px;
    padding-top: 5px;
}
::-ms-clear {
	  display: none;
	}

	.form-control-clear {
	  z-index: 10;
	  pointer-events: auto;
	  cursor: pointer;
	}
	.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 5px 9px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	height:40px;
	border-top-right-radius:4px;
	border-bottom-right-radius:4px;
}
.alert-dismissable .close1{
    position: relative;
    top: -2px;
    color: inherit;
	 right: 0px;
    opacity: 2;
    font-size: 15px;
	font-weight:bold;
	cursor:pointer;
}
.close1 {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}

</style>
    <!-- End Header =============================================== -->
<?php
if($_SESSION['user_login_session_id'] == '') {
    header ("Location: logout.php");
} 
?>
<!-- SubHeader =============================================== -->
<section class="parallax-window"  id="short"  data-parallax="scroll" data-image-src="img/img_2.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
    	 <h1>Place your order</h1>            
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#0">Home</a></li>
                <li><a href="#0">Checkout</a></li>
                <li>Place Your Order</li>
            </ul>
            
        </div>
    </div><!-- Position -->

    <?php 
		if(isset($_POST["submit"]) && $_POST["submit"]!="") {
			
			//Save Order function here
			$coupon_code = $_POST["coupon_code"];
			$coupon_code_type = $_POST["coupon_code_type"];
			$discount_money = $_POST["discount_money"];
			//echo "<pre>"; print_r($_POST); die;
			$payment_group = $_POST["pay_mn"];
			$order_date = date("Y-m-d h:i:s");
			$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
			$random1 = substr($string1,0,3);
			$string2 = str_shuffle('1234567890');
			$random2 = substr($string2,0,3);
			$contstr = "MYSER-FOOD";
			$order_id = $contstr.$random1.$random2;
			$service_tax = $_POST["service_tax"];
			$itemCount = count($_POST["food_item_id"]);
			//Saving user id and coupon id
			$user_id = $_SESSION['user_login_session_id'];
			$payment_status = 2; //In progress
			$country = 99;		
			$_SESSION['order_last_session_id'] = $order_id;
			$dev_type = $_POST["dev_type"];
			if($dev_type == 1) {
				$delivery_charges = '0';
			} else {
				$delivery_charges = $_POST["delivery_charge"];
			}

			if($_SESSION['CART_TEMP_RANDOM'] == "") {
		        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
		    }
		    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];

			for($i=0;$i<$itemCount;$i++) {
				//Generate sub randon id
				$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
				$random1 = substr($string1,0,3);
				$string2 = str_shuffle('1234567890');
				$random2 = substr($string2,0,3);
				$date = date("ymdhis");
				$contstr = "MYSER-FOOD";
				$sub_order_id = $contstr.$random1.$random2.$date;
				$getItemPrice = "SELECT * FROM food_product_weight_prices WHERE product_id = '".$_POST["food_item_id"][$i]."' AND weight_type_id = '".$_POST["item_weight_type_id"][$i]."'";
				$getItemPrice1 = $conn->query($getItemPrice);
				$getItemPriceDatils = $getItemPrice1->fetch_assoc();
				$orders = "INSERT INTO food_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `address`, `country`, `postal_code`, `city`, `order_note`, `category_id`, `product_id`, `item_weight_type_id`, `order_vendor_price`, `item_price`, `item_quantity`,`restaurant_id`, `sub_total`, `order_total`, `coupen_code`, `coupen_code_type`, `discout_money`,  `payment_method`,`lkp_payment_status_id`,`delivery_type_id`,`service_tax`,`delivery_charges`, `order_id`,`order_sub_id`, `created_at`) VALUES ('$user_id','".$_POST["firstname_order"]."','".$_POST["lastname_order"]."', '".$_POST["email_order"]."','".$_POST["tel_order"]."','".$_POST["address_order"]."','$country','".$_POST["pcode_oder"]."','".$_POST["city"]."','".$_POST["order_note"]."','" . $_POST["food_category_id"][$i] . "','" . $_POST["food_item_id"][$i] . "','" . $_POST["item_weight_type_id"][$i] . "','".$getItemPriceDatils['vendor_price']."','" . $_POST["item_price"][$i] . "','" . $_POST["item_quantity"][$i] . "','".$_POST["restaurant_id"]."','".$_POST["sub_total"]."','".$_POST["order_total"]."',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','$dev_type','".$_POST["service_tax"]."','$delivery_charges', '$order_id','$sub_order_id','$order_date')";
				$servicesOrders = $conn->query($orders);
			} 
			$getOrderIngredients = getAllDataWhere('food_update_cart_ingredients','session_cart_id',$session_cart_id);
			while($Ingeredientsdata = $getOrderIngredients->fetch_assoc()) {
				$sql = "INSERT INTO food_order_ingredients ( `user_id`,`cart_id`,`order_id`,`session_cart_id`,`food_item_id`,`item_ingredient_id`,`item_ingredient_price`,`item_ingredient_name`) VALUES ('$user_id','".$Ingeredientsdata["cart_id"]."','$order_id','".$Ingeredientsdata["session_cart_id"]."','".$Ingeredientsdata["food_item_id"]."','".$Ingeredientsdata["item_ingredient_id"]."','".$Ingeredientsdata["item_ingredient_price"]."','".$Ingeredientsdata["item_ingredient_name"]."')";
        		$result = $conn->query($sql);
			}
			if($payment_group == 1) {
				//cod 
				header("Location: ordersuccess.php?odi=".$order_id."&pay_stau=2");				
			} elseif ($payment_group == 2) {
				//online 
				header("Location: PayUMoney_form.php?odi=".$order_id."&pay_stau=2");
			} else {
				header("Location: ordersuccess.php?odi=".$order_id."&pay_stau=1");
			}			
		}
    ?>
    <?php 
	if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    $user_session_id = $_SESSION['user_login_session_id'];
	$getRest = "SELECT * FROM food_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND item_quantity!='0' ";
	$getRest1 = $conn->query($getRest);
   	$getRest2 = $getRest1->fetch_assoc();
    $restaurant_id1 = $getRest2['restaurant_id'];
	?>

<!-- Content ================================================== -->
<div class="container margin_60_35">
		<div class="row">
			<div class="col-md-3 col-sm-3">
            
				<div class="box_style_2 hidden-xs info">
					<h4 class="nomargin_top">Delivery time <i class="icon_clock_alt pull-right"></i></h4>
					<?php $getDeliveryTime = getIndividualDetails('food_vendors','id',$restaurant_id1); ?>
					<p>
						Minimum Delivery Time: <?php echo $getDeliveryTime['min_delivery_time']; ?>
					</p>
					<hr>
					<?php $getCheckoutDetails = getIndividualDetails('food_content_pages','id',16); ?>
					<h4><?php echo $getCheckoutDetails['title']; ?><i class="icon_creditcard pull-right"></i></h4>
					<p>
						<?php echo $getCheckoutDetails['description']; ?>
					</p>
				</div><!-- End box_style_1 -->
                
				<div class="box_style_2 hidden-xs" id="help">
					<i class="icon_lifesaver"></i>
					<h4>Need <span>Help?</span></h4>
					<a href="tel://<?php echo $getFoodSiteSettingsData['mobile'];?>" class="phone"><?php echo $getFoodSiteSettingsData['mobile'];?></a>
					<!-- <small>Monday to Friday 9.00am - 7.30pm</small> -->
				</div>
                
			</div><!-- End col-md-3 -->
			<?php 
			$id = $_SESSION['user_login_session_id'];
			$getUserData = getAllDataWhere('users','id',$id);
			$getUser = $getUserData->fetch_assoc();?>
            <form method="post" name="form">
			<div class="col-md-5 col-sm-5">
				<div class="box_style_2" id="order_process">
					<h2 class="inner">Your order details</h2>
					<div class="form-group">
						<label>First name *</label>
						<input type="text" class="form-control" id="firstname_order" value="<?php echo $getUser['user_full_name']; ?>" name="firstname_order" placeholder="First name" required>
					</div>
					<div class="form-group">
						<label>Last name *</label>
						<input type="text" class="form-control" id="lastname_order" name="lastname_order" placeholder="Last name" required>
					</div>
					<div class="form-group">
						<label>Telephone/mobile *</label>
						<input type="text" id="tel_order" name="tel_order" maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getUser['user_mobile']; ?>" class="form-control valid_mobile_num" placeholder="Telephone/mobile" required>
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="email" id="email_booking_2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email_order" class="form-control" value="<?php echo $getUser['user_email']; ?>" placeholder="Your email" required>
					</div>
					<div class="form-group">
						<label>Your full address *</label>
						<input type="text" id="address_order" name="address_order" class="form-control" placeholder=" Your full address" required>
					</div>
					<?php $getCitiesData = getAllDataWhere('lkp_cities','lkp_status_id',0); ?>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>City *</label>
								<select name="city" id="lkp_city_id" class="form-control" required>
											<option value="">Select City</option>
											<?php while($getCities = $getCitiesData->fetch_assoc()) { ?>
											<option value="<?php echo $getCities['id'];?>"><?php echo $getCities['city_name'];?></option>
											<?php } ?>
										</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Postal code *</label>
								<input type="text" id="pcode_oder" required maxlength="6"  onkeypress="return isNumberKey(event)" name="pcode_oder" class="form-control valid_mobile_num" placeholder=" Your postal code" required>
							</div>
						</div>
					</div>
					
					<hr>
					<div class="row">
						<div class="col-md-12">
				
								<label>Notes for the restaurant</label>
								<textarea class="form-control" style="height:150px" placeholder="Ex. Allergies, cash change..." name="order_note" id="order_note"></textarea>
				
						</div>
					</div>
				</div>
				
			</div><!-- End col-md-6 -->

			<?php 
			if($_SESSION['CART_TEMP_RANDOM'] == "") {
		        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
		    }
		    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
		    $user_session_id = $_SESSION['user_login_session_id'];
			$cartItems1 = "SELECT * FROM food_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND item_quantity!='0' ";
    		$cartItems = $conn->query($cartItems1);
			?>            

            <input type="hidden" name='key' type='text' value='71tFEF'>
			<input type="hidden" name='txnid' type='text' value='<?php echo uniqid( "srinivas_" );?>'>		
			<input type="hidden" name='amount' type='text' value='1'>
			<input type="hidden" name='firstname' type='text' value='srinivas'>
			<input type="hidden" name='email' type='text' value='srinivas@lanciussolutions.in'>
			<input type="hidden" name='phone' type='text' value='1234567890'>
			<input type="hidden" name='productinfo' type='text' value='Just another test site'>
			<input type="hidden" name='furl' type='text' value='online_order_success.php'>
			<input type="hidden" name='surl' type='text' value='online_order_failure.php'>
            
			<div class="col-md-4 col-sm-4" id="sidebar">
            	<div class="theiaStickySidebar">
				<div id="cart_box">
					<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
					<table class="table table_summary">
					<tbody>
					<?php $cartTotal = 0; $service_tax = 0;
                    	while ($getCartItems = $cartItems->fetch_assoc()) { 
                    		$restaurant_id = $getCartItems['restaurant_id']; ?>
                    <?php $getProductDetails= getIndividualDetails('food_products','id',$getCartItems['food_item_id']); ?>
					<tr>
						<td>
						 <strong> <?php echo $getProductDetails['product_name']; ?></strong>
							<?php 
			                $getAddons = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '".$getCartItems['food_item_id']."' AND cart_id='".$getCartItems['id']."' AND session_cart_id = '$session_cart_id'";
			                $getAddonData = $conn->query($getAddons);
			                while($getadcartItems = $getAddonData->fetch_assoc() ) {
			               ?>
			               <div class="alert alert-dismissable" style="margin-bottom:-21px;padding-left:0px">
						   <a class="close1" ><i class="icon-trash" style="color:#fe6003" onclick="removeIngItem(<?php echo $getadcartItems['id']; ?>);"></i></a>
						   <p style="font-size:12px"><?php echo $getadcartItems['item_ingredient_name'] . ":". $getadcartItems['item_ingredient_price']; ?> </p>
						   </div>
						   <?php } ?>
						</td>
						<td>
							<strong><?php echo $getCartItems['item_quantity']; ?> x Rs. <?php echo $getCartItems['item_price']; ?></strong>
						</td>
						<td>
							<strong class="pull-right">Rs. <?php echo  $getCartItems['item_price']*$getCartItems['item_quantity']; ?><?php  $cartTotal += $getCartItems['item_price']*$getCartItems['item_quantity']; ?></strong>
						</td>
					</tr>

					<input type="hidden" name="food_category_id[]" value="<?php echo $getCartItems['food_category_id']; ?>">
					<input type="hidden" name="food_item_id[]" value="<?php echo $getCartItems['food_item_id']; ?>">
					<input type="hidden" name="item_weight_type_id[]" value="<?php echo $getCartItems['item_weight_type_id']; ?>">
					<input type="hidden" name="item_price[]" value="<?php echo $getCartItems['item_price']; ?>">
					<input type="hidden" name="item_quantity[]" value="<?php echo $getCartItems['item_quantity']; ?>">
					<input type="hidden" name="restaurant_id" value="<?php echo $getCartItems['restaurant_id']; ?>">

					<?php } ?>					
					</tbody>
					</table>
					<hr>
					<div class="row" id="options_2">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label class="radiob"><input type="radio" value="2" checked name="dev_type" class="check_dev_type" id="del_check" data-pri-key="<?php echo $cartTotal;?>">Delivery
							<span class="checkmark"></span></label>
						</div>
						<!-- <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label class="radiob"><input type="radio" value="1" name="dev_type" class="check_dev_type" id="take_away_check" data-pri-key="<?php echo $cartTotal; ?>">Take Away<span class="checkmark"></span></label>
						</div> -->
					</div><!-- Edn options 2 -->					
					<hr>
					<table class="table table_summary">
					<tbody>
					<?php
			            $getAddOnsPrice = "SELECT * FROM food_update_cart_ingredients WHERE session_cart_id = '$session_cart_id'";
			            $getAddontotal = $conn->query($getAddOnsPrice);
			            $getAdstotal = 0;
			            while($getAdTotal = $getAddontotal->fetch_assoc()) {
			                $getAdstotal += $getAdTotal['item_ingredient_price'];
			              }
					?>
					<tr>
						<td>
							 Subtotal <span class="pull-right">Rs.<?php echo $cartTotal; ?></span>
						</td>
					</tr>
					<?php if($getAdstotal!=0) { ?>
		            <tr>
		                <td>Extra Add On's Price <span class="pull-right">Rs. <?php echo $getAdstotal; ?></span></td>
		            </tr>
					<?php } ?>
					<?php $getDeliveryCharge = getIndividualDetails('food_vendors','id',$restaurant_id);
					$DeliveryCharges = $getDeliveryCharge['delivery_charges']; ?>
					<tr id="hide_del_fee">
						<td>
							 Delivery fee <span class="pull-right">Rs.<?php echo $DeliveryCharges ; ?></span>
						</td>
					</tr>
					<?php $service_tax += ($getFoodSiteSettingsData['service_tax']/100)*$cartTotal; ?>
                    <tr>
						<td>
							 Service Tax <span class="pull-right">Rs.<?php echo $service_tax; ?>(<?php echo $getFoodSiteSettingsData['service_tax'] ; ?>%)</span>
						</td>
					</tr>
					<tr id="discount_price">
		                <td>Discount<span style="color:green">(Coupon Applied.) <span id="discount_price1" class="pull-right"></span></td>
		            </tr>
					<tr>
						<td class="total">
							<?php $order_total = $cartTotal+$service_tax+$DeliveryCharges+$getAdstotal; ?>
							 TOTAL <span class="pull-right cart_total2" id="apply_price_aft_del">Rs. <?php echo round($order_total); ?></span>
							  
						</td>
					</tr>
					</tbody>
					</table>

					<input type="hidden" name="delivery_charge" value="<?php echo $DeliveryCharges;?>" id="delivery_charge">
					<input type="hidden" name="sub_total" value="<?php echo $cartTotal; ?>" id="sub_total">
					<input type="hidden" name="order_total" value="<?php echo round($order_total); ?>" id="order_total">
					<input type="hidden" name="service_tax" value="<?php echo $service_tax; ?>" id="service_tax">
					<input type="hidden" name="getAdstotal" value="<?php echo $getAdstotal; ?>" id="getAdstotal">
					<input type="hidden" name="discount_money" value="0" id="discount_money">
					<input type="hidden" name="coupon_code_type" value="" id="coupon_code_type">
					<input type="hidden" name="user_id" value="<?php echo $user_session_id; ?>">
					<hr>

					<div class="row">
						<div class="form-group">
						<div class="row">
						<div class="col-sm-8 col-xs-8">
									<div class="field-group has-feedback has-clear twof" style="width:260px;margin-left:40px;margin-top:4px">
								      <input autocomplete="off" type="text" name="coupon_code" style="text-transform:uppercase" id="coupon_code" value="" placeholder="Coupon Code" class="form-control" style="border-radius:0px">
								      <span class="form-control-clear icon-cancel-1 form-control-feedback hidden" style="border-radius:0px"></span>
								    </div>
									</div>
									<div class="col-sm-4 col-xs-4">
									<div class="field-group btn-field">
										<button type="button" class="button1 btn_cart_outine apply_coupon">Apply</button>
									</div>
									</div>
								</div>
								</div>
					</div><!-- Edn options 2 -->
					<hr>

					<div class="row" id="options_2">
					
						<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',2); 
							if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="col-lg-8 col-md-12 col-sm-12 col-xs-6">
							<label class="radiob"><input type="radio" value="2" checked name="pay_mn" id="online_check">Online Payment<span class="checkmark"></span></label>
						</div>
						<?php } ?>
						<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',1); 
							if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-6">
							<label class="radiob"><input type="radio" value="1" name="pay_mn"id="cod_check">COD<span class="checkmark"></span></label>
						</div>
						<?php } ?>
					</div><!-- Edn options 2 -->

					<hr>

					<input type="submit" name="submit" value="Place Order" class="btn_full">					
                    <!-- <a class="btn_full_outline" href="index.php"><i class="icon-right"></i> Add other items</a> -->
				</div><!-- End cart_box -->
                </div><!-- End theiaStickySidebar -->
			</div><!-- End col-md-3 -->
            </form>
		</div><!-- End row -->
</div><!-- End container -->
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
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>

<script type="text/javascript">
$('.check_dev_type').click(function(){

	var getcheckRadio = $(this).val();	
	var getOrderDelCharge = parseFloat($('#delivery_charge').val());	
	var getSubTotal = parseFloat($(this).attr('data-pri-key'));
	var getServiceTax = parseFloat($('#service_tax').val());
	var getAdonsTotal = parseFloat($('#getAdstotal').val());
	if(getcheckRadio == 1) {
		$('#hide_del_fee').hide();		
		$('#order_total').val(Math.round(getSubTotal+getServiceTax+getAdonsTotal));
		$('#apply_price_aft_del').html(Math.round(getSubTotal+getServiceTax+getAdonsTotal));
		$('#coupon_code').removeAttr("readonly");
		$('.form-control-clear').siblings('input[type="text"]').val('').trigger('propertychange').focus();
		$(".apply_coupon").show();
		$('#discount_price').hide();
		$('#discount_money,#coupon_code,#coupon_code_type').val('');
	} else {
		$('#hide_del_fee').show();
		$('#order_total').val(Math.round(getSubTotal + getOrderDelCharge+getServiceTax+getAdonsTotal));
		$('#apply_price_aft_del').html(Math.round(getSubTotal + getOrderDelCharge+getServiceTax+getAdonsTotal));
		$('#coupon_code').removeAttr("readonly");
		$('.form-control-clear').siblings('input[type="text"]').val('').trigger('propertychange').focus();
		$(".apply_coupon").show();
		$('#discount_price').hide();
		$('#discount_money,#coupon_code,#coupon_code_type').val('');
	}
});
</script>
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
<script type="text/javascript">
$('#discount_price').hide();
    $(".apply_coupon").click(function(){
        var coupon_code = $("#coupon_code").val();
        var order_total = $('#order_total').val();
        $.ajax({
           type: "POST",
           url: "apply_coupon.php",
           data: "coupon_code="+coupon_code+"&cart_total="+order_total,
           success: function(value){
           		if(value == 0) {
           			alert('Please Enter Valid Coupon');
           			$("#coupon_code").val('');
           		} else if(value == 1) {
           			alert('Enter Coupon is not valid for this Service');
           			$("#coupon_code").val('');
           		} else{
           			$('#coupon_code').attr('readonly','true');
           			$(".apply_coupon").hide();
           			var data = value.split(",");
	          		$('.cart_total2').html("Rs. "+data[0]);
		            $('#order_total').val(data[0]);
               		$('#discount_price').show();
               		$('#discount_price1').html("Rs. "+data[1]);
               		$('#discount_money').val(data[2]);
               		$('#coupon_code_type').val(data[3]);
               	}
        	}
        });

        $('.has-clear input[type="text"]').on('input propertychange', function() {            	
		  var $this = $(this);
		  var visible = Boolean($this.val());
		  $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
		}).trigger('propertychange');

		$('.form-control-clear').click(function() {
			$('#coupon_code').removeAttr("readonly");
		    $(this).siblings('input[type="text"]').val('').trigger('propertychange').focus();
		    $(".apply_coupon").show();
		    $('.cart_total2').html("Rs. "+order_total);
			$('#order_total').val(order_total);
			$('#discount_price').hide();
			$('#discount_money,#coupon_code_type').val('');
		});	
	});
	function removeIngItem(ingUniqId) { 
	  $.ajax({
	      type:'post',
	      url:'delete_cart_ingredants.php',
	      data:{
	         ingUniqId : ingUniqId,        
	      },
	      success:function(response) {
	        location.reload();
	      }
	    });
	}
</script>


<?php include "search_js_script.php"; ?>
</body>
</html>