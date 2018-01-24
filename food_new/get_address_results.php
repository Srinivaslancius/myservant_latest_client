<?php
include "../admin_includes/config.php";
if (isset($_POST['keyword'])){
    $states = array();
    $term = $_POST['keyword'];
    $sql3 = "SELECT * FROM food_vendors WHERE `lkp_status_id`= '0' AND  (restaurant_address LIKE '%$term%' OR  pincode LIKE '%$term%') AND id IN (SELECT restaurant_id FROM food_products WHERE lkp_status_id = 0) ORDER BY id DESC";
    $result = $conn->query($sql3);  
    ?>
    <ul id="country-list">
    <?php
    foreach($result as $country) {
    ?>
        <li onClick="selectCountry('<?php echo $country["restaurant_address"]; ?>');"><?php echo $country["restaurant_address"]; ?></li>
    <?php } ?>
</ul>   
<?php
}
?>