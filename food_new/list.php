<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- Radio and check inputs -->
    <link href="css/skins/square/grey.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.skinFlat.css" rel="stylesheet" >

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

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

<?php
    if(isset($_POST['searchKey'])) {
        $searchParms = $_POST['searchKey'];
        //$getSearchResults = getSearchResults('food_vendors',$searchParms);
        $getRes = "SELECT * FROM food_vendors WHERE `lkp_status_id`= '0' AND  (restaurant_address LIKE '%$searchParms%' OR  pincode LIKE '%$searchParms%') AND id IN (SELECT restaurant_id FROM food_products WHERE lkp_status_id = 0) ORDER BY id DESC LIMIT 8";
        $getSearchResults = $conn->query($getRes);        
    } else {
        $getSearchResults = getAllRestaruntsWithProducts('0','0','8');
    }
    $getResultsCount = $getSearchResults->num_rows;
?>

<!-- SubHeader =============================================== -->
<div class="container-fluid" style="padding:0px">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/slide/slide_1.jpg" alt="image" style="width:100%;">
        <div class="carousel-caption">
        <h2 style="color:white" id="get_total_res"><?php echo $getResultsCount; ?> Results in your zone</h2>
        <?php if(isset($_POST['searchKey'])) { ?><p><i class="icon_pin"></i> <?php echo $_POST['searchKey']; ?></p><?php } ?>
      </div>
      </div>
    </div>
  </div>
</div>

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>                
                <li><?php if(isset($_POST['searchKey'])) { ?><?php echo $_POST['searchKey']; ?><?php } else { ?>Restaurants<?php } ?></li>
            </ul>
             
        </div>
    </div><!-- Position -->
    
    <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div><!-- End Map -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
            <div class="col-md-3 col-sm-3">
                <?php include_once './filters.php';?>
            </div>       
        <div class="col-md-9 col-sm-9">   
                <div class="ajax_result">
                        <?php while($getResults = $getSearchResults->fetch_assoc()) { 
                             $show_more = $getResults['id'];?>
                        <div class="col-md-6 filter_data">
                            <div class="strip_list wow fadeIn" data-wow-delay="0.1s">
                                    <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                    <div class="desc">
                                                            <div class="thumb_strip">
                                                                <a href="view_rest_menu.php?key=<?php echo encryptPassword($getResults['id']);?>"><img src="<?php echo $base_url . 'uploads/food_vendor_logo/'.$getResults['logo'] ?>" alt=""></a>
                                                            </div>
                                                            <div class="row">
    															<div class="col-md-7 col-sm-7">
                                                                <h4><?php echo $getResults['restaurant_name']; ?></h4>
    															</div>
    															<div class="col-md-5 col-sm-5">
    																<div class="go_to" style="height:10px">                                                          
                                                                    <a href="view_rest_menu.php?key=<?php echo encryptPassword($getResults['id']);?>" class="btn_1 hidden-xs" style="padding:10px">View Menu</a>
                                                                
    																</div>
    															</div>
											                 </div>
                                                            <div class="type" style="text-align:justify">
                                                                <?php echo substr($getResults['description'], 0,150); ?>
                                                            </div>
                                                            
                                                            
                                                            <div class="rating">
                                                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#0">98 reviews</a></small>)
                                                            </div><br>
															 <a href="view_rest_menu.php?key=<?php echo encryptPassword($getResults['id']);?>" class="btn_1 visible-xs" style="padding:10px">View Menu</a>
                                                    </div>
                                            </div>
                                    </div><!-- End row-->
                            </div><!-- End strip_list-->
                        </div>
                        <?php } ?>
                </div>
                       
        </div><!-- End col-md-9--> 
		<div class="col-md-3 col-sm-3">
		</div>
		<div class="col-md-9 col-sm-9">
		<?php if($getResultsCount >= 8) { ?>
                <center><a class="btn_1 load_more">Load More</a></center>
            <?php } ?>
		</div>	
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
    <footer>
            <?php include_once 'footer.php';?>
        </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script  src="js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAs_JyKE9YfYLSQujbyFToZwZy-wc09w7s"></script>
<script src="js/map.js"></script>
<script src="js/infobox.js"></script>
<script src="js/ion.rangeSlider.js"></script>
<script>
    $(function () {
         'use strict';
        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 15,
            from: 0,
            to:5,
            type: 'double',
            step: 1,
            prefix: "Km ",
            grid: true
        });
    });
</script>
<script type="text/javascript">
$(document).on('change','.check_cousin_type',function(){
   var url = "cusine_filters.php";
   $.ajax({
     type: "POST",
     url: url,
     data: $("#search_form").serialize(),
     success: function(data)
     {                  
        //alert(data);
        $('.ajax_result').html(data);
        $('#get_total_res').html($('#get_res_cnt').val() + " Results in your zone");
     }               
   });
  return false;
});

$(document).on('change','.price_filt',function(){   
   var url = "price_filters.php";
   $.ajax({
     type: "POST",
     url: url,
     data: $("#price_filter").serialize(),
     success: function(data)
     {                  
        //alert(data);
        $('.ajax_result').html(data);
        $('#get_total_res').html($('#get_res_cnt').val() + " Results in your zone");
     }               
   });
  return false;
});

</script>
<script>
    $(document).ready(function() {
        $('.load_more').on('click', function () {
            $('.load_more').hide();
            $.ajax({
            type:"post",
            url:"total_list.php", 
            success:function(html){ 
                $(".ajax_result").html('');
                $(".ajax_result").append(html);
                $('#get_total_res').html($('#get_res_cnt').val() + " Results in your zone");
            }
          }); 
        });
    });
</script>
</body>
<?php include "search_js_script.php"; ?>
</html>
