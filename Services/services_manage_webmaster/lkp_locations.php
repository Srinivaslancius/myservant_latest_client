<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$getLocations = "SELECT * FROM lkp_locations GROUP BY lkp_pincode_id ORDER BY id DESC";
$getLocationsData = $conn->query($getLocations); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_lkp_locations.php" style="float:right">Add Locations</a>
            <h3 class="m-t-0 m-b-5">Locations</h3>
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
                    <th>Locations</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getLocationsData->fetch_assoc()) { ?>
                  <tr>
                   <td><?php echo $i;?></td>
                   <td><?php $getStates = getAllData('lkp_states'); while($getStatesData = $getStates->fetch_assoc()) { if($row['lkp_state_id'] == $getStatesData['id']) { echo $getStatesData['state_name']; } } ?></td>
                   <td><?php $getDistricts = getAllData('lkp_districts'); while($getDistrictsData = $getDistricts->fetch_assoc()) { if($row['lkp_district_id'] == $getDistrictsData['id']) { echo $getDistrictsData['district_name']; } } ?></td>
                   <td><?php $getCities = getAllData('lkp_cities'); while($getCitiesData = $getCities->fetch_assoc()) { if($row['lkp_city_id'] == $getCitiesData['id']) { echo $getCitiesData['city_name']; } } ?></td>
                   <td><?php $getPincodes = getAllData('lkp_pincodes'); while($getPincodesData = $getPincodes->fetch_assoc()) { if($row['lkp_pincode_id'] == $getPincodesData['id']) { echo $getPincodesData['pincode']; } } ?></td>
                   <?php $Locations = "SELECT * FROM lkp_locations WHERE lkp_pincode_id = '".$row['lkp_pincode_id']."'";
                    $locationNames = $conn->query($Locations); ?>
                   <td><?php $location = ""; while ($row1 = $locationNames->fetch_assoc()) { $location .= $row1['location_name'].','; } echo rtrim(wordwrap($location,40,"<br />\n"),",");?></td>
                   <td> <a href="edit_lkp_locations.php?lkp_pincode_id=<?php echo $row['lkp_pincode_id']; ?>"><i class="zmdi zmdi-edit"></i></a>  &nbsp; <!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "lkp_locations" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
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