<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
    $lkp_city_id = $getCities1['id'];
}
if (isset($_POST['keyword']) && $_POST['keyword']!=''){
    $states = array();
    $term = $_POST['keyword'];
    $sql3 = "SELECT * FROM grocery_product_name_bind_languages WHERE search_tags LIKE '%$term%' AND product_id IN (SELECT id FROM grocery_products WHERE `lkp_status_id`= 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC";
    $result = $conn->query($sql3);  
    if($result->num_rows > 0) {

    ?>
    <ul id="country-list">
    <?php
    foreach($result as $country) {
    ?>
        <li onClick="selectProduct('<?php echo $country["product_name"]; ?>');"><?php echo $country["product_name"]; ?></li>
    <?php } ?>
</ul>   
<?php } else { ?>
    <ul id="country-list">
        <li>No Record Found</li>
    </ul>
<?php } ?>
<?php
}
?>