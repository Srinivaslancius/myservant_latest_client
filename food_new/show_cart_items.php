<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if($_SESSION['CART_TEMP_RANDOM'] == "") {

    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
if($_SESSION['user_login_session_id'] == "") {

    $user_id = 0;
} else {
    $user_id = $_SESSION['user_login_session_id'];
}

$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
$restId = $_POST['rest_id'];
$_SESSION['session_restaurant_id'] = $restId;
$getAddData = "SELECT * FROM food_cart WHERE session_cart_id = '$session_cart_id' AND item_quantity!='0' AND    restaurant_id = '$restId' ";
$getSelData = $conn->query($getAddData);

if($getSelData->num_rows > 0) {

  $cartSubtotal = 0;
  $cartTotal = 0;
  

  $getDeliveryCharge = getIndividualDetails('food_vendors','id',$_SESSION['session_restaurant_id']);
  $DeliveryCharges = $getDeliveryCharge['delivery_charges'];
  if($DeliveryCharges!=0) {
    $deliveryCharges = $getDeliveryCharge['delivery_charges'];
  } else {
    $deliveryCharges = 0;
  }
  $getAddOnsPrice = "SELECT * FROM food_update_cart_ingredients WHERE session_cart_id = '$session_cart_id'";
  $getAddontotal = $conn->query($getAddOnsPrice);
  $getAdstotal = 0;
  while($getAdTotal = $getAddontotal->fetch_assoc()) {
      $getAdstotal += $getAdTotal['item_ingredient_price'];
  }

  while($cartItems = $getSelData->fetch_assoc() ) {
  $cartSubtotal += $cartItems['item_price'] * $cartItems['item_quantity'];
  $cartTotal = $cartSubtotal+$deliveryCharges+$getAdstotal;
  $getProductsName = getIndividualDetails('food_products','id',$cartItems['food_item_id']);  
  $productId = $cartItems['food_item_id'];
  $getAddons = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '".$cartItems['food_item_id']."' AND cart_id='".$cartItems['id']."' AND session_cart_id = '$session_cart_id'";
  $getAddonData = $conn->query($getAddons);
  echo '<table class="table table_summary cart_total_items"><tbody >
          <tr>
              <td>
                <a href="#0" class="remove_item"><i class="icon_plus_alt inc_cart_quan" onClick="add_cart_item1('.$cartItems['id'] .')" ></i></a> <strong>'.$cartItems['item_quantity'].' </strong> <a href="#0" class="remove_item"><i class="icon_minus_alt" onClick="remove_cart_item1('.$cartItems['id'] .')"></i></a> '.$getProductsName['product_name'].'';
                  while($getadcartItems = $getAddonData->fetch_assoc() ) {
                     echo'<div class="alert alert-dismissable"  style="margin-bottom:-20px">
                           <a class="close1" ><i class="icon-trash" style="color:#fe6003" onclick="removeIngItem('.$getadcartItems['id'].');"></i></a>
                           <p class="itm_wdth"style="font-size:12px;width:130px">'.$getadcartItems['item_ingredient_name'].':'.$getadcartItems['item_ingredient_price'].'</p>
                          </div>';
                    }
                echo'</td>
              <td>
                <strong class="pull-right">Rs. '.$cartItems['item_price']*$cartItems['item_quantity'].' </strong>
              </td>
          </tr>
      </tbody>
      </table>';
  }

  echo '<hr><input type="hidden" value='.$cartTotal.' id="total_cart_val">      
            <input type="hidden" value='.$getSelData->num_rows.' id="total_cart_count">      
            
            <table class="table table_summary">
            <tbody>
            <tr class="sub_total">
              <td>
                 Subtotal <span class="pull-right">Rs. '.$cartSubtotal.'</span>
              </td>
            </tr>';
          if($getAdstotal!=0) {
            echo'<tr>
            <td>
               Extra Addons Price <span class="pull-right">Rs. '.$getAdstotal.'</span>
            </td>
          </tr>';
          }
          echo'<tr class="dev_charge">
              <td>
                 Delivery Charges <span class="pull-right">Rs. '.$deliveryCharges.'</span>
              </td>
            </tr>
            <input type="hidden" value='.$cartTotal.' id="cart_total">
            <tr>
              <td class="total">                
                 TOTAL <span class="pull-right">Rs. '.$cartTotal.'</span>
              </td>
            </tr>
            </tbody>
            </table>';
} else {
  echo "<p style='text-align:center'>Cart Empty !</p>";
}


?>