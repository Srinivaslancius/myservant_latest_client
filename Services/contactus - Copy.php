<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>

	<?php //echo "<pre>"; print_r($_POST); die;?>
	<?php 
	$mobile = $_POST['user_mobile'];
	$mobile_otp = rand(1000, 9999); //Your message to send, Add URL encoding here.


	$selOTP = getAllDataWhere('user_mobile_otp','mobile_otp',$mobile_otp);	
	$getNoRows = $selOTP->num_rows();


	$mobOtpSave = "INSERT INTO `user_mobile_otp`(`user_mobile`, `mobile_otp`) VALUES ('$user_mobile', '$mobile_otp') ";
	$saveOTP = $conn->query($mobOtpSave);

	?>

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


</head>

<body>
	

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
	<header>
		<?php include_once './top_header.php';?>
		<!-- End top line-->

		<div class="container">
                    <?php include_once './menu.php';?>
		</div>
		<!-- container -->
                
        </header>
	<!-- End Header -->

	<main>
	 <div class="container-fluid page-title">
		<div class="row">
			<img src="img/slides/slide_1.jpg" class="img-responsive">
		</div>
    </div>
		<div class="container margin_60">
		  <div class="main_title">
				<h2>Mobile <span>OTP</span></h2>				
			</div>
			<div class="row">
			
				<div class="col-md-8 col-sm-8">
						<div id="message-contact"></div>
						<form method="post" action="" id="mobile_otp" name="mobile_otp"> 

							<input type="text" name="user_name" value="<?php echo $_POST['user_name']; ?>">
							<input type="text" name="user_mobile" value="<?php echo $_POST['user_mobile']; ?>">
							<input type="text" name="user_email" value="<?php echo $_POST['user_email']; ?>">
							<input type="text" name="user_password" value="<?php echo $_POST['user_password']; ?>">
							
							<div class="row">

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" id="phone_contact" name="phone_contact" class="form-control" placeholder="Enter Phone number" value="<?php echo $_POST['user_mobile']; ?>" maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" readonly required>
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>OTP</label>
										<input type="text" id="mobile_otp" name="mobile_otp" class="form-control" placeholder="Enter OTP" maxlength="4" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" required>
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-md-6">									
									<input type="submit" value="Verify" class="btn_1" id="submit-contact">
								</div>
							</div>
						</form><br>
					
				</div>
				
			</div>
			
			<!-- End row -->
		</div>	
		
		
	</main>
	<!-- End main -->

	<footer class="revealed">
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

	
	<!-- Common scripts -->
	<div id="toTop"></div><!-- Back to top button -->

		<!-- Common scripts -->
	<script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>
	
	<!-- Validation purpose add scripts -->
	<?php include_once 'common_validations_scripts.php'; ?>	
	
	
</body>

</html>
<script type="text/javascript">
function isNumberKey(evt){
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	        return false;
	    return true;
	}
</script>
