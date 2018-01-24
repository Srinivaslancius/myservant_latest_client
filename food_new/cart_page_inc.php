<?php

include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
include "../admin_includes/food_common_functions.php";
//echo "<pre>";print_r($_POST);
if (isset($_POST['cart_id'])){

    $cartId = $_POST['cart_id'];
    
    if($_SESSION['CART_TEMP_RANDOM'] == "") {

        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    if($_SESSION['user_login_session_id'] == "") {

        $user_id = 0;
    } else {
        $user_id = $_SESSION['user_login_session_id'];
    }

    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    
    $checkCartItems = "SELECT * FROM food_cart WHERE id = '$cartId' "; 
    $getCartCount = $conn->query($checkCartItems);

    $getCartQuantity = $getCartCount->fetch_assoc();
    $itemPrevQuan = $getCartQuantity['item_quantity'];
    $getTotalCount = $getCartCount->num_rows;
    
    $itemPrevQuantity = $itemPrevQuan+1;
    
    $updateItems = "UPDATE food_cart SET item_quantity = '$itemPrevQuantity' WHERE id = '$cartId' ";
    $upCart = $conn->query($updateItems);    

    if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
        $user_session_id = $_SESSION['user_login_session_id'];
        $getAddData = "SELECT * FROM food_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND item_quantity!='0'";
        $getSelData = $conn->query($getAddData);
    } else {
      $getAddData = "SELECT * FROM food_cart WHERE  item_quantity!='0' AND session_cart_id='$session_cart_id' ";
      $getSelData = $conn->query($getAddData);
    }

    $getFoodsiteSettingsData = getIndividualDetails('food_site_settings','id',1);

    $getAddOnsPrice = "SELECT * FROM food_update_cart_ingredients WHERE session_cart_id = '$session_cart_id'";
    $getAddontotal = $conn->query($getAddOnsPrice);
    $getAdstotal = 0;
    while($getAdTotal = $getAddontotal->fetch_assoc()) {
        $getAdstotal += $getAdTotal['item_ingredient_price'];
    }

        echo '<input type="hidden" id="session_cart_id" value="'.$_SESSION['CART_TEMP_RANDOM'].'">
        <input type="hidden" id="get_cart_cnt" value="'.$getSelData->num_rows.'">
        <div class="row">                 
            <div class="col-md-12">
                <div class="box_style_2" id="main_menu">                  
                    <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>ITEM</th>                           
                            <th>PRICE</th>
                            <th>ADDON</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                            <th>REMOVE</th>
                        </tr>
                    </thead>
                    <tbody>';
        $cartTotal = 0; $service_tax = 0;
        while ($getCartItems1 = $getSelData->fetch_assoc()) {
        $getProductDetails1= getIndividualDetails('food_products','id',$getCartItems1['food_item_id']);
        $img = $base_url . 'uploads/food_product_images/'.$getProductDetails1['product_image'];

        $cartTotal += $getCartItems1['item_price']*$getCartItems1['item_quantity'];
        $service_tax = ($getFoodsiteSettingsData['service_tax']/100)*$cartTotal;
        $getDeliveryCharge = getIndividualDetails('food_vendors','id',$_SESSION['session_restaurant_id']);
        $DeliveryCharges = $getDeliveryCharge['delivery_charges'];
        if($DeliveryCharges!=0) {
          $deliveryCharges = $getDeliveryCharge['delivery_charges'];
        } else {
          $deliveryCharges = 0;
        }
        $order_total = $cartTotal+$service_tax+$deliveryCharges+$getAdstotal;
        $getAddons = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '".$getCartItems1['food_item_id']."' AND cart_id='".$getCartItems1['id']."' AND session_cart_id = '$session_cart_id'";
        $getAddonData = $conn->query($getAddons);
        $getIngredenats1 = getAllDataWhere('food_product_ingredient_prices','product_id',$getCartItems1['food_item_id']);
        $getIngredenatsIdsData = getAllDataWhere('food_update_cart_ingredients','food_item_id',$getCartItems1['food_item_id']);

        $ingredientsPrices = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '".$getCartItems1['food_item_id']."' AND cart_id='".$getCartItems1['id']."' AND session_cart_id = '$session_cart_id'";
        $ingredientsPrices1 = $conn->query($ingredientsPrices);
        $ingredientsPrices3 = 0;
        while($ingredientsPrices2 = $ingredientsPrices1->fetch_assoc()) {
            $ingredientsPrices3 += $ingredientsPrices2['item_ingredient_price'];
        }
        $itemPrice = $getCartItems1['item_price']*$getCartItems1['item_quantity']+$ingredientsPrices3;

        echo '<tr>
                    <td class="rw_wdth" style="width:320px">
                        <div class="row">
                        <div class="col-sm-2">
                            <figure class="thumb_menu_list"><img src="'.$img.'" alt='.$getProductDetails1['product_name'].'></figure>
                        </div>
                        <div class="col-sm-10" style="padding-right:0px">                   
                           <h5 style="margin-left:15px">'.$getProductDetails1['product_name'].'</h5>';
                           while($getadcartItems = $getAddonData->fetch_assoc() ) {
                            echo'<div class="alert alert-dismissable" style="margin-bottom:-20px">
                                 <a class="close1" ><i class="icon-trash" style="color:#fe6003" onclick="removeIngItem('.$getadcartItems['id'].');"></i></a>
                                <p id="dis_add_on_'.$getCartItems1['id'].'" style="font-size:12px">'.$getadcartItems['item_ingredient_name'].':'.$getadcartItems['item_ingredient_price'].'</p>
                                </div>';
                            }
                        echo'</div> 

                    </td>

                    <td>Rs. '.$getCartItems1['item_price'].'</td>
                    <td><a href="#" data-toggle="modal" data-target="#'.$getCartItems1['id'].'"> <i class="icon_plus_alt2" style="font-size:22px;margin-left:10px;color:#fe6003;"></i></a>
                    <input type="hidden" id="item_id_'.$getCartItems1['id'].'" name="item_id" value="'.$getCartItems1['food_item_id'].'">
                        <div class="modal fade" id="'.$getCartItems1['id'].'" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <div class="row">
                                                  <div class="col-sm-6">
                                                  <h4 class="modal-title" style="font-size:15px"><small>Add Ons:</small><br>'.$getProductDetails1['product_name'].'</h4>
                                                  </div>
                                                   <div class="col-sm-6">
                                                    <div class="btn-group">
                                                    <button class="update_cart_item" onclick="updateCartItem('.$getCartItems1['id'].');">Update Cart</button>
                                                    </div>
                                                   </div>
                                              </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-10  col-xs-12">';
                                                while ($getIngProdItems = $getIngredenats1->fetch_assoc()) {
                                                    $getInDet= getIndividualDetails('food_ingredients','id',$getIngProdItems['ingredient_name_id']);
                                                    $ingredientId = "SELECT * FROM food_update_cart_ingredients WHERE session_cart_id = '$session_cart_id' AND cart_id = ".$getCartItems1['id']." AND item_ingredient_id = ".$getIngProdItems['ingredient_name_id']." ";  
                                                    $ingredientId1 = $conn->query($ingredientId);
                                                    $ingredientId2 = $ingredientId1->fetch_assoc();
                                                    $ingId = $ingredientId2['item_ingredient_id'];
                                                    echo'<label class="radio" style="margin-bottom:20px">
                                                        <h4 style="font-size:15px">'.$getInDet['ingredient_name'].'<span style="padding-left:50px">Rs:'.$getIngProdItems['admin_price'].'</span></h4>
                                                        <input type="checkbox"'; if($ingId == $getInDet['id']) { echo 'checked="checked"'; } echo ' class="check_valid_add_on" value="'.$getIngProdItems['admin_price'].'" id="check_valid_add_on_'.$getCartItems1['id'].'" data-key="'.$getCartItems1['id'].'" data-ing-name="'.$getInDet['ingredient_name'].'" data-ing-id="'.$getInDet['id'].'" data-ing-price="'.$getIngProdItems['admin_price'].'" name="checkbox_'.$getCartItems1['id'].'">
                                                        <span class="checkmark"></span>
                                                    </label>';
                                                }
                                                echo'</div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer"></div>
                                    </div>
                                </div>
                            </div>
                    </td>
                    <td><a href="#0" class="remove_item"><i class="icon_plus_alt inc_cart_quan" onclick="add_cart_item1('.$getCartItems1['id'].')"></i></a> <strong id="ind_quan_'.$getCartItems1['id'].'">'.$getCartItems1['item_quantity'].'</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt" onclick="remove_cart_item1('.$getCartItems1['id'].')"></i></a></td>
                    <td>Rs.'.$itemPrice.'/-</td>
                    <td><i class="icon-trash" style="font-size:22px;color:#fe6003;margin-left:10px" onclick="deleteCartItem('.$getCartItems1['id'].');" ></i>
                    </td>
                    </tr>';
                }
                     
        echo '</tbody>
                    </table>                    
                </div>
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <div class="theiaStickySidebar">
                    <div id="cart_box" >
                        <table class="table table_summary">
                        <tbody>
                        <tr>
                            <td>Subtotal <span class="pull-right">Rs. '.$cartTotal.'</span></td>
                        </tr>
                        <tr>
                            <td>GST <span class="pull-right">Rs. '.$service_tax.'('.$getFoodsiteSettingsData['service_tax'].'%)</span></td>
                        </tr>
                        <tr>
                            <td>Delivery fee <span class="pull-right">Rs. '.$deliveryCharges.'</span></td>
                        </tr>';
                        if($getAdstotal!=0) {
                        echo'<tr>
                            <td>Extra Add Ons Price<span class="pull-right">Rs. '.$getAdstotal.'</span></td>
                        </tr>';
                        }
                        echo'<tr>
                            <td style="color:#fe6003">TOTAL <span class="pull-right">Rs. '.$order_total.'</span></td>
                        </tr>';                    
        echo '</tbody>
                        </table>
                        <hr>';
                        if(!isset($_SESSION['user_login_session_id'])) {
                          echo'<a class="btn_full" href="login.php?cart_id='.encryptPassword(1).'">Order now</a>';
                        } else {
                          echo'<a class="btn_full" href="checkout.php">Order now</a>';
                        }
                        echo'<a class="btn_full_outline" href="index.php"><i class="icon-right"></i> Continue</a>
                    </div>
                </div>
            </div>
            
        </div>';
}