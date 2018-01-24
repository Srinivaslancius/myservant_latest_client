<?php 
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
$product_id = $_GET['product_id'];
$pid = $_GET['pid'];
//echo $music_number;
$target_dir = 'grocery_admin/uploads/product_images/';
$getImgUnlink = getImageUnlink('image','grocery_product_bind_images','id',$product_id,$target_dir);
$qry = "DELETE FROM grocery_product_bind_images WHERE id ='$product_id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Product Image Deleted Successfully');window.location.href='product_images.php?pid=".$pid."';</script>";
} else {
   echo "<script>alert('Product Image Not Deleted');window.location.href='product_images.php?pid=".$pid."';</script>";
}
?>