<?php include_once 'admin_includes/main_header.php'; ?>

<?php 
$i=1;

$vendor_id = $_SESSION['food_vendor_user_id'];

$getAllVendorOrdersData = "SELECT * FROM food_orders  WHERE restaurant_id = '$vendor_id' GROUP BY order_id ORDER BY id DESC";
$getVendorOrdersData = $conn->query($getAllVendorOrdersData);

?>
     
      <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <!-- <a href="add_food_products.php" style="float:right">Add Products</a> -->
            <h3 class="m-t-0 m-b-5">Vendor Orders</h3>
          </div>
           <div class="panel-body">
            <div class="table-responsive">
          <div class="clear_fix"></div>
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Order Price</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getVendorOrdersData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php echo $row['order_total'];?></td>
                    <td><a target="_blank" href="invoice.php?order_id=<?php echo $row['order_id']; ?>"><i class="zmdi zmdi-local-printshop" class=""></i></a></td>
                     
                  </tr>
                  <?php  $i++; } ?>
                </tbody>     
              </table>
            </div>
          </div>
        </div>
      </div>
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>