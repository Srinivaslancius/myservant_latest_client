<?php 
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if(isset($_POST["token"]) && $_POST["token"]!="") {	
		$token = encryptPassword($_POST["token"]);
		$encNewPass = encryptPassword($_POST["user_password"]);
		echo $updateq = "UPDATE users SET user_password='$encNewPass' WHERE id = '" . $token . "'";		 die;
		if($conn->query($updateq) === TRUE){             
            echo "<script type='text/javascript'>window.location='login.php?succ=log-success'</script>";
        } else {
        	echo "<script type='text/javascript'>window.location='login.php?succ=log-fail'</script>";
        }
}

?>