<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
	<?php $getContentPageData = getAllDataWhere('services_content_pages','id',9);
		  $getPartnersBanner = $getContentPageData->fetch_assoc();
	?>
	<?php $getAllAboutDataData = getAllDataWhere('services_content_pages','id',1);
		  $getAboutDataData = $getAllAboutDataData->fetch_assoc();
	?>
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
	<link href="css/dash_board.css" rel="stylesheet">
	<link rel="stylesheet" href="css/marquee.css">
<style>
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom:0px;
	color:#fe6003;
	font-size:13px;
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
    padding: 5px 9px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {
	background-color:#fe6003;
 padding: 5px 12px;
} 
.strip_list {
    background-color: #fff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    padding: 20px;
    position: relative;
    border: 1px solid #ededed;
    min-height: 200px;
    margin-bottom: 20px;
    line-height: 1.3;
    display: block;
}
.thumb_strip {
    position: absolute;
    left: 0;
    top: 0;
    width: 110px;
    height: 110px;
    border: 1px solid #ededed;
    padding: 5px;
}

#delivery_time, #hero_video, #hero_video>div, .box_home, .high_light a, .thumb_strip {
    text-align: center;
}
#sub_content #thumb, .thumb_strip {
    box-sizing: border-box;
    overflow: hidden;
}
.desc h3 {
    margin: 0;
    padding: 0;
}
.desc .type {
    font-size: 12px;
    color: #777;
    margin-bottom: 12px;
    margin-top: 5px;
    text-align: justify;
}

</style>

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
		 <div class="container-fluid page-title">
			<?php  
				  if(!empty($getPartnersBanner['image'])) { ?> 	
					<div class="row">
						<img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getPartnersBanner['image'] ?>" alt="<?php echo $getPartnersBanner['title'];?>" class="img-responsive" style="width:100%; height:400px;">
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
					<li>Grocery Wishlist</li>
				</ul>
			</div>
		</div>
		<div class="container margin_60">
<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
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
								 <div class="row">
								  <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="thumb_strip">
                                            <a href=""><img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="<?php echo $getProductName['product_name']; ?>" style="width:100px;height:100px"></a>
                                        </div>
                                       </div>
									    <div class="col-md-9 col-sm-9 col-xs-6">
                                        <h3 style="color:#fe6003"><?php echo $getProductName['product_name']; ?></h3>
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
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="go_to">
								
								<div class="row">
								<div class="col-sm-8 col-xs-12">
                                        <div>
                                        	<a href=""><i class=" icon-trash" style="font-size:25px;color:#fe6003" onclick="removeIngItem(<?php echo $productDetails['product_id']; ?>);"></i></a>
										<!-- <a href=""><button class="button1">Add to Cart</button></a>
                                          <a href=""><button class="button1" onclick="removeIngItem(<?php echo $productDetails['product_id']; ?>);">Remove</button></a> -->
                                      </div> 
								</div>
								<div class="col-sm-4 col-xs-12">
                                       <div>
                                             
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
	<script src="js/theia-sticky-sidebar.js"></script>

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