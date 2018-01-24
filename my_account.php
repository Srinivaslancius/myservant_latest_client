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
								<a href="index.php" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="terms&conditions.php" title="">My Account</a>
								
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
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">My Dashbaord</h3>
                    </div>
                      <div class="panel-body">
					  <div class="row">
          <?php $getServiceOrders = getAllDataWhere('services_orders','user_id',$_SESSION['user_login_session_id']);
          $getServiceOrders1 = $getServiceOrders->num_rows; ?>
                                <div class="col-md-4 col-sm-4">
                                    <a href="Services/service_orders.php"><div class="box_home" id="one">
                                        
                                        <h3>Services Orders</h3>
                                        <p>
                                            <?php echo $getServiceOrders1; ?>
                                        </p>
                                    </div> </a>
                                </div>
                           
        <?php $getFoodOrders = getAllDataWhere('food_orders','user_id',$_SESSION['user_login_session_id']);
          $getFoodOrders1 = $getFoodOrders->num_rows; ?>
                                <div class="col-sm-4">
                                     <a href="food_new/food_orders1.php"> <div class="box_home" id="two">
                                        
                                        <h3>Food Orders</h3>
                                        <p>
                                            <?php echo $getFoodOrders1; ?>
                                        </p>
                                    </div> </a>
                                </div>
                           
        <?php $getGroceryOrders = getAllDataWhere('grocery_orders','user_id',$_SESSION['user_login_session_id']);
          $getGroceryOrders1 = $getGroceryOrders->num_rows; ?>                   
                                <div class="col-sm-4">
                                     <a href="grocery_orders.php"><div class="box_home" id="three">
                                        
                                        <h3>Grocery Orders</h3>
                                        <p>
                                            <?php echo $getGroceryOrders1; ?>
                                        </p>
                                    </div> </a>
                                </div>
                           
							
                          
                                <div class="col-sm-4">
                                      <a href="grocery_wishlist.php"><div class="box_home" id="four">
                                        
                                        <h3>Wishlist Grocery</h3>
                                       
                                    </div>  </a>
                                </div>
                          
                           
                                <div class="col-sm-4">
                                     <a href="my_address.php"><div class="box_home" id="five">
                                        
                                        <h3>My Addresses</h3>
                                       
                                    </div>  </a>
                                </div>
                          
                          
                                <div class="col-sm-4">
                                      <a href="wallet.php"><div class="box_home" id="six">
                                        
                                        <h3>Wallet</h3>
                                       
                                    </div>  </a>
                                </div>
                          
                           
                                <div class="col-sm-4">
                                     <a href="update_profile.php"><div class="box_home" id="seven">
                                        
                                        <h3>Update Profile</h3>
                                       
                                    </div> </a>
                                </div>
                           
                          
                                <div class="col-sm-4">
                                      <a href="#"><div class="box_home" id="eight">
                                        
                                        <h3>Reward Points</h3>
                                       
                                    </div></a>
                                </div>
								 <div class="col-sm-4">
                                      <a href="change_password.php"><div class="box_home" id="nine">
                                        
                                        <h3>Change password</h3>
                                       
                                    </div></a>
                                </div>
                            
						</div>
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

</body>	
</html>