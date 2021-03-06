<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">

<?php  
error_reporting(0);
$id = $_GET['districtid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $lkp_state_id = $_POST['lkp_state_id'];
    $district_name = $_POST['district_name'];
    $lkp_status_id = $_POST['lkp_status_id'];

      $sql = "UPDATE `lkp_districts` SET lkp_state_id = '$lkp_state_id', district_name = '$district_name', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='lkp_districts.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='lkp_districts.php?msg=fail'</script>";
      }
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Districts</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getDistricts = getAllDataWhere('lkp_districts','id',$id);
              $getDistrictsData = $getDistricts->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select id="form-control-3" name="lkp_state_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a State', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getDistrictsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">District Name</label>
                    <input type="text" name="district_name" class="form-control" id="user_input" data-error="Please enter a District Name" required onkeyup="checkUserAvailTest()" value="<?php echo $getDistrictsData['district_name'];?>">
                     <span id="input_status" style="color: red;"></span>
                    <input type="hidden" id="table_name" value="lkp_districts">
                    <input type="hidden" id="column_name" value="district_name">
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getDistrictsData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
