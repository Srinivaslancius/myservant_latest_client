<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
include "../admin_includes/food_common_functions.php";

if(isset($_POST['cartId']) && isset($_POST['productId']) && isset($_POST['cartSessionId']) && isset($_POST['cb']) ) {

   //echo "<pre>"; print_r($_POST['cb']); die;

    $cartId = $_POST['cartId'];
    $productId = $_POST['productId'];
    $cartSessionId = $_POST['cartSessionId'];

    if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    if($_SESSION['user_login_session_id'] == "") {
        $user_id = 0;
    } else {
        $user_id = $_SESSION['user_login_session_id'];
    }

        $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    
        $delOldIng = "DELETE FROM food_update_cart_ingredients WHERE food_item_id = '$productId' AND cart_id='$cartId' AND session_cart_id = '$cartSessionId' ";
        $conn->query($delOldIng);

        //$cbCount = count($_POST['cb']);
        foreach($_POST['cb'] as $key=>$value){

        $ingId = $value['ingId'];
        $ingName = $value['ingName'];
        $ingPrice = $value['ingPrice'];

        $sql = "INSERT INTO food_update_cart_ingredients ( `cart_id`,`session_cart_id`,`food_item_id`,`item_ingredient_id`,`item_ingredient_price`,`item_ingredient_name`) VALUES ('$cartId','$session_cart_id','$productId','$ingId','$ingPrice','$ingName')";
        $result = $conn->query($sql);
        
        }
    echo "data updated";
}
?>