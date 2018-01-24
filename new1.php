<?php include_once 'meta.php';?>
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    font-size: 13px;
}
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 0px;
    background-color: #fe6003;
	color:white;
    font-weight: bold;
}
	</style>
<body class="header_sticky">
	<div class="boxed style2">

		<div class="overlay"></div>

		<!-- Preloader -->
		<!-- <div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div> --><!-- /.preloader -->

		<div class="popup-newsletter">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						
					</div>
					<div class="col-sm-8">
						<div class="popup">
							<span></span>
							<div class="popup-text">
								<h2>Join our newsletter and <br />get discount!</h2>
								<p class="subscribe">Subscribe to the newsletter to receive updates about new products.</p>
								<div class="form-popup">
									<form action="#" class="subscribe-form" method="get" accept-charset="utf-8">
										<div class="subscribe-content">
											<input type="text" name="email" class="subscribe-email" placeholder="Your E-Mail">
											<button type="submit"><img src="images/icons/right-2.png" alt=""></button>
										</div>
									</form><!-- /.subscribe-form -->
									<div class="checkbox">
										<input type="checkbox" id="popup-not-show" name="category">
										<label for="popup-not-show">Don't show this popup again</label>
									</div>
								</div><!-- /.form-popup -->
							</div><!-- /.popup-text -->
							<div class="popup-image">
								<img src="images/product/other/my.jpg" alt="">
							</div><!-- /.popup-text -->
						</div><!-- /.popup -->
					</div><!-- /.col-sm-8 -->
					<div class="col-sm-2">
						
					</div>
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.popup-newsletter -->

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

		<section class="flat-row flat-slider">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="slider owl-carousel">
						<?php $getBanners = "SELECT * FROM grocery_banners WHERE lkp_status_id = 0";
						$getBannersData = $conn->query($getBanners); ?>
						<?php while($getBannersData1 = $getBannersData->fetch_assoc()) { ?>
							<div class="slider-item style2">
								<div class="item-image">
									<!--<div class="sale-off">
										60 % <span>sale</span>
									</div>-->
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBannersData1['web_image'] ?>" alt="">
								</div>
								<div class="clearfix"></div>
							</div><!-- /.slider -->
							<?php } ?>
						</div><!-- /.slider -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-slider -->
                
		<section class="main-blog">
			<div class="container">
			<div class="row">
			<div class="col-sm-2">
			</div>
			<div class="col-sm-8">
			<h2 style="text-align:center">Goomo flights offer - Get discount up to Rs.15,000</h2><br>
			<center> <button type="submit" class="contact" style="background-color:#f92400" data-toggle="modal" data-target="#myModal1">BOOK NOW</button></center><br>
			<p>ICICI Bank in association with Goomo brings to you an exclusive offer on domestic and international flight bookings.</p>
			<p>Get instant discount up to Rs.15,000 on flight bookings.</p>
			<p><b>Offer Details:</b></p>
			<p style="font-size:15px;margin:7px 0px"><b>Domestic Flights:</b></p>
			<table class="table table-bordered">
    <thead>
      <tr>
        <th>Discount</th>
        <th>Booking Amount</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Rs.400	</td>
        <td>Rs.3,000 - Rs.6,999</td>
       
      </tr>
      <tr>
        <td>Rs.800</td>
        <td>Rs.7,000 - Rs.9,999	</td>
      
      </tr>
      <tr>
        <td>Rs.1,000</td>
        <td>Rs.10,000 - Rs.19,999</td>
       
      </tr>
    </tbody>
  </table>
  <p style="font-size:15px;margin:7px 0px"><b>Domestic Flights:</b></p>
  	<table class="table table-bordered">
    <thead>
      <tr>
        <th>Discount</th>
        <th>Booking Amount</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Rs.400	</td>
        <td>Rs.3,000 - Rs.6,999</td>
       
      </tr>
      <tr>
        <td>Rs.800</td>
        <td>Rs.7,000 - Rs.9,999	</td>
      
      </tr>
      <tr>
        <td>Rs.1,000</td>
        <td>Rs.10,000 - Rs.19,999</td>
       
      </tr>
    </tbody>
  </table>
  <p><b>Steps to avail the offer:</b></p>
  <ul>
  <li>Log on to goomo.com</li>
   <li>Log on to goomo.com</li>
    <li>Log on to goomo.com</li>
	</ul>
	<p style="font-size:15px">Offer valid till January 31, 2018.</p><br>
  
  <button type="submit" class="contact" style="background-color:#f92400" data-toggle="modal" data-target="#myModal">BOOK NOW</button>
			</div>
			<div class="col-sm-2">
			</div>
			</div>
       </div>
	    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        
          <center><h4 class="modal-title" style="font-size:23px">Disclaimer</h4></center>
		   <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>By clicking on the hyper-link, you will be leaving ICICIBank.com and entering website operated by other parties. ICICI Bank does not control or endorse such websites, and bears no responsibility for them.</p>
        </div>
        <div class="modal-footer">
          <center> <button type="submit" class="contact" style="background-color:#f92400">CLICK TO PROCEED</button></center>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        
          <center><h4 class="modal-title" style="font-size:23px">Disclaimer</h4></center>
		   <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>By clicking on the hyper-link, you will be leaving ICICIBank.com and entering website operated by other parties. ICICI Bank does not control or endorse such websites, and bears no responsibility for them.</p>
        </div>
        <div class="modal-footer">
          <center> <button type="submit" class="contact" style="background-color:#f92400">CLICK TO PROCEED</button></center>
        </div>
      </div>
      
    </div>
  </div>
		</section><!-- /.main-blog -->
   
		


