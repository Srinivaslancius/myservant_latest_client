<?php include_once 'meta.php';?>
	<style>
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
.button12 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 2px 9px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;
}
	</style>

	

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
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								Wish List
								
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
        
        <div class="col-sm-9">       	 
         
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
				<div class="row">					
                            <div class="col-md-9 col-sm-9">
                                <div class="desc">
								 <div class="row">
								  <div class="col-md-3 col-sm-3 col-xs-6">
                                        <div class="thumb_strip">
                                            <a href=""><img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="<?php echo $getProductName['product_name']; ?>" style="width:100px;height:100px"></a>
                                        </div>
                                       </div>
									    <div class="col-md-9 col-sm-9 col-xs-6">
									    <h3 style="color:#fe6003"><a href="single_product.php?product_id=<?php echo $productDetails['id']; ?>" title=""><?php echo $getProductName['product_name']; ?></a></h3>	
                                        <!-- <h3 style="color:#fe6003"><?php echo $getProductName['product_name']; ?></h3> -->
                                        <div class="type">
                                               <!-- <p style="margin-bottom:10px">1kg(approx 13 to 14 nos)</p> -->
                                               <?php 
											$prodid = $productDetails['product_id'];
									 		$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='$prodid' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ";
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
                                         <a href=""><button class="button12" onclick="removeIngItem(<?php echo $productDetails['product_id']; ?>);">Remove</button></a> 
                                      </div> 
								</div>
								<div class="col-sm-4 col-xs-12">
                                       <div>
                                             <a href="detail_page.html"><i class=" icon-trash" style="font-size:25px;color:#fe6003"></i></a>
                                        </div>
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
<?php include "search_js_script.php"; ?>
</body>	
</html>