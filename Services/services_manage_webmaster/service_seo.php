<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getServiceSeoData = getAllDataWithActiveRecent('service_seo'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_service_seo.php" style="float:right">Add Service Seo</a>
            <h3 class="m-t-0 m-b-5">Service Seo</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Page Name</th>
                    <th>Meta Title</th>
                    <th>Meta Keywords</th>
                    <th>Meta Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServiceSeoData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['page_name'];?></td>
                    <td><?php echo $row['meta_title'];?></td>
                    <td><?php echo $row['meta_keywords'];?></td>
                    <td><?php echo substr(strip_tags($row['meta_description']), 0,150);?></td>
                   <td> <a href="edit_service_seo.php?sseoid=<?php echo $row['id']; ?>">edit</a></td>
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