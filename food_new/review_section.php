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
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
    	 <h1>Review Section</h1>
         <p></p>
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">Review Section</a></li>
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
        <link href="css/rating.css" rel="stylesheet" type="text/css">
        <div class="col-md-9 col-sm-9">
        <?php 
            $uid=$_SESSION['user_login_session_id'];
            $oid=$_GET['order_id'];
            $getOrders = "SELECT * from food_orders WHERE user_id = '$uid' AND order_id='$oid' GROUP BY order_id "; 
            $getOrders1 = $conn->query($getOrders);
            $getDisplayOrderDetails = $getOrders1->fetch_assoc();
        ?>
       	 
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Add a review</h3>
                    </div>
                      <div class="panel-body">
                 <form method="post" action="add_review.php">
                  <div class="col-md-12 col-sm-12">				 
				  <div class="col-md-6 col-sm-6">
  				  <div class="form-group">
      				<div class="rating">
                  <span style="color:black;margin-right:10px"> Add Your Rating: </span>  
                  <input name="rating" value="0" id="rating_star" type="hidden" postID="1" />
              </div>
  				  </div>

        <?php $getRestName= getIndividualDetails('food_vendors','id',$getDisplayOrderDetails['restaurant_id']); ?>

        <div class="form-group">
          <label for="email">Restaurant Name</label>
          <input type="text" class="form-control" id="rest_name" name="rest_name" placeholder="Restaurant Name" value="<?php echo $getRestName['restaurant_name']; ?>" required readonly>
          <span id="input_status" style="color: red;"></span>
        </div>

        <input type="hidden" value="<?php echo $getDisplayOrderDetails['restaurant_id']; ?>" name="restaurant_id">
        <input type="hidden" value="<?php echo $getDisplayOrderDetails['user_id']; ?>" name="user_id">
        <input type="hidden" value="<?php echo $getDisplayOrderDetails['order_id']; ?>" name="order_id">

					<div class="form-group">
						<label for="first-name">Name</label>
						<input type="text" class="form-control"  name="first_name" id="first-name" placeholder="Name" value="<?php echo $getDisplayOrderDetails['first_name']; ?>" readonly required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_email" name="user_email" placeholder="Email" value="<?php echo $getDisplayOrderDetails['email']; ?>" onkeyup="checkEmail();"  required readonly>
            <span id="input_status" style="color: red;"></span>
					</div>
					 <div class="form-group">
						 <label for="text">Message:</label>                
                    <p> <textarea class="form-control" name="message_contact" rows="4" id="comment" placeholder="Message*" required></textarea></p>
					</div>
					<div class="form-group">
						<button class="button1" type="submit" name="update">Add Review</button>					
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

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   

	<!-- End Search Menu -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<script type="text/javascript" src="js/rating.js"></script>
<script language="javascript" type="text/javascript">
$(function() {
    $("#rating_star").spaceo_rating_widget({
        starLength: '5',
        initialValue: '',
        callbackFunctionName: 'processRating',
        imageDirectory: 'img/',
        inputAttr: 'post_id'
    });
});

</script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>


</body>

</html>