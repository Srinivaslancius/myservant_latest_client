<?php include_once 'meta.php';?>
<style>
.close{
	color:white;
}
.modal-body {
    
    padding: 1px 15px 15px;
}
.somthing{
	padding-right:0px !important;
}
</style>
<body class="header_sticky somthing">
	<div class="boxed">

		<div class="overlay"></div>

		<!-- Preloader -->
		<!--<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div>-->
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
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								Login
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		<?php 
		error_reporting(0);
		if($_SESSION['user_login_session_id'] != '') {
		    header ("Location: index.php");
		}
		$cart_id = decryptPassword($_GET['cart_id']);
		$offer_id = decryptPassword($_GET['offer_id']);
		if(isset($_POST['login']))  { 
		    //Login here

		    $user_email = $_POST['user_email'];
		    $user_password = encryptPassword($_POST['login_password']);
		    $getLoginData = userLogin($user_email,$user_password);
		    //Set variable for session
		    if($getLoggedInDetails = $getLoginData->fetch_assoc()) {
		    	$last_login_visit = date("Y-m-d h:i:s");
		    	$login_count = $getLoggedInDetails['login_count']+1;
		    	$sql = "UPDATE `users` SET login_count='$login_count', last_login_visit='$last_login_visit' WHERE user_email = '$user_email' OR user_mobile = '$user_email' ";
		    	$row = $conn->query($sql);
		        $_SESSION['user_login_session_id'] =  $getLoggedInDetails['id'];
		        $_SESSION['user_login_session_name'] = $getLoggedInDetails['user_full_name'];
		        $_SESSION['user_login_session_email'] = $getLoggedInDetails['user_email'];
		        $_SESSION['timestamp'] = time();

		        //Save log data here
				$message = "User";
				saveAdminLogs('3',$_SESSION['user_login_session_id'],$message);//3- for grocery_cart

		        //get wallet Id
		        $getWalletDetails = getIndividualDetails('user_wallet','user_id',$getLoggedInDetails['id']);
		        $_SESSION['wallet_id'] = $getWalletDetails['wallet_id'];
		        
		        $updateCart = "UPDATE `grocery_cart` SET user_id='".$_SESSION['user_login_session_id']."' WHERE session_cart_id = '".$_SESSION['CART_TEMP_RANDOM']."'";
				$updateCart1 = $conn->query($updateCart);
		        if($cart_id == 1) {
		        	header('Location: add_address.php');
		        } elseif($offer_id == 1) {
		        	header("Location:offerzone.php");
		    	} elseif($_GET['err']!='') { header('Location: index.php'); exit; } else { header('Location: index.php'); exit; }
		    } else {
		    	if($cart_id == 1) {
		    		header('Location: login.php?err=log-fail&cart_id='.$_GET['cart_id'].'');
		    	} elseif($offer_id == 1) {
		    		header('Location: login.php?err=log-fail&offer_id='.$_GET['offer_id'].'');
		    	} else {
		    		header('Location: login.php?err=log-fail');
		    	}
		    }
		}
	?>

	<?php if(isset($_GET['err']) && $_GET['err'] == 'log-success' ) {  ?>
	<div class="row">
			<div class="col-sm-3"></div>
       	  	<div class="col-sm-6 alert alert-success" style="display:block">
		      <p style="text-align:center"><strong>Success!</strong> Your Registration Successfully Completed.</p>
		    </div>
			<div class="col-sm-3"></div>
			</div>
		<?php }?>

	    <?php if(isset($_GET['err']) && $_GET['err'] == 'log-fail' ) {  ?>
		<div class="row">
	    <div class="col-sm-3"></div>
	    <div class="col-sm-6 alert alert-danger" style="display:block">
	      <p style="text-align:center"><strong>Failed!</strong> Your Login Failed.</p>
	    </div>
		 <div class="col-sm-3"></div>
		 </div>
	    <?php }?>

	    <?php

		require_once('gplus_login/settings.php');
		$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';
		?>

		<section class="flat-account background">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="form-login">
							<div class="title" style="margin-bottom:60px">
								<h3>Login</h3><br>
								<hr>
							</div>
							<div class="row">
							<div class="col-md-1">
							</div>
                            <div class="col-md-5 col-sm-6">
                                <a href="" class="btn btn-primary fac_book" data-toggle="modal" data-target="#myModal1"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                            </div>
							<div class="modal fade" id="myModal1" role="dialog">
								<div class="modal-dialog modal-sm">
								  <div class="modal-content">
									<div class="modal-header" style="border-bottom:0px">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <center><img src="images/2.png" class="img-responsive"></center>
									</div>
									<div class="modal-body">
									  <p>The page you have requested is almost ready to go. only few days left,
									so check back again for more updates</p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#FE6003;color:white;font-size:16px">Close</button>
									</div>
								  </div>
								</div>
						  	</div>
                            <div class="col-md-5 col-sm-6">
                                <a href="<?= $login_url ?>" class="btn btn-danger twi_ter"><i class="fa fa-google" aria-hidden="true"></i> Google plus</a>
                                <!-- <a href="" class="btn btn-danger twi_ter" data-toggle="modal" data-target="#myModal1"><i class="fa fa-google" aria-hidden="true"></i> Google plus</a> -->
                            </div>
							<div class="col-md-1">
							</div>
                            </div> <!-- end row --><br>
							<div style="text-align:center">(OR)</div>
							<form  method="POST" id="form-login" accept-charset="utf-8" autocomplete="off">
							
								<div class="form-box">
									<label for="name-login">Email or Mobile * </label>
									<input type="text" id="user_email1" name="user_email" placeholder="Email or Mobile" required>
								</div><!-- /.form-box -->
								<div class="form-box">
									<label for="password-login">Password * </label>
									<input type="password" id="login_password" name="login_password" placeholder="Password" required>
								</div><!-- /.form-box -->
								
								<div class="form-box">
									<button type="submit" name="login" class="login">SIGN IN</button>
									<a href="forgot_password.php" title="">Lost your password?</a>
								</div><!-- /.form-box -->
							</form><!-- /#form-login -->
						</div><!-- /.form-login -->
					</div><!-- /.col-md-6 -->
					<div class="col-md-6">
						<div class="form-register">
						<div class="title" style="margin-bottom:60px">
								<h3>Register</h3><br>
								<hr>
							</div>
							<form method="post" action="mobile_otp.php" id="form-register" accept-charset="utf-8" autocomplete="off">
								<input type="hidden" value="<?php echo $_GET['cart_id']?>" name="checkout_key">
								<input type="hidden" value="<?php echo $_GET['offer_id']?>" name="offer_checkout_key">
								<div class="form-box">
									<label for="password-register">Name</label>
									<input type="text" name="user_name"  id="user_name" placeholder="Name" required>
								</div>
								<div class="form-box">
									<label for="password-register">Mobile</label>
									<input type="tel" name="user_mobile" id="user_mobile"  placeholder="Mobile Number" maxlength="10" pattern="[0-9]{10}" onkeyup="checkMobile();" required class="valid_mobile_num">
									<span id="input_status1" style="color: red;"></span>
								</div>  								
								<div class="form-box">
									<label for="name-register">Email address * </label>
									<input type="email" name="user_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  id="user_email" placeholder="Email" onkeyup="checkEmail();" required>
									<span id="input_status" style="color: red;"></span>
								</div>
								<div class="form-box">
									<label for="password-register">Password</label>
									<input type="password" name="user_password" minlength="8" id="user_password" placeholder="Password" required>
								</div> 
								<div class="form-box">
									<label for="password-register">Confirm Password</label>
									<input type="password" name="confirm_password" minlength="8"  id="confirm_password" placeholder="Confirm password" onChange="checkPasswordMatch();" required>
									<div id="divCheckPasswordMatch" style="color:red"></div>
	                    			<div id="pass-info" class="clearfix"></div>
								</div>
								<div class="form-box">
								<div class="row">
								<div class="col-sm-6" style="padding-top:10px">
								<label class="containerc"> We have a Referral code
								  <input type="checkbox" id="check_referral">
								  <span class="checkmarkc"></span>
								</label>
								</div>
								<div class="col-sm-6">
								<input type="text" name="referal_code" id="input_referral" placeholder="Referral code" >
								</div>
								</div>
								</div>
								<div class="form-box">
									<button type="submit" name="register" class="register">Register</button>
								</div><!-- /.form-box -->
							</form><!-- /#form-register -->
						</div><!-- /.form-register -->
					</div><!-- /.col-md-6 -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-account -->

		<section class="flat-row flat-iconbox style1 background">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3">
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
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
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
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
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
					</div><!-- /.col-md-6 col-lg-3 -->
					<div class="col-md-6 col-lg-3">
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
					</div><!-- /.col-md-6 col-lg-3 -->
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
		    var confirmPassword = $("#confirm_password").val();
		    if (confirmPassword != password) {
		        $("#divCheckPasswordMatch").html("Passwords do not match!");
		        $("#confirm_password").val("");
		    } else {
		        $("#divCheckPasswordMatch").html("");
		    }
		}
		function checkEmail() {

	        var user_email = document.getElementById("user_email").value;
	        if (user_email){
	          $.ajax({
	          type: "POST",
	          url: "user_avail_check.php",
	          data: {
	            user_email:user_email,
	          },
	          success: function (result) {	          	
	            if (result > 0){
	            	$("#input_status").html("<span style='color:red;'>Email Already Exist</span>");
	        		$('#user_email').val('');
	            } else {
	              $('#input_status').html("");
	            }     
	            }
	           });          
	        }
	    }
	    function checkMobile() {
	        var user_mobile = document.getElementById("user_mobile").value;
	        if (user_mobile){
	          $.ajax({
	          type: "POST",
	          url: "user_avail_check.php",
	          data: {
	            user_mobile:user_mobile,
	          },
	          success: function (result) {

	            if (result > 0){
	            	$("#input_status1").html("<span style='color:red;'>Mobile Already Exist</span>");
	        		$('#user_mobile').val('');
	            } else {
	              $('#input_status1').html("");
	            }       
	            }
	           });          
	        }
	    }

    </script>

<script type="text/javascript">
$("#input_referral").hide();
 $(document).ready(function () {
   $("#check_referral").click(function () {
     if ($("#check_referral").is(":checked")) {
         $("#input_referral").show();
         
     } else {
         $("#input_referral").hide();
         
     }
   });
 });
</script>
<?php include "search_js_script.php"; ?>
</body>	
</html>