<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html style="overflow-x:hidden">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">

		
    
    <!-- SPECIFIC CSS -->
    <link href="layerslider/css/layerslider.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	<div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    <!-- Header ================================================== -->
    <header>
	 <?php include_once './header.php';?>
        </header>
    <!-- End Header =============================================== -->
<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">Forgot Password</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Forgot Password</li>
               
            </ul>
            
        </div>
    </div><!-- Position -->
<?php 
	error_reporting(0);
	if(isset($_POST['submit']))  { 

		$getSiteSettings1 = getAllDataWhere('food_site_settings','id','1'); 
		$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc();
	    //Login here
	    $user_email = $_POST['login_email'];
	   
	    $getUserForgotData = forgotPassword($user_email);
	    //Set variable for session
	    if($getUserForgotPassword = $getUserForgotData->fetch_assoc()) {

	    	//$pwd = decryptPassword($getUserForgotPassword['user_password']);
	    	$userId = encryptPassword($getUserForgotPassword['id']);
            $to = $user_email;
            $subject =  "Myservant - User Forgot Password";
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
			$name = "My Servant - Food";
			$from = $getSiteSettingsData1["from_email"];
			$resultEmail = sendEmail($to,$subject,$message,$from,$name);
			if($resultEmail == 0) {
				echo "Mail Sent Success";
			} else {
				echo "Mail Sent Failed";
			}

		        echo  "<script>alert('Password Sent To Your Email,Please Check.');window.location='login.php';</script>";
		} else {
	    	echo "<script>alert('Your Entered Email Not Found');</script>";
	    }
	}
?>
<!-- Content ================================================== -->
<div class="container margin_60_35">
        </div>
	<div class="row">
	<div class="col-md-4">
	</div>
	<div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
			<div class="feature">
				
				<center> <h2 class="nomargin_top" style="color:#f26226">Forgot Password</h2></center>
					<hr class="more_margin">
					<form action="" method="POST" class="popup-form">
					 <label for="email">Email ID:</label>
					 <input type="email" name="login_email" class="form-control" placeholder="Enter Email Address." required>
					<button type="submit" name="submit" class="btn btn-submit">SUBMIT</button>
					</form>

			</div>
		</div>
		<div class="col-md-4">
	</div>
	</div><!-- End row -->
	
	
</div><!-- End container -->


<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
	<footer>
         <?php include_once 'footer.php'; ?>
		 </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

</body>
</html>