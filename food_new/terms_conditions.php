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
<?php $getTerms_ConditionsData = getAllDataWhere('food_content_pages','id',10);
          $getAllTerms_ConditionsData = $getTerms_ConditionsData->fetch_assoc();
?>
<div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered"><?php echo $getAllTerms_ConditionsData['title']; ?></div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><?php echo $getAllTerms_ConditionsData['title']; ?></li>
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <!--<div class="main_title margin_mobile">
        <h2 class="nomargin_top"><?php echo $getAllTerms_ConditionsData['title']; ?></h2>
        </div>-->
            <div class="feature_2">
                <?php echo $getAllTerms_ConditionsData['description']; ?>
        </ol>
       
            </div>
        </div>
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

</body>
</html>