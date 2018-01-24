<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['sid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $food_category_id = $_POST['food_category_id'];
    $sub_category_name = $_POST['sub_category_name'];
    $sub_category_description = $_POST['sub_category_description'];
    $meta_title = $_POST['meta_title'];
    $meta_keywords = $_POST['meta_keywords'];
    $meta_desc = $_POST['meta_desc'];
    $lkp_status_id = $_POST['lkp_status_id'];
    $fileToUpload = $_FILES["fileToUpload"]["name"];

    if($_FILES["fileToUpload"]["name"]!='') {

              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/food_sub_category_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('sub_category_image','food_sub_category','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `food_sub_category` SET food_category_id = '$food_category_id', sub_category_name = '$sub_category_name', sub_category_description = '$sub_category_description',sub_category_image = '$fileToUpload',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='food_sub_category.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='food_sub_category.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      } else {

          $sql = "UPDATE `food_sub_category` SET food_category_id = '$food_category_id', sub_category_name = '$sub_category_name', sub_category_description = '$sub_category_description',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='food_sub_category.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='food_sub_category.php?msg=fail'</script>";
          }

      }
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Sub Categories</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getSubCategories = getAllDataWhere('food_sub_category','id',$id);
              $getSubCategoriesData = $getSubCategories->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getServicesCategories = getAllDataWithStatus('food_category','0');?>
                  <div class="form-group" id="service_category_id">
                    <label for="form-control-3" class="control-label">Choose your Services Categories</label>
                    <select id="form-control-3" name="food_category_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Services Categories</option>
                      <?php while($row = $getServicesCategories->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getSubCategoriesData['food_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Sub Category Name</label>
                    <input type="text" name="sub_category_name" class="form-control" id="form-control-2" data-error="Please enter a Sub Category Name" required value="<?php echo $getSubCategoriesData['sub_category_name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Sub Category Image</label>
                    <img src="<?php echo $base_url . 'uploads/food_sub_category_images/'.$getSubCategoriesData['sub_category_image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Sub Category Description</label>
                    <textarea name="sub_category_description" class="form-control" id="category_description" data-error="This field is required." required><?php echo $getSubCategoriesData['sub_category_description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" data-error="Please enter a Meta Title" required value="<?php echo $getSubCategoriesData['meta_title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" data-error="Please enter a Meta Keywords" required value="<?php echo $getSubCategoriesData['meta_keywords'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" data-error="This field is required." required><?php echo $getSubCategoriesData['meta_desc'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getSubCategoriesData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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