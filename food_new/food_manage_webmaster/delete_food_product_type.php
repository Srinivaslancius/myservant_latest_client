<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['proTypeid'];
$qry = "DELETE FROM food_product_type WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Food Product Type Deleted Successfully');window.location.href='food_product_type.php';</script>";
} else {
   echo "<script>alert('Food Product Type Not Deleted');window.location.href='food_product_type.php';</script>";
}
?>