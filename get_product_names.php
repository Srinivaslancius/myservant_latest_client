<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
if($_SESSION['city_name'] == '') {
    $lkp_city_id = 1;
} else {
    $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
    $lkp_city_id = $getCities1['id'];
}

if (isset($_GET['term']) && $_GET['term']!=''){

    $return_arr = array();   
    $term = $_GET['term'];
    $sql3 = "SELECT * FROM grocery_product_name_bind_languages WHERE search_tags LIKE '%$term%' AND product_id IN (SELECT id FROM grocery_products WHERE `lkp_status_id`= 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) GROUP BY product_id ORDER BY id DESC";
    $result = $conn->query($sql3);  
    if($result->num_rows > 0) {

    ?>
    
    <?php
    while ($row = $result->fetch_assoc()) { 
        $return_arr[] =  $row['product_name'];
    } ?>

<?php echo json_encode($return_arr); ?>
<?php
}
}
?>