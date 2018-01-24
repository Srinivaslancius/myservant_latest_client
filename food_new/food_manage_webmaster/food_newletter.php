<?php include_once 'admin_includes/main_header.php'; error_reporting(0);?>
<?php $getServicesNewletter = "SELECT * FROM food_newsletter ORDER BY id";
$getServicesNewletter1 = $conn->query($getServicesNewletter);
 $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Food News Letter</h3
                      </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Email</th>
                    <th>Created Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServicesNewletter1->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['created_at'];?></td>
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