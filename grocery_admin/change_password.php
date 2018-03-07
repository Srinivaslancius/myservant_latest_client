<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Cosmos</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
        <?php include_once './main_header.php';?>
    </div>
    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
            <?php include_once './side_menu.php';?>
        </div>
      </div>
      <div class="site-right-sidebar">
        <?php include_once './right_slide_toggle.php';?>
      </div>

      <?php 
error_reporting(0);
if (!isset($_POST['submit']))  {
    echo "fail";
} else  { 
    //echo "<pre>"; print_r($_POST); die;  
    $id = $_SESSION["grocery_admin_user_id"];
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Change Password</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Current Password</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="password" name="current_password" class="form-control" id="form-control-2" placeholder="*********" data-error="Please enter Current Password" required>
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">New Password</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="password" name="new_password" class="form-control" id="new_password" minlength="8" placeholder="*********" data-error="Please enter New Password(minimum 8 characters)." required>
                                    <span id="email_status" style="color: red;"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Confirm Password</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="password" name="confirm_password" minlength="8" class="form-control" id="confirm_password" placeholder="*********" data-error="Please enter Confirm Password." onChange="checkPasswordMatch();" required>
                                    <div class="help-block with-errors"></div>
                                    <div id="divCheckPasswordMatch" style="color:red"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            
        </div>
    <?php include_once 'footer.php'; ?>
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
  </body>
</html>