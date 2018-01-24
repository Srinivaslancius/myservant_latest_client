<?php include_once 'admin_includes/main_header.php';
$order_id = $_GET['order_id'];
    $serviceOrders = "SELECT * FROM services_orders WHERE order_id = '$order_id' GROUP BY category_id ORDER BY id DESC"; 
    $getServiceOrderData = $conn->query($serviceOrders);
    $i=1;
?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Order based on Categories</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Category</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServiceOrderData->fetch_assoc()) { ?>
                  <?php $getategoriesData = getAllDataWhereWithActive('services_category','id',$row['category_id']); 
                  $getategories = $getategoriesData->fetch_assoc();?>                  
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $getategories['category_name'];?></td>
                    <td><a href="services_orders.php?order_id=<?php echo $order_id;?>&category_id=<?php echo $row['category_id']; ?>"><i class="zmdi zmdi-eye zmdi-hc-fw"  class=""></i></a></td>
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