<?php
include "admin_includes/config.php";
if (isset($_POST['cartId'])){
    $states = array();
    $cartId = $_POST['cartId'];
    $sql3 = "DELETE FROM grocery_cart WHERE id ='$cartId' ";
    if($conn->query($sql3) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}
?>