<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
if(isset($_POST['popularity']) ) {

$popularity = $_POST['popularity'];

if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
    $lkp_city_id = $getCities1['id'];
}

if($popularity == 'recent') {
    if(isset($_POST['category_id'])) {
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id) AND grocery_category_id = '".$_POST['category_id']."'  ORDER BY id DESC ";
    } elseif (isset($_POST['sub_category_id'])) {
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id) AND grocery_sub_category_id = '".$_POST['sub_category_id']."' ORDER BY id DESC ";
    } elseif (isset($_POST['tagId'])) {
        $tagId = $_POST['tagId'];
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' GROUP BY product_id)) ORDER BY id DESC";
    } elseif (isset($_POST['brand_id'])) {
        $brand_id = $_POST['brand_id'];
        $getProducts = "SELECT grocery_product_bind_brands.brand_id,grocery_product_bind_brands.product_id, grocery_products.id,grocery_products.grocery_category_id,grocery_products.grocery_sub_category_id,grocery_products.product_description,grocery_products.lkp_status_id FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id AND grocery_product_bind_brands.brand_id = '$brand_id' WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' GROUP BY product_id) ORDER BY id DESC";
    } else {
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)  ORDER BY id DESC ";
    }

} elseif($popularity == 'low_high') {
    if(isset($_POST['category_id'])) {
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.grocery_category_id = '".$_POST['category_id']."' GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price ASC";
    } elseif (isset($_POST['sub_category_id'])) {
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.grocery_sub_category_id = '".$_POST['sub_category_id']."' GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price ASC";
    } elseif(isset($_POST['tagId'])) {
        $tagId = $_POST['tagId'];
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_tags WHERE tag_id = '$tagId') GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price ASC";
    } elseif (isset($_POST['brand_id'])) {
        $brand_id = $_POST['brand_id'];
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_brands WHERE brand_id = '$brand_id') GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price ASC";
    } else {
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price ASC";
    }

} elseif($popularity == 'high_low') {
    if(isset($_POST['category_id'])) {
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.grocery_category_id = '".$_POST['category_id']."' GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price DESC";
    } elseif (isset($_POST['sub_category_id'])) {
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.grocery_sub_category_id = '".$_POST['sub_category_id']."' GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price DESC";
    } elseif(isset($_POST['tagId'])) {
        $tagId = $_POST['tagId'];
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_tags WHERE tag_id = '$tagId') GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price DESC";
    } elseif (isset($_POST['brand_id'])) {
        $brand_id = $_POST['brand_id'];
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_brands WHERE brand_id = '$brand_id') GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price DESC";
    } else {
        $getProducts = "SELECT grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_weight_prices LEFT JOIN grocery_products ON grocery_products.id = grocery_product_bind_weight_prices.product_id WHERE grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.lkp_status_id=0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' GROUP BY grocery_product_bind_weight_prices.product_id ORDER BY grocery_product_bind_weight_prices.selling_price DESC";
    }

} else {
    if(isset($_POST['category_id'])) {
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id) AND grocery_category_id = '".$_POST['category_id']."'  ORDER BY id DESC ";
    } elseif (isset($_POST['sub_category_id'])) {
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id) AND grocery_sub_category_id = '".$_POST['sub_category_id']."' ORDER BY id DESC ";
    } elseif (isset($_POST['tagId'])) {
        $tagId = $_POST['tagId'];
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' GROUP BY product_id)) ORDER BY id DESC";
    } elseif (isset($_POST['brand_id'])) {
        $brand_id = $_POST['brand_id'];
        $getProducts = "SELECT grocery_product_bind_brands.brand_id,grocery_product_bind_brands.product_id, grocery_products.id,grocery_products.grocery_category_id,grocery_products.grocery_sub_category_id,grocery_products.product_description,grocery_products.lkp_status_id FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id AND grocery_product_bind_brands.brand_id = '$brand_id' WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' GROUP BY product_id) ORDER BY id DESC";
    } else {
        $getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id) ORDER BY id DESC ";
    }
}
$getProducts1 = $conn->query($getProducts);
if($getProducts1->num_rows > 0) {
while($getProductsData1 = $getProducts1->fetch_assoc()) {
$getProductNames1 = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsData1['id']);
$getProductImages1 = getIndividualDetails('grocery_product_bind_images','product_id',$getProductsData1['id']);
 $getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData1['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
$getProductPrices = $conn->query($getPrices);
$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData1['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
$getProductPrices1 = $conn->query($getPrices1);
$getPricesDetails1 = $getProductPrices1->fetch_assoc();
$getCountWishLsit1 = getWishListCount('grocery_save_wishlist',$_SESSION['user_login_session_id'],$getProductsData1['id']);
$img = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages1['image'];
echo'<input type="hidden" id="cat_id1_'.$getProductsData1['id'].'" value="'.$getProductsData1['grocery_category_id'].'">
    <input type="hidden" id="sub_cat_id1_'.$getProductsData1['id'].'" value="'.$getProductsData1['grocery_sub_category_id'].'">
    <input type="hidden" id="pro_name1_'.$getProductsData1['id'].'" value="'.$getProductNames1['product_name'].'">';
 echo '<div class="product-box style3">
        <div id="cart_popup1_'.$getProductsData1['id'].'" class="snackbar">
            <p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
            <p>PRODUCT NAME: '.$getProductNames1['product_name'].' </p> 
        </div>
        <div class="imagebox style1 v3">
            <div class="box-image">
                <a href="single_product.php?product_id='.$getProductsData1['id'].'" title="">
                    <img class="img_wiht" src="'.$img.'" alt="">
                </a>
            </div>
            <div class="box-content">
                <div class="product-name">
                    <a href="single_product.php?product_id='.$getProductsData1['id'].'" title="">'.$getProductNames1['product_name'].'</a>
                </div>
                <div class="status">
                    Availablity: In stock
                </div>
                <div class="info">
                    <p>
                        '.$getProductNames1['product_description'].'
                    </p>
                </div>
            </div>
            <div class="box-price">
                <div class="product_name">
                    <select onchange="get_price(this.value);" class="s-w form-control" id="get_pr_price1_'.$getProductsData1['id'].'">;';
                        while($getPricesDetails = $getProductPrices->fetch_assoc()) {
                            echo'<option value="'.$getPricesDetails['id'].','.$getPricesDetails['selling_price'].'">'.$getPricesDetails['weight_type'].' - Rs.'.$getPricesDetails['selling_price'].' </option>';
                        }
                      echo'</select>
                    </div>
                    <div class="price_'.$getProductsData1['id'].'">
                        <span class="sale">Rs: '.$getPricesDetails1['selling_price'].'</span>';
                        if($getPricesDetails1['offer_type'] == 1) { 
                            echo'<span class="regular">Rs: '.$getPricesDetails1['mrp_price'].'</span>';
                        }
                    echo'</div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="quanlity" style="margin-top:5px">
                            <input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity1_'.$getProductsData1['id'].'" type="number" style="height:45px">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="btn-add-cart mrgn_lft" style="margin-top:-20px;margin-left:-20px">
                            <a href="javascript:void(0)" title="" onClick="show_cart1('.$getProductsData1['id'].')">
                                <img src="images/icons/add-cart.png" alt="">Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
                <div class="compare-wishlist">';
                    if(!isset($_SESSION['user_login_session_id'])) { 
                        echo'<a  class="wishlist" href="login.php"></a>';
                    } else { 
                    echo'<a  class="wishlist" onClick="addWishList1('.$getProductsData1['id'].')" href="javascript:void(0)" >';
                    }
                        if(!isset($_SESSION['user_login_session_id'])) {
                            echo'<img src="images/icons/wishlist.png" alt=""> Wishlist';
                        } else { 
                            if($getCountWishLsit1 == 0) {
                                echo'<img src="images/icons/wishlist.png" id="change_wishlist_img1_'.$getProductsData1['id'].'" alt=""> Wishlist';
                            } else { 
                                echo'<img src="images/icons/1.png" alt="" id="change_wishlist_img1_'.$getProductsData1['id'].'"> Wishlist';
                            }
                        }
                    echo'</a>
                </div>
            </div><!-- /.box-price -->
        </div><!-- /.imagebox -->
    </div>';
    }
}
} else {
    echo'<div class="col-lg-2 col-md-2">
    </div>
    <div class="col-lg-7 col-md-6">
        <center><img src="images/thumb.png" style="padding-top:50px"></center><br>
       <h3 style="text-align:center">Sorry..!! No Items Found.</h3>
       <p style="text-align:center;margin:15px">Please click on the Continue Shopping button below for items</p>
            <center><a href="index.php"><button type="submit" class="contact" style="background-color:#FE6003">Continue Shopping</button></a></center>
       </div>';
}
?>
