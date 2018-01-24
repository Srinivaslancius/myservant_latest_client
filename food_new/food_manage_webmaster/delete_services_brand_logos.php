<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['logoid'];
//echo $music_number;
$target_dir = '../../uploads/services_brand_logos/';
$getImgUnlink = getImageUnlink('brand_logo','services_brand_logos','id',$id,$target_dir);
$qry = "DELETE FROM services_brand_logos WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Brand Logo Deleted Successfully');window.location.href='services_brand_logos.php';</script>";
} else {
   echo "<script>alert('Brand Logo Not Deleted');window.location.href='services_brand_logos.php';</script>";
}
?>