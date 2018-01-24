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
  $lkp_pincode_id = $_POST['lkp_pincode_id'];
  $lkp_status_id = $_POST['lkp_status_id'];

    
      $location_name = $_REQUEST['location_name'];
      foreach($location_name as $key=>$value){
        if(!empty($value)) {
          $location_name = $_REQUEST['location_name'][$key];    
          $sql = "INSERT INTO lkp_locations (`lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `lkp_pincode_id`, `location_name`, `lkp_status_id`) VALUES ('$lkp_state_id', '$lkp_district_id', '$lkp_city_id', '$lkp_pincode_id', '$location_name', '$lkp_status_id')";
          $result = $conn->query($sql);
      }
    }
    

    if( $result == 1){
        echo "<script type='text/javascript'>window.location='lkp_locations.php?msg=success'</script>";
    } else {
        echo "<script type='text/javascript'>window.location='lkp_locations.php?msg=fail'</script>";
    }
  
}
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Locations</h3>
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
                    <select name="lkp_district_id" id="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select District</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select name="lkp_city_id" id="lkp_city_id" class="custom-select" data-error="This field is required." required onChange="getPincodes(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Pincode</label>
                    <select name="lkp_pincode_id" id="lkp_pincode_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a Pincode', allowClear: true }">
                      <option value="">Select Pincode</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="clear_fix"></div>
                  <div class="input_fields_container">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="form-control-2" class="control-label">Location Name</label>
                          <input type="text" name="location_name[]" class="form-control" id="user_input" placeholder="Location Name" data-error="Please enter Location Name" onkeyup="checkUserAvailTest()" required>
                          <span id="input_status" style="color: red;"></span>
                          <input type="hidden" id="table_name" value="lkp_locations">
                          <input type="hidden" id="column_name" value="location_name">
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="form-control-2" class="control-label"></label>
                          <button type="button" class="btn btn-primary add_more_button" style="top:24px;">Add More Fields</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clear_fix"></div>

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
    <script>
        $(document).ready(function() {
        var max_fields_limit      = 10; //set limit for maximum input fields
        var x = 1; //initialize counter for text box
        $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
            e.preventDefault();
            if(x < max_fields_limit){ //check conditions
                x++; //counter increment
                $('.input_fields_container').append('<div><div class="row"><div class="col-sm-6"><div class="form-group"><label for="form-control-2" class="control-label">Location Name</label><input type="text" name="location_name[]" class="form-control" id="user_input" placeholder="Location Name" onkeyup="checkUserAvailTest()"><span id="input_status" style="color: red;"></span><input type="hidden" id="table_name" value="lkp_locations"><input type="hidden" id="column_name" value="location_name"></div></div><a href="#" class="remove_field btn btn-primary" style="margin-left:20px; top:20px;">Remove</a></div></div>'); //add input field
            }
        });  
        $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>
