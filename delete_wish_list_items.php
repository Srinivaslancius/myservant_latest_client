<?php
include "admin_includes/config.php";
if (isset($_POST['ingUniqId'])){   
    $ingUniqId = $_POST['ingUniqId'];
    $sql3 = "DELETE FROM grocery_save_wishlist WHERE product_id ='$ingUniqId' ";
    if($conn->query($sql3) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
    ?>
   
<?php
}
?>