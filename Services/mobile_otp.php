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
	if (isset($_POST['register']))  {

		$user_mobile = $_POST['user_mobile'];
		//$mobile_otp = rand(1000, 9999); //Your message to send, Add URL encoding here.
        $mobile_otp = "1234";
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
	 <!-- Slider -->
		 <div class="container-fluid page-title">
		<div class="row">
			<img src="img/slides/slide_3.jpg" class="img-responsive">
		</div>
    </div>
		<div class="container" style="margin-top:-70px">		

           <div class="row">

		    
           	<div class="col-sm-3"></div>
		   <div class="col-sm-6">

                	<div id="login">
                    		<div class="text-center"><h2><span>Mobile OTP</span></h2></div>
                            <hr>
                            <form method="post" id="opt_valid_mobile" name="opt_valid_mobile">       

                            <input type="hidden" name="user_name" value="<?php echo $_POST['user_name']; ?>">
							<input type="hidden" name="user_mobile_cust" value="<?php echo $_POST['user_mobile']; ?>" id="user_mobile_cust">
							<input type="hidden" name="checkout_key" value="<?php echo $_POST['checkout_key']; ?>" id="checkout_key">
							<input type="hidden" name="user_email" value="<?php echo $_POST['user_email']; ?>">
							<input type="hidden" name="user_password" value="<?php echo encryptPassword($_POST['user_password']); ?>">

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" id="user_mobile" name="user_mobile" class="form-control valid_mobile_num" placeholder="Enter Phone number" value="<?php echo $_POST['user_mobile']; ?>" maxlength="10" pattern="[0-9]{10}" readonly required>
                                </div>

                                <div class="form-group">
                                    <label>OTP</label>
                                    <input type="tel" id="mobile_otp" name="mobile_otp" class="form-control valid_mobile_num" placeholder="Enter OTP" maxlength="4" pattern="[0-9]{10}"  required >
                                </div>
                                <span id="return_msg" style="display:none"></span><br />
                                <div class="clear_fix"></div>
                               
                                <input type="button" value="Verify" id="verify_otp" class="btn_full" >
                                
                            </form>
                        </div>

                </div>
			<div class="col-sm-3"></div>	
			
				<div class="col-sm-1">
				</div>
				
		   </div>
			
  </div>
		
		
	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

	
	<!-- Common scripts -->
	<div id="toTop"></div><!-- Back to top button -->

		<!-- Common scripts -->
	<script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>

	<!-- Specific scripts -->
	<script src="layerslider/js/greensock.js"></script>
	<script src="layerslider/js/layerslider.transitions.js"></script>
	<script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
	
	
</body>

</html>
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
