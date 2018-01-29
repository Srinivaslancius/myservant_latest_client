<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

if(isset($_POST['subCatId']) ) {

$subCatId = $_POST['subCatId'];

if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
    $lkp_city_id = $getCities1['id'];
}
$getProducts = "SELECT * FROM grocery_products WHERE grocery_sub_category_id='$subCatId' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)  ORDER BY id DESC ";
    $getProducts1 = $conn->query($getProducts);
while($getProductsData = $getProducts1->fetch_assoc()) {
$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductsData['id']);
$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductsData['id']);
$img = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'];
 $getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
$getProductPrices = $conn->query($getPrices);
$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductsData['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
$getProductPrices1 = $conn->query($getPrices1);
$getPricesDetails1 = $getProductPrices1->fetch_assoc();
echo'<input type="hidden" id="cat_id_'.$getProductsData['id'].'" value="'.$getProductsData['grocery_category_id'].'">
    <input type="hidden" id="sub_cat_id_'.$getProductsData['id'].'" value="'.$getProductsData['grocery_sub_category_id'].'">
    <input type="hidden" id="pro_name_'.$getProductsData['id'].'" value="'.$getProductNames['product_name'].'">';
 echo '<div class="col-lg-4 col-md-4 col-sm-6" >
        <div class="product-box">
            <div class="imagebox">
                    <a href="single_product.php?product_id='.$getProductsData['id'].'" title="">
                        <img src="'.$img.'" alt="" style="width:264px; height:210px">
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
                    <div class="compare-wishlist">
                        <a href="#" class="wishlist" title="">
                            <img src="images/icons/wishlist.png" alt="">Wishlist
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>';
    }
}
?>
