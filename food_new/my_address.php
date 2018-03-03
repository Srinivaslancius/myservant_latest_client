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
    padding: 4px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {
	background-color:#fe6003;
 padding: 5px 12px;
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
      	$address = $_POST['address'];
      	$created_at = date("Y-m-d h:i:s");
      	 $sql1 = "INSERT INTO food_add_address (`user_id`,`first_name`,`last_name`,`email`,`phone`,`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`lkp_location_id`,`address`,`created_at`) VALUES ('$user_id','$first_name','$last_name','$email','$mobile','$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$lkp_location_id','$address','$created_at')";
      	if($conn->query($sql1) === TRUE){             
         	echo "<script type='text/javascript'>window.location='my_address.php?succ=log-success'</script>";
      	} else {               
         	header('Location: my_address.php?err=log-fail');
      	} 
  	}
?>
<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">My Addresses</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">My Addresses</a></li>
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
		          	$getAllCustomerAddress = "SELECT * FROM food_add_address WHERE user_id = '$user_id' AND lkp_status_id = 0";
		          	$getCustomerAddress = $conn->query($getAllCustomerAddress);
					if($getCustomerAddress->num_rows > 0) { ?>
					<div class="panel-body address">
						<?php $i=1; while($getCustomerDeatils = $getCustomerAddress->fetch_assoc()) { 
							$getState = getIndividualDetails('lkp_states','id',$getCustomerDeatils['lkp_state_id']);
							$getDistrict = getIndividualDetails('lkp_districts','id',$getCustomerDeatils['lkp_district_id']);
							$getPincode = getIndividualDetails('lkp_pincodes','id',$getCustomerDeatils['lkp_pincode_id']);
							$getCity = getIndividualDetails('lkp_cities','id',$getCustomerDeatils['lkp_city_id']);
							$getArea = getIndividualDetails('lkp_locations','id',$getCustomerDeatils['lkp_location_id']);
							?>
	                    <div class="strip_list wow fadeIn" data-wow-delay="0.1s" style="min-height:180px">                  
	                        <div class="col-md-9 col-sm-9">
	                            <h3 style="color:#fe6003">Address <?php echo $i; ?></h3>
	                                <div class="type">
	                                  	<p><?php echo $getCustomerDeatils['first_name']; ?> <span><?php echo $getCustomerDeatils['phone']; ?></span></p>
										<p><?php echo $getState['state_name']; ?>,<?php echo $getDistrict['district_name']; ?>,<?php echo $getCity['city_name']; ?>,<?php echo $getArea['location_name']; ?> - <?php echo $getPincode['pincode']; ?></p>
										<p><?php echo $getCustomerDeatils['address']; ?></p>	
	                                </div>
	                        </div>
						</div><!-- End strip_list-->
						<?php $i++; } ?>
                        <div class="go_to">								
                            <div>
								<center><button class="button1 one">ADD ADDRESS</button></center>
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
					<?php $getStatesData = getAllDataWithStatus('lkp_states','0'); ?>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>State *</label>
						<select name="lkp_state_id" id="lkp_state_id" class="form-control" onChange="getDistricts(this.value);" required>
							<option value="">Select State</option>
							<?php while($getStates = $getStatesData->fetch_assoc()) { ?>
							<option value="<?php echo $getStates['id'];?>"><?php echo $getStates['state_name'];?></option>
							<?php } ?>
						</select>
					</div>
					</div>
					<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>District *</label>
						<select name="lkp_district_id" id="lkp_district_id" class="form-control" onChange="getCities(this.value);" required>
							<option value="">Select District</option>
						</select>
					</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>City *</label>
							<select name="lkp_city_id" id="lkp_city_id" class="form-control" placeholder="City"  required onChange="getPincodes(this.value);">
								<option value="">Select City</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Postal code *</label>
								<select name="lkp_pincode_id" id="lkp_pincode_id" class="form-control" placeholder="City"  required onChange="getLocations(this.value);">
								<option value="">Select Postal code</option>
							</select>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>Location*</label>
							<select name="lkp_location_id" id="lkp_location_id" class="form-control" required>
								<option value="">Select Location*</option>
							</select>
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
				  <div class="col-md-3">
				  </div>
                               
                   </div>        
          </form>
                      </div>
					  <!---end-->
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
<!-- This Script For validations -->
<script type="text/javascript" src="js/check_number_validations.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
    $(document).ready(function () {
      setTimeout(function () {
        $('#set_valid_msg').hide();
      }, 2000);
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
</script>
<script type="text/javascript">
    function getDistricts(val) { 
        $.ajax({
        type: "POST",
        url: "food_manage_webmaster/get_districts.php",
        data:'lkp_state_id='+val,
        success: function(data){
            $("#lkp_district_id").html(data);
        }
        });
    }
    function getCities(val) { 
        $.ajax({
        type: "POST",
        url: "food_manage_webmaster/get_cities.php",
        data:'lkp_district_id='+val,
        success: function(data){
            $("#lkp_city_id").html(data);
        }
        });
    }
    function getPincodes(val) { 
        $.ajax({
        type: "POST",
        url: "food_manage_webmaster/get_pincodes.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
    function getLocations(val) { 
        $.ajax({
        type: "POST",
        url: "food_manage_webmaster/get_locations.php",
        data:'lkp_pincode_id='+val,
        success: function(data){
            $("#lkp_location_id").html(data);
        }
        });
    }
</script>
</body>

</html>