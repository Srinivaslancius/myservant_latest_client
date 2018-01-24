<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
	<?php $getContentPageData = getAllDataWhere('services_content_pages','id',8);
		  $getContactUsBanner = $getContentPageData->fetch_assoc();
	?>
	<?php

if(!empty($_POST['name_contact']) && !empty($_POST['lastname_contact']) && !empty($_POST['email_contact']) && !empty($_POST['phone_contact']) && !empty($_POST['message_contact']))  {
    
    $name_contact = $_POST['name_contact'];
    $lastname_contact = $_POST['lastname_contact'];
    $email_contact = $_POST['email_contact'];
    $phone_contact = $_POST['phone_contact'];
    $message_contact = $_POST['message_contact'];

$dataem = $getSiteSettingsData["contact_email"];
//$to = "srinivas@lanciussolutions.com";
$to = $dataem;
$subject = "Myservent - Contact Us ";
$message = '';		
$message .= '<body>
	<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
	<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
	 <center><img src='.$base_url . "uploads/logo/".$getSiteSettingsData["logo"].' class="logo-responsive"></center>
	</header>
	<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
	  	<h1 style="color:#fe6003">User Feedback Information.</h1>
	  	<h4>First Name: </h4><p>'.$name_contact.'</p>
        <h4>Last Name: </h4><p>'.$lastname_contact.'</p>
        <h4>Email: </h4><p>'.$email_contact.'</p>
        <h4>Mobile: </h4><p>'.$phone_contact.'</p>
        <h4>Message: </h4><p>'.$message_contact.'</p>
	</article>
	<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData['footer_text'].'</footer>
	</div>

	</body>';

//echo $message; die;

//$sendMail = sendEmail($to,$subject,$message,$email_contact);
$name = "My Servant";
$from = $email_contact;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
$headers .= 'From: '.$name.'<'.$from.'>'. "\r\n";
if(mail($to, $subject, $message, $headers)) {
	echo  "<script>alert('Thank You For Your feedback');window.location.href('contactus.php');</script>";
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

	<!-- REVOLUTION SLIDER CSS -->
	<link href="layerslider/css/layerslider.css" rel="stylesheet">


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
	 <div class="container-fluid page-title">
			<?php  
				  if(!empty($getContactUsBanner['image'])) { ?> 	
					<div class="row">
						<?php include_once './common_slider.php';?>
					</div>
				<?php } else { ?>
					<div class="row">
						<img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php }?>
    	</div>
<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
                </div>
    <div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li>Contact Us</li>
				</ul>
			</div>
		</div>
		 
		<div class="container margin_60">
		  <div class="main_title">
				<h2>Contact <span>Us</span></h2>				
			</div>
			<div class="row">
			
				<div class="col-md-8 col-sm-8" style="padding-right:15px">
						<div id="message-contact"></div>
						<form method="post" action="" id="contactform" name="form"> 
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control" id="name_contact" name="name_contact" placeholder="Enter Name" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="Enter Last Name" required> 
									</div>
								</div>
							</div>
							<!-- End row -->
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" id="email_contact" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email_contact" class="form-control" placeholder="Enter Email" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone</label>
										<input type="tel" id="phone_contact" name="phone_contact" class="form-control valid_mobile_num" placeholder="Enter Phone number" maxlength="10" pattern="[0-9]{10}" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Message</label>
										<textarea rows="5" id="message_contact" name="message_contact" class="form-control" placeholder="Write your message" style="height:200px;" required></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">									
									<input type="submit" value="Submit" class="btn_1" id="submit-contact">
								</div>
							</div>
						</form><br>
					
				</div>
				<!-- End col-md-8 -->
				<?php $getAllgetSiteSettingsData = getAllData('services_site_settings');
				
					$getSiteSettingsData = $getAllgetSiteSettingsData->fetch_assoc();
					/*echo $getSiteSettingsData; die;*/
					
				 ?> 
				 <div class="col-md-4 col-sm-4" style="padding-top:20px">
                    <div class="box_style_1">
                        <h3><span>Information</span></h3>
                         <p style="text-align:left"><span class=" icon-location" style="color:#f26226 ;"></span><?php echo $getSiteSettingsData['address']; ?></p>
                          <p><span class = "icon-mobile" style="color:#f26226 ;"></span><?php echo $getSiteSettingsData['mobile']; ?></p>
                        <p><span class=" icon-mail-alt" style="color:#f26226 ;"></span><?php echo $getSiteSettingsData['email']; ?></p>
                    </div>
                </div>
				
			</div>
			
			<!-- End row -->
		</div>	
		<!-- End container -->
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyA04qekzxWtnZq6KLkabMN_4abcJt9nCDk" type="text/javascript"></script>
		<div class="container map-responsive" style="margin-bottom:70px; width:100%">
        	<div id="map"></div>
        </div>
            <script type="text/javascript">
                            var locations = [
                              ['Lancius it solutions', 17.445913, 78.381229],
                              ['Maxcure Hospital', 17.446740, 78.380109],
                              ['Cyber Towers ', 17.450415, 78.381095],
                            ];

                            var map = new google.maps.Map(document.getElementById('map'), {
                              zoom: 14,
                              center: new google.maps.LatLng(17.448293, 78.391485),
                              mapTypeId: google.maps.MapTypeId.ROADMAP
                            });

                            var infowindow = new google.maps.InfoWindow();

                            var marker, i;

                            for (i = 0; i < locations.length; i++) {  
                              marker = new google.maps.Marker({
                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                map: map
                              });

                              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function() {
                                  infowindow.setContent(locations[i][0]);
                                  infowindow.open(map, marker);
                                }
                              })(marker, i));
                            }
                          </script>
		<!-- end map-->
		
	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

	
	<!-- Common scripts -->
	<div id="toTop"></div><!-- Back to top button -->

		<!-- Common scripts -->	
	<?php include_once 'common_validations_scripts.php'; ?>	
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>
	
	<!-- Validation purpose add scripts -->
	<!-- Specific scripts for slider-->
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
<style type="text/css">
  .error {
    color: $errorMsgColor;
  }

</style>