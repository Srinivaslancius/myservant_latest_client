<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
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
.flat-banner-box {
    padding: 30px 0 5px;
}
a.mask {
    text-decoration: none;
    overflow: hidden;
    display: block;
    padding-bottom: 10px;
	border-radius: 10px;
}
.storeimgcapt1 {
    background-color: rgba(0,0,0,0.8);
    text-align: center;
    color: #fff;
    padding: 12px 0px;
    position: relative;
    margin-top: -40px;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
	border-radius: 10px;
}
</style>
</head>
  


    <!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->
    
    
    <!-- Header ================================================== -->
    
    <header>
        <?php include_once './header.php';?>
    </header>
    <!-- End Header =============================================== -->
    
   <div id="myCarousel" class="carousel slide" data-ride="carousel">
   <div class="carousel-inner">
      <?php $getBanners = getAllDataWhere('food_banners','lkp_status_id','0'); ?>
      <?php $i=1; while($getFoodhomeBanners = $getBanners->fetch_assoc()) { ?>
       <div class="item <?php if($i==1) { echo "active"; } ?>">
         <img src="<?php echo $base_url . 'uploads/food_banner_images/'.$getFoodhomeBanners['banner'] ?>"  alt="<?php echo $getFoodhomeBanners['title'];?>" style="width:100%;height:400px">
       </div>
      <?php $i++; } ?>

      <?php $getBanners1 = getAllRestaruntsWithProducts('0','',''); ?>
      <?php $j=1; while($getVendorBanners = $getBanners1->fetch_assoc()) { ?>
        <div class="item">
           <a href="view_rest_menu.php?key=<?php echo encryptPassword($getVendorBanners['id']);?>"><img src="<?php echo $base_url . 'uploads/food_vendor_Banner/'.$getVendorBanners['vendor_banner'] ?>" alt="<?php echo $getVendorBanners['vendor_name'];?>" style="width:100%;height:400px"><a/>
        </div>
      <?php $j++; } ?>
   </div>
    <?php $getAllFoodOrders = "SELECT * FROM food_orders GROUP BY order_id ORDER BY id DESC";
          $getFoodOrders = $conn->query($getAllFoodOrders);
          $getFoodOrdersCount = $getFoodOrders->num_rows;?>
     <div id="count" class="hidden-xs">
        <ul>
            <li><span class="number"><?php echo getRowsCount('food_vendors'); ?></span> Restaurants</li>
            <li><span class="number"><?php echo $getFoodOrdersCount ?></span> People Served</li>
            <li><span class="number"><?php echo getUsersRowsCount('users','lkp_admin_service_type_id','2'); ?></span> Registered Users</li>
        </ul>
   </div>
 </div>
 <?php $getOtherServicesGroceryData ="SELECT * FROM myservant_other_services WHERE id=1";
      $getOtherServices = $conn->query($getOtherServicesGroceryData);
      $getOtherServices1 = $getOtherServices->fetch_assoc();
      ?>
      <?php $getOtherServicesServicesData ="SELECT * FROM myservant_other_services WHERE id=2";
      $getOtherServicesServices = $conn->query($getOtherServicesServicesData);
      $getOtherServicesServices1 = $getOtherServicesServices->fetch_assoc();
?>
    <section class="flat-row flat-banner-box">
			<div class="container">
			<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
							<div class="banner-box">
							<div class="inner-box">
                        <a href="<?php echo $base_url; ?>index.php" class="mask">
                           <img class="img-responsive zoom-img" src="<?php echo $base_url . 'grocery_admin/uploads/other_services_web_images/'.$getOtherServices1['web_image']; ?>" alt="<?php echo $getOtherServices1['title']; ?>" style="width:100%;height:auto">
                           <div class="storeimgcapt1"><?php echo $getOtherServices1['title']; ?></div>
                        </a>
						</div>
						</div>
                     </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
					<div class="banner-box">
							<div class="inner-box">
                        <a href="<?php echo $base_url; ?>Services/index.php" class="mask">
                           <img class="img-responsive zoom-img" src="<?php echo $base_url . 'grocery_admin/uploads/other_services_web_images/'.$getOtherServicesServices1['web_image']; ?>" style="width:100%;height:auto" alt="<?php echo $getOtherServicesServices1['title']; ?>">
                           <div class="storeimgcapt1"><?php echo $getOtherServicesServices1['title']; ?></div>
                        </a>
						</div>
						</div>
                     </div>
                     
                  </div>
				  </section>
