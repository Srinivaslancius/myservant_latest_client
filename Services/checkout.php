<?php ob_start(); ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include_once 'meta.php';?>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

	<!-- CSS -->
	<link href="css/base.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="css/shop.css" rel="stylesheet">

	<!-- Range slider -->
	<link href="css/ion.rangeSlider.css" rel="stylesheet">
	<link href="css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
        <link href="css/skins/square/grey.css" rel="stylesheet">

	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<style>
.box_style_1 h3.inner {
background-color: #fe6003;
}
</style>
</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	
	<!-- End Preload -->

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
        <header id="plain">
		<?php include_once './top_header.php';?>
		<!-- End top line-->

		<div class="container">
                    <?php include_once './menu.php';?>
		</div>
		<!-- container -->
                
        </header>
	<!-- End Header -->

	
	<!-- End Section -->

	<main>
		<?php
	    if($_SESSION['user_login_session_id'] == '') {
	        header ("Location: logout.php");
	    } 
	    ?>
             <div class="container-fluid page-title">
			<?php  
				  if(!empty($getPartnersBanner['image'])) { ?> 	
					<div class="row">
						<img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getPartnersBanner['image'] ?>" alt="<?php echo $getPartnersBanner['title'];?>" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php } else { ?>
					<div class="row">
						<img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php }?>
    	</div>
