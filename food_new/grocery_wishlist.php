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
    	 <h1>Wish List</h1>
         <p></p>
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">Wish List</a></li>
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
                      <h3 class="nomargin_top">Wish List</h3>
                    </div>
                      <div class="panel-body">
					  <?php 
            $user_id = $_SESSION['user_login_session_id'];

            $getProducts = "SELECT * FROM grocery_save_wishlist WHERE user_id='$user_id' AND  product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0) ORDER BY id DESC ";
                          $getProducts1 = $conn->query($getProducts);
                          if($getProducts1->num_rows > 0) {
                while($productDetails = $getProducts1->fetch_assoc()) { 
                  $getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$productDetails['product_id']);
                  $getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$productDetails['product_id']);
                  $categoryName = getIndividualDetails('grocery_category','id',$productDetails['grocery_category_id']);
                  $getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$productDetails['product_id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
                  $allGetPrices1 = $conn->query($getPrices1);
                  $getPrc1 = $allGetPrices1->fetch_assoc();
                        ?>
                    <div class="strip_list wow fadeIn" data-wow-delay="0.1s" style="min-height:150px">                  
                            <div class="col-md-9 col-sm-9">
                                <div class="desc">
                                        <div class="thumb_strip">
                                                <a href=""><img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="<?php echo $getProductName['product_name']; ?>" style="width:100px;height:100px"></a>
                                        </div>
                                       
                                        <h3 style="color:#fe6003"><?php echo $getProductName['product_name']; ?></a></h3>
                                        <div class="type">
                                          <?php 
                      $prodid = $productDetails['product_id'];
                      $getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='$prodid'";
                      $allGetPrices = $conn->query($getPrices);
                      $getPrc = $allGetPrices->fetch_assoc();
                      ?>
                      <p><b><?php echo $getPrc['weight_type']; ?></b></p>
                         <p><b>Rs.<?php echo $getPrc['selling_price']; ?></b></p>
                                        </div>
                                       
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="go_to">
								
								<div class="row">
								<div class="col-sm-8 col-xs-12">
                                        <div>
										
                    <a href=""><button class="button1" onclick="removeIngItem(<?php echo $productDetails['product_id']; ?>);">Remove</button></a>
                                      </div> 
								</div>
								<div class="col-sm-4 col-xs-12">
                                       <div>
                                         

                                             <!-- <a href="detail_page.html"><i class=" icon-trash" style="font-size:25px;color:#fe6003"></i></a> -->
                                        </div>
								</div>
								</div>
                              </div> 
                            </div>
						</div><!-- End strip_list-->
						<?php } ?>
            <?php } else { ?>
               <h3 style="text-align:center">No Items Found</h3>
               <?php } ?>
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

<script>
function removeIngItem(ingUniqId) {

 
  $.ajax({
      type:'post',
      url:'delete_wish_list_items.php',
      data:{
         ingUniqId : ingUniqId,        
      },
      success:function(response) {
        location.reload();
      }
    });

}
</script> 
</body>

</html>