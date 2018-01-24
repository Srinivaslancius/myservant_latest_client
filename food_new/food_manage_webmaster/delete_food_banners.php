<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['bid'];
//echo $music_number;
$target_dir = '../../uploads/food_banner_images/';
$getImgUnlink = getImageUnlink('banner','food_banners','id',$id,$target_dir);
$qry = "DELETE FROM food_banners WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Banner Deleted Successfully');window.location.href='food_banners.php';</script>";
} else {
   echo "<script>alert('Banner Not Deleted');window.location.href='food_banners.php';</script>";
}
?>