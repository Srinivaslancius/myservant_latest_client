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
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								Verify OTP
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
		<?php 
		if($_SESSION['user_login_session_id'] != '') {
		    header ("Location: index.php");
		}
    if (isset($_POST['register']))  {

        $user_mobile = $_POST['user_mobile'];
        $mobile_otp = rand(1000, 9999); //Your message to send, Add URL encoding here.
        //$mobile_otp = "1234";
        $message = urlencode('OTP from MyServant is '.$mobile_otp.' . Do not share it with any one.'); // Message text required to deliver on mobile number
        $sendSMS = sendMobileSMS($message,$user_mobile);
        $message = "";        
        $selOTP = getAllDataWhere('user_mobile_otp','user_mobile',$user_mobile);    
        $getNoRows = $selOTP->num_rows; 

        if($getNoRows > 0) {
            $mobOtpSave = "UPDATE user_mobile_otp SET mobile_otp = '$mobile_otp' WHERE user_mobile = '$user_mobile' ";
            $saveOTP = $conn->query($mobOtpSave);
        } else {
            $mobOtpSave = "INSERT INTO `user_mobile_otp`(`user_mobile`, `mobile_otp`) VALUES ('$user_mobile', '$mobile_otp') ";
            $saveOTP = $conn->query($mobOtpSave);
        }       
    }
    ?>
		<section class="flat-tracking background" style="padding-bottom:30px">
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
								<h3>Verify OTP</h3>
								<!--<p class="subscibe">
									Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br />Excepteur sint occaecat cupidatat non proident.
								</p>-->
							</div><!-- /.title -->
							<div class="tracking-content">
								<form method="post" id="opt_valid_mobile" name="opt_valid_mobile" accept-charset="utf-8" autocomplate="off">
									<input type="hidden" name="user_name" value="<?php echo $_POST['user_name']; ?>">
				                    <input type="hidden" name="user_mobile_cust" value="<?php echo $_POST['user_mobile']; ?>" id="user_mobile_cust">
				                    <input type="hidden" name="user_email" value="<?php echo $_POST['user_email']; ?>">
				                    <input type="hidden" name="user_password" value="<?php echo encryptPassword($_POST['user_password']); ?>">
				                    <input type="hidden" name="checkout_key" value="<?php echo $_POST['checkout_key']; ?>" id="checkout_key">
				                    <input type="hidden" name="offer_checkout_key" value="<?php echo decryptPassword($_POST['offer_checkout_key']); ?>" id="offer_checkout_key">
				                    <input type="hidden" name="referal_code" value="<?php echo $_POST['referal_code']; ?>" >
									<div class="form-box" style="margin-bottom:20px">
										<label for="Mobile" style="margin-right:300px">Mobile No:</label>
										<input type="text" id="user_mobile" name="user_mobile" readonly placeholder="Enter Your Mobile No." maxlength="10" value="<?php echo $_POST['user_mobile']; ?>" class="valid_mobile_num" >
									</div><!-- /.one-half order-id -->
									<div class="form-box">
										<label for="OTP" style="margin-right:415px">OTP:</label>
										<input type="tel" id="mobile_otp" name="mobile_otp" placeholder="Enter OTP" maxlength="4" class="valid_mobile_num" required>
										<a style="cursor:pointer" onClick="resend_otp(<?php echo $_POST['user_mobile']; ?>);">Resend</a>
									</div>
									<span id="return_msg" style="display:none"></span><br />
                                	<div class="clear_fix"></div>
									
									<div class="btn-track">
										<button type="button" value="Verify" id="verify_otp">SUBMIT</button>
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
  var offer_checkout_key = $('#offer_checkout_key').val();
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
            alert("Your Registration Successfully Completed");
            if (checkout_key != '') {
                window.location.href = 'add_address.php';
            } else if (offer_checkout_key != '') {
                window.location.href = 'offerzone.php';
            } else {
                window.location.href = 'index.php';
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
<script type="text/javascript">
	function resend_otp(phone) {
		$.ajax({
	      type:'post',
	      url:'resend_otp.php',
	      data:{		        
	        phone:phone
	      },
	      success:function(response) {
	      }
	    });
	}
</script>
<?php include "search_js_script.php"; ?>
</body>	
</html>