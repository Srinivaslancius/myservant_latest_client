<?php
	include_once('../admin_includes/config.php');
	include_once('../admin_includes/common_functions.php');
	if(isset($_POST['user_mobile'])) {
		$user_mobile=$_POST['user_mobile']; 
	  	$sql = "SELECT * FROM `users` WHERE `user_mobile` = '$user_mobile' ";
        $result = $conn->query($sql);
       echo  $result->num_rows;
    } 
    if(isset($_POST['user_email'])) {
		$user_email=$_POST['user_email']; 
	  	$sql1 = "SELECT * FROM `users` WHERE `user_email` = '$user_email' ";
        $result1 = $conn->query($sql1);
        echo  $result1->num_rows;
    }
?> 