 <!DOCTYPE html>
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
<style>

.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;
}

</style>
</head>
<body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

    <!-- Header ================================================== -->
    <header>
	  <?php include_once './header.php';?>
        </header>
    <!-- End Header =============================================== -->
<?php $getAllAboutData = getAllDataWhere('food_content_pages','id',6);
          $getAboutData = $getAllAboutData->fetch_assoc();
?>

<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">Refer A Friend</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">Refer A Friend</a></li>
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <div class="theiaStickySidebar">
        <div class="box_style_1" id="faq_box">
			<?php include_once 'dashboard_strip.php';?>
		</div><!-- End box_style_1 -->
        </div><!-- End theiaStickySidebar -->
     </div><!-- End col-md-3 -->
        
        <div class="col-md-9 col-sm-9">
<?php $getSiteSettings1 = getAllDataWhere('food_site_settings','id','1'); 
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
      $name = "My Servant - Food";
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
       	 
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Refer A Friend</h3>
                    </div>
                      <div class="panel-body" style="text-align:center">
					 <form method="POST">
							
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
						<button class="button1" type="submit" name="refer_friend" value="refer_friend" style="font-size:16px;">Send Invite</button> 					
					</div>	
							
						</form>
                      </div>
                  </div>
                  
                </div><!-- End panel-group -->
                
            
        </div><!-- End col-md-9 -->
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<div class="high_light">
       <?php include_once 'view_restaurants.php'; ?>
      </div>
	  
	  <!-- Footer ================================================== -->
	<footer>
         <?php include_once 'footer.php'; ?>
		 </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   

	<!-- End Search Menu -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
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