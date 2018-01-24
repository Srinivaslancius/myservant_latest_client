<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>

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

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/base.css" rel="stylesheet">
        <link href="site_launch/css/style.css" rel="stylesheet">
	<link href="layerslider/css/layerslider.css" rel="stylesheet">
	<!-- REVOLUTION SLIDER CSS -->
</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

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
                <div id="position">
			<div class="container">
				<ul>
					<li><a href="#">Home</a>
					</li>
					<li><a href="#">Category</a>
					</li>
					<li>Page active</li>
				</ul>
			</div>
		</div>
		<div class="container" style="margin-top:-70px">		

           <div class="row">
           	

		    
           	<div class="col-sm-3"></div>
		   <div class="col-sm-6">


                	<div id="login">
                    		<div class="text-center"><h2><span>Reset Password</span></h2></div>
                            <hr>
                            <form method="post" action="">                      
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" minlength="8" id="user_password" name="user_password" placeholder="New Password" required>
                                </div>
                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <label>Retype Password</label>
                                    <input type="password" class="form-control" minlength="8" id="retypr_user_password" name="retypr_user_password" placeholder="Retype Password" onChange="checkPasswordMatch();" required>
                                </div>
                                <div id="divCheckPasswordMatch" style="color:red"></div>
                                <button type="submit" name="submit" class="btn_full">Submit</button>
                                
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

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	
	<!-- Common scripts -->
	<script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>

	<!-- Specific scripts -->
	<script src="layerslider/js/greensock.js"></script>
	<script src="layerslider/js/layerslider.transitions.js"></script>
	<script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function () {
			'use strict';
			$('#layerslider').layerSlider({
				autoStart: true,
				responsive: true,
				responsiveUnder: 1280,
				layersContainer: 1170,
				skinsPath: 'layerslider/skins/'
					// Please make sure that you didn't forget to add a comma to the line endings
					// except the last line!
			});
		});
		function checkPasswordMatch() {
		    var password = $("#user_password").val();
		    var confirmPassword = $("#retypr_user_password").val();
		    if (confirmPassword != password) {
		        $("#divCheckPasswordMatch").html("Passwords do not match!");
		        $("#retypr_user_password").val("");
		    } else {
		        $("#divCheckPasswordMatch").html("");
		    }
		}
	</script>

</body>

</html>