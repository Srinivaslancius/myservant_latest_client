<?php include_once 'meta.php';?>
<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>
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
								Contact
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyA_wD4yy0lpl0j2e7f-gCVhbZadHycfk7U" type="text/javascript"></script>
        <?php 
        $address =$getSiteSettingsData1['address']; // Google HQ
              $prepAddr = str_replace(' ','+',$address);
              $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
              $output= json_decode($geocode);
              $latitude = $output->results[0]->geometry->location->lat;
              $longitude = $output->results[0]->geometry->location->lng;
        ?>
		<section class="flat-map">
		<div class="container">
		
		<div id="map" style="height:400px;width:100%"></div>
        <div id="message"> <?php echo $getSiteSettingsData1['address']; ?></div>
          </div>
        </section><!-- /#flat-map -->
        <script type="text/javascript">
                            var map;
                            var infowindow = new google.maps.InfoWindow({
                                content: document.getElementById('message')
                            });
                            function initialize() {
                                // Set static latitude, longitude value
                                var latlng = new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>);
                                // Set map options
                                var myOptions = {
                                    zoom: 16,
                                    center: latlng,
                                    panControl: true,
                                    zoomControl: true,
                                    scaleControl: true,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                }
                                // Create map object with options
                                map = new google.maps.Map(document.getElementById("map"), myOptions);
                            <?php


                                    echo "addMarker(new google.maps.LatLng(".$latitude.", ".$longitude."), map);";
                            ?>
                            }
                            function addMarker(latLng, map) {
                                var marker = new google.maps.Marker({
                                    position: latLng,
                                    map: map,
                                    draggable: true, // enables drag & drop
                                    animation: google.maps.Animation.DROP
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map, marker);
                                  });

                                return marker;
                            }
                            google.maps.event.addDomListener(window, 'load', initialize);
                        </script>


        <section class="flat-iconbox style4">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="images/icons/address.png" alt="">
        						</div>
        						<div class="title">
        							<h3>Address</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<p>
        							<?php echo $getSiteSettingsData1['address']; ?>
        						</p>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="images/icons/phone.png" alt="">
        						</div>
        						<div class="title">
        							<h3>Phone</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<p>
        							<?php echo $getSiteSettingsData1['contact_number']; ?>
        						</p>
        						
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="images/icons/mail-2.png" alt="">
        						</div>
        						<div class="title">
        							<h3>Email</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<p>
        							<?php echo $getSiteSettingsData1['contact_email']; ?>
        						</p>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        			<div class="col-md-6 col-lg-3">
        				<div class="iconbox style2">
        					<div class="box-header">
        						<div class="image">
        							<img src="images/icons/share.png" alt="">
        						</div>
        						<div class="title">
        							<h3>Follow Us</h3>
        						</div>
        					</div><!-- /.box-header -->
        					<div class="box-content">
        						<ul class="social-list style2">
									<li>
										<a href="<?php echo $getSiteSettingsData1['fb_link'] ?>" target="_blank" title="">
											<i class="fa fa-facebook" aria-hidden="true"style="font-size:20px"></i>
										</a>
									</li>
									<li>
										<a href="<?php echo $getSiteSettingsData1['twitter_link'] ?>" target="_blank">
											<i class="fa fa-twitter" aria-hidden="true"style="font-size:20px"></i>
										</a>
									</li>
									<!--<li>
										<a href="<?php echo $getSiteSettingsData1['inst_link'] ?>" target="_blank">
											<i class="fa fa-instagram" aria-hidden="true"style="font-size:20px"></i>
										</a>
									</li>-->
									<li>
										<a href="<?php echo $getSiteSettingsData1['linkden_link'] ?>" target="_blank">
											<i class="fa fa-linkedin" aria-hidden="true"style="font-size:20px"></i>
										</a>
									</li>
									<!--<li>
										<a href="<?php echo $getSiteSettingsData1['you_tube_link'] ?>" target="_blank" >
											<i class="fa fa-youtube" aria-hidden="true"style="font-size:20px"></i>
										</a>
									</li>-->
									<li>
										<a href="<?php echo $getSiteSettingsData1['gplus_link'] ?>" target="_blank">
											<i class="fa fa-google" aria-hidden="true" style="font-size:20px"></i>
										</a>
									</li>
								</ul>
        					</div><!-- /.box-content -->
        				</div><!-- /.iconbox style2 -->
        			</div><!-- /.col-md-6 col-lg-3 -->
        		</div><!-- /.row -->
        	</div><!-- /.container -->
        </section><!-- /.flat-iconbox style4 -->
