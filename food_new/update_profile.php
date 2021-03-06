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
<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">Update Profile</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Update Profile</li>
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
        
       	 
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Update Profile</h3>
                    </div>
                    <?php
        if (!isset($_POST['submit']))  {
         
        } else  {

          $uid = $_SESSION["user_login_session_id"];
        $user_full_name = $_POST["user_full_name"];
        $user_email = $_POST["user_email"];
        $user_mobile = $_POST["user_mobile"];

            $sql1 = "UPDATE users SET user_full_name = '$user_full_name', user_email = '$user_email', user_mobile = '$user_mobile' WHERE  id = '$uid'";
        if($conn->query($sql1) === TRUE){             
          echo "<script type='text/javascript'>window.location='update_profile.php?succ=log-success'</script>";
        }  else { 
          header('Location: update_profile.php?err=log-fail');
        }
        }
        ?><?php if(isset($_GET['succ']) && $_GET['succ'] == 'log-success' ) {  ?>                
            <div class="alert alert-success" style="top:10px; display:block" id="set_valid_msg">
              <strong>Success!</strong> Your Data Updated Successfully.
            </div>               
       <?php }?>

        <?php if(isset($_GET['err']) && $_GET['err'] == 'log-fail' ) {  ?>            
          <div class="alert alert-danger" style="top:10px; display:block" id="set_valid_msg">
            <strong>Failed!</strong> Data Updation Failed.
          </div>     
        <?php } 
          $uid = $_SESSION["user_login_session_id"];
          $userData = getIndividualDetails('users','id',$uid); ?>
                      <div class="panel-body">
                 <form method="post">
                  <div class="col-md-12 col-sm-12">				 
				  <div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label for="first-name">Name</label>
						<input type="text" class="form-control"  name="user_full_name" id="first-name" placeholder="Name" value="<?php echo $userData['user_full_name']; ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_email" name="user_email" placeholder="Email" value="<?php echo $userData['user_email']; ?>" onkeyup="checkEmail();"  required>
            <span id="input_status" style="color: red;"></span>
					</div>
					 <div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="tel" class="form-control valid_mobile_num" name="user_mobile" id="user_mobile" placeholder="Mobile" value="<?php echo $userData['user_mobile']; ?>" maxlength="10" pattern="[0-9]{10}" onkeyup="checkMobile();" required>
            <span id="input_status1" style="color: red;"></span>
					</div>
					<div class="form-group">
						<button class="button1" type="submit" name="submit">Update</button>					
					</div>						
                  </div>
				  <div class="col-md-6 col-sm-6">
				  </div>
                               
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

<div class="layer"></div>
<!-- Login modal -->   

	<!-- End Search Menu -->
<!-- Mobile menu overlay mask -->


<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
<!-- This Script For validations -->
<script type="text/javascript" src="js/check_number_validations.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<script type="text/javascript">
      function checkMobile() {
          var user_mobile = document.getElementById("user_mobile").value;
          if (user_mobile){
            $.ajax({
            type: "POST",
            url: "user_avail_check.php",
            data: {
              user_mobile:user_mobile,
            },
            success: function (result) {
              if (result > 0){
                $("#input_status1").html("<span style='color:red;'>Mobile Already Exist</span>");
              $('#user_mobile').val('');
              } else {
                $('#input_status1').html("");
              }       
              }
             });          
          }
      }
      function checkEmail() {
          var user_email = document.getElementById("user_email").value;
          if (user_email){
            $.ajax({
            type: "POST",
            url: "user_avail_check.php",
            data: {
              user_email:user_email,
            },
            success: function (result) {
              if (result > 0){
                $("#input_status").html("<span style='color:red;'>Email Already Exist</span>");
              $('#user_email').val('');
              } else {
                $('#input_status').html("");
              }     
              }
             });          
          }
      }
    </script>

</body>

</html>