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
		<link rel="stylesheet" href="css/marquee.css">

	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<style>
.box_style_1 h3.inner {
background-color: #fe6003;
}
p{
	line-height:5px;
}
b, strong {
    font-weight: 600;
}
.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    margin: 4px 2px;
    cursor: pointer;
	height:40px;
	border-top-right-radius:4px;
	border-bottom-right-radius:4px;
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
			<div class="content">
			  <?php include_once './news_scroll.php';?> 
			</div>
            <div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>

					<li>Checkout</li>

				</ul>
			</div>
		</div>

		<?php 
	  	if(isset($_POST["save"]) && $_POST["save"]!="") {
	  		//echo "<pre>"; print_r($_POST); exit;
	      	$user_id =$_SESSION["user_login_session_id"];
	      	$first_name = $_POST['first_name'];
	      	$last_name = $_POST['last_name'];
	      	$email = $_POST['email'];
	      	$mobile = $_POST['mobile'];
	      	$lkp_state_id = $_POST['lkp_state_id'];
	      	$lkp_district_id = $_POST['lkp_district_id'];
	      	$lkp_city_id = $_POST['lkp_city_id'];
	      	$lkp_pincode_id = $_POST['lkp_pincode_id'];
	      	$lkp_location_id = $_POST['lkp_location_id'];
	      	$address = $_POST['address'];
	      	$created_at = date("Y-m-d h:i:s");
	      	$sql1 = "INSERT INTO food_add_address (`user_id`,`first_name`,`last_name`,`email`,`phone`,`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`lkp_location_id`,`address`,`created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$lkp_location_id','$address','$created_at')";
	      	if($conn->query($sql1) === TRUE){             
	         	echo "<script type='text/javascript'>window.location='add_address.php?succ=log-success'</script>";
	      	} else {               
	         	header('Location: add_address.php?err=log-fail');
	      	} 
		}
		?>

		<div class="container margin_60">
		<div class="feature">
			<div class="checkout-page">
				<form method="post" name="form">
				<div class="row">
					<div class="col-md-7"  style="padding-right:20px">
						<?php if(isset($_GET['succ']) && $_GET['succ'] == 'log-success' ) {  ?>                
			            <div class="alert alert-success" style="top:10px; display:block" id="set_valid_msg">
			              <strong>Success!</strong> Your Data Updated Successfully.
			            </div>               
				       <?php }?>

				        <?php if(isset($_GET['err']) && $_GET['err'] == 'log-fail' ) {  ?>            
				          <div class="alert alert-danger" style="top:10px; display:block" id="set_valid_msg">
				            <strong>Failed!</strong> Data Updation Failed.
				          </div>     
				        <?php } ?>
						<div class="billing-details">
							<div class="shop-form">
								<div class="default-title">
									<h2>Address Details</h2>
								</div>
								<div class="one">
									<?php
									$user_id = $_SESSION["user_login_session_id"];
						          	$getAllCustomerAddress = "SELECT * FROM food_add_address WHERE user_id = '$user_id' AND lkp_status_id = 0";
						          	$getCustomerAddress = $conn->query($getAllCustomerAddress);
									if($getCustomerAddress->num_rows == 0) { ?>
									<div class="row">
							  			<div class="col-sm-3"></div>
							  			<div class="col-sm-6">
											<center><img src="img/myaddress.png"></center>
											<h4>No Addresses found in your account!</h4>
											<p style="text-align:center">Add a delivery address.</p>
											<div class="row">
												<div class="col-sm-2"></div>
												<div class="col-sm-8">
								 					<div id="divId">
														<input name="submit" class="btn_full add_address" value="Add New Address">
													</div>
												</div>
												<div class="col-sm-2"></div>
											</div>
										</div>
										<div class="col-sm-3"></div>
									</div>
									<?php } else { ?>
									<?php $i=1; while($getCustomerDeatils = $getCustomerAddress->fetch_assoc()) { 
									$getState = getIndividualDetails('lkp_states','id',$getCustomerDeatils['lkp_state_id']);
									$getDistrict = getIndividualDetails('lkp_districts','id',$getCustomerDeatils['lkp_district_id']);
									$getPincode = getIndividualDetails('lkp_pincodes','id',$getCustomerDeatils['lkp_pincode_id']);
									$getCity = getIndividualDetails('lkp_cities','id',$getCustomerDeatils['lkp_city_id']);
									$getArea = getIndividualDetails('lkp_locations','id',$getCustomerDeatils['lkp_location_id']);
									?>
									<div class="feature">
										<label class="radiochck">
											<input type="radio" checked="checked" value="<?php echo $getCustomerDeatils['id']; ?>" class="make_it_default" name="make_it_default"> Address <?php echo $i;?>
										</label>
										<p><b><?php echo $getCustomerDeatils['first_name']; ?><span> <?php echo $getCustomerDeatils['phone']; ?></span></b></p>
										<p><?php echo $getState['state_name']; ?>,<?php echo $getDistrict['district_name']; ?>,<?php echo $getCity['city_name']; ?>,<?php echo $getArea['location_name']; ?> - <?php echo $getPincode['pincode']; ?></p>
										<p><?php echo $getCustomerDeatils['address']; ?>.</p>
									</div>
									<?php $i++; } ?>
									<div class="row">
										<div class="col-sm-4"></div>
										<div class="col-sm-4">
									 		<div id="divId">
												<input  name="submit" class="btn_full add_address" value="Add New Address">
											</div>
										</div>
										<div class="col-sm-4"></div>
									</div>
									<?php } ?>
								</div>
							</div>
							<?php 
							$id = $_SESSION['user_login_session_id'];
							$getUserData = getAllDataWhere('users','id',$id);
							$getUser = $getUserData->fetch_assoc();?>
							<div class="three">
								<form method="post">
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
											<select name="lkp_state_id" id="lkp_state_id" class="form-control" onChange="getDistricts(this.value);" required>
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
											<select name="lkp_district_id" id="lkp_district_id" placeholder="District" class="form-control" onChange="getCities(this.value);" required>
												<option value="">Select District</option>
											</select>
										</div>
										<?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
										<div class="form-group col-md-6">
											<label>City <sup>*</sup>
											</label>
											<select name="lkp_city_id" id="lkp_city_id" class="form-control" placeholder="City" onChange="getPincodes(this.value);" required>
												<option value="">Select City</option>
											</select>
										</div>
										<?php $getPincodes = getAllDataWithStatus('lkp_pincodes','0');?>
										<div class="form-group col-md-6">
											<label>Pincode <sup>*</sup>
											</label>
											<select name="lkp_pincode_id" id="lkp_pincode_id" class="form-control" class="form-control valid_mobile_num" maxlength="6" onChange="getLocations(this.value);" placeholder="Zip / Postal Code" required>
												<option value="">Select Pincode</option>
											</select>
										</div>
										<?php $getLocations = getAllDataWithStatus('lkp_locations','0');?>
										<div class="form-group col-md-6">
											<label>Location <sup>*</sup>
											</label>
											<select name="lkp_location_id" id="lkp_location_id" class="form-control" placeholder="Location" required>
												<option value="">Select Location</option>
											</select>
										</div>
										<!-- <div class="form-group col-md-6">
											<label>Sub Location <sup>*</sup>
											</label>
											<select name="location" id="lkp_location_id" class="form-control" placeholder="Location" required>
												<option value="">Select Sub Location</option>
												<?php while($row = $getLocations->fetch_assoc()) {  ?>
						                          <option <?php if($row['id'] == $getUserAdressDetails['location']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['location_name']; ?></option>
						                      	<?php } ?>
											</select>
										</div> -->
										<div class="form-group col-md-12">
											<label>Address <sup>*</sup>
											</label>
											<input type="text" name="address" value="" placeholder="" class="form-control" required>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4"></div>
										<div class="col-sm-4">
									 		<div id="divId">
												<input type="submit" name="save" class="btn_full" value="Submit">
											</div>
										</div>
										<div class="col-sm-4"></div>
									</div>
								</form>
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
							<div class="table-responsive">
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
                               		<input type="hidden" name="address_status" vlaue="" id="make_it_default">
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
								<div id="divId">
									<input type="button" name="submit" class="btn_full checkout" value="Place Order">
								</div>
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
	<script src="js/icheck.js"></script>
	<script>
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-grey',
			radioClass: 'iradio_square-grey'
		});
	</script>
	<script>
	$(document).ready(function(){
		$(".three").hide();
	    $(".add_address").click(function(){
			$(".three").show();
			$(".one").hide();
	    });
	    setTimeout(function () {
	        $('#set_valid_msg').hide();
	      }, 2000);
	    $(".make_it_default").click(function(){
			var defaultvalue = $(".make_it_default").val();
			if(defaultvalue == 0) {
				$("#make_it_default").val(1);
			}
			//alert($(".make_it_default").val());
	    });
	});
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
        $('.checkout').click(function(){
        	var numberOfCheckedRadio = $('input:radio:checked').length;
        	if(numberOfCheckedRadio == 0) {
        		alert("Please fill your address");
        		return false;
        	} else {
        		var radioValue = $("input[name='make_it_default']:checked").val();
		        window.location.href='checkout.php?adid='+radioValue+'';
		        return false;
        	}
		});
	</script>
</body>

</html>