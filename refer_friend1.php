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
								Wish List
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-term-conditions">
			<div class="container">
				<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
     </div><!-- End col-md-3 -->
<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
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
				 <center>MY SERVANT</center>
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
			$name = "My Servant - Grocery";
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
        <div class="col-sm-9">       	 
         
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Refer A Friend</h3>
                    </div>
                      <div class="panel-body" style="text-align:center">
                      	<form method="POST">
							
								<img src="images/refer-a-friend.png">
								<p>Do you want to make some extra money? Tell your family and friends<br>about us and start making extra cash!</p><br>
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
						<button class="button1" type="submit" name="refer_friend" value="refer_friend" style="font-size:16px;padding:0px 40px">Send Invite</button> 					
					</div>	
							
						</form>
                      </div>
                  </div>
                  
                </div><!-- End panel-group -->
                
            
        </div><!-- End col-md-9 -->
    </div><!-- End row -->
			</div><!-- /.container -->
		</section><!-- /.flat-term-conditions -->
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
		<?php include "search_js_script.php"; ?>
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