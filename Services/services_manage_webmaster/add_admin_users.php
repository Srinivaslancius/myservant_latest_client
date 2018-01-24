<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(1);
  if (!isset($_POST['submit']))  {
              echo "fail";
          } else  { 
      $admin_name = $_POST['admin_name'];
      $admin_email = $_POST['admin_email'];
      $admin_password = encryptPassword($_POST['admin_password']);
      $created_at = date("Y-m-d h:i:s");
      $lkp_admin_service_type_id = $_POST['lkp_admin_service_type_id'];
      $lkp_admin_user_type_id = $_POST['lkp_admin_user_type_id'];
      $status = $_POST['lkp_status_id'];
      $sql = "INSERT INTO admin_users (`admin_name`, `admin_email`, `admin_password`, `created_at`, `lkp_admin_service_type_id`, `lkp_admin_user_type_id`, `lkp_status_id`) VALUES ('$admin_name', '$admin_email', '$admin_password','$created_at','$lkp_admin_service_type_id','$lkp_admin_user_type_id','$status')";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='admin_users.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='admin_users.php?msg=fail'</script>";
      }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Admin Users</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Admin Name</label>
                    <input type="text" name="admin_name" class="form-control" id="form-control-2" placeholder="Admin Name" data-error="Please enter a valid User Name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="admin_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="user_input" placeholder="Email" data-error="Please enter a valid email address." onkeyup="checkUserAvailTest()" required>
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="admin_users">
                    <input type="hidden" id="column_name" value="admin_email">
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Password</label>
                    <input type="password" name="admin_password" class="form-control" minlength="8" id="form-control-2" placeholder="Password" data-error="Please enter Password(minimum 8 characters)." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getAdminSetviceTypes = getAllDataWhereWithActive('lkp_admin_service_types','id',1);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Admin Service Types</label>
                    <select id="form-control-3" name="lkp_admin_service_type_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a User Types', allowClear: true }">
                      <option value="">Select Admin Service Types</option>
                      <?php while($row = $getAdminSetviceTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['admin_service_type']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getAdminUserTypes = getAllDataWithStatus('lkp_admin_user_types','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Admin User Types</label>
                    <select id="form-control-3" name="lkp_admin_user_type_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a User Types', allowClear: true }">
                      <option value="">Select Admin User Types</option>
                      <?php while($row = $getAdminUserTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['admin_type']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
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