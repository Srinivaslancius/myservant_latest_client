<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">
<?php  
$id = $_GET['bid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $lkp_banner_type_id = $_POST['lkp_banner_type_id'];   
    $title = $_POST['title'];
    $lkp_status_id = $_POST['lkp_status_id'];
    $fileToUpload = $_FILES["fileToUpload"]["name"];

    if($lkp_banner_type_id == 2) {
      $service_category_id = "0";
    } else {
      $service_category_id = $_POST['service_category_id'];
    }
  

    if($_FILES["fileToUpload"]["name"]!='' && $_FILES["fileToUpload1"]["name"]!='') {

              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/services_banner_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('banner','services_banners','id',$id,$target_dir);

              $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
              $target_dir1 = "../../uploads/services_banner_app_images/";
              $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
              $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
              $getImgUnlink1 = getImageUnlink('app_image','services_banners','id',$id,$target_dir1);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1);
                    $sql = "UPDATE `services_banners` SET title = '$title',banner = '$fileToUpload',app_image ='$fileToUpload1',lkp_banner_type_id = '$lkp_banner_type_id',service_category_id = '$service_category_id', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='services_banners.php?msg=success'</script>";
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
              $target_dir = "../../uploads/services_banner_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('banner','services_banners','id',$id,$target_dir);


              move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
              
                    $sql = "UPDATE `services_banners` SET title = '$title',banner = '$fileToUpload', lkp_banner_type_id = '$lkp_banner_type_id',service_category_id = '$service_category_id', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='services_banners.php?msg=success'</script>";
                } else {
                echo "<script type='text/javascript'>window.location='services_banners.php?msg=fail'</script>";
                } 
              
      }
      elseif($_FILES["fileToUpload1"]["name"]!=''){
        
              $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
              $target_dir1 = "../../uploads/services_banner_app_images/";
              $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
              $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
              $getImgUnlink1 = getImageUnlink('app_image','services_banners','id',$id,$target_dir1);


              move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1);
              
                    $sql = "UPDATE `services_banners` SET title = '$title',app_image ='$fileToUpload1', lkp_banner_type_id = '$lkp_banner_type_id',service_category_id = '$service_category_id', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='services_banners.php?msg=success'</script>";
                } else {
                echo "<script type='text/javascript'>window.location='services_banners.php?msg=fail'</script>";
                } 
              
      }
       else {

          $sql = "UPDATE `services_banners` SET title = '$title',lkp_banner_type_id = '$lkp_banner_type_id',service_category_id = '$service_category_id', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='services_banners.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='services_banners.php?msg=fail'</script>";
          }

      }
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Banners</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getBanners = getAllDataWhere('services_banners','id',$id);
              $getBannersData = $getBanners->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" data-error="Please enter a Title" required value="<?php echo $getBannersData['title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Banner&nbsp;&nbsp;&nbsp;</label>
                    <img src="<?php echo $base_url . 'uploads/services_banner_images/'.$getBannersData['banner'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label> (width : 1800px ; height : 400px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">App Image</label>
                    <img src="<?php echo $base_url . 'uploads/services_banner_app_images/'.$getBannersData['app_image'] ?>"  id="output1" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload1" id="fileToUpload1"  onchange="loadFile1(event)"  multiple="multiple" >
                      </label> (width : 550px ; height : 200px) 
                  </div>
                  <?php $getBannerTypes = getAllDataWithStatus('lkp_banner_types','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Banner Types</label>
                      <div class="radio">
                        <?php while($getBannerTypes1 = $getBannerTypes->fetch_assoc()) {  ?>
                        <label>
                          <input name="lkp_banner_type_id" id="lkp_banner_type_id" value="<?php echo $getBannerTypes1['id']; ?>" type="radio" <?php if($getBannersData['lkp_banner_type_id']  == $getBannerTypes1['id']){ echo "checked=checked"; }?> required><?php echo $getBannerTypes1['banner_type']; ?>
                        </label>
                        <?php } ?>
                      </div>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getServicesCategories = getAllDataWithStatus('services_category','0');?>
                  <div class="form-group" id="service_category_id">
                    <label for="form-control-3" class="control-label">Choose your Services Categories</label>
                    <select id="form-control-3" name="service_category_id" class="custom-select check_valid_cust" data-error="This field is required." data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select Services Categories</option>
                      <?php while($row = $getServicesCategories->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getBannersData['service_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getBannersData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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

    if ($("#lkp_banner_type_id").is(":checked")) {
          $("#service_category_id").show();
          $(".check_valid_cust").attr("required", "true");
      } else {
          $("#service_category_id").hide();
          $('.check_valid_cust').removeAttr('required');
      }
      
    $("input[name='lkp_banner_type_id']").click(function () {
      if ($("#lkp_banner_type_id").is(":checked")) {
          $("#service_category_id").show();
          $(".check_valid_cust").attr("required", "true");
      } else {
          $("#service_category_id").hide();
          $('.check_valid_cust').removeAttr('required');
      }
    });
  });
</script>
<script type="text/javascript">
      $(".chosen").chosen();
</script>