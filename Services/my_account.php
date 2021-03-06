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
					<li>My Account</li>
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
        
       	 
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">My Dashboard</h3>
                    </div>
                    <?php $getServiceOrders = "SELECT * FROM services_orders WHERE user_id = '".$_SESSION['user_login_session_id']."' GROUP BY order_id";
                        $getServiceOrders1 = $conn->query($getServiceOrders);
                        $getServiceOrdersCount = $getServiceOrders1->num_rows; ?>
                      <div class="panel-body">
                            <a href="service_orders.php">
                                <div class="col-md-4 col-sm-4">
                                    <div class="box_home" id="one">
                                        
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
                            <a href="food_orders.php"> 
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
							<a href="change_password2.php">
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
	

</body>

</html>