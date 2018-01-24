<?php
	include_once('../admin_includes/config.php');
	include_once('../admin_includes/common_functions.php');
	if(isset($_POST['userInput'])) {
		$userInput=$_POST['userInput'];
		$table=$_POST['table'];
		$columnName = $_POST['columnName']; 
	  	$output = checkUserAvail($table,$columnName,$userInput);
	  	echo $output;
	  	exit;
    }
?> 