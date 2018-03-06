<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
    $lkp_city_id = $getCities1['id'];
}
$array_values = array_values($_POST['price']);
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
$categories="";
$brand="";
if(isset($_POST['category_id'])) {
	$category_id = $_POST['category_id'];
} 
if(isset($_POST['sub_category_id'])) {
	$sub_category_id = $_POST['sub_category_id'];
}
if($_POST['price']) {
    $price = 'AND (selling_price BETWEEN '.$sendMinPrice.' AND '.$sendMaxPrice.')';
} else {
    $price = '';
}
$offer_id = $_POST['offer_id'];
$banner_id = $_POST['banner_id'];
$categories = isset($_REQUEST['categories'])?$_REQUEST['categories']:"";
$brand = isset($_REQUEST['brand'])?$_REQUEST['brand']:"";
if ($banner_id) {
	$id = $banner_id;
	$offerProducts = getIndividualDetails('grocery_banners','id',$id);
    $min_percentage = $offerProducts['min_percentage'];
    $max_percentage = $offerProducts['max_percentage'];
    $type = $offerProducts['type'];
    $offer_type = $offerProducts['banner_image_type'];
    $category_id = $offerProducts['category_id'];
	$sub_category_id = $offerProducts['sub_category_id'];
} elseif ($offer_id) {
	$id = $offer_id;
	$offerProducts = getIndividualDetails('grocery_offer_module','id',$id);
    $min_percentage = $offerProducts['min_offer_percentage'];
    $max_percentage = $offerProducts['max_offer_percentage'];
    $type = $offerProducts['offer_level'];
    $offer_type = $offerProducts['offer_type'];
    $category_id = $offerProducts['category_id'];
	$sub_category_id = $offerProducts['sub_category_id'];
}

if($id) {
	if($offer_type == 1) {
		$offer_percentage = ' AND (offer_percentage BETWEEN '.$min_percentage.' AND '.$max_percentage.')';
	} else {
		$offer_percentage = '';
	}
}
if(!empty($categories) && empty($brand)) {
	$query = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id $offer_percentage $price) "; 
} elseif(!empty($brand)){
    if($category_id) {
    	$query = "SELECT grocery_product_bind_brands.*,grocery_products.*FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage $price) AND grocery_products.grocery_category_id = '$category_id' ";
    } elseif($sub_category_id) {
    	$query = "SELECT grocery_product_bind_brands.*,grocery_products.*FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage $price) AND grocery_products.grocery_sub_category_id = '$sub_category_id' ";
    } else{
        $query = "SELECT grocery_product_bind_brands.*,grocery_products.*FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id WHERE grocery_products.lkp_status_id = '0' AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage $price)";
    }
} else {
    if($category_id) {
        $query = "SELECT * FROM grocery_products WHERE grocery_category_id = '$category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id $offer_percentage $price)  ORDER BY id DESC";
    } elseif($sub_category_id) {
        $query = "SELECT * FROM grocery_products WHERE grocery_sub_category_id = '$sub_category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id $offer_percentage $price)  ORDER BY id DESC";
    } else {
        $query = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id $offer_percentage $price)  ORDER BY id DESC";
    }
}
//$query = "SELECT * FROM grocery_products WHERE ";
//filter query start 
  if(!empty($categories)){
	  $colordata =implode("','",$categories);
	  $query  .= " and grocery_sub_category_id in('$colordata')"; 
  }
  
   if(!empty($brand)){
	  $branddata =implode("','",$brand);
	  $query  .= " and grocery_product_bind_brands.brand_id in('$branddata') GROUP BY grocery_product_bind_brands.product_id"; 
  }
