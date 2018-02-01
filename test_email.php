<?php
error_reporting(1);
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

$to = "srinivas@lanciussolutions.com";
$subject = "Test Email";
$message = "Test Email";
$from = "srinu7008@gmail.com";
$name = "Srinu Dantha";

$resultEmail = sendEmail($to,$subject,$message,$from,$name);

if($resultEmail == 0) {
	echo "Mail Sent Success";
} else {
	echo "Mail Sent Failed";
}
?>