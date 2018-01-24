<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['id'];
$qry = "DELETE FROM `lkp_locations` WHERE lkp_city_id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Locations Deleted Successfully');window.location.href='lkp_locations.php';</script>";
} else {
   echo "<script>alert('Locations Not Deleted');window.location.href='lkp_locations.php';</script>";
}
?>