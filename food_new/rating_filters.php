<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
include "../admin_includes/food_common_functions.php";

if(isset($_POST['ratings']) && $_POST['ratings']!='' ) {
   
 //echo "<pre>"; print_r($_POST); die;    

 $getFoodVendors = "SELECT * FROM food_vendors LEFT JOIN food_order_rating ON food_vendors.id=food_order_rating.restaurant_id WHERE food_order_rating.rating_number IN (".implode(',', $_POST['ratings']).") AND food_vendors.lkp_status_id=0 GROUP BY food_vendors.id ";
    $getSearchResults=$conn->query($getFoodVendors); 
} else {
    $getSearchResults = getAllRestaruntsWithProducts('0','','');
}
?>
    <input type="hidden" id="get_res_cnt" value="<?php echo  $getReCount = $getSearchResults->num_rows;?>">
    <?php if($getSearchResults->num_rows > 0) { ?>
    <?php while($getResults = $getSearchResults->fetch_assoc()) { ?>
    <?php //$getResults = getIndividualDetails('food_vendors','id',$getResults1['vendor_id']);?>
    <div class="col-md-6 filter_data ajax_result">
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
                                        <?php 
                                            $getDataAll1 = "SELECT SUM(rating_number) as totalRating, COUNT(rating_number) as totalCount FROM food_order_rating WHERE restaurant_id = '".$getResults['restaurant_id']."' "; 
                                            $getData1 = $conn->query($getDataAll1);
                                            $getFetchRate = $getData1->fetch_assoc();
                                            $rating_count = $getFetchRate['totalRating']/$getFetchRate['totalCount'];
                                        ?>                                    
                                        <div class="rating">
                                            <?php for($i=1; $i<$rating_count; $i++) { ?>
                                                <i class="icon_star voted"></i> 
                                            <?php } ?>
                                            (<small><a href="#0">98 reviews</a></small>)  
                                        </div><br>
										<a href="view_rest_menu.php?key=<?php echo encryptPassword($getResults['id']);?>" class="btn_1 visible-xs" style="padding:10px">View Menu</a>
                                </div>
                        </div>
                      
                </div><!-- End row-->
        </div><!-- End strip_list-->
    </div>
    <?php } } else { ?>
    <div>No Data Found</div>
    <?php } ?>