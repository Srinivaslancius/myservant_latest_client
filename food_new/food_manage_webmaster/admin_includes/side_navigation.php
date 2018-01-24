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
            <li class="<?php if($page_name == 'site_settings.php') { echo "active"; } ?>">
              <a href="site_settings.php" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-settings zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Site Settings</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'social_networks_links.php') { echo "active"; } ?>">
              <a href="social_networks_links.php" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-settings zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Social Network Links</span>
              </a>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-accounts zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Users</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Users</li>
                <li class="<?php if($page_name == 'admin_users.php' || $page_name == 'add_admin_users.php' || $page_name == 'edit_admin_users.php') { echo "active"; } ?>"><a href="admin_users.php">Admin Users</a></li> 
                <li class="<?php if($page_name == 'users.php' || $page_name == 'add_users.php' || $page_name == 'edit_users.php') { echo "active"; } ?>"><a href="users.php">Customers</a></li>
                <li class="<?php if($page_name == 'vendors.php' || $page_name == 'add_vendors.php' || $page_name == 'edit_vendors.php') { echo "active"; } ?>"><a href="vendors.php">Vendors</a></li>
                <li class="<?php if($page_name == 'food_delivery_boys.php' || $page_name == 'add_food_delivery_boys.php' || $page_name == 'edit_food_deliveryboys.php') { echo "active"; } ?>"><a href="food_delivery_boys.php">Delivery Boys</a></li>
              </ul>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-collection-item  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">CMS</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">CMS</li>
                <li  class="<?php if($page_name == 'food_content_pages.php' || $page_name == 'add_food_content_pages.php' || $page_name == 'edit_food_content_pages.php' ) { echo "active"; } ?>"><a href="food_content_pages.php">Content Pages</a>
                </li>
                <li  class="<?php if($page_name == 'food_banners.php' || $page_name == 'add_food_banners.php' || $page_name == 'edit_food_banners.php' ) { echo "active"; } ?>"><a href="food_banners.php">Banners</a>
                </li>
                <li  class="<?php if($page_name == 'food_newletter.php' ) { echo "active"; } ?>">
                  <a href="food_newletter.php">News Letters</a>
                </li>
                <li  class="<?php if($page_name == 'faqs.php' || $page_name == 'add_food_faqs.php' || $page_name == 'edit_food_faqs.php') { echo "active"; } ?>"><a href="faqs.php">FAQ'S</a>
                </li>
                <li  class="<?php if($page_name == 'food_howcanhelp_you.php' || $page_name == 'add_food_howcanhelp_you.php' || $page_name == 'edit_food_howcanhelp_you.php' ) { echo "active"; } ?>"><a href="food_howcanhelp_you.php">How Can I Help You</a>
                </li>                
              </ul>
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
               <li  class="<?php if($page_name == 'food_cusine.php' || $page_name == 'add_food_food_cusine.php' || $page_name == 'edit_food_cusine.php' ) { echo "active"; } ?>"><a href="food_cusine.php">Cusine Types
                </a>
                </li>
                <li  class="<?php if($page_name == 'food_category.php' || $page_name == 'add_food_category.php' || $page_name == 'edit_food_category.php' ) { echo "active"; } ?>"><a href="food_category.php">Categories</a>
                </li>
                 <li  class="<?php if($page_name == 'food_product_weights.php' || $page_name == 'add_food_product_weights.php' || $page_name == 'edit_food_product_weights.php') { echo "active"; } ?>"><a href="food_product_weights.php">Weights</a>
                </li>
                <li  class="<?php if($page_name == 'food_ingredients.php' || $page_name == 'add_food_ingredients.php' || $page_name == 'edit_food_ingredients.php') { echo "active"; } ?>">
                  <a href="food_ingredients.php">Ingredients</a>
                </li>
                <li  class="<?php if($page_name == 'food_product_type.php' || $page_name == 'add_food_product_type.php' || $page_name == 'edit_food_product_type.php') { echo "active"; } ?>">
                  <a href="food_product_type.php">Items Type</a>
                </li>
                <li  class="<?php if($page_name == 'food_products.php' || $page_name == 'add_food_products.php' || $page_name == 'edit_food_products.php') { echo "active"; } ?>">
              <a href="food_products.php" >Items</a>
            </li>
              </ul>
            </li>
            <li  class="<?php if($page_name == 'food_coupons.php' || $page_name == 'add_food_coupons.php' || $page_name == 'edit_food_coupons.php' ) { echo "active"; } ?>">
              <a href="food_coupons.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-local-offer zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Food Coupons</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'food_brand_logos.php' || $page_name == 'add_food_brand_logos.php' || $page_name == 'edit_food_brand_logos.php' ) { echo "active"; } ?>">
              <a href="food_brand_logos.php" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-collection-image  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Brand Logos</span>
              </a>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Mangae Master Data</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Mangae Master Data</li>
                <li  class="<?php if($page_name == 'lkp_states.php' || $page_name == 'add_lkp_states.php' || $page_name == 'edit_lkp_states.php' ) { echo "active"; } ?>">
                 <a href="lkp_states.php">States</a>
                </li>
                <li  class="<?php if($page_name == 'lkp_districts.php' || $page_name == 'add_lkp_districts.php' || $page_name == 'edit_lkp_districts.php' ) { echo "active"; } ?>"><a href="lkp_districts.php">Districts</a>
                </li>
                <li  class="<?php if($page_name == 'lkp_cities.php' || $page_name == 'add_lkp_cities.php' || $page_name == 'edit_lkp_cities.php' ) { echo "active"; } ?>"><a href="lkp_cities.php">Cities</a>
                </li>
                <li  class="<?php if($page_name == 'lkp_pincodes.php' || $page_name == 'add_lkp_pincodes.php' || $page_name == 'edit_lkp_pincodes.php' ) { echo "active"; } ?>"><a href="lkp_pincodes.php">Pincodes</a>
                </li>
                <li  class="<?php if($page_name == 'lkp_locations.php' || $page_name == 'add_lkp_locations.php' || $page_name == 'edit_lkp_locations.php' ) { echo "active"; } ?>"><a href="lkp_locations.php">Locations</a>
                </li>

               <!-- <li  class="<?php if($page_name == 'availability_of_locations.php' || $page_name == 'add_availability_of_locations.php' || $page_name == 'edit_availability_of_locations.php' ) { echo "active"; } ?>"><a href="availability_of_locations.php">Availability of Locations</a>

                </li> -->
              </ul>
            </li>
            <!-- <li  class="<?php if($page_name == 'faqs.php' || $page_name == 'add_faqs.php' || $page_name == 'edit_faqs.php') { echo "active"; } ?>">
              <a href="faqs.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-pin-help zmdi-hc-fw"></i>
                </span> 
                <span class="menu-text">FAQ'S</span>
              </a>
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
                <li  class="<?php if($page_name == 'food_orders.php' || $page_name == 'add_food_orders.php' || $page_name == 'edit_food_orders.php' || $page_name == 'assign_to.php' ) { echo "active"; } ?>"><a href="food_orders.php">Orders</a>
                </li>
                <li  class="<?php if($page_name == 'food_failed_orders.php' || $page_name == 'edit_food_failed_orders.php' ) { echo "active"; } ?>"><a href="food_failed_orders.php">Failed Orders</a>
                </li>
                <li  class="<?php if($page_name == 'food_cancelled_orders.php' ) { echo "active"; } ?>"><a href="food_cancelled_orders.php">Cancelled Orders</a>
                </li>
                <li  class="<?php if($page_name == 'food_today_orders.php' ) { echo "active"; } ?>"><a href="food_today_orders.php">Today Orders</a>
                </li> 
              </ul>
            </li>
            <li  class="<?php if($page_name == 'payment_gateway_options.php' ) { echo "active"; } ?>">
              <a href="payment_gateway_options.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-card zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Payment Gateway Options</span>
              </a>
            </li>
            
            <!-- <li  class="<?php if($page_name == 'food_sub_category.php' || $page_name == 'add_food_sub_category.php' || $page_name == 'edit_food_sub_category.php' ) { echo "active"; } ?>">
              <a href="food_sub_category.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-local-offer zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Sub Categories</span>
              </a>
            </li> --> 
            <!-- <li  class="<?php if($page_name == 'food_restaurants.php' || $page_name == 'add_food_restaurants.php' || $page_name == 'edit_food_restaurants.php' ) { echo "active"; } ?>">
              <a href="food_restaurants.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-local-offer zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Restaurants</span>
              </a>
            </li> -->
            <!-- <li  class="<?php if($page_name == 'food_testimonials.php' || $page_name == 'add_food_testimonials.php' || $page_name == 'edit_food_testimonials.php') { echo "active"; } ?>">
              <a href="food_testimonials.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-comments  zmdi-hc-fw"></i>
                </span> 
                <span class="menu-text">Testimonials</span>
              </a>
            </li> -->
           <!-- <li  class="<?php if($page_name == 'customer_enquireis.php' ) { echo "active"; } ?>">
              <a href="customer_enquireis.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Customer Enquireis</span>
              </a>
            </li> -->
          </ul>
        </div>
      </div>