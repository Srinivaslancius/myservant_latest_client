<?php
    $currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode('/', $currentFile);
    $page_name = $parts[count($parts) - 1];
?>
<ul class="sidebar-menu">
            <li class="<?php if($page_name == 'dashboard.php') { echo "active"; } ?>"><a href="dashboard.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-home"></i>
                </span>
                <span class="menu-text">Dashboard</span>
              </a>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-view-list zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Master Data</span>
              </a>
              <ul class="sidebar-submenu">
                <li class="menu-subtitle">Dashboards</li>
                <li class="<?php if($page_name == 'add_state.php' || $page_name == 'edit_lkp_states.php') { echo "active"; } ?>"><a href="add_state.php">Manage States</a></li> 
                <li class="<?php if($page_name == 'add_districts.php' || $page_name == 'edit_lkp_districts.php') { echo "active"; } ?>"><a href="add_districts.php">Manage Districts</a></li> 

                <li class="<?php if($page_name == 'add_cities.php' || $page_name =='edit_lkp_cities.php') { echo "active"; } ?>"><a href="add_cities.php">Manage Cities</a></li>
                <li class="<?php if($page_name == 'manage_pincodes.php' || $page_name =='edit_lkp_pincodes.php') { echo "active"; } ?>"><a href="manage_pincodes.php">Manage Pin Codes</a></li>
  
                <li class="<?php if($page_name == 'manage_areas.php' || $page_name == 'edit_lkp_areas.php') { echo "active"; } ?>"><a href="manage_areas.php">Manage Areas</a></li>

                <li class="<?php if($page_name == 'manage_sub_areas.php' || $page_name == 'edit_lkp_sub_areas.php') { echo "active"; } ?>"><a href="manage_sub_areas.php">Manage Sub Areas</a></li>
                
                <li class="<?php if($page_name == 'manage_languages.php' || $page_name == 'edit_grocery_languages.php') { echo "active"; } ?>"><a href="manage_languages.php">Manage Languages</a></li>
                <li class="<?php if($page_name == 'manage_brands.php' || $page_name == 'edit_grocery_brands.php') { echo "active"; } ?>"><a href="manage_brands.php">Manage Brands</a></li>
                <li class="<?php if($page_name == 'manage_categories.php' || $page_name == 'edit_grocery_category.php') { echo "active"; } ?>"><a href="manage_categories.php">Manage Categories</a></li>
                <li class="<?php if($page_name == 'manage_sub_categories.php' || $page_name == 'edit_grocery_sub_category.php') { echo "active"; } ?>"><a href="manage_sub_categories.php">Manage Sub Categories</a></li>
                <!-- <li class="<?php if($page_name == '') { echo "active"; } ?>"><a href="">Manage Time Slots</a></li> -->
                <!-- <li><a href="">Manage Time Slots</a></li> -->
              </ul>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-settings zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Settings</span>
              </a>
              <ul class="sidebar-submenu">
                <li class="menu-subtitle">Settings</li>
                <li class="<?php if($page_name == 'basic_settings.php') { echo "active"; } ?>"><a href="basic_settings.php">Site Level Settings</a></li>
                <li class="<?php if($page_name == 'payment_settings.php') { echo "active"; } ?>"><a href="payment_settings.php">Payment Settings</a></li>
                <li class="<?php if($page_name == 'Social_media_settings.php') { echo "active"; } ?>"><a href="Social_media_settings.php">Social Media Settings</a></li>
                <li class="<?php if($page_name == 'reward_points.php') { echo "active"; } ?>"><a href="reward_points.php">Reward Settings</a></li>
                <li class="<?php if($page_name == 'reward_settings.php') { echo "active"; } ?>"><a href="reward_settings.php">Reward Points</a></li>
              </ul>
            </li>

            <li class="<?php if($page_name == 'manage_time_slots.php' || $page_name == 'edit_manage_time_slots.php') { echo "active"; } ?>"><a href="manage_time_slots.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-alarm-check zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Manage Time Slots</span>
              </a>
            </li>

            <li class="<?php if($page_name == 'content_page.php' || $page_name == 'edit_content_pages.php') { echo "active"; } ?>"><a href="content_page.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-comments  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Content Pages</span>
              </a>
            </li>
             <li class="<?php if($page_name == 'other_services.php' || $page_name == 'edit_other_services.php') { echo "active"; } ?>"><a href="other_services.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-info zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Other Services</span>
              </a>
            </li> 
    
            <li class="<?php if($page_name == 'grocery_blog.php' || $page_name == 'edit_grocery_blog.php') { echo "active"; } ?>"><a href="grocery_blog.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-blogger zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Blog</span>
              </a>
            </li>
            <!-- <li class="<?php if($page_name == 'brand_logos.php' || $page_name == 'edit_brand_logos.php') { echo "active"; } ?>"><a href="brand_logos.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-gradient zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Brand Logos</span>
              </a>
            </li> -->
            <li class="<?php if($page_name == 'grocery_banners.php' || $page_name == 'edit_grocery_banners.php' || $page_name == 'add_grocery_banners.php') { echo "active"; } ?>"><a href="grocery_banners.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-collection-image  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Banners</span>
              </a>
            </li>
  
            <li class="<?php if($page_name == 'grocery_tags.php' || $page_name == 'edit_grocery_tags.php') { echo "active"; } ?>"><a href="grocery_tags.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-link zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Tags</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'testimonials.php' || $page_name == 'edit_testimonials.php') { echo "active"; } ?>"><a href="testimonials.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-accounts-add zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Testimonials</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'grocery_offer_module.php' || $page_name == 'edit_grocery_offer_module.php') { echo "active"; } ?>"><a href="grocery_offer_module.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-label"></i>
                </span>
                <span class="menu-text">Offers</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'faq.php' || $page_name == 'edit_faq.php') { echo "active"; } ?>"><a href="faq.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-pin-help zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">FAQ'S</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'manage_products.php' || $page_name == 'add_manage_products.php' || $page_name == 'edit_products.php' || $page_name == 'edit_deal_dates.php' || $page_name == 'product_images.php' || $page_name == 'update_price.php' || $page_name == 'edit_product_price.php') { echo "active"; } ?>"><a href="manage_products.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-labels zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Products</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'grocery_offer_zone.php' || $page_name == 'edit_grocery_offer_zone.php') { echo "active"; } ?>"><a href="grocery_offer_zone.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-label"></i>
                </span>
                <span class="menu-text">Offer Zone</span>
              </a>
            </li>
           <!-- <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Orders</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Orders</li>
                <li  class="<?php if($page_name == 'view_orders.php'|| $page_name == 'edit_orders.php') { echo "active"; } ?>"><a href="view_orders.php">Orders</a>
                </li>
                <li  class="<?php if($page_name == 'failed_orders.php') { echo "active"; } ?>"><a href="failed_orders.php">Failed Orders</a>
                </li>
                <li  class="<?php if($page_name == 'cancelled_orders.php' ) { echo "active"; } ?>"><a href="cancelled_orders.php">Cancelled Orders</a>
                </li>
                <li  class="<?php if($page_name == 'today_orders.php' ) { echo "active"; } ?>"><a href="today_orders.php">Today Orders</a>
                </li> 
              </ul>
            </li> -->
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Orders</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Orders</li>
                <li  class="<?php if($page_name == 'view_orders.php') { echo "active"; } ?>"><a href="view_orders.php">New Orders</a>
                </li>
                <li  class="<?php if($page_name == 'inprocess_orders.php') { echo "active"; } ?>"><a href="inprocess_orders.php">In Process Orders</a>
                </li>
                <li  class="<?php if($page_name == 'completed_orders.php') { echo "active"; } ?>"><a href="completed_orders.php">Complete Orders</a>
                </li>
                <li  class="<?php if($page_name == 'delivered_orders.php') { echo "active"; } ?>"><a href="delivered_orders.php">Delivered Orders</a>
                </li>
                <li  class="<?php if($page_name == 'failed_orders.php') { echo "active"; } ?>"><a href="failed_orders.php">Failed Orders</a>
                </li>
                <li  class="<?php if($page_name == 'cancelled_orders.php' ) { echo "active"; } ?>"><a href="cancelled_orders.php">Cancelled Orders</a>
                </li>
              </ul>
            </li>
            <li class="<?php if($page_name == 'grocery_coupons.php' || $page_name == 'edit_grocery_coupons.php') { echo "active"; } ?>">
              <a href="grocery_coupons.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-dot-circle-alt"></i>
                </span>
                <span class="menu-text">Coupons</span>
              </a>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Manage Users</span>
              </a>
              <ul class="sidebar-submenu">
                <li class="menu-subtitle">Manage Users</li>
                <li class="<?php if($page_name == 'users.php') { echo "active"; } ?>"><a href="users.php">Customers</a></li>
                <li class="<?php if($page_name == 'employees.php' || $page_name == 'edit_employees.php') { echo "active"; } ?>"><a href="employees.php">Employees</a></li>
                <li class="<?php if($page_name == 'delivery_boys.php' || $page_name == 'edit_deliveryboys.php') { echo "active"; } ?>"><a href="delivery_boys.php">Delivery Boys</a></li>
                <li class="<?php if($page_name == 'admin_users.php' || $page_name == 'edit_admin_users.php') { echo "active"; } ?>"><a href="admin_users.php">Admin Users</a></li>
                <!-- <li class="<?php if($page_name == 'city_wise_admin_users.php' || $page_name == 'edit_citywise_admin_users.php') { echo "active"; } ?>"><a href="city_wise_admin_users.php">City Wise Admins</a></li> -->
                
              </ul>
            </li>
            <li class="<?php if($page_name == 'grocery_news_letter.php') { echo "active"; } ?>"><a href="grocery_news_letter.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-email zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">News Letter</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'wallet.php') { echo "active"; } ?>"><a href="wallet.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-balance-wallet zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Wallet</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'grocery_refer_a_friend.php') { echo "active"; } ?>"><a href="grocery_refer_a_friend.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-accounts-outline zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Refer A Friend</span>
              </a>
            </li>
            <!-- <li><a href="#">
                <span class="menu-icon">
                  <i class="zmdi zmdi-notifications zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Reward Points</span>
              </a>
            </li>
             <li class="<?php if($page_name == 'package_creation.php') { echo "active"; } ?>"><a href="package_creation.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-case zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Packages</span>
              </a>
            </li> -->
            <li class="<?php if($page_name == 'mobile_push_notifications.php') { echo "active"; } ?>"><a href="mobile_push_notifications.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-account-box-mail zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Mobile Push Notifications</span>
              </a>
            </li>

            <li class="<?php if($page_name == 'admin_logs.php') { echo "active"; } ?>"><a href="admin_logs.php">
                <span class="menu-icon">
                  <i class="zmdi zmdi-dot-circle-alt"></i>
                </span>
                <span class="menu-text">Logs</span>
              </a>
            </li>
          </ul>