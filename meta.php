<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<!-- Basic Page Needs -->
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title>Myservant</title>
	<link rel="shortcut icon" href="favicon/favicon.png">
	<meta name="" content="">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Boostrap style -->
	<link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
        
	<!-- Reponsive -->
	<link rel="stylesheet" type="text/css" href="stylesheets/responsive.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/dash_board.css">
	<link href="stylesheets/animate.min.css" rel="stylesheet">

	<script type="text/javascript" src="javascript/modernAlert.min.js"></script>

	<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
	$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>

	<?php echo $getSiteSettingsData1['google_analytics_code']; ?>
</head>
