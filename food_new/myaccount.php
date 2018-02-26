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
 <div class="centered">My Account</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">Myaccount</a></li>
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
                      <h3 class="nomargin_top">My Dashboard</h3>
                    </div>
                      <div class="panel-body">
					  <a href="service_orders.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="one">
                                        <?php $getServiceOrders = "SELECT * FROM services_orders WHERE user_id = '".$_SESSION['user_login_session_id']."' GROUP BY order_id";
                                        $getServiceOrders1 = $conn->query($getServiceOrders);
                                        $getServiceOrdersCount = $getServiceOrders1->num_rows; ?>
                                        <h3>Services Orders</h3>
                                        <p>
                                             <?php echo $getServiceOrdersCount; ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <?php $getFoodOrders = "SELECT * FROM food_orders WHERE user_id = '".$_SESSION['user_login_session_id']."' GROUP BY order_id";
                            $getFoodOrders1 = $conn->query($getFoodOrders);
                            $getFoodOrdersCount = $getFoodOrders1->num_rows; ?>
                            <a href="food_orders1.php"> 
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="two">
                                        
                                        <h3>Food Orders</h3>
                                        <p>
                                            <?php echo $getFoodOrdersCount; ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <?php $getGroceryOrders = "SELECT * FROM grocery_orders WHERE user_id = '".$_SESSION['user_login_session_id']."' GROUP BY order_id";
                            $getGroceryOrders1 = $conn->query($getGroceryOrders);
                            $getGroceryOrdersCount = $getGroceryOrders1->num_rows; ?>
                            <a href="grocery_orders1.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="three">
                                        
                                        <h3>Grocery Orders</h3>
                                        <p>
                                             <?php echo $getGroceryOrdersCount; ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <?php 

                  $getWishListOrders = "SELECT * FROM grocery_save_wishlist WHERE user_id = '".$_SESSION['user_login_session_id']."'";
                  $getWishListOrders1 = $conn->query($getWishListOrders);
                  $getWishListOrdersCount = $getWishListOrders1->num_rows; ?> 
							 <a href="grocery_wishlist.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="four">
                                        
                                        <h3>My Wishlist</h3>
                                       <?php echo $getWishListOrdersCount; ?>
                                    </div>
                                </div>
                            </a>
							<a href="my_address.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="five">
                                        
                                        <h3>My Addresses</h3>
                                       
                                    </div>
                                </div>
                            </a>
							 <a href="wallet.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="six">
                                        
                                        <h3>Wallet</h3>
                                       
                                    </div>
                                </div>
                            </a>
                            <a href="update_profile.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="seven">
                                        
                                        <h3>Update Profile</h3>
                                       
                                    </div>
                                </div>
                            </a>
                            
                           
                            <a href="rewards.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="eight">
                                        
                                        <h3>Reward Points</h3>
                                       
                                    </div>
                                </div>
                            </a>
							 <a href="change_password1.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="nine">
                                        
                                        <h3>Change Password</h3>
                                       
                                    </div>
                                </div>
                            </a>
                           
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


</body>

</html>