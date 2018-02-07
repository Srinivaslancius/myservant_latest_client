<?php include_once 'meta.php';?>
<body class="header_sticky" onload="getDateTime()">
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
		

		

		<section class="flat-tracking">
			<div class="container-fluid">
			<form action="shop_checkout.php" method="post" accept-charset="utf-8">
				<div class="row">
				
					<div class="col-lg-8">
						<div class="order-tracking">
							<div class="title">
								<h2>Select Your Time Slot</h2>
								
							</div><!-- /.title --><br>
							<div class="tracking-content">
								
                                                                    
                                    <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Next Availble Time Slots</th> 
                                                    <th>Delivery Date</th> 
                                                    <th>Delivery Slot</th> 
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr>
                                                <td><p style="text-align: left">Date :    <span id="date"></span> <br>Time Slot :    <span id="time"></span> </p></td>
                                                <td>
                                            		<input type="text" id="datepicker" name="slot_date" class="slot_date" readonly>
                                        		</td>

                                        		<?php 

                                        		$getDuration = getIndividualDetails('grocery_manage_time_slots','lkp_status_id',0);
                                        		$cur_time=date("Y-m-d H:i:00");
												$duration='+'.$getDuration['booking_time_gap'].' minutes';
												$getCurTime = date('H:i:00', strtotime($duration, strtotime($cur_time)));

                                        		$getTimeSlots = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  AND start_time > '$getCurTime' ";
                                        		$getTotalTimeSlots = $conn->query($getTimeSlots);
                                        		$gettotalSlt = $getTotalTimeSlots->num_rows;

                                        		?>
                                        		<?php if($gettotalSlt == 0) { ?>
                                        		<?php 

                                        			$getTimeSlots1 = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  ";
                                        			$getTotalTimeSlots1 = $conn->query($getTimeSlots1);
                                        		?>
			                                        <td>
			                                        	<select name="slot_timings" style="border: 1px solid #ccc;" id="slot_timings">
															<?php 
																while($row1 = $getTotalTimeSlots1->fetch_assoc()) {  	
															?>
																<option value="<?php echo $row1['total_slot_time']; ?>"><?php echo $row1['total_slot_time']; ?></option>
															<?php } ?>
														</select>
			                                        </td>
			                                    <?php } else { ?>
			                                    	<td>
			                                        	<select name="slot_timings" style="border: 1px solid #ccc;" id="slot_timings">
															<?php 
																while($row = $getTotalTimeSlots->fetch_assoc()) {  	
															?>
																<option value="<?php echo $row['total_slot_time']; ?>">Today - <?php echo $row['total_slot_time']; ?></option>
															<?php } ?>
														</select>
			                                        </td>
			                                    <?php } ?>
                                        </tr>
                                            
                                        </tbody>
                                            </tbody>
                                        </table>
								
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
                    <div class="col-lg-4">
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                            
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
                                        <tr>
                                            <td>Total</td>
                                            <td class="price-total" id="ordertotal">Rs. <?php echo round($subTotal+$service_tax+$getSiteSettingsData1['delivery_charges']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    <center><button type="submit" class="checkout" title="" style="background-color: #fe6003;width:100%">Next</button></center>
                                </div><!-- /.btn-cart-totals -->
                            
                        </div><!-- /.cart-totals -->
                    </div>
				</div><!-- /.row -->
				</form><!-- /form -->
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
		  

</body>	
</html>