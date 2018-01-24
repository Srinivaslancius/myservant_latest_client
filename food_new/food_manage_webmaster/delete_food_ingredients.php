<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['fid'];
$qry = "DELETE FROM food_ingredients WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Food Ingredient Deleted Successfully');window.location.href='food_ingredients.php';</script>";
} else {
   echo "<script>alert('Food Ingredient Not Deleted');window.location.href='food_ingredients.php';</script>";
}
?>