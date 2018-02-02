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
<style>
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom:0px;
	color:#fe6003;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
   border-top: 0px solid #ddd;
}
.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 5px 9px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {
	background-color:#fe6003;
 padding: 5px 12px;
} 
.strip_list {
    background-color: #fff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    padding: 20px;
    position: relative;
    border: 1px solid #ededed;
    min-height: 200px;
    margin-bottom: 20px;
    line-height: 1.3;
    display: block;
}
.thumb_strip {
    position: absolute;
    left: 0;
    top: 0;
    width: 110px;
    height: 110px;
    border: 1px solid #ededed;
    padding: 5px;
}

#delivery_time, #hero_video, #hero_video>div, .box_home, .high_light a, .thumb_strip {
    text-align: center;
}
#sub_content #thumb, .thumb_strip {
    box-sizing: border-box;
    overflow: hidden;
}
.desc h3 {
    margin: 0;
    padding: 0;
}
.desc .type {
    font-size: 12px;
    color: #777;
    margin-bottom: 12px;
    margin-top: 5px;
    text-align: justify;
	line-height:10px;
}
.desc .type p{
line-height:10px;
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
	<?php 
	  if(isset($_POST["submit"]) && $_POST["submit"]!="") {
	      $user_id =$_SESSION["user_login_session_id"];
	      $name = $_POST['name'];
	      $email = $_POST['email'];
	      $mobile = $_POST['mobile'];
	      $city = $_POST['city'];
	      $pincode = $_POST['pincode'];
	      $last_name = $_POST['last_name'];
	      $address = $_POST['address'];
	      $created_at = date("Y-m-d h:i:s");
	      $sql1 = "INSERT INTO add_user_address (`user_id`,`name`,`email`,`mobile`,`last_name`,`city`,`pincode`,`address`,`created_at`) VALUES ('$user_id','$name','$email','$mobile','$last_name','$city','$pincode','$address','$created_at')";
	      if($conn->query($sql1) === TRUE){             
	         echo "<script type='text/javascript'>window.location='my_address.php?succ=log-success'</script>";
	      } else {               
	         header('Location: my_address.php?err=log-fail');
	      } 
	  }
	  if(isset($_POST["address_status"]) && $_POST["address_status"]!="") {
	      $id = $_POST['id'];
	      $address_status = 1;
	      $sql2 = "UPDATE add_user_address SET address_status = '$address_status' WHERE id = '$id' ";
	      if($conn->query($sql2) === TRUE){             
	         echo "<script type='text/javascript'>window.location='my_address.php?succ=log-success'</script>";
	      } else {               
	         header('Location: my_address.php?err=log-fail');
	      } 
	  }
	?>

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
<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
                </div>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li>My Address</li>
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
        
        <div class="col-md-9 col-sm-9">
        <?php if(isset($_GET['succ']) && $_GET['succ'] == 'log-success' ) {  ?>                
            <div class="alert alert-success" style="top:10px; display:block" id="set_valid_msg">
              <strong>Success!</strong> Your Data Updated Successfully.
            </div>               
       <?php }?>

        <?php if(isset($_GET['err']) && $_GET['err'] == 'log-fail' ) {  ?>            
          <div class="alert alert-danger" style="top:10px; display:block" id="set_valid_msg">
            <strong>Failed!</strong> Data Updation Failed.
          </div>     
        <?php } ?>
       	 
         	<div class="panel-group">
	          <div class="panel panel-default">
	            <div class="panel-heading">
	              <h3 class="nomargin_top">My Addresses</h3>
	            </div>
				<!---start-->
				<?php
				$user_id = $_SESSION["user_login_session_id"];
				$getAddress = getAllDataWhereWithActive('add_user_address','user_id',$user_id);
				if($getAddress->num_rows) { ?>
	              <div class="panel-body address">
	              	<?php while($getAddressDetails = $getAddress->fetch_assoc()) { ?>
				  <div class="strip_list wow fadeIn" data-wow-delay="0.1s" style="min-height:200px">                  
	                    <div class="col-md-9 col-sm-9">
	                        <h3 style="color:#fe6003">Address</h3>
	                        <div class="type">
	                            <p><?php echo $getAddressDetails['name']; ?><br>
								<?php echo $getAddressDetails['mobile']; ?><br>
								<?php echo $getAddressDetails['address']; ?></p>
	                        </div>
	                    </div>
	                    <div class="col-md-3 col-sm-3">
	                        <div class="go_to" style="padding-top:50px">
	                        	<?php if($getAddressDetails['address_status'] == 0) { ?>
									<a href="make_as_default.php?default_id=<?php echo $getAddressDetails['id']; ?>"><button style="background-color: #fba775" class="button1">Make As Default</button></a>
									<?php } else { ?> 
									<a href="make_as_default.php?default_id=<?php echo $getAddressDetails['id']; ?>"><button class="button1">Make As Default</button></a>
								<?php } ?>                      						
	                      </div> 
	                    </div>
					</div><!-- End strip_list-->
					<?php } ?>
					<div class="go_to one">										
	                    <div>
							<center><button class="button1">ADD NEW ADDRESS</button></center>
	                    </div> 							
	                </div> 
	              </div>
	              <?php } else { ?>
	            <div class="panel-body address">
					<div class="row">
					  	<div class="col-sm-3"></div>
					  	<div class="col-sm-6">
							<center><img src="img/myaddress.png">
							<h4>No Addresses found in your account!</h4>
							<p>Add a delivery address.</p>
							<button class="button1 one">ADD ADDRESS</button></center>
						</div>
						<div class="col-sm-3"></div>
					</div>
	            </div>
				  <!---end-->
				  <?php } ?>
				  <!---end-->
				  <!---start-->
	              <div class="panel-body two">
				      <form method="post">
		                  <div class="col-md-12">
						  	<div class="col-md-9">
						  		<div class="row">
						  			<?php $uid = $_SESSION["user_login_session_id"];
				       	  			$userData = getIndividualDetails('users','id',$uid);
				       	  			?>
						  			<div class="col-sm-6">
										<div class="form-group">
											<label for="first-name">Name*</label>
											<input type="text" class="form-control"  name="name" placeholder="Name" value="<?php echo $userData['user_full_name']; ?>" required>
										</div>
									</div>
				 					<div class="col-sm-6">
										<div class="form-group">
											<label for="mobile">Last Name*</label>
											<input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
										</div>
									</div>
				 					<div class="col-sm-6">
										<div class="form-group">
											<label for="mobile">Email*</label>
											<input type="text" class="form-control" readonly name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Mobile" value="<?php echo $userData['user_email']; ?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="mobile">Mobile*</label>
											<input type="text" class="form-control valid_mobile_num" name="mobile" value="<?php echo $userData['user_mobile']; ?>"  placeholder="Mobile" maxlength="10" pattern="[0-9]{10}" required>
										</div>
									</div>
									<?php $getCitiesData = getAllDataWhere('lkp_cities','lkp_status_id',0); ?>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="locality">City*</label>
											<select name="city" id="lkp_city_id" class="form-control" required>
												<option value="">Select City</option>
												<?php while($getCities = $getCitiesData->fetch_assoc()) { ?>
												<option value="<?php echo $getCities['id'];?>"><?php echo $getCities['city_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="pincode">Pincode*</label>
											<input type="text" class="form-control valid_mobile_num" maxlength="6" name="pincode" placeholder="pincode" required>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="address">Address*</label>
											<textarea class="form-control" name="address" rows="5" id="comment" required></textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<button class="button1" type="submit" name="submit" value="submit" style="width:100px;font-size:18px">Save</button> 					
								</div>						
			                </div>
				  			<div class="col-md-3"></div>
                   		  </div>        
          				</form>
                    </div>
					  <!---end-->
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
$(document).ready(function(){
	 $(".two").hide();
    $(".one").click(function(){
        $(".one").hide();
        $(".address").hide();
		$(".two").show();
    });
});
//Set time for messge notifications
$(document).ready(function () {
setTimeout(function () {
  $('#set_valid_msg').hide();
}, 2000);
});
</script>

</body>

</html>