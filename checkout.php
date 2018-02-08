<?php include_once 'meta.php';?>
<style>
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
	.close-icon {
	border:1px solid transparent;
	// background-color: transparent;
	display: inline-block;
	vertical-align: middle;
  outline: 0;
  cursor: pointer;
}
.close-icon:after {
	content: "X";
	display: block;
	width: 15px;
	height: 15px;
	position: absolute;
	/*background-color: #FA9595;*/
	z-index:1;
	right: 0px;
	top: 0px;
	bottom: 50px;
	margin: auto;
	padding: 2px;
	/*border-radius: 50%;*/
	text-align: center;
	color: black;
	font-weight: normal;
	font-size: 12px;
	/*box-shadow: 0 0 2px #E50F0F;*/
	cursor: pointer;
}
.form-control-feedback {
    position:absolute;
    top: 0;
    right: 0;
    z-index: 2;
    display: block;
    width: 34px;
    height: 34px;
    line-height: 54px;
    text-align: center;
    pointer-events: auto;
	 cursor: pointer;
}
.form-control:focus {
	box-shadow: 0 0 15px 5px #b0e0ee;
	border: 2px solid #bebede;
}
.order{
	background-color:#fe6003 !important;
	color:white !important;
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
								<a href="#" title="">Shop_checkout</a>
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

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
				$contstr = "MYSER-GR";
				$order_id = $contstr.$random1.$random2;
				$service_tax = $_POST["service_tax"];
				$itemCount = count($_POST["product_id"]);
				$reward_points = $_POST["reward_points"];
				$product_reward_points = $_POST["product_reward_points"];
				//Saving user id and coupon id
				$user_id = $_SESSION['user_login_session_id'];
				$payment_status = 2; //In progress
				$country = 99;		
				$_SESSION['order_last_session_id'] = $order_id;
				$delivery_charges = $_POST["delivery_charges"];
				$delivery_date = date("Y-m-d",strtotime($_POST["delivery_slot_date"]));
				$delivery_time = $_POST["delivery_time"];

				if($_SESSION['CART_TEMP_RANDOM'] == "") {
			        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
			    }
			    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
			    if($_POST['walletid'] == 1) {
				    $wallet_id = $_SESSION['wallet_id'];
				    if($_POST['wallet_amount'] > $_POST['order_total_without_wallet']) {
				    	$wallet_amount = $_POST["order_total_without_wallet"];
				    } else {
				    	$wallet_amount = $_POST['wallet_amount'];
				    }
				} else {
					$wallet_id = '';
				    $wallet_amount = '';
				}

				for($i=0;$i<$itemCount;$i++) {
					//Generate sub randon id
					$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
					$random1 = substr($string1,0,3);
					$string2 = str_shuffle('1234567890');
					$random2 = substr($string2,0,3);
					$date = date("ymdhis");
					$contstr = "MYSERVANT-GR";
					$sub_order_id = $contstr.$random1.$random2.$date;
					$orders = "INSERT INTO grocery_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `address`, `lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `lkp_pincode_id`, `lkp_location_id`, `order_note`, `category_id`, `sub_cat_id`, `product_id`, `item_weight_type_id`, `item_price`, `item_quantity`, `sub_total`, `order_total`, `coupen_code`, `coupen_code_type`, `discout_money`,  `payment_method`,`lkp_payment_status_id`,`service_tax`,`delivery_charges`,`delivery_slot_date`,`delivery_time`, `order_id`,`order_sub_id`,`wallet_id`,`wallet_amount`, `created_at`, `reward_points`, `product_reward_points`) VALUES ('$user_id','".$_POST["first_name"]."','".$_POST["last_name"]."', '".$_POST["email"]."','".$_POST["mobile"]."','".$_POST["address"]."','".$_POST["lkp_state_id"]."','".$_POST["lkp_district_id"]."','".$_POST["lkp_city_id"]."','".$_POST["lkp_pincode_id"]."','".$_POST["lkp_area_id"]."','".$_POST["order_note"]."','" . $_POST["category_id"][$i] . "','" . $_POST["sub_cat_id"][$i] . "','" . $_POST["product_id"][$i] . "','".$_POST['product_weight'][$i]."','" . $_POST["product_price"][$i] . "','" . $_POST["product_quantity"][$i] . "','".$_POST["sub_total"]."','".$_POST["order_total"]."',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','".$_POST["service_tax"]."','$delivery_charges','$delivery_date','$delivery_time', '$order_id','$sub_order_id','$wallet_id','$wallet_amount','$order_date','$reward_points','" . $_POST["product_reward_points"][$i] . "')";
					$groceryOrders = $conn->query($orders);
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
		if($_SESSION['user_login_session_id'] == '') {
		    header ("Location: logout.php");
		} 
		?>
		<?php 
		$id = $_SESSION['user_login_session_id'];
		$getUserData = getAllDataWhere('users','id',$id);
		$getUser = $getUserData->fetch_assoc();?>

		<section class="flat-checkout">
			<form action="" method="post" accept-charset="utf-8">
				<div class="container">
					<div class="row">
						<div class="col-md-7">
							<div class="box-checkout">
								<div class="billing-fields">
									<div class="fields-title">
										<h3>Billing details</h3>
										<span></span>
										<div class="clearfix"></div>
									</div><!-- /.fields-title -->
									<div class="fields-content">
										<div class="field-row">
											<p class="field-one-half">
												<label for="first-name">First Name *</label>
												<input type="text" id="first-name" name="first_name" placeholder="First name" required value="<?php echo $getUser['user_full_name']; ?>">
											</p>
											<p class="field-one-half">
												<label for="last-name">Last Name *</label>
												<input type="text" id="last-name" name="last_name" placeholder="Last name" required>
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label for="email-address">Email Address *</label>
												<input type="email" id="email-address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" class="form-control" value="<?php echo $getUser['user_email']; ?>" placeholder="Your email" required>
											</p>
											<p class="field-one-half">
												<label for="phone">Phone *</label>
												<input type="text" id="phone" name="mobile" maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getUser['user_mobile']; ?>" class="form-control valid_mobile_num" placeholder="Telephone/mobile" required>
											</p>
											<div class="clearfix"></div>
										</div>
										
										<!-- <div class="checkbox">
											<input type="checkbox" id="create-account" name="create-account" checked>
											<label for="create-account">Create an account?</label>
										</div> -->
									</div><!-- /.fields-content -->
								</div><!-- /.billing-fields -->
							</div><!-- /.box-checkout -->
						</div><!-- /.col-md-7 -->
						<?php
						    if($_SESSION['CART_TEMP_RANDOM'] == "") {
						        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
						    }
						    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
						    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
						        $user_session_id = $_SESSION['user_login_session_id'];
						        $cartItems1 = "SELECT * FROM grocery_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND product_quantity!='0'";
						        $cartItems = $conn->query($cartItems1);
						    } else {
						      $cartItems1 = "SELECT * FROM grocery_cart WHERE  product_quantity!='0' AND session_cart_id='$session_cart_id' ";
						      $cartItems = $conn->query($cartItems1);
						    } 
						?>
						<div class="col-md-5">
							<div class="cart-totals style2">						
								<h3>Sample Heading</h3>
								<div class="row">
								<div class="col-sm-3">
								<img src="images/product/other/sta.jpg">
								</div>
								<div class="col-sm-9">
								<h4>Strawberries</h4>								
								<p style="margin-top:10px">Product Price : 600/-</p>								
								</div>								
								</div><br>
								<p style="text-align:justify"><b>Description:</b> The garden strawberry is a widely grown hybrid species of the genus Fragaria, collectively known as the strawberries. It is cultivated worldwide for its fruit.</p><br>
								<p><b>Your Reward Points : 400</b></p>
									<div class="btn-order">									
										<input type="submit" name="submit" value="Place Order" class="order">
									</div><!-- /.btn-order -->
							</div><!-- /.cart-totals style2 -->
						</div><!-- /.col-md-5 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</form>
		</section><!-- /.flat-checkout -->

		<section class="flat-row flat-iconbox style5">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Free Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/order.png" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/payment.png" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/return.png" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
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
		    function getDistricts(val) { 
		        $.ajax({
		        type: "POST",
		        url: "grocery_admin/get_districts.php",
		        data:'lkp_state_id='+val,
		        success: function(data){
		            $("#lkp_district_id").html(data);
		        }
		        });
		    }
		    function getCities(val) { 
		        $.ajax({
		        type: "POST",
		        url: "grocery_admin/get_cities.php",
		        data:'lkp_district_id='+val,
		        success: function(data){
		            $("#lkp_city_id").html(data);
		        }
		        });
		    }
		    function getPincodes(val) { 
		        $.ajax({
		        type: "POST",
		        url: "grocery_admin/get_pincodes.php",
		        data:'lkp_city_id='+val,
		        success: function(data){
		            $("#lkp_pincode_id").html(data);
		        }
		        });
		    }
		    function getAreas(val) { 
		        $.ajax({
		        type: "POST",
		        url: "grocery_admin/get_locations.php",
		        data:'lkp_pincode_id='+val,
		        success: function(data){
		            $("#lkp_area_id").html(data);
		        }
		        });
		    }
		    var totalWithoutWallet = $('#order_total_without_wallet').val();
		    var totalWithWallet = $('#order_total').val();
		    $('.radio-button').on("click", function(event){
			    $(this).prop('checked', false);
			    $('#wallet').hide();
			    $('.price-total').html("Rs. "+totalWithoutWallet);
			    $('#order_total').val(totalWithoutWallet);
			});
			$('.radio-button').on("change", function(event){
			    $(this).prop('checked', true);
			    $('#wallet').show();
			    $('.price-total').html("Rs. "+totalWithWallet);
			    $('#order_total').val(totalWithWallet);
			});
		    </script>

			<script type="text/javascript">
			$('#discount_price').hide();
			$('.close-icon').hide();
			    $(".apply_coupon").click(function(){
			        var coupon_code = $("#coupon_code").val();
			        var order_total = $('#order_total').val();
			        $.ajax({
			           type: "POST",
			           url: "apply_coupon.php",
			           data: "coupon_code="+coupon_code+"&cart_total="+order_total,
			           success: function(value){
			           	//alert(value);
			           		if(value == 0) {
			           			$('#coupon_status').html("<span>Please Enter Valid Coupon.</span>");
			           			//alert('Please Enter Valid Coupon');
			           			$("#coupon_code").val('');
			           		} else if(value == 1) {
			           			$('#coupon_status').html("<span>Enter Coupon is not valid for this Service.</span>");
			           			//alert('Enter Coupon is not valid for this Service');
			           			$("#coupon_code").val('');
			           		} else if(value == 2) {
			           			$('#coupon_status').html("<span>Already Used.</span>");
			           			//alert('Enter Coupon is not valid for this Service');
			           			$("#coupon_code").val('');
			           		} else{
			           			$('#coupon_status').html("");
			           			$('#coupon_code').attr('readonly','true');
			           			$(".apply_coupon").hide();
			           			var data = value.split(",");
				          		$('.cart_total2').html("Rs. "+Math.round(data[0]));
					            $('#order_total').val(Math.round(data[0]));
			               		$('#discount_price').show();
			               		$('.close-icon').show();
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
						$('.close-icon').hide();
						$('#discount_money,#coupon_code_type').val('');
					});	
				});
			</script>
</body>	
</html>