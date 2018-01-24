<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['tid'];
//echo $music_number;
$target_dir = '../../uploads/food_testimonials_images/';
$getImgUnlink = getImageUnlink('image','food_testimonials','id',$id,$target_dir);
$qry = "DELETE FROM food_testimonials WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Testimonial Deleted Successfully');window.location.href='food_testimonials.php';</script>";
} else {
   echo "<script>alert('Testimonial Not Deleted');window.location.href='food_testimonials.php';</script>";
}
?>