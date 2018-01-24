<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">
<?php  
error_reporting(0);
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  //If success
  //echo "<pre>";print_r($_POST);exit;
  $lkp_state_id = $_POST['lkp_state_id'];
  $lkp_district_id = $_POST['lkp_district_id'];
  $lkp_city_id = $_POST['lkp_city_id'];
  $lkp_status_id = $_POST['lkp_status_id'];
  $pincode = $_POST['pincode'];

  $sql = "INSERT INTO lkp_pincodes (`lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `pincode`, `lkp_status_id`) VALUES ('$lkp_state_id', '$lkp_district_id', '$lkp_city_id', '$pincode', '$lkp_status_id')";
  $result = $conn->query($sql);

  if( $result == 1){
      echo "<script type='text/javascript'>window.location='lkp_pincodes.php?msg=success'</script>";
  } else {
      echo "<script type='text/javascript'>window.location='lkp_pincodes.php?msg=fail'</script>";
  }
  
}
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Pincodes</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form autocomplete="off" data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a State', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select name="lkp_district_id" id="lkp_district_id" class="custom-select " data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select District</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select name="lkp_city_id" id="lkp_city_id" class="custom-select " data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="form-control-2" class="control-label">Pincode</label>
                        <input type="text" name="pincode" class="form-control valid_mobile_num" id="user_input" placeholder="Pincode" data-error="Please enter Pincode" minlength="6" maxlength="6" onkeyup="checkUserAvailTest()" required>
                        <span id="input_status" style="color: red;"></span>
                        <input type="hidden" id="table_name" value="lkp_pincodes">
                        <input type="hidden" id="column_name" value="pincode">
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>

                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
