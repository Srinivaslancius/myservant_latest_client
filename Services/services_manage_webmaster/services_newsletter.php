<?php include_once 'admin_includes/main_header.php'; error_reporting(0);?>
<?php $getServicesNewletter = getAllData('services_newsletter'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Service New Letter</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServicesNewletter->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                    <td><a href="mailto:<?php echo $row['email'];?>"><i class="zmdi zmdi-email"></i></i></td>
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