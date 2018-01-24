<?php
    $currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode('/', $currentFile);
    $page_name = $parts[count($parts) - 1];
?>
<div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
          <ul class="sidebar-menu">
            <li class="menu-title">Menu</li>
             <li  class="<?php if($page_name == 'dashboard.php') { echo "active"; } ?>">
              <a href="dashboard.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Dashboard</span>
              </a>
            </li>

            <li  class="<?php if($page_name == 'vendor_details.php') { echo "active"; } ?>">
              <a href="vendor_details.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-account zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Vendor Details</span>
              </a>
            </li>    
            
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Catelog</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Catelog</li>              
                <li  class="<?php if($page_name == 'food_category.php' || $page_name == 'add_food_category.php' || $page_name == 'edit_food_category.php' ) { echo "active"; } ?>"><a href="food_category.php">Categories</a>
                </li>                
                <li  class="<?php if($page_name == 'food_products.php' || $page_name == 'add_food_products.php' || $page_name == 'edit_food_products.php') { echo "active"; } ?>">
              <a href="food_products.php" >Items</a>
                </li>
              </ul>
            </li>

            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Orders</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Orders</li>
                <li  class="<?php if($page_name == 'food_vendor_orders.php' ) { echo "active"; } ?>"><a href="food_vendor_orders.php">Orders</a>
                </li>
                <li  class="<?php if($page_name == 'vendor_today_orders.php' ) { echo "active"; } ?>"><a href="vendor_today_orders.php">Today Orders</a>
                </li> 
              </ul>
            </li>
          </ul>
        </div>
      </div>