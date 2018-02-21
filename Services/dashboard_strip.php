<?php
if($_SESSION['user_login_session_id'] == '') {
    header ("Location: logout.php");
}
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$page_name = $parts[count($parts) - 1];
?>
<ul id="cat_nav">
       <li><a href="my_account.php" class="<?php if($page_name == 'my_account.php') { echo "active"; } ?>"><i class="icon-user"></i> My Account</a></li>
       <li><a href="service_orders.php" class="<?php if($page_name == 'service_orders.php' || $page_name == 'services_category_orders.php' || $page_name == 'order_details1.php') { echo "active"; } ?>"><i class="icon-cart"></i> Services Orders</a></li>
       <li><a href="food_orders.php" class="<?php if($page_name == 'food_orders.php' || $page_name == 'view_food_order_details.php') { echo "active"; } ?>"><i class="icon-food-1"></i> Food Orders</a></li>
       <li><a href="grocery_orders1.php" class="<?php if($page_name == 'grocery_orders1.php' || $page_name == 'order_details.php') { echo "active"; } ?>"><i class="icon-grocery-store"></i> Grocery Orders</a></li>
       <li><a href="grocery_wishlist.php" class="<?php if($page_name == 'grocery_wishlist.php') { echo "active"; } ?>"><i class="icon-heart-empty"></i> Wishlist Grocery</a></li>
       <li><a href="my_address.php" class="<?php if($page_name == 'my_address.php') { echo "active"; } ?>"><i class="icon-address-book"></i> My Addresses</a></li>
       <li><a href="wallet.php" class="<?php if($page_name == 'wallet.php') { echo "active"; } ?>"><i class="icon-wallet"></i> Wallet</a></li>
       <li><a href="update_profile.php" class="<?php if($page_name == 'update_profile.php') { echo "active"; } ?>"><i class="icon-address-book-alt"></i> Update Profile</a></li>
       <li><a href="rewards.php" class="<?php if($page_name == 'rewards.php') { echo "active"; } ?>"><i class="icon-gift"></i> Reward Points</a></li>
       <li><a href="change_password2.php" class="<?php if($page_name == 'change_password2.php') { echo "active"; } ?>"><i class="icon-lock-open-6"></i> Change Password</a></li>
	   <li><a href="refer_friend.php" class="<?php if($page_name == 'refer_friend.php') { echo "active"; } ?>"><i class="icon-users"></i> Refer a friend</a></li>
       <li><a href="logout.php"><i class="icon-logout-3"></i> Logout</a></li>
</ul>