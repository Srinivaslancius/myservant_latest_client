<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['id'];
$table = $_GET['table'];
$qry = "DELETE FROM `$table` WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Data Deleted Successfully');window.location.href='$table.php';</script>";
} else {
   echo "<script>alert('Data Not Deleted');window.location.href='$table.php';</script>";
}
?>