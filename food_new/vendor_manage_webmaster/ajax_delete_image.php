<?php include_once 'admin_includes/main_header.php'; 
$id = $_POST['del_id'];
$target_dir = '../../uploads/food_product_images/';
$getImgUnlink = getImageUnlink('product_image','food_product_images','id',$id,$target_dir);
$qry = "DELETE FROM food_product_images WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "YES";
} else {
   echo "NO";
}
?>