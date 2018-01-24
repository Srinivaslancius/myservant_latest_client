<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getAvailableLocations = getAllDataWithActiveRecent('food_availability_of_locations'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_availability_of_locations.php" style="float:right">Add Available Locations</a>
            <h3 class="m-t-0 m-b-5">Available Locations</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>State</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getAvailableLocations->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <?php $getStateNames = getIndividualDetails('lkp_states','id',$row['lkp_state_id']); ?>
                    <td><?php echo $getStateNames['state_name'];?></td>
                    <?php $getStateNames = getIndividualDetails('lkp_districts','id',$row['lkp_district_id']); ?>
                    <td><?php echo $getStateNames['district_name'];?></td>
                    <?php $getCityNames = getIndividualDetails('lkp_cities','id',$row['lkp_city_id']); ?>
                    <td><?php echo $getCityNames['city_name'];?></td>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='food_availability_of_locations'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='food_availability_of_locations'>In Active</span>" ;} ?></td>
                   <td> <a href="edit_availability_of_locations.php?id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
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