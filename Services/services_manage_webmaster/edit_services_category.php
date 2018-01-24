<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['cid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];
    $category_position = $_POST['category_position'];
    $meta_title = $_POST['meta_title'];
    $meta_keywords = $_POST['meta_keywords'];
    $meta_desc = $_POST['meta_desc'];
    $lkp_status_id = $_POST['lkp_status_id'];
    

    if($_FILES["fileToUpload"]["name"]!='' && $_FILES["fileToUpload1"]["name"]!='') {

              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/services_category_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('category_image','services_category','id',$id,$target_dir);

              $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
              $target_dir1 = "../../uploads/services_category_app_images/";
              $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
              $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
              $getImgUnlink1 = getImageUnlink('app_image','services_category','id',$id,$target_dir1);

                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1);
                    $sql = "UPDATE `services_category` SET category_name = '$category_name', category_description = '$category_description', category_position = '$category_position',category_image = '$fileToUpload',app_image ='$fileToUpload1',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='services_category.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='services_category.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      }
      elseif($_FILES["fileToUpload"]["name"]!=''){
              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/services_category_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('category_image','services_category','id',$id,$target_dir);


              move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
              
                    $sql = "UPDATE `services_category` SET category_name = '$category_name', category_description = '$category_description', category_position = '$category_position',category_image = '$fileToUpload',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='services_category.php?msg=success'</script>";
                } else {
                echo "<script type='text/javascript'>window.location='services_category.php?msg=fail'</script>";
                } 
              
      }
      elseif ( $_FILES["fileToUpload1"]["name"]!='') {

              $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
              $target_dir1 = "../../uploads/services_category_app_images/";
              $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
              $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
              $getImgUnlink1 = getImageUnlink('app_image','services_category','id',$id,$target_dir1);

              move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1);
                
                    $sql = "UPDATE `services_category` SET category_name = '$category_name', category_description = '$category_description', category_position = '$category_position',app_image ='$fileToUpload1',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                    echo "<script type='text/javascript'>window.location='services_category.php?msg=success'</script>";
                    } else {
                    echo "<script type='text/javascript'>window.location='services_category.php?msg=fail'</script>";
                    } 
              
      }
       else {

          $sql = "UPDATE `services_category` SET category_name = '$category_name', category_description = '$category_description', category_position = '$category_position',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='services_category.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='services_category.php?msg=fail'</script>";
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
              <?php $getCategories = getAllDataWhere('services_category','id',$id);
              $getCategoriesData = $getCategories->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" id="form-control-2" data-error="Please enter a Category Name" required value="<?php echo $getCategoriesData['category_name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Category Image</label>
                    <img src="<?php echo $base_url . 'uploads/services_category_images/'.$getCategoriesData['category_image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label> (Width : 150 px ; height : 150 px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">App Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <img src="<?php echo $base_url . 'uploads/services_category_app_images/'.$getCategoriesData['app_image'] ?>"  id="output1" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload1" id="fileToUpload1"  onchange="loadFile1(event)"  multiple="multiple" >
                      </label> (width : 90px ; height : 90px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Category Description</label>
                    <textarea name="category_description" class="form-control" id="category_description" data-error="This field is required." required><?php echo $getCategoriesData['category_description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Category Position</label>
                    <input type="text" name="category_position" class="form-control valid_mobile_num" id="user_input" data-error="Please enter a Category Position" required value="<?php echo $getCategoriesData['category_position'];?>" onblur="checkUserAvailTest()">
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="services_category">
                    <input type="hidden" id="column_name" value="category_position">
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" data-error="Please enter a Meta Title" required value="<?php echo $getCategoriesData['meta_title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" data-error="Please enter a Meta Keywords" required value="<?php echo $getCategoriesData['meta_keywords'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" data-error="This field is required." required><?php echo $getCategoriesData['meta_desc'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getCategoriesData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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