<?php

if(!empty($_POST['name_contact']) && !empty($_POST['last_name_contact']) && !empty($_POST['email_contact']) && !empty($_POST['phone_contact']) && !empty($_POST['message_contact']) && !empty($_POST['subject']) && !empty($_POST['priority']))  {


    $name_contact = $_POST['name_contact'];
    $last_name_contact = $_POST['last_name_contact'];
    $email_contact = $_POST['email_contact'];
    $phone_contact = $_POST['phone_contact'];
    $message_contact = $_POST['message_contact'];
    $subject1 = $_POST['subject'];
    $priority = $_POST['priority'];

$dataem = $getSiteSettingsData1["contact_email"];
//$to = "srinivas@lanciussolutions.com";
$to = $dataem;
$subject = "Myservent - Contact Us ";
$message = '';      
$message .= '<body>
    <div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
    <header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
     <center><h1>My Servant</h1></center>
    </header>
    <article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
        <h1 style="color:#fe6003">User Feedback Information.</h1>
        <h4>First Name: </h4><p>'.$name_contact.'</p>
        <h4>Last Name: </h4><p>'.$last_name_contact.'</p>
        <h4>Email: </h4><p>'.$email_contact.'</p>
        <h4>Mobile: </h4><p>'.$phone_contact.'</p>
        <h4>Subject: </h4><p>'.$subject1.'</p>
        <h4>Priority: </h4><p>'.$priority.'</p>
        <h4>Message: </h4><p>'.$message_contact.'</p>
    </article>
    <footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
    </div>

    </body>';
//echo $message; die;
//$sendMail = sendEmail($to,$subject,$message,$email_contact);
$name = "My Servant - Grocery";
$from = $email_contact;
$resultEmail = sendEmail($to,$subject,$message,$from,$name);
if($resultEmail == 0) {
    echo  "<script>alert('Thank You For Your feedback');window.location.href('contact.php');</script>";
} else {
    echo "Mail Sent Failed";
}

}
?>
        <section class="flat-contact">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-2">
        			</div>
        			<div class="col-lg-8 col-md-12">
        				<div class="form-contact center">
        					<div class="form-contact-header">
        						<h3>Leave us a Message</h3>
        					<!--	<p>
        							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
        						</p>-->
        					</div><!-- /.form-contact-header -->
        					<div class="form-contact-content">
        						<form method="post" action="" id="form-contact" accept-charset="utf-8">
									<div class="form-box one-half name-contact">
										<label for="name-contact">First name*</label>
										<input type="text" id="name-contact" name= "name_contact" placeholder="First name" required>
									</div>
									<div class="form-box one-half password-contact">
										<label for="password-contact">Last name*</label>
										<input type="text" id="password-contact" name="last_name_contact" placeholder="Last name" required>
									</div>
									<div class="form-box one-half name-contact">
										<label for="name-contact">Email*</label>
										<input type="text" id="email_contact" name="email_contact" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email" required>
									</div>
									<div class="form-box one-half name-contact">
										<label for="name-contact">Mobile*</label>
										<input type="text" maxlength="10" pattern="[0-9]{10}" name="phone_contact" placeholder="Mobile Number" required class="valid_mobile_num">
									</div>
                                    <div class="form-box one-half name-contact">
                                        <label for="name-contact">Subject*</label>
                                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter Subject" required>
                                    </div>
                                    <div class="form-box one-half name-contact">
                                        <label for="name-contact">Priority*</label>
                                        <select name="priority" required>
                                            <option value="">Select Priority</option>
                                            <option value="Option1">Option1</option>
                                            <option value="Option2">Option2</option>
                                            <option value="Option3">Option3</option>
                                        </select>
                                    </div>
									<div class="form-box">
										<label for="comment-contact">Comment</label>
										<textarea name="message_contact" rows="4" id="comment" required></textarea>
									</div>
									<div class="form-box">
										<button type="submit" class="contact">Send</button>
									</div>
								</form>
        					</div><!-- /.form-contact-content -->
        				</div><!-- /.form-contact center -->
        			</div><!-- /.col-lg-8 col-md-12 -->
        			<div class="col-lg-2">
        			</div>
        		</div><!-- /.row -->
        	</div><!-- /.container -->
        </section><!-- /.flat-contact -->
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
	   	<script type="text/javascript" src="javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="javascript/waves.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.countdown.js"></script>

		<script type="text/javascript" src="javascript/main.js"></script>
        <?php include "search_js_script.php"; ?>
</body>	
</html>