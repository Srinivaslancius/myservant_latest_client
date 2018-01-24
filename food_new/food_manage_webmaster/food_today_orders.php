<?php include_once 'admin_includes/main_header.php';?>
<?php $getFoodTodayOrders = "SELECT * FROM food_orders WHERE DATE(`created_at`) = CURDATE() AND lkp_order_status_id != 6 AND lkp_payment_status_id!=3 ORDER BY lkp_order_status_id DESC ";
$getFoodTodayOrdersData = $conn->query($getFoodTodayOrders); $i=1;
  ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Today Orders</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Item Name</th>
                    <th>Order Id</th>
                    <th>Order Price</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getFoodTodayOrdersData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <?php $getProductNames = getAllDataWhere('food_products','id',$row['product_id']); 
                    $getProductNamesData = $getProductNames->fetch_assoc();?>
                    <td><?php echo $getProductNamesData['product_name'];?></td>
                    <td><?php echo $row['order_id'];?></td>
                    <td><?php echo $row['item_price'];?></td>
                    <td><?php $orderStatus = getIndividualDetails('lkp_food_order_status','id',$row['lkp_order_status_id']); echo $orderStatus['order_status']; ?></td>                   
                    <td><?php $orderPaymentStatus = getIndividualDetails('lkp_payment_status','id',$row['lkp_payment_status_id']); echo $orderPaymentStatus['payment_status']; ?></td>
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