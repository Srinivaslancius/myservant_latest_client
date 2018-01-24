<?php include_once 'admin_includes/main_header.php'; ?>
<?php 
error_reporting(0);
if (!isset($_POST['submit']))  {
    echo "fail";
} else  { 
    //echo "<pre>"; print_r($_POST); die;  
    $id = $_SESSION["services_admin_user_id"];
    $sql = "SELECT * FROM admin_users WHERE id = '$id'";
    $result = $conn->query($sql);
    $getAdminUserPwd = $result->fetch_assoc();

    if($_POST['current_password'] == decryptPassword($getAdminUserPwd['admin_password'])){
        
        $sql1 = "UPDATE admin_users SET admin_password = '" . encryptPassword($_POST["confirm_password"]) . "' WHERE  id = '$id'";
        if($conn->query($sql1) === TRUE){                
            echo "<script>alert('Password Changed Successfully');window.location.href='dashboard.php';</script>";
        }          
    } else {  
        echo "<script>alert('Current Password is not Correct');window.location.href='change_password.php';</script>";
    }
}
?>
<div class="site-content">
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Change Password</h3>
        </div>
        <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" id="form-control-2" placeholder="*********" data-error="Please enter Current Password" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" id="new_password" minlength="8" placeholder="*********" data-error="Please enter New Password(minimum 8 characters)." required>
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Confirm Password</label>
                    <input type="password" name="confirm_password" minlength="8"class="form-control" id="confirm_password" placeholder="*********" data-error="Please enter Confirm Password." onChange="checkPasswordMatch();" required>
                    <div class="help-block with-errors"></div>
                    <div id="divCheckPasswordMatch" style="color:red"></div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'admin_includes/footer.php'; ?>
<script>
function checkPasswordMatch() {
    var password = $("#new_password").val();
    var confirmPassword = $("#confirm_password").val();
    if (confirmPassword != password) {
        $("#divCheckPasswordMatch").html("Passwords do not match!");
        $("#confirm_password").val("");
    } else {
        $("#divCheckPasswordMatch").html("");
    }
}
</script>