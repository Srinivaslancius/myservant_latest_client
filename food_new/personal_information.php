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
ul#cat_nav li a {
    position: relative;
    color: #555;
    display: block;
    padding: 10px 10px;
}
ul#cat_nav li a:hover {
   background-color:#fe6003;
   color:white;
}
ul#cat_nav li a#active {
   background-color:#fe6003;
   color:white;
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
</style>
</head>
<body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

<?php 
if(isset($_POST['update']))  { 

  //echo "<pre>"; print_r($_POST); die;

    $uid =$_SESSION['user_login_session_id'];

    $updateUser = "UPDATE users SET user_full_name = '".$_POST['user_full_name']."' , user_email='".$_POST['user_email']."', user_mobile = '".$_POST['user_mobile']."' WHERE id='$uid' ";
    $conn->query($updateUser);
    header('Location: personal_information.php?err=success');
  }
?>

	
    <!-- Header ================================================== -->
    <header>
	  <?php include_once './header.php';?>
        </header>
    <!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
    	 <h1>Personal Information</h1>
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Personal Information</li>
            </ul>            
        </div>
    </div><!-- Position -->

      

<!-- Content ================================================== -->
<div class="container margin_60_35">
			<div class="feature_2">
	<div class="row">

    <div class="clear_fix"></div>
    <?php if(isset($_GET['err']) && $_GET['err'] == 'success' ) {  ?>      
          <div class="alert alert-success" style="display:block">
          <strong>Success!</strong> Your Personal Info Updated.
        </div>
    <?php }?>

            
        <aside class="col-lg-3 col-md-4 col-sm-4">
           <div class="box_style_cat">
       		<ul id="cat_nav" style="border:1px solid #f5f5f5;padding:0px">
            	<div class="box_style_cat">
       		<?php include_once 'my_dashboard_strip.php';?>
            </div>           
            </ul>
            </div>
        </aside>     
        <?php $userData = getIndividualDetails('users','id',$_SESSION['user_login_session_id']); ?>  
        <div class="col-lg-9 col-md-8 col-sm-8">        
       			 <div class="row">
				 <div class="col-md-1">
				  </div>
          <form method="post">
                  <div class="col-md-11">				 
				  <div class="col-md-6">
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
						<input type="text" class="form-control valid_mobile_num" name="user_mobile" id="user_mobile" placeholder="Mobile" value="<?php echo $userData['user_mobile']; ?>" onkeyup="checkMobile();" required>
            <span id="input_status1" style="color: red;"></span>
					</div>
					<div class="form-group">
						<button class="button1" type="submit" name="update">Update</button>					
					</div>						
                  </div>
				  <div class="col-md-6">
				  </div>
                               
                   </div>        
          </form>
        </div><!-- End col-lg-9-->
        </div>
			</div>
</div>
</div>
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
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

</body>
</html>