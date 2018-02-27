<?php include_once 'meta.php';?>
<style>
.order-tracking{
	text-align:left;
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
								Reset Password
							</li>
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		<?php
			error_reporting(0);
			if(isset($_GET['token']) && $_GET['token']!='')  {
			    //Login here
			    $token = $_GET['token'];
			}
			if(isset($_POST["token"]) && $_POST["token"]!="") {	
				$token = decryptPassword($_POST['token']);
				$encNewPass = encryptPassword($_POST["user_password"]);
				$updateq = "UPDATE users SET user_password='$encNewPass' WHERE id = '" . $token . "'";
				if($conn->query($updateq) === TRUE){             
		            echo "<script type='text/javascript'>alert('Your Password Updated Successfully');window.location='login.php?succ=log-success'</script>";
		        } else {
		        	echo "<script type='text/javascript'>alert('Your Password not Updated');window.location='login.php?succ=log-fail'</script>";
		        }
			}
		?>
		<section class="flat-tracking background">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="order-tracking">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-6">
									<div class="title">
										<center><h3>Reset Password</h3></center>
									</div><!-- /.title -->
									<div class="tracking-content">
										<form method="post"  accept-charset="utf-8">
											<input type="hidden" name="token" value="<?php echo $token; ?>">
											<label for="user_password">New Password</label>
											<input type="password" minlength="8" id="user_password" name="user_password" placeholder="New Password" data-error ="please entre atleast 8 characters" required><br>
											<label for="user_password">Retype Password</label>
											<input type="password" id="retypr_user_password" name="retypr_user_password" placeholder="Retype Password" onChange="checkPasswordMatch();" required>
											<div id="divCheckPasswordMatch" style="color:red"></div>
											<div class="btn-track">
												<button type="submit" name="submit">Submit</button>
											</div><!-- /.container -->
										</form><!-- /.form -->
									</div><!-- /.tracking-content -->
								</div>
								<div class="col-sm-3"></div>
							</div>
						</div><!-- /.order-tracking -->
					</div><!-- /.col-md-12 -->
					<div class="col-md-1"></div>
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
									<h3>Free Shipping</h3>
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
			function checkPasswordMatch() {
			    var password = $("#user_password").val();
			    var confirmPassword = $("#retypr_user_password").val();
			    if (confirmPassword != password) {
			        $("#divCheckPasswordMatch").html("Passwords do not match!");
			        $("#retypr_user_password").val("");
			        $("#user_password").val("");
			    } else {
			        $("#divCheckPasswordMatch").html("");
			    }
			}
		</script>

</body>	
</html>