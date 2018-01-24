<?php
include "../admin_includes/config.php";
if (isset($_POST['cartId'])){
    $states = array();
    $cartId = $_POST['cartId'];
    $cart_ingredients = "DELETE FROM food_update_cart_ingredients WHERE cart_id ='$cartId' ";
    $conn->query($cart_ingredients);
    $sql3 = "DELETE FROM food_cart WHERE id ='$cartId' ";
    if($conn->query($sql3) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }

    ?>
   
<?php
}
?>