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
if(isset($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];
}
if(isset($_POST['tagId'])) {
    $tagId = $_POST['tagId'];
}
if(isset($_POST['price'])) {
    $price = 'AND (selling_price BETWEEN '.$sendMinPrice.' AND '.$sendMaxPrice.')';
} else {
    $price = '';
}
if($_POST['sorting'] == 'recent') {
    $sort = ' ORDER BY grocery_products.id DESC';
} elseif($_POST['sorting'] == 'low_high') {
    $sort = ' ORDER BY grocery_product_bind_weight_prices.selling_price ASC';
} elseif($_POST['sorting'] == 'high_low') {
    $sort = ' ORDER BY grocery_product_bind_weight_prices.selling_price DESC';
} elseif($_POST['sorting'] == 'a_z') {
    $sort = ' ORDER BY grocery_product_name_bind_languages.product_name';
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
	$query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_products LEFT JOIN grocery_product_bind_weight_prices ON grocery_product_bind_weight_prices.product_id = grocery_products.id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price "; 
} elseif(!empty($brand)){
    if($category_id) {
    	$query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_brands.*,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = '0' AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price AND grocery_products.grocery_category_id = '$category_id' ";
    } elseif($sub_category_id) {
    	$query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_brands.*,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = '0' AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price AND grocery_products.grocery_sub_category_id = '$sub_category_id' ";
    } else{
        $query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_brands.*,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_product_bind_brands LEFT JOIN grocery_products ON grocery_products.id=grocery_product_bind_brands.product_id LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = '0' AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price";
    }
} else {
    if($category_id) {
        $query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_products LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.grocery_category_id = '$category_id' AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price ";
    } elseif($sub_category_id) {
        $query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_products LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.grocery_sub_category_id = '$sub_category_id' AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price ";
    } elseif($brand_id) {
        $query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_products LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_brands WHERE brand_id = '$brand_id') AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price ";
    } elseif($tagId) {
        $query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_products LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_products.id IN (SELECT product_id FROM grocery_product_bind_tags WHERE tag_id = '$tagId') AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price ";
    } else {
        $query = "SELECT grocery_product_name_bind_languages.product_id,grocery_product_bind_weight_prices.*,grocery_products.* FROM grocery_products LEFT JOIN grocery_product_bind_weight_prices ON grocery_products.id=grocery_product_bind_weight_prices.product_id LEFT JOIN grocery_product_name_bind_languages ON grocery_product_name_bind_languages.product_id = grocery_products.id WHERE grocery_products.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_status_id = 0 AND grocery_product_bind_weight_prices.lkp_city_id = '$lkp_city_id' $offer_percentage $price ";
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
	  $query  .= " and grocery_product_bind_brands.brand_id in('$branddata')"; 
  }
  $query .= " GROUP BY grocery_products.id";
  $query .= $sort;
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
<input type="hidden" id="cat_id_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_category_id']; ?>">
<input type="hidden" id="sub_cat_id_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductDetails['grocery_sub_category_id']; ?>">
<input type="hidden" id="pro_name_<?php echo $getProductDetails['id']; ?>" value="<?php echo $getProductNames['product_name']; ?>">
<div class="col-lg-4 col-md-4 col-sm-6" >
    <div class="product-box">
        <div id="cart_popup_<?php echo $getProductDetails['id']; ?>" class="snackbar">
            <p style="color:white"><img src="images/icons/add-cart.png" alt="" style="margin-right:10px"> ITEM ADDED TO YOUR CART</p>
            <p>PRODUCT NAME: <?php echo $getProductNames['product_name']; ?> </p> 
        </div> 
        <div class="imagebox">
                <a href="single_product.php?product_id=<?php echo $getProductDetails['id']; ?>" title="">
                    <img class=".img_wiht" src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image']; ?>" alt="">
                </a>
                
            <div class="box-content">
                <div class="product-name">
                    <a href="single_product.php?product_id=<?php echo $getProductDetails['id']; ?>" title=""><?php echo $getProductNames['product_name']; ?></a>
                </div>
                <div class="product_name">
                <select onchange="get_price(this.value);" class="s-w form-control" id="get_pr_price_<?php echo $getProductDetails['id']; ?>">
                    <?php while($getPricesDetails = $getProductPrices->fetch_assoc()) { ?>
                        <option value="<?php echo $getPricesDetails['id']; ?>,<?php echo $getPricesDetails['selling_price']; ?>,<?php echo $getProductDetails['id']; ?>"><?php echo $getPricesDetails['weight_type']; ?> - Rs.<?php echo $getPricesDetails['selling_price']; ?> </option>
                    <?php } ?>
                </select>
                </div>
                <div class="price_<?php echo $getProductDetails['id']; ?>">
                    <span class="sale">Rs: <?php echo $getPricesDetails1['selling_price']; ?></span>
                    <?php if($getPricesDetails1['offer_type'] == 1) { ?>
                        <span class="regular">Rs: <?php echo $getPricesDetails1['mrp_price']; ?></span>
                    <?php } ?>
                </div>
            </div>
            <div class="box-bottom">
                <div class="row">
                    <div class="col-sm-5 col-xs-12">
                        <div class="quanlity">
                            <input name="product_quantity" value="1" min="1" max="20" placeholder="Quantity" id="product_quantity_<?php echo $getProductDetails['id']; ?>" type="number" style="height:45px">
                        </div>
                    </div>
                    <div class="col-sm-7 col-xs-12" style="margin-left:-20px">
                        <div class="btn-add-cart mrgn_lft">
                            <a href="javascript:void(0)" title="" onClick="show_cart(<?php echo $getProductDetails['id']; ?>);" style="width:115%">
                                <img src="images/icons/add-cart.png" alt="">Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
                <div class="compare-wishlist">
                    <?php if(!isset($_SESSION['user_login_session_id'])) { ?>
                        <a  class="wishlist" href="login.php"></a>
                    <?php } else { ?>
                    <a class="wishlist" onClick="addWishList(<?php echo $getProductDetails['id']; ?>)" href="javascript:void(0)" >
                    <?php } 
                    if(!isset($_SESSION['user_login_session_id'])) { ?>
                        <img src="images/icons/wishlist.png" alt=""> Wishlist
                    <?php } else { 
                        if($getCountWishLsit == 0) { ?>
                            <img src="images/icons/wishlist.png" id="change_wishlist_img_<?php echo $getProductDetails['id']; ?>" alt=""> Wishlist
                        <?php } else { ?>
                            <img src="images/icons/1.png" alt="" id="change_wishlist_img_<?php echo $getProductDetails['id']; ?>"> Wishlist
                        <?php } } ?>
                    </a>
                </div>
            </div>
        </div>
        </div>
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
