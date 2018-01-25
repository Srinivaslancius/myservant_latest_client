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
.table>thead>tr>th,.table>thead>tr>td{
    width:20%;
} 
</style>
</head>
<body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    <!-- Header ================================================== -->
    <header>
      <?php include_once './header.php';?>
        </header>
    <!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
         <h1>Service Orders</h1>
         <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="service_orders.php">Service orders</a></li>
                <li>Service Order Details</li>
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
            <?php 
            $order_id = $_GET['order_id'];
            $serviceOrders = "SELECT * FROM services_orders WHERE order_id = '$order_id' GROUP BY category_id ORDER BY id DESC"; 
            $getServiceOrderData = $conn->query($serviceOrders);
            $i=1;
            while ($row = $getServiceOrderData->fetch_assoc()) { 
            ?>
         <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#<?php echo $row['category_id']; ?>" href="#accordion-<?php echo $row['category_id']; ?>" aria-expanded="true">
                    <i class="zmdi zmdi-chevron-down"></i> <?php $getCatname = getIndividualDetails('services_category','id',$row['category_id']); ?><h3 class="margin-top"><?php echo $getCatname['category_name']; ?></h3>
                </a>
              </h4>
            </div>
            <div id="accordion-<?php echo $row['category_id']; ?>" class="panel-collapse collapse <?php if($i==1){ echo "in"; } ?>">
               <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" style="border:1px solid #ddd;width:100%">
                          <thead>
                              <tr>
                                <th>ORDER SUB ID</th>
                                <th>SERVICE NAME</th>
                                <th>ORDER PRICE</th>
                                <th>ORDER STATUS</th>
                                <th>PAYMENT STATUS</th>
                                <th>ACTION</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $category_id = $row['category_id']; 
                                $getServiceOrders1 = "SELECT * FROM services_orders WHERE order_id = '$order_id' AND category_id = '$category_id' AND lkp_payment_status_id != 3 AND lkp_order_status_id != 3 ORDER BY id DESC";
                                $getServiceOrders = $conn->query($getServiceOrders1);
                                while ($row = $getServiceOrders->fetch_assoc()) { 
                                    $getServicenamesData = getIndividualDetails('services_group_service_names','id',$row['service_id']); ?>
                              <tr>
                                <td><?php echo $row['order_sub_id'];?></td>
                                <td><?php echo $getServicenamesData['group_service_name'];?></td>
                                <td><?php echo $row['order_price'];?></td>
                                <td><?php $orderStatus = getIndividualDetails('lkp_order_status','id',$row['lkp_order_status_id']); echo $orderStatus['order_status']; ?></td>
                                <td><?php $orderPaymentStatus = getIndividualDetails('lkp_payment_status','id',$row['lkp_payment_status_id']); echo $orderPaymentStatus['payment_status']; ?></td>
                                <td><a href="view_service_order_details.php?id=<?php echo $row['id']; ?>"><button class="button1">View Details</button></a></td>
                              </tr>
                              <?php } ?>
                          </tbody>
                        </table>
                   </div>
                </div>
            </div>
        </div>
        <?php $i++; } ?>
    </div>
    </div><!-- End panel-group -->
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