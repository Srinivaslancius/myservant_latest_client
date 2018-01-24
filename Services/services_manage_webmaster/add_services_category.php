<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  //If success
  $category_name = $_POST['category_name'];
  $category_description = $_POST['category_description'];
  $category_position = $_POST['category_position'];
  $meta_title = $_POST['meta_title'];
  $meta_keywords = $_POST['meta_keywords'];
  $meta_desc = $_POST['meta_desc'];
  $lkp_status_id = $_POST['lkp_status_id'];
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
  
  if($fileToUpload!='' && $fileToUpload1!='') {

    $target_dir = "../../uploads/services_category_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $target_dir1 = "../../uploads/services_category_app_images/";
    $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
    $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1);
        $sql = "INSERT INTO services_category (`category_name`, `category_description`,`category_image`,`app_image`,`category_position`, `meta_title`, `meta_keywords`, `meta_desc`, `lkp_status_id`) VALUES ('$category_name', '$category_description','$fileToUpload','$fileToUpload1' ,'$category_position', '$meta_title', '$meta_keywords', '$meta_desc', '$lkp_status_id')"; 
        if($conn->query($sql) === TRUE){
           echo "<script type='text/javascript'>window.location='services_category.php?msg=success'</script>";
        } else {
           echo "<script type='text/javascript'>window.location='services_category.php?msg=fail'</script>";
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
            <h3 class="m-y-0">Categories</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" id="form-control-2" placeholder="Category Name" data-error="Please enter Category Name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Category Image</label>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" required >
                      </label> (Width : 150 px ; height : 150 px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">App Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <img id="output1" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload1" id="fileToUpload1"  onchange="loadFile1(event)"  multiple="multiple" required >
                      </label> (width : 90px ; height : 90px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Category Description</label>
                    <textarea name="category_description" class="form-control" id="category_description" placeholder="Category Description" data-error="Please enter Category Description." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Category Position</label>
                    <input type="text" name="category_position" class="form-control valid_mobile_num" id="user_input" placeholder="Category Position" data-error="Please enter Category Position" required onblur="checkUserAvailTest()">
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="services_category">
                    <input type="hidden" id="column_name" value="category_position">
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter Meta Title" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter Meta Keywords" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" placeholder="Description" data-error="This field is required." required></textarea>
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
