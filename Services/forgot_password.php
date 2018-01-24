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
	if(isset($_POST['submit']))  { 
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
			 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData["logo"].' class="logo-responsive"></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Your Password</h1>
			  <p>Dear <span style="color:#fe6003;">'.$getUserForgotPassword["user_full_name"].'</span>.</p>
			  <p>Want to change your password? Please click on the link given below to reset the password of your Myservant Account </p>
			  <p><a href="'.$base_url . "Services/reset_password.php?token=".$userId.'" target="_blank"> Click here</a></p>

			  <p>If you are not able to click on the above link, please copy and paste the entire URL into your browsers address bar and press Enter.</p>
			  <strong>'.$base_url . "Services/reset_password.php?token=".$userId.'</strong>
				<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
				<p>Warm Regards,<br>The Myservant Team </p>
			</article>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData['footer_text'].'</footer>
			</div>

			</body>';

			//echo $message; die;
			$name = "My Servant";
			$from = $getSiteSettingsData["from_email"];
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
<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
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
                    		<div class="text-center"><h2><span>Forgot Password</span></h2></div>
                            <hr>
                            <form method="POST">                      
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class=" form-control " name="login_email" placeholder="Email" required>
                                </div>
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
	</script>

</body>

</html>