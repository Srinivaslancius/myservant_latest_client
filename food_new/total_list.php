<?php
include "../admin_includes/config.php";
include "../admin_includes/food_common_functions.php";
include "../admin_includes/common_functions.php";
$getRestaurants = getAllRestaruntsWithProducts('0','','');
while($getRestaurantsData = $getRestaurants->fetch_assoc()) {
 $img = $base_url . 'uploads/food_vendor_logo/'.$getRestaurantsData['logo']; 
 $output = '';
 $output .=  ' <input type="hidden" id="get_res_cnt" value='.$getRestaurants->num_rows .'><div class="col-md-6 filter_data">
                <div class="strip_list wow fadeIn" data-wow-delay="0.1s">
                        <div class="row">
                                <div class="col-md-12 col-sm-12">
                                        <div class="desc">
                                                <div class="thumb_strip">
                                                    <a href="view_rest_menu.php?key='.encryptPassword($getRestaurantsData['id']).'"><img src="'.$img.'" alt=""></a>
                                                </div>
                                                <div class="row">
												<div class="col-md-7 col-sm-7">
                                                <h4>'.$getRestaurantsData['restaurant_name'].'</h4>
												</div>
												<div class="col-md-5 col-sm-5">
												 <div  class="go_to"style="height:10px">                                             
                                                    <a href="view_rest_menu.php?key='.encryptPassword($getRestaurantsData['id']).'" class="btn_1 hidden-xs"style="padding:10px">View Menu</a>                                             
												</div>
												</div>
                                                </div>
                                                <div class="type"style="text-align:justify">
                                                    '.substr($getRestaurantsData['description'], 0,150).'
                                                </div>
                                                
                                                
                                                <div class="rating">
                                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#0">98 reviews</a></small>)
                                                </div><br>
												 <a href="view_rest_menu.php?key='.encryptPassword($getRestaurantsData['id']).'" class="btn_1 visible-xs"style="padding:10px">View Menu</a> 
                                        </div>
                                </div>
                                
                        </div><!-- End row-->
                </div><!-- End strip_list-->
            </div>';

print $output;
}
?>
