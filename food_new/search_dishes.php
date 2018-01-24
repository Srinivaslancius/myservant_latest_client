<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
include "../admin_includes/food_common_functions.php";
$getRestaurantId = $_POST['key'];
if(isset($_POST['item_name']) && $_POST['item_name']!='' ) {
    $item_name = $_POST['item_name'];
    $getItems = "SELECT * FROM food_products WHERE `lkp_status_id`= '0' AND restaurant_id = '$getRestaurantId' AND product_name LIKE '%$item_name%' GROUP BY category_id ";
    $getItemNames = $conn->query($getItems); 
} else {
     $getItemNames = getFoodCategoryByRestId('food_products','restaurant_id',$getRestaurantId);
}
?>
<?php if($getItemNames->num_rows > 0) { ?>
    <?php while($getItemsList = $getItemNames->fetch_assoc()) { ?>
    <hr>
    <h5 class="nomargin_top" id="<?php echo $getItemsList['category_id']; ?>"><b><?php $getItemData = getIndividualDetails('food_category','id',$getItemsList['category_id']); echo $getItemData['category_name']; ?></b></h5>
    <p>
    <?php echo substr($getItemData['category_description'], 0,300); ?>
    </p>
    <table class="table table-striped cart-list">
        <thead>
        <tr>
            <th>
                 Item
            </th>
            <th>
                 Price
            </th>
            <th>
                 Order
            </th>
            <th></th>
        </tr>
        </thead>
    <tbody>
    <?php 
        $getItemDetails="SELECT * FROM food_products WHERE restaurant_id = '$getRestaurantId' AND lkp_status_id = '0' AND product_name LIKE '%$item_name%' AND category_id = '".$getItemData['id']."'";
        $getItemDetails1 = $conn->query($getItemDetails);
        $i=1; while($getItemDetails2 = $getItemDetails1->fetch_assoc()) {
        $productId = $getItemDetails2['id'];
    ?>
    <input type="hidden" id="product_id" value="<?php echo $productId; ?>" class="product_id">  
    <input type="hidden" id="rest_id" value="<?php echo $getRestaurantId; ?>" class="rest_id">               
        <td>
            <figure class="thumb_menu_list"><img src="<?php echo $base_url . 'uploads/food_product_images/'.$getItemDetails2['product_image']; ?>" alt="<?php echo $getItemDetails2['product_name']; ?>" ></figure>
            <h5><?php echo $i; ?>. <?php echo $getItemDetails2['product_name']; ?></h5>
            <p style="font-size:13px">
                <?php echo $getItemDetails2['specifications']; ?>
            </p>
        </td>
        <td>
            <?php $getFirstPrice =  getIndividualDetails('food_product_weight_prices','product_id',$productId); ?>
            <strong id="get_price_<?php echo $productId; ?>">Rs. <?php echo $getFirstPrice['admin_price']; ?></strong>                            
        </td>


        <td>
            <div class="selectdiv">
            <label>
            <input type="hidden" id="item_price_<?php echo $productId; ?>" name="item_price" value="<?php echo $getFirstPrice['admin_price']; ?>">
            <input type="hidden" id="item_category_id_<?php echo $productId; ?>" name="item_category_id" value="<?php echo $getItemDetails2['category_id']; ?>">
            <?php $getWeights = getAllDataWhere('food_product_weight_prices','product_id',$productId); ?>
            <select name="item_weight_type" id="item_weight_type_<?php echo $productId; ?>" class="get_product_id" data-key-product-id="<?php echo $productId?>" >
              <?php while($getItemWeights = $getWeights->fetch_assoc()) {  ?>
              <?php $getItemWeights1 =  getIndividualDetails('food_product_weights','id',$getItemWeights['weight_type_id']); ?>
                  <option value="<?php echo $getItemWeights['weight_type_id']; ?>"><?php echo $getItemWeights1['weight_type']; ?></option>
              <?php } ?>
           </select>
            </label>
            </div>
        </td>
        <td id="view_add_cart_btn_">
            <!-- <a class="btn_full" data-key="<?php echo $productId; ?>"  style="width:74px;">Add</a> -->

            <?php 
            $weIgId = $getFirstPrice['weight_type_id'];
            $getcnt = "SELECT * FROM food_cart WHERE food_item_id = '$productId' AND item_weight_type_id = '$weIgId' AND session_cart_id = '$session_cart_id'";
            $getCountItems = $conn->query($getcnt);
            $getIndProducartCount = $getCountItems->fetch_assoc();
            if($getIndProducartCount['item_quantity']!= '') {
                $getOnloadProductCount = $getIndProducartCount['item_quantity'];
            } else {
                $getOnloadProductCount = 0;
            }
            ?>
            <a class="btn_full" onClick = "add_cart_item(<?php echo $productId; ?>);" style="padding:8px 0px">Add to cart</a>
        </td>
        
    </tr>
        <?php $i++; } ?>
    </tbody>

    </table>
    <?php } ?>
    <?php } else { ?>
    <table class="table table-striped cart-list">
        <tbody>
           <p style="text-align:center"> No Records Found</p>
        </tbody>        
    </table>
<?php } ?>