<?php
if($_SESSION['user_login_session_id'] == '') {
    header ("Location: logout.php");
} 
?>
<ul id="cat_nav" style="border:1px solid #ddd;;padding:0px">
	<li style="font-size:12px"><a href="my_dashboard.php" <?php if($page_name=="my_dashboard.php" || $page_name=="order_details.php") { echo "id=active"; } ?> ><i class="icon-cart"></i> MY ORDERS</a></li>
    <li style="font-size:12px"><a href="personal_information.php"><i class="icon-address-book"></i> ACCOUNT SETTINGS</a></li>
    <li style="text-align:center;font-size:13px"><a href="personal_information.php" <?php if($page_name=="personal_information.php") { echo "id=active"; } ?>><i class="icon-user"></i> Personal Information</a></li>
    <li style="text-align:center;font-size:13px"><a href="change_password.php" <?php if($page_name=="change_password.php") { echo "id=active"; } ?>><i class="icon-lock"></i> Change Password</a></li>            
</ul>