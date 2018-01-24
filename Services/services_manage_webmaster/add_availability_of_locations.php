<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">

<?php
  error_reporting(1);
  if (!isset($_POST['submit']))  {
    echo "fail";
  } else  {
    //echo "<pre>";print_r($_POST);  exit;
    $service_id = implode(',',$_POST['service_id']);
    $lkp_state_id = $_POST['lkp_state_id'];
    $lkp_district_id = $_POST['lkp_district_id'];
    $lkp_city_id = $_POST["lkp_city_id"];
    $lkp_pincode_id = implode(',',$_POST['lkp_pincode_id']);
    $status = $_POST['lkp_status_id'];
    
    $sql = "INSERT INTO availability_of_locations (`service_id`, `lkp_state_id`, `lkp_district_id`,`lkp_city_id`, `pincodes`,`lkp_status_id`) VALUES ('$service_id', '$lkp_state_id', '$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$status')";
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
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <?php $getServiceNames = getAllDataWithStatus('services_category','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Service Name</label>
                    <select name="service_id[]" class="custom-select multi_select" multiple="multiple" data-error="This field is required." required data-plugin="select2">
                      <!-- <option value="">Select Service Name</option> -->
                      <?php while($row = $getServiceNames->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
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
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select name="lkp_district_id" id="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select District</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select name="lkp_city_id" id="lkp_city_id" class="custom-select" data-error="This field is required." required onChange="getPincodes1(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <span id="lkp_pincode_id"/></span>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['status']; ?></option>
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
<script>
  $(".multi_select").attr("required", "true");
  function getPincodes1(val) { 
        $.ajax({
        type: "POST",
        url: "get_pincodes1.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
  </script>
