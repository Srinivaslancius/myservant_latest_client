<?php
include "admin_includes/config.php";
if (isset($_POST['keyword']) && $_POST['keyword']!=''){
    $states = array();
    $term = $_POST['keyword'];
    $sql3 = "SELECT * FROM grocery_product_name_bind_languages WHERE product_name LIKE '%$term%' AND product_id IN (SELECT id FROM grocery_products WHERE `lkp_status_id`= 0) ORDER BY id DESC";
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