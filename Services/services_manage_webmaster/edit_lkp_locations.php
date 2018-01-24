<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">
<?php  
error_reporting(0);
$lkp_pincode_id = $_GET['lkp_pincode_id'];
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
  //echo "<pre>"; print_r($_POST); die;

  //$i = 0;
  $count = count($_POST['location_name']);
  for($i=0;$i<$count;$i++) {
    $location_name = $_POST['location_name'][$i];
    $id = $_POST['location_id'][$i];
    $sql = "UPDATE lkp_locations SET lkp_state_id = '$lkp_state_id',lkp_district_id ='$lkp_district_id',lkp_city_id ='$lkp_city_id',lkp_pincode_id ='$lkp_pincode_id',location_name = '$location_name' WHERE id = '$id' ";
    $res = $conn->query($sql);
    //$i++;
  }
  

    if($res === TRUE){
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

              <?php 
              $getDistricts = getAllDataWhere('lkp_locations','id',$lkp_pincode_id);
          
              $getLocationsData = $getDistricts->fetch_assoc(); ?>

              <?php $sql = "SELECT * FROM lkp_locations WHERE lkp_pincode_id = $lkp_pincode_id";
               $getLocations = $conn->query($sql);
              $getLocationsData = $getLocations->fetch_assoc(); ?>

              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a State', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getDistrcits = getAllDataWithStatus('lkp_districts','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select id="lkp_district_id" name="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select District</option>
                      <?php while($row = $getDistrcits->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select id="lkp_city_id" name="lkp_city_id" class="custom-select" data-error="This field is required." required  onChange="getPincodes(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getPincodes = getAllDataWithStatus('lkp_pincodes','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Pincode</label>
                    <select id="lkp_pincode_id" name="lkp_pincode_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a Pincode', allowClear: true }">
                      <option value="">Select Pincode</option>
                      <?php while($row = $getPincodes->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_pincode_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['pincode']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getAllLocations = getAllDataWhere('lkp_locations','lkp_pincode_id',$lkp_pincode_id); ?>
                  <div class="row">
                    <?php while($row = $getAllLocations->fetch_assoc()) {  ?>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="form-control-2" class="control-label">Location Name</label>
                        <input type="hidden" name="location_id[]" value="<?php  echo $row['id'] ;?>">
                        <input type="text" name="location_name[]" class="form-control" id="user_input" placeholder="Location Name" data-error="Please enter Location Name" required value="<?php echo $row['location_name'];?>"><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active1 open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='lkp_locations'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active1 open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='lkp_locations'>In Active</span>" ;} ?>
                        <span id="input_status" style="color: red;"></span>
                        <input type="hidden" id="table_name" value="lkp_locations">
                        <input type="hidden" id="column_name" value="location_name">
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <?php } ?>
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
  $(".chosen").chosen();
  //check status active or not
    $(".check_active1").click(function(){
      var check_active_id = $(this).attr("data-incId");
      var table_name = $(this).attr("data-tbname");
      var current_status = $(this).attr("data-status");
      if(current_status == 0) {
        send_status = 1;
      } else {
        send_status = 0;
      }
      $.ajax({
        type:"post",
        url:"changestatus.php",
        data:"check_active_id="+check_active_id+"&table_name="+table_name+"&send_status="+send_status,
        success:function(result){  
          if(result ==1) {
            //alert("Your Status Updated!");
            //location.reload();
            window.location = "edit_lkp_locations.php?lkp_pincode_id=<?php echo $lkp_pincode_id; ?>&msg=success";
          }
        }
      });
    }); 
</script>