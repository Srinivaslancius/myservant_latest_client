<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['scid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
      $title = $_POST['title'];
      $description = $_POST['description'];
      $meta_title = $_POST['meta_title'];
      $meta_keywords = $_POST['meta_keywords'];
      $meta_desc = $_POST['meta_desc'];
      $created_at = date("Y-m-d h:i:s");
      $fileToUpload = $_FILES["fileToUpload"]["name"];

      if($_FILES["fileToUpload"]["name"]!='') {

              $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/services_content_pages_images/";
              $target_file = $target_dir . basename($fileToUpload);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('image','services_content_pages','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `services_content_pages` SET title = '$title', description = '$description', image = '$fileToUpload',meta_title = '$meta_title', meta_keywords = '$meta_keywords',meta_desc = '$meta_desc' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='services_content_pages.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='services_content_pages.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      } else {

          $sql = "UPDATE `services_content_pages` SET title = '$title', description = '$description',meta_title = '$meta_title', meta_keywords = '$meta_keywords',meta_desc = '$meta_desc' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='services_content_pages.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='services_content_pages.php?msg=fail'</script>";
          }

      }
  }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Service Content Pages</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getServiceContent = getAllDataWhere('services_content_pages','id',$id);
              $getServiceContentData = $getServiceContent->fetch_assoc(); ?>  
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Title" data-error="Please enter Title" required value="<?php echo $getServiceContentData['title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="category_description" placeholder="Group Description" data-error="Please enter Description." required><?php echo $getServiceContentData['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getServiceContentData['image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter Meta Title" required value="<?php echo $getServiceContentData['meta_title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter Meta Keywords" required value="<?php echo $getServiceContentData['meta_keywords'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" placeholder="Meta Description" data-error="This field is required." required><?php echo $getServiceContentData['meta_desc'];?></textarea>
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