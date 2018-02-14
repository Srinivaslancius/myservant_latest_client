<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); 

// note the differences in the array keys for price filetr checking here 
if(isset($_POST['price'])) { 
    $array_values = array_values($_POST['price']);
} else {
    $array_values = array_values($_POST['product_price']);
}
$indFirstval = array_shift($array_values); 
$indLastval = array_pop($array_values); 
$piece1 = explode(" - ", $indFirstval);
$piece2 = explode(" - ", $indLastval);
$getMinPriceVal = $piece1[0];
$getMaxPriceVal = $piece2[1];

if($getMaxPriceVal=='') {
    $sendMinPrice = $piece1[0];
    $sendMaxPrice = $piece1[1];
} else {
    $sendMinPrice = $piece1[0];
    $sendMaxPrice = $piece2[1];
}
// echo $sendMinPrice .'-'. $sendMaxPrice;
// die;

if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
    $lkp_city_id = $getCities1['id'];
}

if(isset($_POST['price'])) {
    $where_condition = "WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' AND (selling_price BETWEEN '$sendMinPrice' AND '$sendMaxPrice'))  ORDER BY id DESC";
} elseif(isset($_POST['product_price']) && isset($_POST['category_id'])) {
    $where_condition = "WHERE grocery_category_id = '".$_POST['category_id']."' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' AND (selling_price BETWEEN '$sendMinPrice' AND '$sendMaxPrice'))  ORDER BY id DESC";
} elseif(isset($_POST['product_price']) && isset($_POST['sub_category_id'])) {
    $where_condition = "WHERE grocery_sub_category_id = '".$_POST['sub_category_id']."' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' AND (selling_price BETWEEN '$sendMinPrice' AND '$sendMaxPrice'))  ORDER BY id DESC";
} elseif($_POST['product_price'] == ''  && isset($_POST['category_id'])) {
    $where_condition = "WHERE grocery_category_id = '".$_POST['category_id']."' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')  ORDER BY id DESC";
} elseif($_POST['product_price'] == '' && isset($_POST['sub_category_id'])) {
    $where_condition = "WHERE grocery_sub_category_id = '".$_POST['sub_category_id']."' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')  ORDER BY id DESC";
} elseif(isset($_POST['product_price']) && isset($_POST['brand_id'])) {
    $where_condition = "WHERE id IN (SELECT product_id FROM grocery_product_bind_brands WHERE brand_id = '".$_POST['brand_id']."') AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' AND (selling_price BETWEEN '$sendMinPrice' AND '$sendMaxPrice'))  ORDER BY id DESC";
} elseif($_POST['product_price'] == '' && isset($_POST['brand_id'])) {
    $where_condition = "WHERE id IN (SELECT product_id FROM grocery_product_bind_brands WHERE brand_id = '".$_POST['brand_id']."') AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')  ORDER BY id DESC";
} else {
    $where_condition = "WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)  ORDER BY id DESC LIMIT 0,10";
}
$getProducts = "SELECT * FROM grocery_products $where_condition";
$getProducts1 = $conn->query($getProducts);
if($getProducts1->num_rows > 0) {
while($getProductsData = $getProducts1->fetch_assoc()) {
$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsData['id']);
$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductsData['id']);
$img = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'];
 $getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
$getProductPrices = $conn->query($getPrices);
$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
$getProductPrices1 = $conn->query($getPrices1);
$getPricesDetails1 = $getProductPrices1->fetch_assoc();
$getCountWishLsit = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$getProductsData['id']);
echo'<input type="hidden" id="cat_id_'.$getProductsData['id'].'" value="'.$getProductsData['grocery_category_id'].'">
    <input type="hidden" id="sub_cat_id_'.$getProductsData['id'].'" value="'.$getProductsData['grocery_sub_category_id'].'">
    <input type="hidden" id="pro_name_'.$getProductsData['id'].'" value="'.$getProductNames['product_name'].'">';
 echo '<div class="col-lg-4 col-md-4 col-sm-6" >
        <div class="product-box">
            <div id="div1" class="cart_popup_'.$getProductsData['id'].'">
                <p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
                <p style="color:white">Product Name : '.$getProductNames['product_name'].'</p>
            </div>
            <div class="imagebox">
                    <a href="single_product.php?product_id='.$getProductsData['id'].'" title="">
                        <img class="img_wiht"src="'.$img.'" alt="">
                    </a>
                    
                <div class="box-content">
                    <div class="product-name">
                        <a href="single_product.php?product_id='.$getProductsData['id'].'" title="">'.$getProductNames['product_name'].'</a>
                    </div>
                    <div class="product_name">
                    <select onchange="get_price(this.value);" class="s-w form-control" id="get_pr_price_'.$getProductsData['id'].'">;';
                        while($getPricesDetails = $getProductPrices->fetch_assoc()) {
                            echo'<option value="'.$getPricesDetails['id'].','.$getPricesDetails['selling_price'].'">'.$getPricesDetails['weight_type'].' - Rs.'.$getPricesDetails['selling_price'].' </option>';
                        }
                    echo'</select>
                    </div>
                    <div class="price_'.$getProductsData['id'].'">
                        <span class="sale">Rs: '.$getPricesDetails1['selling_price'].'</span>';
                        if($getPricesDetails1['offer_type'] == 1) {
                            echo'<span class="regular">Rs: '.$getPricesDetails1['selling_price'].'</span>';
                        }
                    echo'</div>
                </div>
                <div class="box-bottom">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <div class="quanlity">
                                <input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_'.$getProductsData['id'].'" type="number" style="height:45px">
                            </div>
                        </div>
                        <div class="col-sm-7 col-xs-12" style="margin-left:-20px">
                            <div class="btn-add-cart mrgn_lft">
                                <a href="javascript:void(0)" title="" onClick="show_cart('.$getProductsData['id'].');" style="width:115%">
                                    <img src="images/icons/add-cart.png" alt="">Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="compare-wishlist">';
                        if(!isset($_SESSION['user_login_session_id'])) { 
                            echo'<a  class="wishlist" href="login.php"></a>';
                        } else { 
                        echo'<a class="wishlist" onClick="addWishList('.$getProductsData['id'].')" href="javascript:void(0)" >';
                        }
                        if(!isset($_SESSION['user_login_session_id'])) { 
                            echo'<img src="images/icons/wishlist.png" alt=""> Wishlist';
                        } else {
                            if($getCountWishLsit == 0) {
                                echo'<img src="images/icons/wishlist.png" id="change_wishlist_img_'.$getProductsData['id'].'" alt=""> Wishlist';
                            } else {
                                echo'<img src="images/icons/1.png" alt="" id="change_wishlist_img_'.$getProductsData['id'].'"> Wishlist';
                            }
                        }
                        echo'</a>
                    </div>
                </div>
            </div>
            </div>
        </div>';
    }
} else {
    echo'<div class="col-lg-2 col-md-2">
	</div>
	<div class="col-lg-7 col-md-6">
        <center><img src="images/thumb.png" style="padding-top:40px"></center><br>
       <h3 style="text-align:center">Sorry..!! No Items Found.</h3>
       <p style="text-align:center;margin:15px">Please click on the Continue Shopping button below for items</p>
            <center><a href="index.php"><button type="submit" class="contact" style="background-color:#FE6003">Continue Shopping</button></a></center>
       </div>';
}
?>
