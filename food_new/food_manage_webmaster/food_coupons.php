<?php include_once 'admin_includes/main_header.php';?>
<?php $getFoodCoupons = getAllDataWithActiveRecent('food_coupons'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_food_coupons.php" style="float:right">Add Food Coupons</a>
            <h3 class="m-t-0 m-b-5">Food Coupons</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coupon Code</th>
                    <th>Price Type</th>
                    <th>Discount Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getFoodCoupons->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['coupon_code'];?></td>
                    <td><?php if($row['price_type_id'] == 1) { echo "Price"; } else { echo "Percentage"; }?></td>
                    <td><?php echo $row['discount_price'];?></td>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='food_coupons'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='food_coupons'>In Active</span>" ;} ?></td>
                   <td> <a href="edit_food_coupons.php?coupon_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "food_coupons";?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a></td>
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