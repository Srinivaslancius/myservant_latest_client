<?php
include "admin_includes/config.php";
$deleteCart = "DELETE FROM grocery_cart ";
if($conn->query($deleteCart) === TRUE) {
    echo "<script type='text/javascript'>window.location='shop_cart.php'</script>";
}
?>