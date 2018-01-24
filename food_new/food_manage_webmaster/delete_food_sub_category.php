<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['sid'];
//echo $music_number;
$target_dir = '../../uploads/food_sub_category_images/';
$getImgUnlink = getImageUnlink('sub_category_image','food_sub_category','id',$id,$target_dir);
$qry = "DELETE FROM food_sub_category WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Sub Category Image Deleted Successfully');window.location.href='food_sub_category.php';</script>";
} else {
   echo "<script>alert('Sub Category Image Not Deleted');window.location.href='food_sub_category.php';</script>";
}
?>