<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
                </div>
            <div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>

					<li>checkout</li>

				</ul>
			</div>
		</div>

		<?php 
		if(isset($_POST["submit"]) && $_POST["submit"]!="") {

				$first_name = $_POST["first_name"];
				$last_name = $_POST["last_name"];
				$email = $_POST["email"];
				$mobile = $_POST["mobile"];
				$state = $_POST["state"];
				$district = $_POST["district"];
				$city = $_POST["city"];
				$postal_code=$_POST["postal_code"];
				$location = $_POST["location"];
				$address = $_POST["address"];
				$order_note = $_POST["order_note"];
				$sub_total = $_POST["sub_total"];
				$order_total = $_POST["order_total"];
				$coupon_code = $_POST["coupon_code"];
				$coupon_code_type = $_POST["coupon_code_type"];
				$discount_money = $_POST["discount_money"];
				$payment_group = $_POST["payment_group"];
				$order_date = date("Y-m-d h:i:s");
				$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
				$random1 = substr($string1,0,3);
				$string2 = str_shuffle('1234567890');
				$random2 = substr($string2,0,3);
				$contstr = "MYSER-SERVICES";
				$order_id = $contstr.$random1.$random2;
				$service_tax = $_POST["service_tax"];
				$servicesCount = count($_POST["service_id"]);
				//Saving user id and coupon id
				$user_id = $_SESSION['user_login_session_id'];
				$payment_status = 2; //In progress
				
				for($i=0;$i<$servicesCount;$i++) {
					//Generate sub randon id
					$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
					$random1 = substr($string1,0,3);
					$string2 = str_shuffle('1234567890');
					$random2 = substr($string2,0,3);
					$date = date("ymdhis");
					$contstr = "MYSER-SERVICES";
					$sub_order_id = $contstr.$random1.$random2.$date;
					$orders = "INSERT INTO services_orders (`user_id`,`first_name`, `last_name`, `email`, `mobile`, `state`, `district`, `city`, `postal_code`, `location`, `address`, `order_note`, `category_id`, `sub_category_id`,  `group_id`, `service_id`, `service_price_type_id`,`service_price`,`order_price`,`service_quantity`, `service_selected_date`, `service_selected_time`, `sub_total`, `order_total`, `coupon_code`, `coupon_code_type`, `discount_money`, `payment_method`,`lkp_payment_status_id`,`service_tax`, `order_id`,`order_sub_id`, `created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$state','$district','$city','$postal_code','$location','$address','$order_note','" . $_POST["category_id"][$i] . "','" . $_POST["sub_cat_id"][$i] . "','" . $_POST["group_id"][$i] . "','" . $_POST["service_id"][$i] . "','" . $_POST["service_price_type_id"][$i] . "','" . $_POST["service_price"][$i] . "','" . $_POST["service_price"][$i] . "','" . $_POST["service_quantity"][$i] . "','" . $_POST["service_selected_date"][$i] . "','" . $_POST["service_selected_time"][$i] . "','$sub_total','$order_total',UPPER('$coupon_code'),'$coupon_code_type','$discount_money','$payment_group','$payment_status','$service_tax', '$order_id','$sub_order_id','$order_date')";
					$servicesOrders = $conn->query($orders);
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

		<div class="container margin_60">
		<div class="feature">
			<div class="checkout-page">

				<?php
				$id = $_SESSION['user_login_session_id'];
				$getUserData = getAllDataWhere('users','id',$id);
				$getUser = $getUserData->fetch_assoc();
				$getUserAdress = "SELECT * FROM services_orders WHERE user_id = $id ORDER BY id DESC";
				$getUserAdress1 = $conn->query($getUserAdress);
				$getUserAdressDetails = $getUserAdress1->fetch_assoc();
				?>
				<form method="post" name="form">
				<div class="row">
					<div class="col-md-7"  style="padding-right:20px">

						<div class="billing-details">
							<div class="shop-form">
								<div class="default-title">
									<h2>Billing Details</h2>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>First name <sup>*</sup>
										</label>
										<input type="text" name="first_name" id="name_contact" value="<?php echo $getUser['user_full_name']; ?>" placeholder="" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label>Last name <sup>*</sup>
										</label>
										<input type="text" name="last_name" id="lastname_contact" value="" placeholder="" class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<label>Email Address <sup>*</sup>
										</label>
										<input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email_contact" value="<?php echo $getUser['user_email']; ?>" placeholder="" class="form-control" required readonly>
									</div>
									<div class="form-group col-md-6">
										<label>Phone <sup>*</sup>
										</label>
										<input type="tel" name="mobile" id="phone_contact" value="<?php echo $getUser['user_mobile']; ?>" placeholder="" maxlength="10" pattern="[0-9]{10}" class="form-control valid_mobile_num" required>
									</div>
									<?php $getStates = getAllDataWithStatus('lkp_states','0'); ?>
									<div class="form-group col-md-6">
										<label>State <sup>*</sup>
										</label>
										<select name="state" id="lkp_state_id" class="form-control" onChange="getDistricts(this.value);" required>
											<option value="">Select State</option>
											<?php while($getStatesData = $getStates->fetch_assoc()) { ?>
											<option <?php if($getStatesData['id'] == $getUserAdressDetails['state']) { echo "Selected"; } ?> value="<?php echo $getStatesData['id'];?>"><?php echo $getStatesData['state_name'];?></option>
											<?php } ?>
										</select>
									</div>
									<?php $getDistrcits = getAllDataWithStatus('lkp_districts','0');?>
									<div class="form-group col-md-6">
										<label>District <sup>*</sup>
										</label>
										<select name="district" id="lkp_district_id" placeholder="District" class="form-control" onChange="getCities(this.value);" required>
											<option value="">Select District</option>
											<?php while($row = $getDistrcits->fetch_assoc()) {  ?>
					                          <option <?php if($row['id'] == $getUserAdressDetails['district']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
					                      	<?php } ?>
										</select>
									</div>
									<?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
									<div class="form-group col-md-6">
										<label>City <sup>*</sup>
										</label>
										<select name="city" id="lkp_city_id" class="form-control" placeholder="City" onChange="getPincodes(this.value);" required>
											<option value="">Select City</option>
											<?php while($row = $getCities->fetch_assoc()) {  ?>
					                          <option <?php if($row['id'] == $getUserAdressDetails['city']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
					                      	<?php } ?>
										</select>
									</div>
									<?php $getPincodes = getAllDataWithStatus('lkp_pincodes','0');?>
									<div class="form-group col-md-6">
										<label>Pincode <sup>*</sup>
										</label>
										<select name="postal_code" id="lkp_pincode_id" class="form-control" class="form-control valid_mobile_num" maxlength="6" onChange="getLocations(this.value);" placeholder="Zip / Postal Code" required>
											<option value="">Select Pincode</option>
											<?php while($row = $getPincodes->fetch_assoc()) {  ?>
					                          <option <?php if($row['id'] == $getUserAdressDetails['postal_code']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['pincode']; ?></option>
					                      	<?php } ?>
										</select>
									</div>
									<?php $getLocations = getAllDataWithStatus('lkp_locations','0');?>
									<div class="form-group col-md-6">
										<label>Location <sup>*</sup>
										</label>
										<select name="location" id="lkp_location_id" class="form-control" placeholder="Location" required>
											<option value="">Select Location</option>
											<?php while($row = $getLocations->fetch_assoc()) {  ?>
					                          <option <?php if($row['id'] == $getUserAdressDetails['location']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['location_name']; ?></option>
					                      	<?php } ?>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label>Address <sup>*</sup>
										</label>
										<input type="text" name="address" value="" placeholder="" class="form-control" required>
									</div>
									<div class="form-group col-lg-12 col-md-12 col-xs-12">
										<label>Order note</label>
										<textarea id="order_note" name="order_note" placeholder="Notes about your order, e.g. special notes for delivery" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
						<!--End Billing Details-->
					</div>
					<!--End Col-->

					<?php
					    if($_SESSION['CART_TEMP_RANDOM'] == "") {
					        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
					    }
					    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
					    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
					        $user_session_id = $_SESSION['user_login_session_id'];
					        $cartItems1 = "SELECT * FROM services_cart WHERE user_id = '$user_session_id' OR session_cart_id='$session_cart_id' ";
        					$cartItems = $conn->query($cartItems1);
					    } else {                                       
					        $cartItems = getAllDataWhere('services_cart','session_cart_id',$session_cart_id);
					    } 
						$getPriceType = "SELECT * FROM services_cart WHERE (services_price_type_id=2) AND (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') ";
        					$getCount = $conn->query($getPriceType);
					?>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <aside class="col-md-5">
					<div class="box_style_1">
						<h3 class="inner">- Summary -</h3>
						<table class="table table_summary">
                                                    <thead>
                                                        <tr>
                                                            <th>SERVICE</th>
                                                            <th>QUANTITY</th>
                                                            <th>PRICE</th>
                                                        </tr>
                                                    </thead>
                                                    <?php $cartTotal = 0; $service_tax = 0;
                              		while ($getCartItems = $cartItems->fetch_assoc()) { 
                               		$getSerName= getIndividualDetails('services_group_service_names','id',$getCartItems['service_id']); ?>

                               	<input type="hidden" name="category_id[]" value="<?php echo $getCartItems['service_category_id']; ?>">
                                <input type="hidden" name="sub_cat_id[]" value="<?php echo $getCartItems['service_sub_category_id']; ?>">
                                <input type="hidden" name="group_id[]" value="<?php echo $getCartItems['group_id']; ?>">
                                <input type="hidden" name="service_id[]" value="<?php echo $getCartItems['service_id']; ?>">
                                <input type="hidden" name="service_quantity[]" value="<?php echo $getCartItems['service_quantity']; ?>">
                                <input type="hidden" name="service_price_type_id[]" value="<?php echo $getSerName['service_price_type_id']; ?>">
                                	<?php if($getSerName['service_price_type_id'] == 1) {
			                            $cartTotal1 += $getSerName['service_price']*$getCartItems['service_quantity'];
			                        ?>
									<input type="hidden" name="service_price[]" value="<?php echo $getSerName['service_price']; ?>">
									<?php } elseif($getSerName['price_after_visit_type_id'] == 1) { 
										$cartTotal1 = $cartTotal;
									?>
									<input type="hidden" name="service_price[]" value="<?php echo $getSerName['price_after_visiting']; ?>">
									<?php } else { 
										$cartTotal1 = $cartTotal;
									?>
									<input type="hidden" name="service_price[]" value="<?php echo $getSerName['service_min_price']; ?> - <?php echo $getSerName['service_max_price']; ?>">
									<?php } ?>
                                <input type="hidden" name="service_selected_date[]" value="<?php echo $getCartItems['service_selected_date']; ?>">
                                <input type="hidden" name="service_selected_time[]" value="<?php echo $getCartItems['service_selected_time']; ?>">
							<tbody>
								<tr>
									<td>
										<?php echo $getSerName['group_service_name']; ?>
									</td>
									<td>
                                                                            <?php echo $getCartItems['service_quantity'];?> 
										
									</td>
                                                                        <?php if($getSerName['service_price_type_id'] == 1) {
			                            $cartTotal += $getSerName['service_price']*$getCartItems['service_quantity'];
			                        ?>
                                                                        <td>
                                                                           Rs. <?php echo $getSerName['service_price']; ?>
                                                                        </td>
                                                                        <?php } elseif($getSerName['price_after_visit_type_id'] == 1) { ?>
                                                                        <td>
                                                                            <?php echo $getSerName['price_after_visiting']; ?>
                                                                        </td>
                                                                        <?php } else { ?>
                                                                        <td>
                                                                            Rs. <?php echo $getSerName['service_min_price']; ?> - <?php echo $getSerName['service_max_price']; ?>
                                                                        </td>
                                                                        <?php } ?>
								</tr>
								<?php } ?>
							</tbody>
                                                        <input type="hidden" name="sub_total" id="sub_total" value="<?php echo $cartTotal1; ?>">
								<input type="hidden" name="coupon_code_type" id="coupon_code_type" value="">
								<input type="hidden" name="discount_money" id="discount_money" value="">
                                                                <tfoot>
                                                                <tr>
                                                                    <td>Sub Total</td>
                                                                    
                                                                    <td colspan="2" class="text-right">Rs. <?php echo $cartTotal; ?></td>
                                                                </tr>
                                                                <?php if($getCount->num_rows == 0) { 
																	$service_tax += ($getSiteSettingsData['service_tax']/100)*$cartTotal;
																?>
                                                                <tr>
                                                                    <td>GST (<?php echo $getSiteSettingsData['service_tax'] ; ?>%)</td>
                                                                    <td colspan="2" class="text-right">Rs. <?php echo $service_tax ; ?></td>
                                                                </tr>
                                                                <?php }  ?>
                                                                <input type="hidden" name="service_tax" id="service_tax" value="<?php echo $service_tax ; ?>">
                                                                <tr>

                                                                    <td><strong>Order Total</strong><br><small>(*Minimum Charges applicable.)<small></td>

                                                                    
                                                                    <td colspan="2" class="text-right"><strong>Rs. <?php echo $cartTotal+$service_tax; ?></strong></td>
                                                                </tr>
                                                                <input type="hidden" name="order_total" id="order_total" value="<?php echo $cartTotal1+$service_tax; ?>">
                                                                </tfoot>    
						</table>
						
						
					</div>
					<div class="box_style_4">
						<span class="icon_set_1_icon-57" style="font-size:50px"></span>
						<h4>Payment Method</h4>
                                                <div id="policy">
                                                    <?php if($getCount->num_rows == 0) { ?>
									<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',2); ?>
									<?php if($getOnlineDeatils['enable_status'] == 0) { ?>
						<div class="form-group text-left">
							<label for="payment-2">
								<input type="radio" name="payment_group" id="payment-2" value="2" required>Online Payment</label>
						</div>
                                                    <?php } } ?>
									<?php $getOnlineDeatils = getIndividualDetails('payment_gateway_options','id',1); ?>
									<?php if($getOnlineDeatils['enable_status'] == 0) { ?>
                                                    <div class="form-group text-left">
							<label for="payment-3">
								<input type="radio" type="radio" name="payment_group" id="payment-3" value="1" required>COD</label>
						</div>
                                                    <?php } ?>
                                                </div>
                                                <div id="divId">
								<input type="submit" name="submit" class="btn_full" value="Place Order"></i>
							</div>
                                                
					</div>
				</aside>
                                        
                                        
                                        
                                        
                                        
					
				</div>
				</form>
				<?php if(!isset($_SESSION['user_login_session_id'])) { ?>
				<script type="text/javascript">document.getElementById('divId').style.display = 'none';</script>
				<?php } ?>
			</div>
			</div>
		</div>
		<!-- End Container -->
	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
        </footer><!-- End footer -->

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="button"><i class="icon_set_1_icon-78"></i>
			</button>
		</form>
	</div><!-- End Search Menu -->

	<!-- Common scripts -->
	<script src="/cdn-cgi/scripts/84a23a00/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<!-- Validation purpose add scripts -->
	<?php include_once 'common_validations_scripts.php'; ?>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>


	<script>
		if ($('.prod-tabs .tab-btn').length) {
			$('.prod-tabs .tab-btn').on('click', function (e) {
				e.preventDefault();
				var target = $($(this).attr('href'));
				$('.prod-tabs .tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				$('.prod-tabs .tab').fadeOut(0);
				$('.prod-tabs .tab').removeClass('active-tab');
				$(target).fadeIn(500);
				$(target).addClass('active-tab');
			});

		}
	</script>
	<!-- Script to get Cities -->
    <script type="text/javascript">
    function getDistricts(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_districts.php",
        data:'lkp_state_id='+val,
        success: function(data){
            $("#lkp_district_id").html(data);
        }
        });
    }
    function getCities(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_cities.php",
        data:'lkp_district_id='+val,
        success: function(data){
            $("#lkp_city_id").html(data);
        }
        });
    }
    function getPincodes(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_pincodes.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
    function getLocations(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_locations.php",
        data:'lkp_pincode_id='+val,
        success: function(data){
            $("#lkp_location_id").html(data);
        }
        });
    }
    </script>
    <script type="text/javascript">
    $('#discount_price').hide();
        $(".apply_coupon").click(function(){
            var coupon_code = $("#coupon_code").val();
            var cart_total = $('#sub_total').val();
            var order_total = $('#order_total').val();
            var service_tax = $('#service_tax').val();
            $.ajax({
               type: "POST",
               url: "apply_coupon.php",
               data: "coupon_code="+coupon_code+"&cart_total="+cart_total+"&service_tax="+service_tax,
               success: function(value){
               		if(value == 0) {
               			alert('Please Enter Valid Coupon');
               			$("#coupon_code").val('');
               			$(".form-control-clear").html('');
               		} else if(value == 1) {
               			alert('Enter Coupon is not valid for this Service');
               			$("#coupon_code").val('');
               			$(".form-control-clear").html('');
               		} else{
               			$('#coupon_code').attr('readonly','true');
               			var data = value.split(",");
		          		$('#cart_total2').html(data[0]);
			            $('#order_total').val(data[0]);
	               		$('#discount_price').show();
	               		$('#discount_price1').html(data[1]);
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
			  $(this).siblings('input[type="text"]').val('')
			    .trigger('propertychange').focus();
			    $('#cart_total2').html(order_total);
				$('#order_total').val(order_total);
				$('#discount_price').hide();
				$('#discount_money').val('');
	            $('#coupon_code_type').val('');
			});
		});
	</script>
	<style type="text/css">
	  .error {
	    color: $errorMsgColor;
	  }

	</style>
	<style>
	::-ms-clear {
	  display: none;
	}

	.form-control-clear {
	  z-index: 10;
	  pointer-events: auto;
	  cursor: pointer;
	}
	</style><script src="js/icheck.js"></script>
	<script>
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-grey',
			radioClass: 'iradio_square-grey'
		});
	</script>
</body>

</html>