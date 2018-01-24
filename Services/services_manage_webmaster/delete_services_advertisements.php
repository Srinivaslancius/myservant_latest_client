<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['adv_id'];
//echo $music_number;
$target_dir = '../../uploads/services_advertisements/';
$getImgUnlink = getImageUnlink('image','services_advertisements','id',$id,$target_dir);
$qry = "DELETE FROM services_advertisements WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Image Deleted Successfully');window.location.href='services_advertisements.php';</script>";
} else {
   echo "<script>alert('Image Not Deleted');window.location.href='services_advertisements.php';</script>";
}
?>