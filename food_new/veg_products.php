<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
include "../admin_includes/food_common_functions.php";
//echo "<pre>"; print_r($_POST); exit;
$getRestKey1 =$_POST['key'];
if(isset($_POST['item_type']) && $_POST['item_type']=='undefined' ) {
    $getFoodItems1 = getFoodCategoryByRestId('food_products','restaurant_id',$getRestKey1);
} else {
    $getFoodItems="SELECT * FROM food_products WHERE restaurant_id = '$getRestKey1' AND lkp_status_id = '0' AND item_type = '".$_POST['item_type']."' GROUP BY category_id";
    $getFoodItems1 = $conn->query($getFoodItems);
}
?>
<?php if($getFoodItems1->num_rows > 0) { ?>
    <?php while($getCategoriesList = $getFoodItems1->fetch_assoc()) { ?>
    <hr>
    <h5 class="nomargin_top" id="<?php echo $getCategoriesList['category_id']; ?>"><b><?php $getCatName1 = getIndividualDetails('food_category','id',$getCategoriesList['category_id']); echo $getCatName1['category_name']; ?></b></h5>
    <p>
    <?php echo substr($getCatName1['category_description'], 0,300); ?>
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
    if(isset($_POST['item_type']) && $_POST['item_type']=='undefined' ) {
        $getItemsByCat2="SELECT * FROM food_products WHERE restaurant_id = '$getRestKey1' AND lkp_status_id = '0'  AND category_id = '".$getCatName1['id']."'";        
    } else {
        $getItemsByCat2="SELECT * FROM food_products WHERE restaurant_id = '$getRestKey1' AND lkp_status_id = '0' AND item_type = '".$_POST['item_type']."' AND category_id = '".$getCatName1['id']."'";
    }
        
        $getItemsByCat1 = $conn->query($getItemsByCat2);
        //$getItemsByCat1 = getFoodItemsByCategory('food_products','restaurant_id',$getRestKey1,'category_id',$getCatName1['id']); 
        $i=1; while($getItemsByCategory1 = $getItemsByCat1->fetch_assoc()) {
        $productId = $getItemsByCategory1['id'];
    ?>
    <input type="hidden" id="product_id" value="<?php echo $productId; ?>" class="product_id">  
    <input type="hidden" id="rest_id" value="<?php echo $getRestKey1; ?>" class="rest_id">               
        <td>
            <figure class="thumb_menu_list"><img src="<?php echo $base_url . 'uploads/food_product_images/'.$getItemsByCategory1['product_image']; ?>" alt="<?php echo $getItemsByCategory1['product_name']; ?>" ></figure>
            <h5><?php echo $i; ?>. <?php echo $getItemsByCategory1['product_name']; ?></h5>
            <p style="font-size:13px">
                <?php echo $getItemsByCategory1['specifications']; ?>
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
            <input type="hidden" id="item_category_id_<?php echo $productId; ?>" name="item_category_id" value="<?php echo $getItemsByCategory1['category_id']; ?>">
            <?php $getWeightTypes1 = getAllDataWhere('food_product_weight_prices','product_id',$productId); ?>
            <select name="item_weight_type" id="item_weight_type_<?php echo $productId; ?>" class="get_product_id" data-key-product-id="<?php echo $productId?>" >
              <?php while($getWeightType1 = $getWeightTypes1->fetch_assoc()) {  ?>
              <?php $getWeight1 =  getIndividualDetails('food_product_weights','id',$getWeightType1['weight_type_id']); ?>
                  <option value="<?php echo $getWeightType1['weight_type_id']; ?>"><?php echo $getWeight1['weight_type']; ?></option>
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