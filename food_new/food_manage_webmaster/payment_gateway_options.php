<?php include_once 'admin_includes/main_header.php';
$getPaymentGatewayOptions = getAllData('payment_gateway_options'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Payment Gateway</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Payment Gateway</th>
                    <th>Enable Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getPaymentGatewayOptions->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['payment_gateway_option'];?></td>
                    <td><?php if ($row['enable_status']==0) { echo "<span class='label label-outline-success check_payment_gateway open_cursor' data-incId=".$row['id']." data-status=".$row['enable_status']." data-tbname='payment_gateway_options'>Enable</span>" ;} else { echo "<span class='label label-outline-info check_payment_gateway open_cursor' data-status=".$row['enable_status']." data-incId=".$row['id']." data-tbname='payment_gateway_options'>Disable</span>" ;} ?></td>
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
   <script type="text/javascript">
     $(".check_payment_gateway").click(function(){
          var check_active_id = $(this).attr("data-incId");
          var table_name = $(this).attr("data-tbname");
          var current_status = $(this).attr("data-status");
          if(current_status == 0) {
            send_status = 1;
          } else {
            send_status = 0;
          }
          $.ajax({
            type:"post",
            url:"check_payment_gateway.php",
            data:"check_active_id="+check_active_id+"&table_name="+table_name+"&send_status="+send_status,
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