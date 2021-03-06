<?php include_once 'meta.php';?>
<style>
.text_brdr{
	text-align:left;
	border:1px solid #ddd;
	width:100%;
	height: auto;
	padding:20px;
	margin-bottom:20px;
}
.text_brdr p{
	font-size:13px;
	
}
.text_brdr span{
	padding-left:10px;
}
.button1{
	margin-top:15px;
	padding:0px 20px;
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
	      	$lkp_area_id = $_POST['lkp_area_id'];
	      	$lkp_sub_area_id = $_POST['lkp_sub_area_id'];
	      	$address = $_POST['address'];
	      	$created_at = date("Y-m-d h:i:s");
	      	$sql1 = "INSERT INTO grocery_add_address (`user_id`,`first_name`,`last_name`,`email`,`phone`,`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`lkp_location_id`,`lkp_sub_location_id`,`address`,`created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$lkp_area_id','$lkp_sub_area_id','$address','$created_at')";
	      	if($conn->query($sql1) === TRUE){             
	         	echo "<script type='text/javascript'>window.location='my_address.php?succ=log-success'</script>";
	      	} else {               
	         	header('Location: my_address.php?err=log-fail');
	      	} 
		}
		?>

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
								My Addresses
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-term-conditions">
			<div class="container">
				<div class="row">
				    <div class="col-md-3 col-sm-3" id="sidebar">
				    	<aside>
				           <div class="box_style_cat">
				       		<?php include_once 'dashboard_strip.php';?>
				            </div>
				        </aside>   
				 	</div><!-- End col-md-3 -->
				    <div class="col-sm-9">  
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
				     	<div class="panel-group">
				          	<div class="panel panel-default">
				                <div class="panel-heading">
				                  <h3 class="nomargin_top">My Addresses</h3>
				                </div>
								<!---start-->
				              	<div class="panel-body one">
								  	<?php
									$user_id = $_SESSION["user_login_session_id"];
						          	$getAllCustomerAddress = "SELECT * FROM grocery_add_address WHERE user_id = '$user_id' AND lkp_status_id = 0";
						          	$getCustomerAddress = $conn->query($getAllCustomerAddress);
									if($getCustomerAddress->num_rows == 0) { ?>
									<div class="row">
									  	<div class="col-sm-3"></div>
									  	<div class="col-sm-6">
											<center><img src="images/myaddress.png">
											<h4>No Addresses found in your account!</h4>
											<p>Add a delivery address.</p>
											<button class="button1">ADD ADDRESS</button></center>
										</div>
										<div class="col-sm-3"></div>
									</div>
									<?php } else { ?>
									<div class="">
										<?php $i=1; while($getCustomerDeatils = $getCustomerAddress->fetch_assoc()) { 
										$getState = getIndividualDetails('grocery_lkp_states','id',$getCustomerDeatils['lkp_state_id']);
										$getDistrict = getIndividualDetails('grocery_lkp_districts','id',$getCustomerDeatils['lkp_district_id']);
										$getPincode = getIndividualDetails('grocery_lkp_pincodes','id',$getCustomerDeatils['lkp_pincode_id']);
										$getCity = getIndividualDetails('grocery_lkp_cities','id',$getCustomerDeatils['lkp_city_id']);
										$getArea = getIndividualDetails('grocery_lkp_areas','id',$getCustomerDeatils['lkp_location_id']);
										$getsubArea = getIndividualDetails('grocery_lkp_sub_areas','id',$getCustomerDeatils['lkp_sub_location_id']);
										?>
										<div class="text_brdr">
											<label class="container3">
									  			<input type="radio" checked="checked" class="make_it_default" name="make_it_default" value="<?php echo $getCustomerDeatils['id']; ?>">Address <?php echo $i;?>
								  				<span class="checkmarkR1"></span>
											</label>
											<p><b><?php echo $getCustomerDeatils['first_name']; ?><span> <?php echo $getCustomerDeatils['phone']; ?></span></b></p>
											<p><?php echo $getState['state_name']; ?>,<?php echo $getDistrict['district_name']; ?>,<?php echo $getCity['city_name']; ?>,<?php echo $getArea['area_name']; ?><?php if($getCustomerDeatils['lkp_sub_location_id'] != 0) { echo ','.$getsubArea['sub_area_name']; } ?> - <?php echo $getPincode['pincode']; ?>,</p>
											<p><?php echo $getCustomerDeatils['address']; ?>.</p>
										</div>
										<?php $i++; } ?>
										<center><button class="button1">ADD NEW ADDRESS</button></center>
									</div>
									<?php } ?>
				              	</div>
							  	<!---end-->
							  	<!---start-->
							  	<?php 
								$id = $_SESSION['user_login_session_id'];
								$getUserData = getAllDataWhere('users','id',$id);
								$getUser = $getUserData->fetch_assoc();?>
				              	<div class="panel-body three">
							      	<form method="post">
				                  		<div class="col-md-12">				 
								  			<div class="col-md-9">
								  				<div class="row">
								  					<div class="col-sm-6">
														<div class="form-group">
															<label for="first-name">First Name *</label>
															<input type="text" id="first-name" name="first_name" placeholder="First name" required value="<?php echo $getUser['user_full_name']; ?>">
														</div>
													</div>
												 	<div class="col-sm-6">
														<div class="form-group">
															<label for="last-name">Last Name *</label>
															<input type="text" id="last-name" name="last_name" placeholder="Last name" required>
														</div>
													</div>
									 				<div class="col-sm-6">
														<div class="form-group">
															<label for="email-address">Email Address *</label>
															<input type="email" id="email-address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" class="form-control" value="<?php echo $getUser['user_email']; ?>" placeholder="Your email" required readonly>
														</div>
													</div>
									 				<div class="col-sm-6">
														<div class="form-group">
															<label for="phone">Phone *</label>
															<input type="text" id="phone" name="mobile" maxlength="10" pattern="[0-9]{10}" value="<?php echo $getUser['user_mobile']; ?>" class="form-control valid_mobile_num" placeholder="Telephone/mobile" required>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
									 						<label>State *</label>
															<?php $getStates = getAllDataWithStatus('grocery_lkp_states','0'); ?>
															<select name="lkp_state_id" id="lkp_state_id" onChange="getDistricts(this.value);" required>
																<option value="">Select State</option>
																<?php while($getStatesData = $getStates->fetch_assoc()) { ?>
																<option value="<?php echo $getStatesData['id'];?>"><?php echo $getStatesData['state_name'];?></option>
																<?php } ?>
															</select>
														</div>
													</div>
									 				<div class="col-sm-6">
														<div class="form-group">
									 						<label>District *</label>
															<select name="lkp_district_id" id="lkp_district_id" placeholder="District" onChange="getCities(this.value);" required>
																<option value="">Select District</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>City *</label>
															<select name="lkp_city_id" id="lkp_city_id" placeholder="City" onChange="getPincodes(this.value);" required>
																<option value="">Select City</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Pincode *</label>
															<select name="lkp_pincode_id" id="lkp_pincode_id" onChange="getAreas(this.value);" placeholder="Zip / Postal Code" required>
																<option value="">Select Pincode</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Location *</label>
															<select name="lkp_area_id" id="lkp_area_id" placeholder="Location" onChange="getSubAreas(this.value);" required>
																<option value="">Select Location</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Sub Location</label>
															<select name="lkp_sub_area_id" id="lkp_sub_area_id" placeholder="Location">
																<option value="">Select Sub Location</option>
															</select>
														</div>
													</div>
									 				<div class="col-sm-12">
														<div class="form-group">
															<label for="address">Address*</label>
															<textarea name="address" class="form-control" rows="5" id="comment" placeholder="Address" style="border-radius:30px;height:48px;padding:10px 0px 0px 20px" required></textarea>
														</div>
													</div>
												</div>
												<div class="form-group">
													<button class="button1" type="submit" value="save" name="save" style="width:100px;font-size:18px">Save</button>
												</div>						
				                  			</div>
								  			<div class="col-md-3"></div>
				                   		</div>        
				          			</form>
				              	</div>
							  	<!---end-->
				          	</div>
				        </div><!-- End panel-group -->
				    </div><!-- End col-md-9 -->
		    	</div><!-- End row -->
			</div><!-- /.container -->
		</section><!-- /.flat-term-conditions -->
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
	<script>
	$(document).ready(function(){
	 	$(".three").hide();
	    $(".button1").click(function(){
			$(".three").show();
			$(".one").hide();
	    });
	    setTimeout(function () {
	        $('#set_valid_msg').hide();
	      }, 2000);
	});
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
    function getSubAreas(val) { 
        $.ajax({
        type: "POST",
        url: "grocery_admin/get_sub_locations.php",
        data:'lkp_area_id='+val,
        success: function(data){
            $("#lkp_sub_area_id").html(data);
        }
        });
    }
	</script>
	<?php include "search_js_script.php"; ?>
</body>	
</html>