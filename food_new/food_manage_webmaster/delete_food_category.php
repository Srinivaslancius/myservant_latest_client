<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['cid'];
//echo $music_number;
$target_dir = '../../uploads/food_category_images/';
$getImgUnlink = getImageUnlink('category_image','food_category','id',$id,$target_dir);
$qry = "DELETE FROM food_category WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Category Item Deleted Successfully');window.location.href='food_category.php';</script>";
} else {
   echo "<script>alert('Category Item Not Deleted');window.location.href='food_category.php';</script>";
}
?>