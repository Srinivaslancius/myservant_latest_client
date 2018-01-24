<?php include_once 'admin_includes/main_header.php';


    $serviceOrders = "SELECT * FROM food_orders GROUP BY order_id ORDER BY id DESC"; 
    $getServiceOrderData = $conn->query($serviceOrders);
    $i=1;
?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Orders</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Mobile Number</th>
                    <th>Email Id</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Vendor Confirmation</th>
                    <th>Assign To</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServiceOrderData->fetch_assoc()) { ?>              
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['order_id'];?></td>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php echo $row['mobile'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                    <td><?php $adminServiceTypes = getIndividualDetails('lkp_food_order_status','id',$row['lkp_order_status_id']); echo $adminServiceTypes['order_status']; ?></td>
                    <td><?php if ($row['vendor_order_status']==1) { echo "<span class='label label-outline-success check_active1 open_cursor' data-incId=".$row['id']." style='border-color:#7d57c1;color:#7d57c1' data-status=".$row['vendor_order_status']." data-tbname='food_orders'>Confirm Order</span>" ;} else { echo "<span class='label label-outline-info check_active1 open_cursor' style='border-color:green;color:green'php data-status=".$row['vendor_order_status']." data-incId=".$row['order_id']." data-tbname='food_orders'>Confirmed</span>" ;} ?></td>
                    <?php if($row['vendor_order_status'] != 2) { ?>
                     <td>Assign To</td>
                     <?php } elseif($row['assign_delivery_id'] == '0' || $row['assign_delivery_id'] == '') { ?>
                     <td><a href="assign_to.php?order_id=<?php echo $row['order_id']; ?>">Assign To</a></td>
                     <?php } else { 
                      $getDeliveryBoysNames = getAllDataWhere('food_delivery_boys','id',$row['assign_delivery_id']); $getDeliveryBoysNamesData = $getDeliveryBoysNames->fetch_assoc();
                      ?>
                     <td><a href="assign_to.php?order_id=<?php echo $row['order_id']; ?>"><?php if($getDeliveryBoysNamesData['id'] == $row['assign_delivery_id']) { echo $getDeliveryBoysNamesData['name']; } ?>(Assigned)</a></td>
                    <?php } ?>
                    <td><a href="invoice.php?order_id=<?php echo $row['order_id']; ?>" target="_blank"><i class="zmdi zmdi-eye zmdi-hc-fw"  class=""></i></a>&nbsp;<?php if($row['lkp_order_status_id'] == 5 && $row['lkp_payment_status_id'] == 1) { ?><a href="../../uploads/food_order_invoice/<?php echo $row['order_id']; ?>.pdf" target="_blank"><i class="zmdi zmdi-local-printshop"></i></a><?php } elseif($row['assign_delivery_id'] > '0') { ?> <a href="edit_food_orders.php?order_id=<?php echo $row['order_id']; ?>"><i class="zmdi zmdi-edit"></i></a><?php } ?></td>
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
   <script>
   $(".check_active1").click(function(){
      var check_active_id = $(this).attr("data-incId");
      var current_status = $(this).attr("data-status");
      if(current_status == 1) {
        send_status = 2;
      } else {
        send_status = 1;
      }
      $.ajax({
        type:"post",
        url:"venodr_confirmation.php",
        data:"check_active_id="+check_active_id+"&send_status="+send_status,
        success:function(result){  
          if(result ==1) {
            //alert("Your Status Updated!");
            //location.reload();
            window.location = "?msg=success";
          }
        }
      });
    });
   </script>