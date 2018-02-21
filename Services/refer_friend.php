<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
	<?php $getContentPageData = getAllDataWhere('services_content_pages','id',9);
		  $getPartnersBanner = $getContentPageData->fetch_assoc();
	?>
	<?php $getAllAboutDataData = getAllDataWhere('services_content_pages','id',1);
		  $getAboutDataData = $getAllAboutDataData->fetch_assoc();
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

	<!-- REVOLUTION SLIDER CSS -->
	<link href="layerslider/css/layerslider.css" rel="stylesheet">
	<link href="css/dash_board.css" rel="stylesheet">
	<link rel="stylesheet" href="css/marquee.css">
<style>

.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}


</style>

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
			<?php  
				  if(!empty($getPartnersBanner['image'])) { ?> 	
					<div class="row">
						<img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getPartnersBanner['image'] ?>" alt="<?php echo $getPartnersBanner['title'];?>" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php } else { ?>
					<div class="row">
						<img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php }?>
    	</div>
		<div class="content">
			  <?php include_once './news_scroll.php';?> 
			</div>
			<div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li>Grocery Wishlist</li>
				</ul>
			</div>
		</div>
		<div class="container margin_60">
<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
     </div><!-- End col-md-3 -->
   <?php $getSiteSettings1 = getAllDataWhere('services_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>
<?php 
if(isset($_POST['refer_friend']) && !empty($_POST['refer_friend'])) {

  //echo "<pre>"; print_r($_POST); die;
  $refer_email = $_POST['refer_email'];
  $user_id = $_SESSION['user_login_session_id'];
  $string2 = str_shuffle('1234567890');
  $referal_code = substr($string2,0,5);
  $getEmail1 = "SELECT * FROM users WHERE user_email LIKE '$refer_email'";
  $getEmail = $conn->query($getEmail1);
  $getEmailDeatils = $getEmail->fetch_assoc();
  $created_at = date('Y-m-d H:i:s');
  if($getEmail->num_rows == 0) {
    $sql = "INSERT INTO grocery_refer_a_friend (`refered_user_id`,`refer_email_id`,`created_at`,`referal_code`) VALUES ('$user_id','$refer_email','$created_at','$referal_code')";
      $result = $conn->query($sql);
      if($result === TRUE) {
      $to = $refer_email;
      $subject = "Myservent - Refer a Friend";
      $message = '';    
      $message .= '<body>
        <div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
        <header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
         <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
        </header>
        <article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
            <h1 style="color:#fe6003">Welcome To Myservant</h1>
            <p>A very special welcome to you <span style="color:#fe6003;">'.$refer_email.'</span></p>
            <p>Your Friend <span style="color:#fe6003;">'.$getEmailDeatils['user_full_name'].' has reffered.</span></p>
            <p>Your Referal code <span style="color:#fe6003;">'.$referal_code.'.</span></p>
          <p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
          <p>Warm Regards,<br>The Myservant Team </p>
        </article>
        <footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
        </div>

        </body>';

      //echo $message; die;
      $name = "My Servant - Services";
      $from = $getSiteSettingsData1["from_email"];
      $resultEmail = sendEmail($to,$subject,$message,$from,$name);
      echo "<script>alert('Thank You. Your recommendation has been sent to $refer_email.');</script>";
    } else {
      echo "<script>alert('Sorry! There was a problem sending your recommendation.');</script>";
    }
  } else {
    echo "<script>alert('Sorry! You Cant refered this Mail.');</script>";
  }
}
?>     
        <div class="col-md-9 col-sm-9">
        
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Refer A Friend</h3>
                    </div>
                      <div class="panel-body" style="text-align:center">
					  <form method="POST">
							<div class="tracking-content">
								<img src="img/refer-a-friend.png">
								<p style="text-align:center">Do you want to make some extra money? Tell your family and friends<br>about us and start making extra cash!</p>
								<div class="row">
								<div class="col-sm-3">
								</div>
								<div class="col-sm-6">
								<div class="form-group">						
						<input type="email" class="form-control" name="refer_email" placeholder="please enter email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
			            </div>
						</div>
						<div class="col-sm-3">
								</div>
						</div>
					<div class="form-group">
						<button class="button1" type="submit" name="refer_friend" value="refer_friend" style="font-size:16px">Send Invite</button> 					
					</div>	
							</div><!-- /.tracking-content -->
						</form>
                      </div>
                  </div>
                  
                </div><!-- End panel-group -->
                
            
        </div><!-- End col-md-9 -->
    </div><!-- End row -->
			<!-- End row -->						
		</div>
		<?php include_once 'our_associate_partners.php';?>
		<!-- End section -->

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
	<script src="js/theia-sticky-sidebar.js"></script>

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
	<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>

<script>
function removeIngItem(ingUniqId) {

 $.ajax({
      type:'post',
      url:'delete_wish_list_items.php',
      data:{
         ingUniqId : ingUniqId,        
      },
      success:function(response) {
        location.reload();
      }
    });

}
</script>
</body>

</html>