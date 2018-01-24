<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['tid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
      $title = $_POST['title'];
      $description = $_POST['description'];
      $lkp_status_id = $_POST['lkp_status_id'];
      $fileToUpload = $_FILES["fileToUpload"]["name"];

      if($_FILES["fileToUpload"]["name"]!='') {

              $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/food_testimonials_images/";
              $target_file = $target_dir . basename($fileToUpload);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('image','food_testimonials','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `food_testimonials` SET title = '$title', description = '$description', image = '$fileToUpload',lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='food_testimonials.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='food_testimonials.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      } else {

          $sql = "UPDATE `food_testimonials` SET title = '$title', description = '$description',lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='services_testimonials.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='services_testimonials.php?msg=fail'</script>";
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
              <?php $getTestimonials = getAllDataWhere('food_testimonials','id',$id);
                    $getTestimonialsData = $getTestimonials->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Title" data-error="Please enter Title" required value="<?php echo $getTestimonialsData['title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img src="<?php echo $base_url . 'uploads/food_testimonials_images/'.$getTestimonialsData['image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="category_description" placeholder="Group Description" data-error="Please enter Description." required><?php echo $getTestimonialsData['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getTestimonialsData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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