//echo $query; die;
$rs=$conn->query($query);
if($rs->num_rows > 0) {
while($getProductDetails = $rs->fetch_assoc()){
	$getPrices = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
	$getProductPrices = $conn->query($getPrices);
    $getPrices2 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
    $getProductPrices2 = $conn->query($getPrices2);
	$getPrices1 = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id ='".$getProductDetails['id']."' AND lkp_status_id = 0 AND lkp_city_id ='$lkp_city_id' ORDER BY selling_price  ";
	$getProductPrices1 = $conn->query($getPrices1);
	$getPricesDetails1 = $getProductPrices1->fetch_assoc();
	$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductDetails['id']);
	$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductDetails['id']);
	?>
    <input type="hidden" id="cat_id1_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_category_id']; ?>">
    <input type="hidden" id="sub_cat_id1_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_sub_category_id']; ?>">
    <input type="hidden" id="pro_name1_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductNames['product_name']; ?>">
    <div class="product-box style3">
        <div id="cart_popup1_<?php echo $getProductDetails['id']; ?>" class="snackbar">
            <p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
            <p>PRODUCT NAME: <?php echo $getProductNames['product_name']; ?> </p> 
        </div>
        <div class="imagebox style1 v3">
            <div class="box-image">
                <a href="single_product.php?product_id=<?php echo $getProductDetails['id']; ?>" title="">
                    <img class="img_wiht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image']; ?>" alt="">
                </a>
            </div>
            <div class="box-content">
                <div class="product-name">
                    <a href="single_product.php?product_id=<?php echo $getProductDetails['id']; ?>" title=""><?php echo $getProductNames['product_name']; ?></a>
                </div>
                <!-- <div class="status">
                    Availablity: In stock
                </div>
                <div class="info">
                    <p>
                        '.$getProductNames1['product_description'].'
                    </p>
                </div> -->
            </div>
            <div class="box-price">
                <div class="product_name">
                    <select onchange="get_price(this.value);" class="s-w form-control" id="get_pr_price1_<?php echo $getProductDetails['id']; ?>">;';
                        <?php while($getPricesDetails2 = $getProductPrices2->fetch_assoc()) { ?>
                            <option value="<?php echo $getPricesDetails2['id']; ?>,<?php echo $getPricesDetails2['selling_price']; ?>"><?php echo $getPricesDetails2['weight_type']; ?> - Rs.<?php echo $getPricesDetails2['selling_price']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="price_<?php echo $getProductDetails['id']; ?>">
                        <span class="sale">Rs: <?php echo $getPricesDetails1['selling_price']; ?></span>
                        <?php if($getPricesDetails1['offer_type'] == 1) {  ?>
                            <span class="regular">Rs: <?php echo $getPricesDetails1['mrp_price']; ?></span>
                        <?php } ?>
                    </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="quanlity" style="margin-top:5px">
                            <input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity1_<?php echo $getProductDetails['id']; ?>" type="number" style="height:45px">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="btn-add-cart mrgn_lft" style="margin-top:-20px;margin-left:-20px">
                            <a href="javascript:void(0)" title="" onClick="show_cart1(<?php echo $getProductDetails['id']; ?>)">
                                <img src="images/icons/add-cart.png" alt="">Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
                <div class="compare-wishlist">
                    <?php if(!isset($_SESSION['user_login_session_id'])) { ?>
                        <a  class="wishlist" href="login.php"></a>
                    <?php } else { ?>
                    <a  class="wishlist" onClick="addWishList1(<?php echo $getProductDetails['id']; ?>)" href="javascript:void(0)" >
                    <?php } ?>
                        <?php if(!isset($_SESSION['user_login_session_id'])) {?>
                            <img src="images/icons/wishlist.png" alt=""> Wishlist
                        <?php } else { ?>
                            <?php if($getCountWishLsit1 == 0) { ?>
                                <img src="images/icons/wishlist.png" id="change_wishlist_img1_<?php echo $getProductDetails['id']; ?>" alt=""> Wishlist
                            <?php } else { ?>
                                <img src="images/icons/1.png" alt="" id="change_wishlist_img1_<?php echo $getProductDetails['id']; ?>"> Wishlist
                            <?php } ?>
                        <?php } ?>
                    </a>
                </div>
            </div><!-- /.box-price -->
        </div><!-- /.imagebox -->
    </div>
<?php  } } else { ?>
<div class="col-lg-2 col-md-2">
</div>
<div class="col-lg-7 col-md-6">
    <center><img src="images/thumb.png" style="padding-top:50px"></center><br>
   <h3 style="text-align:center">Sorry..!! No Items Found.</h3>
   <p style="text-align:center;margin:15px">Please click on the Continue Shopping button below for items</p>
        <center><a href="index.php"><button type="submit" class="contact" style="background-color:#FE6003">Continue Shopping</button></a></center>
</div>
<?php } ?>