<?php $getAllSearchByAreaData = getAllDataWhere('food_content_pages','id',2);
          $getSearchByAreaData = $getAllSearchByAreaData->fetch_assoc();
?>
<?php $getALlChooseRestaurantData = getAllDataWhere('food_content_pages','id',3);
          $getChooseRestaurant = $getALlChooseRestaurantData->fetch_assoc();
?>
<?php $getAllPayByCardData = getAllDataWhere('food_content_pages','id',4);
          $getPayByCardData = $getAllPayByCardData->fetch_assoc();
?>
<?php $getAllDeliveryData = getAllDataWhere('food_content_pages','id',5);
          $getDeliveryData = $getAllDeliveryData->fetch_assoc();
?>

<?php $gethowitWorksData = getAllDataWhere('food_content_pages','id',7);
          $gethowitWorksData1 = $gethowitWorksData->fetch_assoc();
?>

<?php $getchooseFrom = getAllDataWhere('food_content_pages','id',8);
          $getchooseFrom1 = $getchooseFrom->fetch_assoc();
?>
    <!-- Content ================================================== -->
         <div class="container margin_10">
        
         <div class="main_title">
            <h2 class="nomargin_top" style="padding-top:0"><?php echo $gethowitWorksData1['title']; ?></h2>
            <p>
               <?php echo $gethowitWorksData1['description']; ?>
            </p>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="box_home" id="one">
                    <span>1</span>
                    <h3><?php echo $getSearchByAreaData['title']; ?></h3>
                    <p>
                        <?php echo $getSearchByAreaData['description']; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="box_home" id="two">
                    <span>2</span>
                    <h3><?php echo $getChooseRestaurant['title']; ?></h3>
                    <p>
                       <?php echo $getChooseRestaurant['description']; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="box_home" id="three">
                    <span>3</span>
                    <h3><?php echo $getPayByCardData['title']; ?></h3>
                    <p>
                        <?php echo $getPayByCardData['description']; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="box_home" id="four">
                    <span>4</span>
                    <h3><?php echo $getDeliveryData['title']; ?></h3>
                    <p>
                        <?php echo $getDeliveryData['description']; ?>
                    </p>
                </div>
            </div>
        </div><!-- End row -->
        
        
        </div><!-- End container -->
            
           
    <div class="white_bg">
    <div class="container margin_60">
        
        <div class="main_title">
            <h2 class="nomargin_top"><?php echo $getchooseFrom1['title']; ?></h2>
            
               <!-- <?php echo $getchooseFrom1['description']; ?> -->
          
        </div>

        <?php $getMostPopualrRest = getAllRestaruntsWithProducts('0','0','4'); ?>
        
        <div class="row">
            <?php while($getMostPopualrRestaurants = $getMostPopualrRest->fetch_assoc()) { ?>
            <div class="col-md-6 col-sm-6">
               
                <a href="view_rest_menu.php?key=<?php echo encryptPassword($getMostPopualrRestaurants['id']);?>" class="strip_list">
                    <?php if($getMostPopualrRestaurants['make_it_popular'] == '1') { ?><div class="ribbon_1">Popular</div><?php } ?>
                    <div class="desc">
                        <div class="thumb_strip">
                            <?php if($getMostPopualrRestaurants['logo']!='') { ?>
                                <img src="<?php echo $base_url . 'uploads/food_vendor_logo/'.$getMostPopualrRestaurants['logo']; ?>" alt="<?php echo $getMostPopualrRestaurants['restaurant_name']; ?>">
                            <?php } else { ?>
                                <img src="img/thumb_restaurant.jpg" alt="<?php echo $getMostPopualrRestaurants['restaurant_name']; ?>">
                            <?php } ?>
                        </div>
                        <div class="rating">
                            <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                        </div>
                        <h3><?php echo $getMostPopualrRestaurants['restaurant_name']; ?></h3>
                        <div class="type">
                           <?php echo substr($getMostPopualrRestaurants['description'], 0,150); ?>
                        </div>
                        <div class="location">
                           <?php echo $getMostPopualrRestaurants['restaurant_address']; ?> .<span class="opening">Opens at <?php echo $getMostPopualrRestaurants['working_timings']; ?></span>
                        </div>
                        <ul>
                            <?php 
                                $getDeliveryTypes = $getMostPopualrRestaurants['delivery_type_id']; 
                                $getDtype = explode(",",$getDeliveryTypes);
                            ?>
                            <?php 
                                if (in_array("1", $getDtype)) { 
                                   echo "<li>Take away<i class='icon_check_alt2 ok'></i></li>";
                                } 

                                if(in_array("2", $getDtype)) {
                                    echo "<li>Delivery<i class='icon_check_alt2 ok'></i></li>";
                                }

                            ?>
                           
                        </ul>
                    </div><!-- End desc-->
                </a><!-- End strip_list-->
              
            </div><!-- End col-md-6-->
             <?php } ?>
        </div><!-- End row -->   
        
        </div><!-- End container -->
        </div><!-- End white_bg -->
                       
    <div class="white_bg" style="margin-top:-60px">
    <div class="container margin_60">
        
        <div class="main_title">
            <h2 class="nomargin_top">Our Brands</h2>
        </div>
        
        <div class="container carousel1" style="padding-left:5px;padding-right:35px">
  <div class="row">
    <div class="col-md-12">
      <div class="carousel carousel-showmanymoveone slide" id="carousel123">
        <div class="carousel-inner pad_lft">
             <?php $getBrands = getAllDataWithStatus('food_brand_logos','0'); ?>
          <?php while($getAllBrands = $getBrands->fetch_assoc()) { ?>
          <div class="item <?php if($getAllBrands['id']==4) { echo "active"; } ?>">
            <div class="col-xs-12 col-sm-3 col-md-2"><a href=""> <img src="<?php echo $base_url . 'uploads/food_brand_logos/'.$getAllBrands['brand_logo'] ?>" alt="" width="200px" height="150px"></a>
            </div>
          </div>
          <?php } ?>
        </div>
        <a class="left carousel-control" href="#carousel123" data-slide="prev"><i class="glyphicon glyphicon-chevron-left" style="margin-left:-110px;color:#f26226"></i></a>
        <a class="right carousel-control" href="#carousel123" data-slide="next"><i class="glyphicon glyphicon-chevron-right"style="margin-right:-120px;color:#f26226"></i></a>
      </div>
    </div>
  </div> 
