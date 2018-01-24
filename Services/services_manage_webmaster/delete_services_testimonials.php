<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['tid'];
//echo $music_number;
$target_dir = '../../uploads/services_testimonials_images/';
$getImgUnlink = getImageUnlink('image','services_testimonials','id',$id,$target_dir);
$qry = "DELETE FROM services_testimonials WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Testimonial Deleted Successfully');window.location.href='services_testimonials.php';</script>";
} else {
   echo "<script>alert('Testimonial Not Deleted');window.location.href='services_testimonials.php';</script>";
}
?>