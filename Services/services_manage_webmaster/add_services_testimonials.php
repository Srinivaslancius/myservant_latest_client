<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(1);
  if (!isset($_POST['submit']))  {
              echo "fail";
          } else  { 
      $title = $_POST['title'];
      $email = $_POST['email'];
      $phone_number = $_POST['phone_number'];
      $reason = $_POST['reason'];
      $description = $_POST['description'];
      $created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
      $lkp_status_id = $_POST['lkp_status_id'];
      $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
      if($fileToUpload!='') {

        $target_dir = "../../uploads/services_testimonials_images/";
        $target_file = $target_dir . basename($fileToUpload);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             $sql = "INSERT INTO services_testimonials (`title`,`email`,`phone_number`,`reason`, `description`, `image`, `lkp_status_id`, `created_at`) VALUES ('$title','$email','$phone_number','$reason', '$description','$fileToUpload', 1, '$created_at')";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='services_testimonials.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='services_testimonials.php?msg=fail'</script>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

      }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Testimonials</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter Title" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="form-control-2" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control valid_mobile_num" id="form-control-2" placeholder="Phone Number" required maxlength="10" pattern="[0-9]{10}">
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getFeedReasons = getAllDataWithStatus('services_customer_feedback_reasons','0');?>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose reason</label>
                    <select name="reason" class="form-control" required>
                      <option value="">Select reason</option>
                      <?php while($row = $getFeedReasons->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['title']; ?>" ><?php echo $row['title']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" required>
                      </label> (width : 75px ; height : 75px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="category_description" placeholder="Group Description" data-error="Please enter Description." required></textarea>
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