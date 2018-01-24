<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['seid'];
//echo $music_number;
$target_dir = '../../uploads/service_employee_photo/';
$getImgUnlink = getImageUnlink('photo','services_employee_registration','id',$id,$target_dir);
$qry = "DELETE FROM services_employee_registration WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Service Employee Deleted Successfully');window.location.href='service_employee_registration.php';</script>";
} else {
   echo "<script>alert('Service Employee Not Deleted');window.location.href='service_employee_registration.php';</script>";
}
?>