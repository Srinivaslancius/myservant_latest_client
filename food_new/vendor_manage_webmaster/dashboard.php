<?php include_once 'admin_includes/main_header.php'; ?>
      <div class="site-content">
        <?php
        $vendor_id = $_SESSION['food_vendor_user_id'];

         $getAllProducts = "SELECT * FROM food_products WHERE restaurant_id= '$vendor_id'";
          $getProducts = $conn->query($getAllProducts);
          $getProductsCount = $getProducts->num_rows;
          $getAllOrders = "SELECT * FROM food_orders  WHERE restaurant_id = '$vendor_id' AND vendor_order_status = 2 GROUP BY order_id ORDER BY id DESC";
          $getAllOrders1 = $conn->query($getAllOrders);
          $getOrdersCount = $getAllOrders1->num_rows;?>
        <div class="row">
          <a href="food_vendor_orders.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-primary m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Orders</div>
                <div class="wt-number"><?php echo $getOrdersCount ?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>
          <a href="food_products.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-warning m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Items</div>
                <div class="wt-number"><?php echo $getProductsCount ?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>
          
        </div>

        <!-- <div class="col-md-6 m-b-30">
          <h4 class="m-t-0 m-b-30">Pie chart</h4>
          <div id="pie" style="height: 300px"></div>
        </div> -->


      </div>
     <?php include_once 'admin_includes/footer.php'; ?>
     <!-- Script for pie chart -->
     <script src="js/charts-flot.min.js"></script>
     