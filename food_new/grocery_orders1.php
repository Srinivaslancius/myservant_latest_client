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
 <div class="centered">Grocery Orders</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">Grocery Orders</a></li>
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
                      <h3 class="nomargin_top">Grocery Orders</h3>
                    </div>
                      <div class="panel-body">
                     <div class="table-responsive">	
				<?php $uid=$_SESSION['user_login_session_id'];
                    $getOrders = "SELECT * from grocery_orders WHERE user_id = '$uid' GROUP BY order_id ORDER BY id DESC"; 
                    $getOrders1 = $conn->query($getOrders);
                    if($getOrders1->num_rows > 0) { 
                    while($orderData = $getOrders1->fetch_assoc()) { ?> 			 
        			<table class="table" style="border:1px solid #ddd;width:100%">
					
            		<thead>
            		  <tr>
					  <th>Order PLACED</th>
                        <th>Order Price</th>
                        <th>SHIP TO</th>
                        <th>ORDER ID</th>
                        <th>ACTION</th>
            		  </tr>
            		</thead>
            		<tbody>
            		  <tr>
					  <td><?php echo $orderData['created_at']; ?>  </td>
                        <td>Rs.<?php echo $orderData['order_total']; ?></td>
                        <td><?php echo $orderData['first_name']; ?><br><?php echo $orderData['address']; ?></td>
                        <td><?php echo $orderData['order_id']; ?></td>
                        <td><a href="grocery_order_details.php?order_id=<?php echo $orderData['order_id']; ?>"><button class="button1">View Details</button></a>
                        <?php 
                        if($orderData['lkp_order_status_id'] != 3) {
                        if($orderData['assign_delivery_id'] == '0' || $orderData['assign_delivery_id'] == '') { ?>
                        <a href="../cancel_order.php?order_id=<?php echo $orderData['order_id']; ?>" onclick="return confirm('Are you sure you want to cancel?')"><button class="button1">Cancel Order</button></a></td>
                        <?php } } ?>
            		  </tr>
            		  
            		</tbody>
					
        	     </table>
				 <?php } } else { ?>
                     <h3 style="text-align:center;color:#fe6003;">No Orders Found</h3>
                <?php } ?>
        	  </div>
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