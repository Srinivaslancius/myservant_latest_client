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
       <li><a href="Services/service_orders.php" class="<?php if($page_name == 'Services/service_orders.php') { echo "active"; } ?>"><i class="icon-cart"></i> Services Orders</a></li>
       <li><a href="food_new/food_orders1.php" class="<?php if($page_name == 'food_new/food_orders1.php') { echo "active"; } ?>"><i class="icon-food-1"></i> Food Orders</a></li>
       <li><a href="grocery_orders.php" class="<?php if($page_name == 'grocery_orders.php') { echo "active"; } ?>"><i class="icon-grocery-store"></i> Grocery Orders</a></li>
       <li><a href="grocery_wishlist.php" class="<?php if($page_name == 'grocery_wishlist.php') { echo "active"; } ?>"><i class="icon-heart-empty"></i> Wishlist Grocery</a></li>
       <li><a href="my_address.php" class="<?php if($page_name == 'my_address.php') { echo "active"; } ?>"><i class="icon-address-book"></i> My Addresses</a></li>
       <li><a href="wallet.php" class="<?php if($page_name == 'wallet.php') { echo "active"; } ?>"><i class="icon-wallet"></i> Wallet</a></li>
       <li><a href="update_profile.php" class="<?php if($page_name == 'update_profile.php') { echo "active"; } ?>"><i class="icon-address-book-alt"></i> Update Profile</a></li>
       <li><a href="rewards.php"><i class="icon-gift" class="<?php if($page_name == 'myaccount.php') { echo "active"; } ?>"></i> Reward Points</a></li>
       <li><a href="change_password.php" class="<?php if($page_name == 'change_password.php') { echo "active"; } ?>"><i class="icon-lock-open-6"></i> Change Password</a></li>
       <li><a href="logout.php"><i class="icon-logout-3"></i> Logout</a></li>
</ul>