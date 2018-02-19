<?php ob_start(); ?>
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
  <link rel="stylesheet" href="css/marquee.css">


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
    <?php if ($_GET['cat_id']) {
      $sub_cat_id = decryptPassword($_GET['cat_id']);
    } else {
      $sub_cat_id = decryptPassword($_GET['key']);
    }
    $getSubCategories = "SELECT * from services_sub_category WHERE services_category_id = '$sub_cat_id' AND id IN (SELECT services_sub_category_id FROM services_groups WHERE lkp_status_id = 0) AND lkp_status_id = '0' ORDER BY id DESC";
      $getSubCategoriesData = $conn->query($getSubCategories);
      $getBanners1 = "SELECT * FROM `services_banners` WHERE lkp_status_id = 0 ANd service_category_id = $sub_cat_id ORDER BY id DESC";
      $getBanners = $conn->query($getBanners1);
      $getAllBanners = $getBanners->fetch_assoc();
    ?>

    <div class="container-fluid page-title">
      <?php  
    if(!empty($getAllBanners['banner'])) { ?>
      <div class="row">
        <img src="<?php echo $base_url . 'uploads/services_banner_images/'.$getAllBanners['banner'] ?>" class="img-responsive" style="width:100%; height:400px;">
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
					<li><a href="services.php">Services</a>
					</li>
					<li><?php $catName = getIndividualDetails('services_category','id',$sub_cat_id); echo $catName['category_name']; ?></li>
				</ul>
			</div>
		</div>

    <div class="container margin_60">

      <div class="main_title">
        <h2><?php $catName = getIndividualDetails('services_category','id',$sub_cat_id); echo $catName['category_name']; ?> Sub Categories</h2>
        
      </div>

  <div class="row">
        <?php if($getSubCategoriesData->num_rows > 0) { 
        while($getAllSubCategoriesData = $getSubCategoriesData->fetch_assoc()) { ?>           
        <div class="col-md-2 col-sm-4 wow zoomIn" data-wow-delay="0.1s">
          <a href="list.php?key2=<?php echo encryptPassword($getAllSubCategoriesData['id']); ?>">
          <div class="tour_container" style="min-height:180px">

            <div class="ribbon_3 popular"><!-- <span>Popular</span> --> 
            </div>
            <div class="img_container padd_sp"style="padding:10px 0px 10px">
                        <center><img src="<?php echo $base_url . 'uploads/services_sub_category_images/'.$getAllSubCategoriesData['sub_category_image'] ?>" class="img-responsive" alt="<?php echo $getAllSubCategoriesData['sub_category_name']; ?>"></center>
            </div>
            <div class="tour_title">
              <h3><?php echo $getAllSubCategoriesData['sub_category_name']; ?></h3>
              
              <!-- end rating -->
            </div>
          </div>
          </a>
          <!-- End box tour -->
        </div>
                 <?php } } else { echo "<h3 style='text-align:center;'>Sorry! Items Not found</h3>"; } ?>
        <!-- End col-md-4 -->
        <!-- End col-md-4 -->
    </div>
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