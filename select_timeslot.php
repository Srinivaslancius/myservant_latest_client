<?php include_once 'meta.php';?>
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
		

		

		<section class="flat-tracking">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8">
						<div class="order-tracking">
							<div class="title">
								<h3>Select Your Time Slot</h3>
								
							</div><!-- /.title -->
							<div class="tracking-content">
								<form action="#" method="get" accept-charset="utf-8">
                                                                    
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
                                                <td><p style="text-align: left">Date :    21-01-2018 (Tomorrow) <br>Time Slot :    10:00 AM To 12:00 AM</p></td>
                                                <td>
                                            		<input type="text" id="datepicker" name="slot_date" class="slot_date" readonly>
                                        		</td>

                                        		<?php 

                                        		$cur_time=date("Y-m-d H:i:s");
												$duration='+'.$getSiteSettingsData1['booking_time_gap'].' minutes';
												$getCurTime = date('g:i A', strtotime($duration, strtotime($cur_time)));

                                        		$getTimeSlots = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  AND end_time > '$getCurTime' ";
                                        		$getTotalTimeSlots = $conn->query($getTimeSlots);
                                        		$gettotalSlt = $getTotalTimeSlots->num_rows;

                                        		?>
                                        		<?php if($gettotalSlt == 0) { ?>
                                        		<?php 

                                        			$getTimeSlots1 = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  ";
                                        			$getTotalTimeSlots1 = $conn->query($getTimeSlots1);
                                        		?>
			                                        <td>
			                                        	<select name="slot_timings" style="border: 1px solid #ccc;">
															<?php 
																while($row1 = $getTotalTimeSlots1->fetch_assoc()) {  	
															?>
																<option value="<?php echo $row1['total_slot_time']; ?>">Tomorrow - <?php echo $row1['total_slot_time']; ?></option>
															<?php } ?>
														</select>
			                                        </td>
			                                    <?php } else { ?>
			                                    	<td>
			                                        	<select name="slot_timings" style="border: 1px solid #ccc;">
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
								</form><!-- /.form -->
							</div><!-- /.tracking-content -->
						</div><!-- /.order-tracking -->
					</div><!-- /.col-md-12 -->
                                        <div class="col-lg-4">
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                            <form action="#" method="get" accept-charset="utf-8">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="subtotal"> ₹2,589.00</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="btn-radio">
                                                <div class="radio-info">
                                                    <input type="radio" id="flat-rate" checked name="radio-flat-rate">
                                                    <label for="flat-rate">Flat Rate: <span> ₹3.00</span></label>
                                                </div>
                                                <div class="radio-info">
                                                    <input type="radio" id="free-shipping" name="radio-flat-rate">
                                                    <label for="free-shipping">Free Shipping</label>
                                                </div>
                                                <div class="btn-shipping">
                                                    <a href="#" title="">Calculate Shipping</a>
                                                </div>
                                            </td><!-- /.btn-radio -->
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="price-total"> ₹1,591.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    
                                    <a href="#" class="checkout" title="">Next</a>
                                </div><!-- /.btn-cart-totals -->
                            </form><!-- /form -->
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
				        //alert(dateText);
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
				        //alert(dateText);
				    },
				});
            }
		  	$('#datepicker').datepicker('setDate', today);
		});
		</script>
		  
		  

</body>	
</html>