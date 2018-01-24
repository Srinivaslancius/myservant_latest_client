<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['wid'];
$qry = "DELETE FROM food_product_weights WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Product Weight Deleted Successfully');window.location.href='food_product_weights.php';</script>";
} else {
   echo "<script>alert('Product Weight Not Deleted');window.location.href='food_product_weights.php';</script>";
}
?>