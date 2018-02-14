<?php include_once 'meta.php';?>
<style>
.order-tracking{
	padding: 48px 50px 116px;
	text-align:left;
}
.text_brdr{
	text-align:left;
	border:1px solid #ddd;
	width:100%;
	height: auto;
	padding:20px;
	margin-bottom:20px;
}
.text_brdr h4{
	font-size:14px;
	
}
.text_brdr span{
	padding-left:10px;
}
.button1{
	margin-top:15px;
	padding:0px 20px;
}
.cart-totals h4{
	color:#f28b00;
	font-size:17px;
	margin-top:20px;
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
	      	$address = $_POST['address'];
	      	$created_at = date("Y-m-d h:i:s");
	      	$sql1 = "INSERT INTO grocery_add_address (`user_id`,`first_name`,`last_name`,`email`,`phone`,`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`lkp_location_id`,`address`,`created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$lkp_area_id','$address','$created_at')";
	      	if($conn->query($sql1) === TRUE){             
	         	echo "<script type='text/javascript'>window.location='add_address1.php?succ=log-success'</script>";
	      	} else {               
	         	header('Location: add_address1.php?err=log-fail');
	      	} 
		}
		?>

		<section class="flat-tracking">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-7">
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
						<div class="order-tracking">
							<div class="title">
								<center><h2>My Addresses</h2></center>
							</div><!-- /.title --><br>
							<div class="tracking-content">
								<div class="one">
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
										?>
										<div class="text_brdr">
											<label class="container3">
									  			<input type="radio" checked="checked" class="make_it_default" name="make_it_default" value="<?php echo $getCustomerDeatils['id']; ?>">Address <?php echo $i;?>
								  				<span class="checkmarkR1"></span>
											</label>
											<p><b><?php echo $getCustomerDeatils['first_name']; ?><span> <?php echo $getCustomerDeatils['phone']; ?></span></b></p>
											<p><?php echo $getState['state_name']; ?>,<?php echo $getDistrict['district_name']; ?>,<?php echo $getCity['city_name']; ?>,<?php echo $getArea['area_name']; ?> - <?php echo $getPincode['pincode']; ?>,</p>
											<p><?php echo $getCustomerDeatils['address']; ?>.</p>
										</div>
										<?php $i++; } ?>
										<center><button class="button1">ADD NEW ADDRESS</button></center>
									</div>
									<?php } ?>
								</div>
								<?php 
								$id = $_SESSION['user_login_session_id'];
								$getUserData = getAllDataWhere('users','id',$id);
								$getUser = $getUserData->fetch_assoc();?>
								<div class="three">
									<form method="post">
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
													<select name="lkp_area_id" id="lkp_area_id" placeholder="Location" required>
														<option value="">Select Location</option>
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
						  			</form>   
								</div>	
							</div><!-- /.tracking-content -->
						</div><!-- /.order-tracking -->
					</div><!-- /.col-md-12 -->
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
					$cartTotal = 0;
					while ($getCartItems = $cartItems->fetch_assoc()) { 
						$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
						$cartTotal = $getCartItems['product_price']*$getCartItems['product_quantity'];
						$subTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];
					}
					?>
					<input type="hidden" name="address_status" vlaue="" id="make_it_default">
                    <div class="col-lg-5">
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                           <h4 style="margin-bottom:10px">Next Availble Time Slots</h4>
						   <div class="row">
												    <div class="col-sm-4">
                                                   <p><b>Date :</b><span id="date"></span></p>
												   </div>
												    <div class="col-sm-8">
												   <p><b>Time Slot :</b><span id="time"></span></p>
												   </div>
												   </div><br>
												   <div class="row" style="margin-bottom:10px">
												    <div class="col-sm-4">
                                                <h4>Delivery Date:</h4>
												</div>
												<div class="col-sm-6">
                                            		<input type="text" id="datepicker" name="slot_date" class="slot_date" readonly style="height:45px;">	
													</div>
													<div class="col-sm-2">
													</div>
													</div>
                                        		

                                        		<?php 

                                        		$getDuration = getIndividualDetails('grocery_manage_time_slots','lkp_status_id',0);
                                        		$cur_time=date("Y-m-d H:i:00");
												$duration='+'.$getDuration['booking_time_gap'].' minutes';
												$getCurTime = date('H:i:00', strtotime($duration, strtotime($cur_time)));

                                        		$getTimeSlots = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  AND start_time > '$getCurTime' ";
                                        		$getTotalTimeSlots = $conn->query($getTimeSlots);
                                        		$gettotalSlt = $getTotalTimeSlots->num_rows;

                                        		?>
                                        		<div class="row">
												    <div class="col-sm-4">
                                                <h4>Delivery Slot:</h4>
												</div>
												<div class="col-sm-6">
												<?php if($gettotalSlt == 0) { ?>
                                        		<?php 

                                        			$getTimeSlots1 = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  ";
                                        			$getTotalTimeSlots1 = $conn->query($getTimeSlots1);
                                        		?>
			                                        
			                                        	<select name="slot_timings" style="border: 1px solid #ccc;" id="slot_timings" style="height:45px;">
															<?php 
																while($row1 = $getTotalTimeSlots1->fetch_assoc()) {  	
															?>
																<option value="<?php echo $row1['total_slot_time']; ?>"><?php echo $row1['total_slot_time']; ?></option>
															<?php } ?>
														</select>
			                                        
			                                    <?php } else { ?>
			                                    	
			                                        	<select name="slot_timings" style="border: 1px solid #ccc;" id="slot_timings"style="height:45px;">
															<?php 
																while($row = $getTotalTimeSlots->fetch_assoc()) {  	
															?>
																<option value="<?php echo $row['total_slot_time']; ?>">Today - <?php echo $row['total_slot_time']; ?></option>
															<?php } ?>
														</select>
			                                        
			                                    <?php } ?>
												</div>
													<div class="col-sm-2">
													</div>
													</div>
                                      
								
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="subtotal" id="subtotal">Rs . <?php echo $subTotal; ?></td>
                                        </tr>
                                        <tr>
                                            <td>GST(<?php echo $getSiteSettingsData1['service_tax']; ?>%)</td>
                                            <?php $service_tax += ($getSiteSettingsData1['service_tax']/100)*$subTotal; ?>
                                            <td class="subtotal" id="serviceTax1">Rs . <?php echo $service_tax; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Charges</td>
                                            <td class="subtotal">Rs . <?php echo $getSiteSettingsData1['delivery_charges']; ?></td>
                                        </tr>
                                        <?php
                                        	$_SESSION['slot_date'] =  $_POST['slot_date'];
                                        	$_SESSION['slot_timings'] =  $_POST['slot_timings'];
                                        ?>
                                        <tr>
                                            <td>Delivery Date</td>
                                            <td class="subtotal" id="serviceTax1"><?php echo changeDateFormat($_SESSION['slot_date']); ?></td>         
                                        </tr>
                                        <tr>
                                            <td>Delivery Slot</td>
                                            <td class="subtotal" id="serviceTax1"><?php echo $_SESSION['slot_timings']; ?></td>                                           
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="price-total" id="ordertotal">Rs. <?php echo round($subTotal+$service_tax+$getSiteSettingsData1['delivery_charges']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    <button type="button" class="checkout" title="" style="background-color: #fe6003;width:100%">Next</button>
                                </div><!-- /.btn-cart-totals -->
                        </div><!-- /.cart-totals -->
                    </div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-tracking -->

		<section class="flat-row flat-iconbox style1 background">
			<div class="container">
				<div class="row">
                                    
					<div class="col-md-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Worldwide Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
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
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
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
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
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
					</div><!-- /.col-md-3 -->
                                    
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
<script type="text/javascript" src="javascript/jquery.zoom.min.js"></script>
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
		
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {

			var d = new Date();
	  		var month = d.getMonth()+1;
	  		var day = d.getDate();
	  		var today = (month<10 ? '0' : '') + month + "/" 
              + (day<10 ? '0' : '') + day + '/'
	              + d.getFullYear();

            var sltcnt= <?php echo $gettotalSlt; ?>		
            if(sltcnt == 0)   {

            	$('#datepicker').datepicker({
				format: "mm/dd/yyyy",
				minDate:1,
				todayHighlight: true,
				startDate: today+1,				
				autoclose: true,
				maxDate: "+2M",
					onSelect: function (dateText, inst) {
				        //alert("su");
				        $.ajax({
	                        type:"POST",
	                        url:"get_slot_timings.php",
	                        data:{
							     dateText:dateText,
							 },
	                        success: function(result)
	                        {
	                           //alert("result");
	                           $("#slot_timings").html(result);
	                        }
                    	});
				    },
				});

            } else {

            	$('#datepicker').datepicker({
				format: "mm/dd/yyyy",
				minDate:0,
				todayHighlight: true,
				startDate: today,				
				autoclose: true,
				maxDate: "+2M",
					onSelect: function (dateText, inst) {
				        //alert("su1");
					    $.ajax({
	                        type:"POST",
	                        url:"get_slot_timings.php",
	                        data:{
							     dateText:dateText,
							 },
	                        success: function(result)
	                        {
	                           //alert("result");
	                           $("#slot_timings").html(result);
	                        }
                    	});
				    },
				});
            }
		  	$('#datepicker').datepicker('setDate', today);
		});
		</script>
		<script>
		function getDateTime() {
			var date = $('#datepicker').val();
			var time = $('#slot_timings').val();
		    $("#date").html(date);
		    $("#time").html(time);
		}
		</script>
		<script type="text/javascript">
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
			$(".make_it_default").click(function(){
				var defaultvalue = $(".make_it_default").val();
				if(defaultvalue == 0) {
					$("#make_it_default").val(1);
				}
				//alert($(".make_it_default").val());
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

		</script>

		<script type="text/javascript">
	        $('.checkout').click(function(){
	        	var radioValue = $("input[name='make_it_default']:checked").val();
	        	//var slotDate = $('#slot_date').val();
	        	//var slotTimings = $('#slot_timings').val();
		        window.location.href='shop_checkout.php?adid='+radioValue+'';
		        return false;
			});
		</script>

	</body>	
</html>