<?php include_once 'meta.php';?>
	<style>
	.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 2px 19px;
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
								<a href="index.php" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								Update Profile
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
        
        <div class="col-sm-9">  
        <?php if($_SESSION['user_login_session_id'] == '') {
	      header ("Location: logout.php");
	  	}
	  	?>     	 
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
        ?>
       	 <?php if(isset($_GET['succ']) && $_GET['succ'] == 'log-success' ) {  ?>                
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
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Update Profile</h3>
                    </div>
                      <div class="panel-body">
                 <form method="post">
                  <div class="col-md-12 col-sm-12">				 
				  <div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label for="first-name">Name</label>
						<input type="text" class="form-control"  name="user_full_name"  placeholder="Name" value="<?php echo $userData['user_full_name']; ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_email" id="user_email" name="user_email" placeholder="Email" value="<?php echo $userData['user_email']; ?>" required">
            <span id="input_status" style="color: red;"></span>
					</div>
					 <div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" class="form-control valid_mobile_num" id="user_mobile" name="user_mobile" placeholder="Mobile" value="<?php echo $userData['user_mobile']; ?>" maxlength="10" pattern="[0-9]{10}" required onkeyup="checkMobile();">
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

		<script type="text/javascript">
	    
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
	    $(document).ready(function(){
		    setTimeout(function () {
		        $('#set_valid_msg').hide();
	      	}, 2000);
		});
    </script>
<?php include "search_js_script.php"; ?>
</body>	
</html>