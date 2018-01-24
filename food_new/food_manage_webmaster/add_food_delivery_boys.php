<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  //If success
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $experience = $_POST['experience'];
  $type = $_POST['type'];
  $lkp_status_id = $_POST['lkp_status_id'];
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $created_at = date("Y-m-d h:i:s");
  
  //if($fileToUpload!='') {

    $target_dir = "../../uploads/food_deliveryboys_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $sql = "INSERT INTO food_delivery_boys (`name`, `email`,`mobile`,`identity_proof_image`,`address`,`experience`,`lkp_status_id`,`type`,`created_at`) VALUES ('$name', '$email', '$mobile','$fileToUpload', '$address','$experience','$lkp_status_id','$type','$created_at')";
        if($conn->query($sql) === TRUE){
           echo "<script type='text/javascript'>window.location='food_delivery_boys.php?msg=success'</script>";
        } else {
           echo "<script type='text/javascript'>window.location='food_delivery_boys.php?msg=fail'</script>";
        }
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

  //}
  
}
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Food Delivery Boys</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter Name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="user_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" placeholder="Email" onkeyup="checkemail();" data-error="Please enter valid email address." required>
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="form-control-2" placeholder="Mobile" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Address</label>
                    <textarea name="address" id="address" class="form-control"  placeholder="Address" data-error="This field is required." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Experience</label>
                    <input type="text" name="experience" class="form-control" id="form-control-2" placeholder="Experience" data-error="Please enter Experience" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Type</label>
                    <select id="type" name="type" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Price Type</option>
                        <option value="1">Own</option>
                        <option value="2">Others</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Identity Proof Image</label>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" required >
                      </label>
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
<!-- Script for display category based on banner type -->
<script type="text/javascript">
  $(document).ready(function () {
    $("input[name='lkp_banner_type_id']").click(function () {
      if ($("#lkp_banner_type_id").is(":checked")) {
          $("#food_category_id").show();
      } else {
          $("#food_category_id").hide();
      }
    });
  });
</script>