<?php $getFreeShippingData = getIndividualDetails('grocery_content_pages','id',4);

$getOnlineOrderData = getIndividualDetails('grocery_content_pages','id',5);

$getPaymentsData = getIndividualDetails('grocery_content_pages','id',6);

$getReturnPolicydataData = getIndividualDetails('grocery_content_pages','id',7);
?>
		<section class="flat-iconbox">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getFreeShippingData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getFreeShippingData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getFreeShippingData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getOnlineOrderData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getOnlineOrderData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getOnlineOrderData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getPaymentsData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getPaymentsData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getPaymentsData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
					<div class="col-md-3 col-sm-6">
						<div class="iconbox">
							<div class="box-header">
								<div class="image">
									<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$getReturnPolicydataData['image'] ?>" alt="">
								</div>
								<div class="box-title">
									<h3><?php echo $getReturnPolicydataData['title']; ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-content">
								<p><?php echo $getReturnPolicydataData['description']; ?></p>
							</div><!-- /.box-content -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 col-sm-6 -->
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
		<!-- <script type="text/javascript" src="javascript/jquery.circlechart.js"></script> -->
		<script type="text/javascript" src="javascript/easing.js"></script>
		<script type="text/javascript" src="javascript/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="javascript/owl.carousel.js"></script>
		<script type="text/javascript" src="javascript/smoothscroll.js"></script>
		<!-- <script type="text/javascript" src="javascript/jquery-ui.js"></script> -->
		<script type="text/javascript" src="javascript/jquery.mCustomScrollbar.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="javascript/waves.min.js"></script> 


		<script type="text/javascript" src="javascript/main.js"></script>

		<script type="text/javascript">
	function makeTimer() {

		var endTime = new Date("21 January 2018 10:56:00");			
		endTime = (Date.parse(endTime) / 1000);

		var now = new Date();
		now = (Date.parse(now) / 1000);

		var timeLeft = endTime - now;

		var days = Math.floor(timeLeft / 86400); 
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }

		$("#days").html(days + "<span>Days</span>");
		$("#hours").html(hours + "<span>Hours</span>");
		$("#minutes").html(minutes + "<span>Minutes</span>");
		$("#seconds").html(seconds + "<span>Seconds</span>");		

	}
setInterval(function() { makeTimer(); }, 1000);
</script>

<style type="text/css">


#days {
  font-size: 100px;
  color: #db4844;
}
#hours {
  font-size: 100px;
  color: #f07c22;
}
#minutes {
  font-size: 100px;
  color: #f6da74;
}
#seconds {
  font-size: 50px;
  color: #abcd58;
}
</style>

</body>	
</html>