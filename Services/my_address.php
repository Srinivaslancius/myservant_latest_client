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
	      	$first_name = $_POST['first_name'];
	      	$last_name = $_POST['last_name'];
	      	$email = $_POST['email'];
	      	$mobile = $_POST['mobile'];
	      	$lkp_state_id = $_POST['lkp_state_id'];
	      	$lkp_district_id = $_POST['lkp_district_id'];
	      	$lkp_city_id = $_POST['lkp_city_id'];
	      	$lkp_pincode_id = $_POST['lkp_pincode_id'];
	      	$lkp_location_id = $_POST['lkp_location_id'];
	      	$lkp_sub_area_id = $_POST['lkp_sub_area_id'];
	      	$address = $_POST['address'];
	      	$created_at = date("Y-m-d h:i:s");
	      	$sql1 = "INSERT INTO grocery_add_address (`user_id`,`first_name`,`last_name`,`email`,`phone`,`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`lkp_location_id`,`lkp_sub_location_id`,`address`,`created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$lkp_location_id','$lkp_sub_area_id','$address','$created_at')";
	      	if($conn->query($sql1) === TRUE){             
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
			<div class="content">
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
	          	$getAllCustomerAddress = "SELECT * FROM grocery_add_address WHERE user_id = '$user_id' AND lkp_status_id = 0";
	          	$getCustomerAddress = $conn->query($getAllCustomerAddress);
				if($getCustomerAddress->num_rows == 0) { ?>
				<div class="panel-body address">
					<div class="row">
					  	<div class="col-sm-3"></div>
					  	<div class="col-sm-6">
							<center><img src="img/myaddress.png">
							<h4>No Addresses found in your account!</h4>
							<p style="text-align:center">Add a delivery address.</p>
							<button class="button1 one">ADD ADDRESS</button></center>
						</div>
						<div class="col-sm-3"></div>
					</div>
	            </div>
              	<?php } else { ?>
              	<div class="panel-body address">
	              	<?php $i=1; while($getCustomerDeatils = $getCustomerAddress->fetch_assoc()) { 
					$getState = getIndividualDetails('lkp_states','id',$getCustomerDeatils['lkp_state_id']);
					$getDistrict = getIndividualDetails('lkp_districts','id',$getCustomerDeatils['lkp_district_id']);
					$getPincode = getIndividualDetails('lkp_pincodes','id',$getCustomerDeatils['lkp_pincode_id']);
					$getCity = getIndividualDetails('lkp_cities','id',$getCustomerDeatils['lkp_city_id']);
					$getArea = getIndividualDetails('lkp_locations','id',$getCustomerDeatils['lkp_location_id']);
					?>
				  	<div class="strip_list wow fadeIn" data-wow-delay="0.1s" style="min-height:200px">                  
	                    <div class="col-md-9 col-sm-9">
	                        <h3 style="color:#fe6003">Address <?php echo $i;?></h3>
	                        <div class="type">
	                            <p><b><?php echo $getCustomerDeatils['first_name']; ?><span> <?php echo $getCustomerDeatils['phone']; ?></span></b>
								<br><?php echo $getState['state_name']; ?>,<?php echo $getDistrict['district_name']; ?>,<?php echo $getCity['city_name']; ?>,<?php echo $getArea['location_name']; ?> - <?php echo $getPincode['pincode']; ?>
								<br><?php echo $getCustomerDeatils['address']; ?>.</p>
	                        </div>
	                    </div>
	                    <!-- <div class="col-md-3 col-sm-3">
	                        <div class="go_to" style="padding-top:50px">
	                        	<?php if($getAddressDetails['address_status'] == 0) { ?>
									<a href="make_as_default.php?default_id=<?php echo $getAddressDetails['id']; ?>"><button style="background-color: #fba775" class="button1">Make As Default</button></a>
									<?php } else { ?> 
									<a href="make_as_default.php?default_id=<?php echo $getAddressDetails['id']; ?>"><button class="button1">Make As Default</button></a>
								<?php } ?>                      						
	                      </div> 
	                    </div> -->
					</div><!-- End strip_list-->
					<?php  $i++; } ?>
					<div class="go_to one">										
	                    <div>
							<center><button class="button1">ADD NEW ADDRESS</button></center>
	                    </div> 							
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
									<?php $getStates = getAllDataWithStatus('lkp_states','0'); ?>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="locality">City*</label>
											<select name="lkp_state_id" id="lkp_state_id" class="form-control" onChange="getDistricts(this.value);" required>
												<option value="">Select State</option>
												<?php while($getStatesData = $getStates->fetch_assoc()) { ?>
												<option <?php if($getStatesData['id'] == $getUserAdressDetails['state']) { echo "Selected"; } ?> value="<?php echo $getStatesData['id'];?>"><?php echo $getStatesData['state_name'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>District <sup>*</sup>
										</label>
										<select name="lkp_district_id" id="lkp_district_id" placeholder="District" class="form-control" onChange="getCities(this.value);" required>
											<option value="">Select District</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>City <sup>*</sup>
										</label>
										<select name="lkp_city_id" id="lkp_city_id" class="form-control" placeholder="City" onChange="getPincodes(this.value);" required>
											<option value="">Select City</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Pincode <sup>*</sup>
										</label>
										<select name="lkp_pincode_id" id="lkp_pincode_id" class="form-control" class="form-control valid_mobile_num" maxlength="6" onChange="getLocations(this.value);" placeholder="Zip / Postal Code" required>
											<option value="">Select Pincode</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Location <sup>*</sup>
										</label>
										<select name="lkp_location_id" id="lkp_location_id" class="form-control" placeholder="Location" required>
											<option value="">Select Location</option>
										</select>
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
	    setTimeout(function () {
	        $('#set_valid_msg').hide();
	      }, 2000);
	});
	function getDistricts(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_districts.php",
        data:'lkp_state_id='+val,
        success: function(data){
            $("#lkp_district_id").html(data);
        }
        });
    }
    function getCities(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_cities.php",
        data:'lkp_district_id='+val,
        success: function(data){
            $("#lkp_city_id").html(data);
        }
        });
    }
    function getPincodes(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_pincodes.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
    function getLocations(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_locations.php",
        data:'lkp_pincode_id='+val,
        success: function(data){
            $("#lkp_location_id").html(data);
        }
        });
    }
</script>

</body>

</html>