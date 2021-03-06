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
<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">Frequently Asked Questions</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Faq</li>
                
            </ul>
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
      <div class="feature_2">
  <div class="row">         
        <div class="col-md-12 col-xs-12">        
         <div class="panel-group" id="accordion">
          <?php $getHelpCentersData = getAllDataWhere('food_faqs','lkp_status_id',0); 
                      while($getHelpCenters = $getHelpCentersData->fetch_assoc()) { ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $getHelpCenters['id'];?>"><?php echo $getHelpCenters['question']; ?><i class="indicator pull-right  <?php if($getHelpCenters['id']==1) { echo "icon_minus_alt2"; } else { echo "icon_plus_alt2";  } ?>"></i></a>
                      </h4>
                    </div>
                    <div id="collapse<?php echo $getHelpCenters['id'];?>" class="panel-collapse collapse  <?php if($getHelpCenters['id']==1) { echo "in"; } ?>">
                      <div class="panel-body">
                        <?php echo $getHelpCenters['answer']; ?>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div><!-- End panel-group -->
             
        </div>
    
    </div>
  </div>
</div><!-- End container -->
<div class="high_light">
       <?php include_once 'view_restaurants.php'; ?>
      </div>

<!-- Footer ================================================== -->
  <footer>
   <?php include_once 'footer.php'; ?>
    </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->
    
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
<script>
$('#faq_box a[href^="#"]').on('click', function (e) {
      e.preventDefault();
      var target = this.hash;
      var $target = $(target);
      $('html, body').stop().animate({
        'scrollTop': $target.offset().top - 120
      }, 900, 'swing', function () {
        window.location.hash = target;
      });
    });
</script>

</body>
</html>