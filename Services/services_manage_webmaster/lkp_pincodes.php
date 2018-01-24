<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getPincodes = getAllDataWithActiveRecent('lkp_pincodes'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_lkp_pincodes.php" style="float:right">Add Pincodes</a>
            <h3 class="m-t-0 m-b-5">Pincodes</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>State Name</th>
                    <th>District Name</th>
                    <th>City Name</th>
                    <th>Pincode</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getPincodes->fetch_assoc()) { ?>
                  <tr>
                   <td><?php echo $i;?></td>
                   <td><?php $getStates = getAllData('lkp_states'); while($getStatesData = $getStates->fetch_assoc()) { if($row['lkp_state_id'] == $getStatesData['id']) { echo $getStatesData['state_name']; } } ?></td>
                   <td><?php $getDistricts = getAllData('lkp_districts'); while($getDistrictsData = $getDistricts->fetch_assoc()) { if($row['lkp_district_id'] == $getDistrictsData['id']) { echo $getDistrictsData['district_name']; } } ?></td>
                   <td><?php $getCities = getAllData('lkp_cities'); while($getCitiesData = $getCities->fetch_assoc()) { if($row['lkp_city_id'] == $getCitiesData['id']) { echo $getCitiesData['city_name']; } } ?></td>
                   <td><?php echo $row['pincode']; ?></td>
                   <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='lkp_pincodes'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='lkp_pincodes'>In Active</span>" ;} ?></td>
                   <td> <a href="edit_lkp_pincodes.php?pincode_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a>  &nbsp; <!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "lkp_pincodes" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
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