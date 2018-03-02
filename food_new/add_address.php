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
    top: 4px;
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
    font-size: 13px;
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
.feature_2{
	margin-bottom:15px;
}

</style>
    <!-- End Header =============================================== -->
<?php
if($_SESSION['user_login_session_id'] == '') {
    header ("Location: logout.php");
} 
?>
<!-- SubHeader =============================================== -->
<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">Add Address</div>
</div>

<!-- End SubHeader ============================================ -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Add Address</li>
            </ul>
            
        </div>
    </div><!-- Position -->
<!-- Content ================================================== -->
<div class="container margin_60_35">
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<div class="box_style_2" id="order_process">
					<h2 class="inner">Add Address</h2>
					<div class="One">
					<div class="row">
									  	<div class="col-sm-3"></div>
									  	<div class="col-sm-6">
											<center><img src="img/myaddress.png">
											<h4>No Addresses found in your account!</h4>
											<p>Add a delivery address.</p>
											<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-4">						
						<input type="submit" name="submit" value="ADD ADDRESS" class="btn_full">
						</div>
						<div class="col-md-4">
						</div>
						</div>
										</div>
										<div class="col-sm-3"></div>
									</div>
									</div>
									<div class="Two">
					<div class="feature_2">
					<label class="containerf"> 
					  <input type="radio" checked="checked" name="radio">Address 1
					  <span class="checkmarkf"></span>
					  
					</label>
					<p><b>Swapna, <span>9876543210</span></b></p>
					<p>Plot No:403, lancius IT Solutions, Patrikanage 3, Madhapur, Hyderabad, Telangana, India</P>
				</div>
				<div class="feature_2">
					<label class="containerf"> 
					  <input type="radio" name="radio">Address 2
					  <span class="checkmarkf"></span>
					  
					</label>
					<p><b>Swapna, <span>9876543210</span></b></p>
					<p>Plot No:403, lancius IT Solutions, Patrikanage 3, Madhapur, Hyderabad, Telangana, India</P>
				</div>
				<div class="feature_2">
					<label class="containerf"> 
					  <input type="radio" name="radio">Address 3
					  <span class="checkmarkf"></span>
					  
					</label>
					<p><b>Swapna, <span>9876543210</span></b></p>
					<p>Plot No:403, lancius IT Solutions, Patrikanage 3, Madhapur, Hyderabad, Telangana, India</P>
				</div>
			
				<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-4">						
						<input type="submit" name="submit" value="ADD NEW ADDRESS" class="btn_full">
						</div>
						<div class="col-md-4">
						</div>
						</div>
					</div>
					<div class="Three">
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>First name *</label>
						<input type="text" class="form-control" id="firstname_order" value="<?php echo $getUser['user_full_name']; ?>" name="firstname_order" placeholder="First name" required>
					</div>
					</div>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Last name *</label>
						<input type="text" class="form-control" id="lastname_order" name="lastname_order" placeholder="Last name" required>
					</div>
					</div>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Telephone/mobile *</label>
						<input type="text" id="tel_order" name="tel_order" maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getUser['user_mobile']; ?>" class="form-control valid_mobile_num" placeholder="Telephone/mobile" required >
					</div>
					</div>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Email *</label>
						<input type="email" id="email_booking_2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email_order" class="form-control" value="<?php echo $getUser['user_email']; ?>" placeholder="Your email" required readonly>
					</div>
					</div>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>State *</label>
						<input type="text" class="form-control" id="lastname_order" name="lastname_order" placeholder="Last name" required>
					</div>
					</div>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>District*</label>
						<input type="text" class="form-control" id="lastname_order" name="lastname_order" placeholder="Last name" required>
					</div>
					</div>
					
					<?php $getCitiesData = getAllDataWhere('lkp_cities','lkp_status_id',0); ?>
					
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
					
					<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Location*</label>
								<select name="city" id="lkp_city_id" class="form-control" required>
											<option value="">Select Location*</option>
											<?php while($getCities = $getCitiesData->fetch_assoc()) { ?>
											<option value="<?php echo $getCities['id'];?>"><?php echo $getCities['city_name'];?></option>
											<?php } ?>
										</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Sub Location*</label>
								<select name="city" id="lkp_city_id" class="form-control" required>
											<option value="">Select Sub Location*</option>
											<?php while($getCities = $getCitiesData->fetch_assoc()) { ?>
											<option value="<?php echo $getCities['id'];?>"><?php echo $getCities['city_name'];?></option>
											<?php } ?>
										</select>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
						<div class="form-group">
						<label>Your full address *</label>
						<input type="text" id="address_order" name="address_order" class="form-control" placeholder=" Your full address" required>
					</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
						<label>Notes for the restaurant</label>
						<textarea class="form-control" style="height:150px" placeholder="Ex. Allergies, cash change..." name="order_note" id="order_note"></textarea>
					</div>
					</div>
					
					<hr>
					<div class="row">
						<div class="col-md-12">
						<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-4">						
						<input type="submit" name="submit" value="Submit" class="btn_full">
						</div>
						<div class="col-md-4">
						</div>
						</div>						
						</div>
					</div>
					</div>
			</div><!-- End col-md-6 -->
</div>
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
					<!-- <hr>
					<div class="row" id="options_2">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label class="radiob"><input type="radio" value="2" checked name="dev_type" class="check_dev_type" id="del_check" data-pri-key="<?php echo $cartTotal;?>">Delivery
							<span class="checkmark"></span></label>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label class="radiob"><input type="radio" value="1" name="dev_type" class="check_dev_type" id="take_away_check" data-pri-key="<?php echo $cartTotal; ?>">Take Away<span class="checkmark"></span></label>
						</div>
					</div> --><!-- Edn options 2 -->					
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
					
					<!--<div class="row">
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
					</div>-->

					<!--<div class="row" id="options_2">

						<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',1); 
							if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label class="radiob"><input type="radio" value="1" required name="pay_mn" id="cod_check">COD<span class="checkmark"></span></label>
						</div><br>
						<?php } ?>					
						<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',2); 
							if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label class="radiob"><input type="radio" value="2" required name="pay_mn" id="online_check">Payu<span class="checkmark"></span></label>
						</div><br>
						<?php } ?>	
						<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',3); 
							if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label class="radiob"><input type="radio" value="3"  required name="pay_mn" id="online_check">HDFC<span class="checkmark"></span></label>
						</div><br>
						<?php } ?>
						<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',4); 
							if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label class="radiob"><input type="radio" value="4"  required name="pay_mn" id="online_check" style="margin-top:5px"><img src="img/paytm1.png"><b>(Debit Card/Credit Card/NB/UPI/Wallet)</b><span class="checkmark"></span></label>
						</div>
						<?php } ?>					
					</div>-->

					<hr>
					<div class="checkbox">
						<input type="checkbox" id="checked-order" name="checked-order" checked required>
						<label for="checked-order" style="padding-left:30px"> I’ve read and accept the terms & conditions *</label>
					</div><br>
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
           		} else if(value == 2) {
           			alert('Already Used.');
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

<script>
$(document).ready(function(){
	 $(".Two,.Three").hide();
    $(".One").click(function(){
        $(".One,.Three").hide();
		$(".Two").show();
		 $(".Two").click(function(){
			   $(".Two,.One").hide();
			   $(".Three").show();
		 })
    });
});
</script>
<?php include "search_js_script.php"; ?>
</body>
</html>