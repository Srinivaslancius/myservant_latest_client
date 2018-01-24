<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once 'meta.php';?>

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
    <!-- MYDASHBOARD CSS-->
    <link href="css/my-dashboard.css" rel="stylesheet">
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
    <?php
    if($_SESSION['user_login_session_id'] == '') {
        header ("Location: logout.php");
    } 
    ?>
    <div class="container-fluid page-title">
            <?php if($getContentPageData->num_rows > 0) { ?>    
                <div class="row">
                    <img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getAboutUsData['image'] ?>" alt="<?php echo $getAboutUsData['title'];?>" class="img-responsive">
                </div>
            <?php } else { ?>
                <div class="row">
                    <img src="img/slides/slide_1.jpg" class="img-responsive">
                </div>
            <?php }?>   
        </div>
    
    <br>
    <div class="container margin_60">
        <div class="main_title">
            <h2><span>Order Information</span></h2>
        </div>
        <div class="row">
            <div class="col-xs-12 bhoechie-tab">
                <!-- My orders section -->
                <div class="bhoechie-tab-content active">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php $order_sub_id = $_GET['token'];
                                      $user_id = $_SESSION['user_login_session_id'];
                                      $orderDetails ="SELECT * FROM services_orders WHERE order_sub_id ='$order_sub_id' AND user_id= '$user_id' ORDER BY id DESC";
                                      $orderDetails1 = $conn->query($orderDetails);
                                      $orderData = $orderDetails1->fetch_assoc();
                                      $getCategories = getIndividualDetails('services_category','id',$orderData['category_id']);
                                      $getSubCategories = getIndividualDetails('services_sub_category','id',$orderData['sub_category_id']);
                                      $getGroups = getIndividualDetails('services_groups','id',$orderData['group_id']);
                                      $getServiceNames = getIndividualDetails('services_group_service_names','id',$orderData['service_id']);
                                      $orderStatus = getIndividualDetails('lkp_order_status','id',$orderData['lkp_order_status_id']);
                                      $paymentStatus = getIndividualDetails('lkp_payment_status','id',$orderData['lkp_payment_status_id']);
                                      $paymentMethod = getIndividualDetails('lkp_payment_types','id',$orderData['payment_method']);
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p style="font-size:13px;">Name:<span style="font-size:15px;">  <?php echo $orderData['first_name'];?></span><br>Email:<span style="font-size:15px;">  <?php echo $orderData['email'];?></span><br>Mobile: <span style="font-size:15px;">  <?php echo $orderData['mobile'];?></span><br>Address: <span style="font-size:15px;"><?php echo $orderData['address'];?></span></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p style="font-size:13px;">Category Name:<span style="font-size:15px;">  <?php echo $getCategories['category_name'];?></span><br>Sub Category Name:<span style="font-size:15px;">  <?php echo $getSubCategories['sub_category_name'];?></span><br>Group Name: <span style="font-size:15px;">  <?php echo $getGroups['group_name'];?></span><br>Order Sub Id: <span style="font-size:15px;"><?php echo $orderData['order_id'];?></span></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p style="font-size:13px;">Order Id:<span style="font-size:15px;">  <?php echo $orderData['order_id'];?></span><br>Payment Method:<span style="font-size:15px;">  <?php echo $paymentMethod['status'];?></span><br>Order Status: <span style="font-size:15px;">  <?php echo $orderStatus['order_status'];?></span><br>Payment Status: <span style="font-size:15px;"><?php echo $paymentStatus['payment_status'];?></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="border-bottom:1px solid #ddd">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h5 style="color:#f26226">Service Name</h5>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5 style="color:#f26226">Service Price</h5>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5 style="color:#f26226">Service Quantity</h5>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5 style="color:#f26226">Service Selected Date</h5>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5 style="color:#f26226">Service Selected Time</h5>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5 style="color:#f26226">Order Price</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 col-xs-12">
                                            <p><?php echo $getServiceNames['group_service_name'];?></p>
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <p><?php echo $orderData['service_price'];?></p>
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                           <p><?php echo $orderData['service_quantity'];?></p>
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                           <p><?php echo $orderData['service_selected_date'];?></p>
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                           <p><?php echo $orderData['service_selected_time'];?></p>
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                           <p><?php echo $orderData['order_price'];?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- </div> -->
        </div>
    </div>

        </main>
    <!-- End main -->

    <footer>
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

        <!-- Search Menu -->
    
    <!-- Common scripts -->
    <script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/common_scripts_min.js"></script>
    <script src="js/functions.js"></script>

    <!-- Specific scripts -->
    <script src="layerslider/js/greensock.js"></script>
    <script src="layerslider/js/layerslider.transitions.js"></script>
    <script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
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