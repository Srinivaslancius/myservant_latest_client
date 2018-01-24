<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['cid'];
//echo $music_number;
$target_dir = '../../uploads/services_category_images/';
$getImgUnlink = getImageUnlink('category_image','services_category','id',$id,$target_dir);
$qry = "DELETE FROM services_category WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Category Deleted Successfully');window.location.href='services_category.php';</script>";
} else {
   echo "<script>alert('Category Not Deleted');window.location.href='services_category.php';</script>";
}
?>