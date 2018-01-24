<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

$cart_id = $_POST['cart_id'];
$qry = "DELETE FROM services_cart WHERE id ='$cart_id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo 1;
} else {
   echo 0;
}
?>