</div>
        
    </div>
    </div>
    
       <div class="high_light">
       <?php include_once 'view_restaurants.php';?>
      </div><!-- End hight_light -->
            
    
    <!-- End Content =============================================== -->
    
       
    <!-- Footer ================================================== -->
    <footer>
        <?php include_once 'footer.php';?>
    </footer>
    <!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>

<script>
$(document).ready(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else { 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});
function showLocation(position) {  
    var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;
    

  $.ajax({
    type:'POST',
    url:'getLocation.php',
    data:'latitude='+latitude+'&longitude='+longitude,
    success:function(msg){
            if(msg){
               $("#location").html(msg);
            }else{
                $("#location").html('Not Available');
            }
    }
  });

}
</script>

<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>


<!-- SPECIFIC SCRIPTS -->
<script src="layerslider/js/greensock.js"></script>
<script src="layerslider/js/layerslider.transitions.js"></script>
<script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            responsive: true,
            responsiveUnder: 1280,
            layersContainer: 1170,
            navButtons:false,
            showCircleTimer:false,
            navStartStop:false,
            skinsPath: 'layerslider/skins/'
            // Please make sure that you didn't forget to add a comma to the line endings
            // except the last line!
        });
    });
</script>

   
    <script>
(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // https://getbootstrap.com/javascript/#carousel
  $('#carousel123').carousel({ interval: 2000 });
  $('#carouselABC').carousel({ interval: 3600 });
}());

(function(){
  $('.carousel-showmanymoveone .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<6;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());
</script>



<?php include "search_js_script.php"; ?>

</html>