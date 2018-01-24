<?php
error_reporting(0);
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');
//session_start();

if($_SERVER["REQUEST_METHOD"]=="POST") {

	$vendor_email = $_POST["vendor_email"];
	//Set Password encrypt and decrypt	
	$pwd=$_POST["vendor_password"];	
	$vendor_password = encryptPassword($pwd);
	$sql = "SELECT * FROM food_vendors WHERE vendor_email = '$vendor_email' AND password = '$vendor_password' AND lkp_status_id = 0";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	if($row) {
	    $_SESSION['food_vendor_user_id'] = $row['id'];
	    $_SESSION['food_vendor_user_name'] = $row['vendor_name'];
	    //Assign the current timestamp as the user's
		//latest activity
		$_SESSION['last_action'] = time();
	    if(isset($_SESSION["food_vendor_user_name"])) {
		    echo "<script type='text/javascript'>window.location='dashboard.php'</script>";
		}
	} else {
	    //echo "<script language=javascript>alert('Entered Username or Password is incorrect!')</script>";
	    echo "<script type='text/javascript'>window.location='index.php?error=fail'</script>";
	}
} else {
	//echo "<script language=javascript>alert('Invalid Request!')</script>";
    echo "<script type='text/javascript'>window.location='index.php?error=invalid'</script>";
}
?>
