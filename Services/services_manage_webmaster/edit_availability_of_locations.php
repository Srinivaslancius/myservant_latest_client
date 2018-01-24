<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">
<?php  
$id = $_GET['id'];

if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success  
    //echo "<pre>"; print_r($_POST); die;
    $service_id = implode(',',$_POST["service_id"]);
    $lkp_state_id = $_POST['lkp_state_id'];
    $lkp_district_id = $_POST['lkp_district_id'];
    $lkp_city_id = $_POST['lkp_city_id'];
    $lkp_pincode_id = implode(',',$_POST["lkp_pincode_id"]);
    $lkp_status_id = $_POST['lkp_status_id'];

    $sql = "UPDATE availability_of_locations SET service_id = '$service_id', lkp_state_id = '$lkp_state_id', lkp_district_id = '$lkp_district_id',lkp_city_id = '$lkp_city_id', pincodes = '$lkp_pincode_id',lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
    if($conn->query($sql) === TRUE){
      echo "<script type='text/javascript'>window.location='availability_of_locations.php?msg=success'</script>";
    } else {
      echo "<script type='text/javascript'>window.location='availability_of_locations.php?msg=fail'</script>";
    }
}
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Available Locations</h3>
          </div>
          <div class="panel-body">
            <?php $getAvailableLocations = getAllDataWhere('availability_of_locations','id',$id);
              $getAvailableLocationsData = $getAvailableLocations->fetch_assoc(); ?>
            <?php $getServiceNames = getAllDataWithStatus('services_category','0');
            $getServiceId = explode(',',$getAvailableLocationsData['service_id']);?>
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Service Name</label>
                    <select name="service_id[]" class="custom-select multi_select" multiple="multiple" data-error="This field is required." required data-plugin="select2">
                      <!-- <option value="">Select Service Name</option> -->
                      <?php while($row1 = $getServiceNames->fetch_assoc()) {  ?>
                          <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == in_array($row1['id'], $getServiceId)) { echo "selected=selected"; } ?> ><?php echo $row1['category_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getAvailableLocationsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getDistrcits = getAllDataWithStatus('lkp_districts','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select id="lkp_district_id" name="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
                      <option value="">Select District</option>
                      <?php while($row = $getDistrcits->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getAvailableLocationsData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                   <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select id="lkp_city_id" name="lkp_city_id" class="custom-select" data-error="This field is required." required  onChange="getPincodes1(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
                      <option value="">Select City</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getAvailableLocationsData['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <span id="lkp_pincode_id1"/></span>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getPincodes = getAllDataWhereWithActive('lkp_pincodes','lkp_city_id',$getAvailableLocationsData['lkp_city_id']);
                  $getPincodeId = explode(',',$getAvailableLocationsData['pincodes']);
                  $checked = "checked"; ?>
                  <div class="form-group pincodes">
                    <h4>Pincodes</h4>
                    <?php while($row1 = $getPincodes->fetch_assoc()) {  ?>
                    <input type="checkbox" value="<?php echo $row1['id']?>" <?php if($row1['id'] == in_array($row1['id'], $getPincodeId)) echo $checked; ?> name="lkp_pincode_id[]" >&nbsp;<?php echo $row1['pincode']; ?>
                    <?php } ?>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getstatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Status</label>
                    <select name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getstatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getAvailableLocationsData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
<?php include_once 'admin_includes/footer.php'; ?>
<script type="text/javascript">
  $(".multi_select").attr("required", "true");
      $(".chosen").chosen();
</script>
<script>
  function getPincodes1(val) { 
        $.ajax({
        type: "POST",
        url: "get_pincodes1.php",
        data:'lkp_city_id='+val,
        success: function(data){
          $(".pincodes").css("display", "none");
          $("#lkp_pincode_id1").html(data);
        }
        });
    }
  </script>