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
                Service Orders
                
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
        
        <div<div class="col-md-9 col-sm-9">
        
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