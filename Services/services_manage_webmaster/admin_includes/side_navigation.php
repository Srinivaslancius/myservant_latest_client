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
                <li  class="<?php if($page_name == 'services_content_pages.php' || $page_name == 'add_services_content_pages.php' || $page_name == 'edit_services_content_pages.php' ) { echo "active"; } ?>"><a href="services_content_pages.php">Content Pages</a>
                </li>
                <li  class="<?php if($page_name == 'services_banners.php' || $page_name == 'add_services_banners.php' || $page_name == 'edit_services_banners.php' ) { echo "active"; } ?>"><a href="services_banners.php">Banners</a>
                </li>
                <li  class="<?php if($page_name == 'services_testimonials.php' || $page_name == 'add_services_testimonials.php' || $page_name == 'edit_services_testimonials.php') { echo "active"; } ?>"><a href="services_testimonials.php">Testimonials</a>
                </li>
                <li  class="<?php if($page_name == 'services_newsfeeds.php' || $page_name == 'add_services_newsfeeds.php' || $page_name == 'edit_services_newsfeeds.php') { echo "active"; } ?>"><a href="services_newsfeeds.php">News Feeds</a>
                </li>
                <!-- <li  class="<?php if($page_name == 'services_newsletter.php' ) { echo "active"; } ?>"><a href="services_newsletter.php">News Letters</a>
                </li> -->
              </ul>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-collection-item  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Service Providers</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Service Providers</li>
                <li  class="<?php if($page_name == 'service_employee_registration.php' || $page_name == 'add_service_employee_registration.php' || $page_name == 'edit_service_employee_registration.php' ) { echo "active"; } ?>"><a href="service_employee_registration.php">Service Employees</a>
                </li>
                <li  class="<?php if($page_name == 'service_provider_registration.php' || $page_name == 'add_service_provider_registration.php' || $page_name == 'edit_service_provider_registration.php' ) { echo "active"; } ?>"><a href="service_provider_registration.php">Service Provider Registrations
                  </a>
                </li>
              </ul>
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
                  <i class="zmdi zmdi-collection-item  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Service Master Data</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Service Master Data</li>

                <li  class="<?php if($page_name == 'services_category.php' || $page_name == 'add_services_category.php' || $page_name == 'edit_services_category.php' ) { echo "active"; } ?>">
                  <a href="services_category.php">Categories</a>
                </li>
                <li  class="<?php if($page_name == 'services_sub_category.php' || $page_name == 'add_services_sub_category.php' || $page_name == 'edit_services_sub_category.php' ) { echo "active"; } ?>"><a href="services_sub_category.php">Sub Categories</a>
                </li>
                <li  class="<?php if($page_name == 'services_groups.php' || $page_name == 'add_services_groups.php' || $page_name == 'edit_services_groups.php' ) { echo "active"; } ?>"><a href="services_groups.php">Groups</a>
                </li>
                <li  class="<?php if($page_name == 'services_group_service_names.php' || $page_name == 'add_services_group_service_names.php' || $page_name == 'edit_services_group_service_names.php' ) { echo "active"; } ?>"><a href="services_group_service_names.php">Service Names</a>
                </li>
              </ul>
            </li>
            <li  class="<?php if($page_name == 'services_coupons.php' || $page_name == 'add_services_coupons.php' || $page_name == 'edit_services_coupons.php' ) { echo "active"; } ?>">
              <a href="services_coupons.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-local-offer zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Service Coupons</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'services_brand_logos.php' || $page_name == 'add_services_brand_logos.php' || $page_name == 'edit_services_brand_logos.php' ) { echo "active"; } ?>">
              <a href="services_brand_logos.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Brand Logos</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'service_seo.php' || $page_name == 'add_service_seo.php' || $page_name == 'edit_service_seo.php' ) { echo "active"; } ?>">
              <a href="service_seo.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">SEO</span>
              </a>
            </li>
            <!-- <li  class="<?php if($page_name == 'services_our_branches.php' || $page_name == 'add_services_our_branches.php' || $page_name == 'edit_services_our_branches.php' ) { echo "active"; } ?>">
              <a href="services_our_branches.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Delivery Areas</span>
              </a>
            </li> -->
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
                <li  class="<?php if($page_name == 'availability_of_locations.php' || $page_name == 'add_availability_of_locations.php' || $page_name == 'edit_availability_of_locations.php' ) { echo "active"; } ?>"><a href="availability_of_locations.php">Availability of Locations</a>
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
                <li  class="<?php if($page_name == 'view_orders.php' || $page_name == 'view_category_orders.php' ) { echo "active"; } ?>"><a href="view_orders.php">Orders</a>
                </li> 
                <!-- <li  class="<?php if($page_name == 'services_failed_orders.php' || $page_name == 'edit_services_failed_orders.php' ) { echo "active"; } ?>"><a href="services_failed_orders.php">Failed Orders</a>
                </li> -->
                <li  class="<?php if($page_name == 'services_cancelled_orders.php' ) { echo "active"; } ?>"><a href="services_cancelled_orders.php">Cancelled Orders</a>
                </li>
                <li  class="<?php if($page_name == 'services_today_orders.php' ) { echo "active"; } ?>"><a href="services_today_orders.php">Today Orders</a>
                </li> 
              </ul>
            </li>
            <li  class="<?php if($page_name == 'payment_gateway_options.php' ) { echo "active"; } ?>">
              <a href="payment_gateway_options.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Payment Gateway Options</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'services_faqs.php' || $page_name == 'add_services_faqs.php' || $page_name == 'edit_services_faqs.php' ) { echo "active"; } ?>">
              <a href="services_faqs.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Help Center Faqs</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'services_advertisements.php' || $page_name == 'add_services_advertisements.php' || $page_name == 'edit_services_advertisements.php' ) { echo "active"; } ?>">
              <a href="services_advertisements.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-local-offer zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Service Advertisements</span>
              </a>
            </li>
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