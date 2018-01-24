<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['frid'];
//echo $music_number;
$target_dir = '../../uploads/food_restaurants_images/';
$getImgUnlink = getImageUnlink('image','food_restaurants','id',$id,$target_dir);
$qry = "DELETE FROM food_restaurants WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Restaurant Data Deleted Successfully');window.location.href='food_restaurants.php';</script>";
} else {
   echo "<script>alert('Restaurant Data Not Deleted');window.location.href='food_restaurants.php';</script>";
}
?>