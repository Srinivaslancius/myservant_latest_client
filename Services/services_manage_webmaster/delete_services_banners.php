<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['bid'];
//echo $music_number;
$target_dir = '../../uploads/services_banner_images/';
$getImgUnlink = getImageUnlink('banner','services_banners','id',$id,$target_dir);
$qry = "DELETE FROM services_banners WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Banner Deleted Successfully');window.location.href='services_banners.php';</script>";
} else {
   echo "<script>alert('Banner Not Deleted');window.location.href='services_banners.php';</script>";
}
?>