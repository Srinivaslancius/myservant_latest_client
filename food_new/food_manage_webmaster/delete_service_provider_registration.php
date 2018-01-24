<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['registrationid'];
$qry = "DELETE FROM service_provider_registration WHERE id ='$id'";
$result = $conn->query($qry);
$target_dir = '../../uploads/service_provider_business_logo/';
$getImgUnlink1 = getImageUnlink('logo','service_provider_business_registration','service_provider_registration_id',$id,$target_dir);
$qry1 = "DELETE FROM service_provider_business_registration WHERE service_provider_registration_id ='$id'";
$result1 = $conn->query($qry1);
$target_dir1 = '../../uploads/service_provider_personal_iamge/';
$getImgUnlink2 = getImageUnlink('image','service_provider_personal_registration','service_provider_registration_id',$id,$target_dir1);
$qry2 = "DELETE FROM service_provider_personal_registration WHERE service_provider_registration_id ='$id'";
$result2 = $conn->query($qry2);

if(isset($result)) {
   echo "<script>alert('Data Deleted Successfully');window.location.href='service_provider_registration.php';</script>";
} else {
   echo "<script>alert('Data Not Deleted');window.location.href='service_provider_registration.php';</script>";
}
?>