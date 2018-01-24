<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['sid'];
//echo $music_number;
$target_dir = '../../uploads/services_sub_category_images/';
$getImgUnlink = getImageUnlink('sub_category_image','services_sub_category','id',$id,$target_dir);
$qry = "DELETE FROM services_sub_category WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Sub Category Deleted Successfully');window.location.href='services_sub_category.php';</script>";
} else {
   echo "<script>alert('Sub Category Not Deleted');window.location.href='services_sub_category.php';</script>";
}
?>