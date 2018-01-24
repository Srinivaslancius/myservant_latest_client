<?php include_once 'meta.php';?>
<style>
	.thumbnail {
    padding: 0 0 15px 0;
      border: 1px solid #ddd;
    border-radius: 4px;
	position: relative;
  width: 100%;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
}
.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
 background: rgba(0,0,0,0.8);
  overflow: hidden;
  width: 100%;
  height: 0;
  transition: .5s ease;
}

.thumbnail:hover .overlay {
  height: 100%;
}

.text {
  color: white;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
  
}
.button {
    background-color: #FE6003;
	
    border-radius: 30px;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;
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
			<div class="container text-center bg-grey">
  <h2>Offers based on your interest</h2><br> 
  <div class="row text-center">
    <div class="col-sm-3">
      <div class="thumbnail">
     <img src="images/team/01.jpg" alt="" style="width=400px;height:300px" class="image1">
        <p><strong>Somthing</strong></p>
        <p>Experies on 31-03-2018</p>
		 <div class="overlay">
    <div class="text"><h4 style="margin-bottom:18px">Get Discount upto</h4>
	<h3 style="color:white;margin-bottom:15px;font-size:20px">₹15,000</h3>
	<p style="font-size:13px;margin-bottom:15px;">Pay Using ICICI Bank<br>Netbanking, or Cards</p>
	<a href="new1.php"><button class="button" style="font-size:15px">SEE FULL DETAILS</button></a>

	</div>
														
  </div>
      </div>
    </div>
    <div class="col-sm-3">

     <div class="thumbnail">
     <img src="images/team/01.jpg" alt="" style="width=400px;height:300px" class="image1">
        <p><strong>Somthing</strong></p>
        <p>Experies on 31-03-2018</p>
		 <div class="overlay">
    <div class="text"><h4 style="margin-bottom:18px">Get Discount upto</h4>
	<h3 style="color:white;margin-bottom:15px;font-size:20px">₹15,000</h3>
	<p style="font-size:13px;margin-bottom:15px;">Pay Using ICICI Bank<br>Netbanking, or Cards</p>
	<a href="new1.php"><button class="button" style="font-size:15px">SEE FULL DETAILS</button></a>

	</div>
														
  </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
     <img src="images/team/01.jpg" alt="" style="width=400px;height:300px" class="image1">
        <p><strong>Somthing</strong></p>
        <p>Experies on 31-03-2018</p>
		 <div class="overlay">
    <div class="text"><h4 style="margin-bottom:18px">Get Discount upto</h4>
	<h3 style="color:white;margin-bottom:15px;font-size:20px">₹15,000</h3>
	<p style="font-size:13px;margin-bottom:15px;">Pay Using ICICI Bank<br>Netbanking, or Cards</p>
	<a href="new1.php"><button class="button" style="font-size:15px">SEE FULL DETAILS</button></a>

	</div>
														
  </div>
      </div>
    </div>
	<div class="col-sm-3">
      <div class="thumbnail">
     <img src="images/team/01.jpg" alt="" style="width=400px;height:300px" class="image1">
        <p><strong>Somthing</strong></p>
        <p>Experies on 31-03-2018</p>
		 <div class="overlay">
    <div class="text"><h4 style="margin-bottom:18px">Get Discount upto</h4>
	<h3 style="color:white;margin-bottom:15px;font-size:20px">₹15,000</h3>
	<p style="font-size:13px;margin-bottom:15px;">Pay Using ICICI Bank<br>Netbanking, or Cards</p>
	<a href="new1.php"><button class="button" style="font-size:15px">SEE FULL DETAILS</button></a>

	</div>
														
  </div>
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