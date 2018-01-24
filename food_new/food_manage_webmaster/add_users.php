<?php include_once 'admin_includes/main_header.php'; ?>
<?php 
  error_reporting(0);
    const MIN_VALUE = 0.0; 
  if (!isset($_POST['submit']))  {
    //If fail
    echo "fail";
  } else  { 
      // //If success
    //echo "<pre>";print_r($_POST);
    $name = $_POST['user_full_name'];
    $email = $_POST['user_email'];
    $mobile = $_POST['user_mobile'];
    $password = encryptPassword($_POST['user_password']);
    $created_admin_id = $_SESSION['services_admin_user_id'];
    $otp = $_POST['otp'];
    $lkp_status_id = $_POST['lkp_status_id'];
    $login_count = $_POST['login_count'];
    $last_login_visit = $_POST['last_login_visit'];
    $lkp_register_device_type_id = $_POST['lkp_register_device_type_id'];
    $mobile_token = MIN_VALUE;
    $created_at = date("Y-m-d h:i:s");
      $sql = saveUser($name, $email, $mobile, $password,$created_admin_id,$otp,$lkp_status_id,$login_count,$last_login_visit,$lkp_register_device_type_id,$mobile_token);
    if ($sql) {
       echo "<script type='text/javascript'>window.location='users.php?msg=success'</script>";
    } else {
       echo "<script type='text/javascript'>window.location='users.php?msg=fail'</script>";
    }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Users</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="user_full_name" class="form-control" id="form-control-2" placeholder="User Name" data-error="Please enter Name" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="user_email" class="form-control" id="user_email" placeholder="Email" onkeyup="checkemail();" data-error="Please enter valid email address." required>
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Password</label>
                    <input type="password" name="user_password" class="form-control" id="form-control-2" placeholder="Password" data-error="Please enter Password." required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="user_mobile" class="form-control" id="form-control-2" placeholder="Mobile" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)">
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

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">OTP</label>
                    <input type="text" name="otp" class="form-control" id="form-control-2" placeholder="OTP" data-error="Please enter OTP" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Log In Count</label>
                    <input type="text" name="login_count" class="form-control" id="form-control-2" placeholder="Log In Count" data-error="Please enter Log In Count" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Last Login Visit</label>
                    <input type="text" name="last_login_visit" class="form-control" id="last_login_visit" placeholder="Last Login Visit" data-error="Please enter Last Login Visit" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getRegisterDeviceTypes = getAllData('lkp_register_device_types');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Register Device Type</label>
                    <select id="form-control-3" name="lkp_register_device_type_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Register Device Type</option>
                      <?php while($row = $getRegisterDeviceTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['user_type']; ?></option>
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