<?php
session_start(); //to ensure you are using same session
//Update Log
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
updateAdminLogs('3',$_SESSION['grocery_admin_user_id']);//3-Grocery,
session_unset();
session_destroy();
ob_start(); //destroy the session
header("location:index.php"); //to redirect back to "index.php" after logging out
exit();
?>