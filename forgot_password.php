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
								<a href="#" title="">Forgot Password</a>
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		<?php 
	error_reporting(0);
	if(isset($_POST['submit']))  { 
	
		$getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
		$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc();
	    //Login here
	    $user_email = $_POST['login_email'];
	   
	    $getUserForgotData = forgotPassword($user_email);
	    //Set variable for session
	    if($getUserForgotPassword = $getUserForgotData->fetch_assoc()) {

	    	//$pwd = decryptPassword($getUserForgotPassword['user_password']);
	    	$userId = encryptPassword($getUserForgotPassword['id']);
            $to = $user_email;
            $subject =  "User Forgot Password";
            $message = '';
            $message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Your Password</h1>
			  <p>Dear <span style="color:#fe6003;">'.$getUserForgotPassword["user_full_name"].'</span>.</p>
			  <p>Want to change your password? Please click on the link given below to reset the password of your Myservant Account </p>
			  <p><a href="'.$base_url . "reset_password.php?token=".$userId.'" target="_blank"> Click here</a></p>

			  <p>If you are not able to click on the above link, please copy and paste the entire URL into your browsers address bar and press Enter.</p>
			  <strong>'.$base_url . "reset_password.php?token=".$userId.'</strong>
				<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
				<p>Warm Regards,<br>The Myservant Team </p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
			</div>

			</body>';
			
			//echo $message; die;
			$name = "My Servant";
			$from = $getSiteSettingsData1["from_email"];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
			$headers .= 'From: '.$name.'<'.$from.'>'. "\r\n";
            mail($to, $subject, $message, $headers);

		        echo  "<script>alert('Password Sent To Your Email,Please Check.');window.location='login.php';</script>";
		    } else {
	    	echo "<script>alert('Your Entered Email Not Found');</script>";
	    }
	}
?>
		<section class="flat-tracking background">
			<div class="container">
				<div class="row">
				<div class="col-md-1">
				</div>
					<div class="col-md-10">
						<div class="order-tracking">
						<div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-6">
							<div class="title">
								<h3>Forgot Password</h3>
								<!--<p class="subscibe">
									Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br />Excepteur sint occaecat cupidatat non proident.
								</p>-->
							</div><!-- /.title -->
							<div class="tracking-content">
								<form method="post"  accept-charset="utf-8">
									<label for="name-contact" style="margin-right:300px">Email:</label>
										<input type="text" id="login_email" name="login_email" placeholder="Email">
									
									<div class="btn-track">
										<button type="submit" name="submit">Submit</button>
									</div><!-- /.container -->
								</form><!-- /.form -->
							</div><!-- /.tracking-content -->
							</div>
							<div class="col-sm-3">
							</div>
							</div>
						</div><!-- /.order-tracking -->
						
					</div><!-- /.col-md-12 -->
					<div class="col-md-1">
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

$('#verify_otp').on('click', function () {

  var user_mobile = $('#user_mobile').val();
  var mobile_otp = $('#mobile_otp').val();
  var checkout_key = $('#checkout_key').val();
  if(user_mobile!='' && mobile_otp!='') {

      $.ajax({
        type:"post",
        url:"check_otp.php",
        data:$("form").serialize(),
        success:function(result){           
          if(result == 0) {
            $("#return_msg").css("display", "block");       
            $("#return_msg").html("<span style='color:red;'>Please enter valid OTP!</span>");
            $('#mobile_otp').val('');
          } else {
            //Success
            alert("OTP verified");
            if (checkout_key == '') {
                window.location.href = 'index.php';
            } else {
                window.location.href = 'checkout.php';
            }
          }
        }
      });

  } else {
    alert("Please enter OTP!");
    $("#return_msg").css("display", "none");
    return false;
  }
  
});

</script>

</body>	
</html>