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
								<a href="<?php echo $base_url; ?>" title="">Home</a>
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
				$user_first_name = $_POST["user_first_name"];
				$user_last_name = $_POST["user_last_name"];
				$user_email = $_POST["user_email"];
				//echo "<pre>"; print_r($_POST); die;
				$user_phone = $_POST["user_phone"];
				$order_date = date("Y-m-d h:i:s");
				$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
				$random1 = substr($string1,0,3);
				$string2 = str_shuffle('1234567890');
				$random2 = substr($string2,0,3);
				$contstr = "MYSER-GR";
				$order_id = $contstr.$random1.$random2;
				$offer_id = $_GET['offer_id'];
				$offer_reward_points = $_POST["offer_reward_points"];
				$offer_end_date = $_POST["offer_end_date"];
				$offer_code = $_POST["offer_code"];
				//Saving user id 
				$user_id = $_SESSION['user_login_session_id'];

				$orders = "INSERT INTO grocery_offer_zone_orders (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `order_id`, `offer_id`, `offer_reward_points`, `offer_end_date`, `created_at`) VALUES ('$user_id','$user_first_name','$user_last_name','$user_email','$user_phone','$order_id','$offer_id','$offer_reward_points','$offer_end_date','$order_date')";
				$groceryOrders = $conn->query($orders);
				$transation_status = "Debited Reward Points to purchase coupon";
				$reward_points = "INSERT INTO grocery_reward_transactions (`user_id`, `offerzone_purchase_id`, `transation_status`, `debit_reward_points`, `created_at`) VALUES ('$user_id','$order_id','$transation_status','$offer_reward_points','$order_date')";
				$result = $conn->query($reward_points);
				if($result === TRUE) {
					header ("Location: thank_you.php");
				}
				$dataem = $_POST["user_email"];
				//$to = "srinivas@lanciussolutions.com";
				$to = $dataem;
				$from = $getSiteSettingsData1["orders_email"];
				$subject = "My Servent - Offer Coupon ";
				$message = '';
				$message .= '<body>
					<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
					<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
					 <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
					</header>
					<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
					  <h1 style="color:#fe6003">Greetings From Myservant</h1>
					  <p>Dear <span style="color:#fe6003;">'.$user_first_name.'</span>, Thank you for Purchasing Coupons.  myservant.com!</p>
						<p>Your Offer Coupon Code is: <span style="color:#fe6003;">'.$offer_code.'</span></p>
						<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
						<p>Warm Regards,<br>The Myservant Team </p>
					</article>
					<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
					</div>

					</body>';

				//echo $message; die;
				//$sendMail = sendEmail($to,$subject,$message,$from);
				$name = "My Servant - Grocery";
				$mail = sendEmail($to,$subject,$message,$from,$name);

				//Sending SMS after Purchase coupon
				$message1 = urlencode('Thank you for purchasing offer coupon. Your Offer Coupon Code is '.$offer_code.''); // Message text required to deliver on mobile number
			    $sendSMS = sendMobileSMS($message1,$user_phone);
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
												<input type="text" id="first-name" name="user_first_name" placeholder="First name" required value="<?php echo $getUser['user_full_name']; ?>">
											</p>
											<p class="field-one-half">
												<label for="last-name">Last Name *</label>
												<input type="text" id="last-name" name="user_last_name" placeholder="Last name" required>
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label for="email-address">Email Address *</label>
												<input type="email" id="email-address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="user_email" class="form-control" value="<?php echo $getUser['user_email']; ?>" placeholder="Your email" required>
											</p>
											<p class="field-one-half">
												<label for="phone">Phone *</label>
												<input type="text" id="phone" name="user_phone" maxlength="10" pattern="[0-9]{10}" value="<?php echo $getUser['user_mobile']; ?>" class="form-control valid_mobile_num" placeholder="Telephone/mobile" required>
											</p>
											<div class="clearfix"></div>
										</div>
									</div><!-- /.fields-content -->
								</div><!-- /.billing-fields -->
							</div><!-- /.box-checkout -->
						</div><!-- /.col-md-7 -->
						<?php 
				        $id = $_GET['offer_id'];
				        $user_id = $_SESSION['user_login_session_id'];
				        $offerZone = getIndividualDetails('grocery_offer_zone','id',$id); 
				        $getRewards1 = "SELECT * FROM grocery_reward_transactions WHERE user_id = '$user_id' ";
			     		$getRewards = $conn->query($getRewards1);
			     		while ($getRewards1 = $getRewards->fetch_assoc()) {
			     			$credit_reward_points += $getRewards1['credit_reward_points'];
			     			$debit_reward_points += $getRewards1['debit_reward_points'];
			     		}
			     		$totalRewards = $credit_reward_points - $debit_reward_points;
			     		?>
				        <input type="hidden" name="offer_reward_points" value="<?php echo $offerZone['offer_reward_points'];?>">
				        <input type="hidden" name="offer_end_date" value="<?php echo $offerZone['offer_end_date'];?>">
				        <input type="hidden" name="offer_code" value="<?php echo $offerZone['offer_code'];?>">
						<div class="col-md-5">
							<div class="cart-totals style2">						
								<!-- <h3>Sample Heading</h3> -->
								<div class="row">
								<div class="col-sm-3">
								<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_zone_images/'.$offerZone['offer_image'] ?>">
								</div>
								<div class="col-sm-9">
								<!-- <h4>Strawberries</h4> -->								
								<!-- <p style="margin-top:10px">Product Price : 600/-</p> -->
								</div>								
								</div><br>
								<p style="text-align:justify"><b>Description:</b> <?php echo $offerZone['offer_description'];?></p><br>
								<p><b>Minimum Reward points to purchase this coupon : <?php echo $offerZone['offer_reward_points'];?></b></p>
								<?php if($totalRewards >= $offerZone['offer_reward_points']) { ?>
								<div class="btn-order">
									<input type="submit" name="submit" value="Place Order" class="order">
								</div><!-- /.btn-order -->
								<?php } ?>
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
			<?php include "search_js_script.php"; ?>
</body>	
</html>