<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
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
	<link rel="stylesheet" href="css/marquee.css">


</head>

<body>
	

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
	<header id="plain">
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
	<div class="content">
			  <?php include_once './news_scroll.php';?> 
			</div>
			<div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li>Coming Soon</li>
				</ul>
			</div>
		</div>
		<div class="container" style="padding-bottom:50px">		

          
                	<center><img src="img/comingsoon.png"></center>		
				<h4 style="text-align:center;line-height:30px;color:#333">The page you have requested is almost ready to go. only few days left,<br> so check back again for more updates</h4>
				<center><a href="index.php"><input type="submit" value="Back To Home" class="btn_1" ></a></center>
                     
               
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
