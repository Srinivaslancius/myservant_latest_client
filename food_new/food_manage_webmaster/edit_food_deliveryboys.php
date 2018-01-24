<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['bid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $experience = $_POST['experience'];
  $type = $_POST['type'];
  $lkp_status_id = $_POST['lkp_status_id'];
  $fileToUpload = $_FILES["fileToUpload"]["name"];

    if($_FILES["fileToUpload"]["name"]!='') {

              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/food_deliveryboys_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('identity_proof_image','food_delivery_boys','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE food_delivery_boys SET name = '$name', identity_proof_image = '$fileToUpload',email = '$email',mobile = '$mobile', lkp_status_id='$lkp_status_id' , address= '$address', experience = '$experience',type= '$type' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='food_delivery_boys.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='food_delivery_boys.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      } else {

          $sql = "UPDATE food_delivery_boys SET name = '$name', email = '$email',mobile = '$mobile', lkp_status_id='$lkp_status_id' , address= '$address', experience = '$experience',type= '$type' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='food_delivery_boys.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='food_delivery_boys.php?msg=fail'</script>";
          }

      }
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Food Delivery boys</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getAllFoodDeliveryBoys = getAllDataWhere('food_delivery_boys','id',$id);
              $getFoodDeliveryBoys = $getAllFoodDeliveryBoys->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" data-error="Please enter a Name" required value="<?php echo $getFoodDeliveryBoys['name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" id="form-control-2" placeholder="Email" data-error="Please enter a valid email address." required value="<?php echo $getFoodDeliveryBoys['email'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="form-control-2" placeholder="Mobile" data-error="Please enter Correct Mobile Number." required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getFoodDeliveryBoys['mobile'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Address</label>
                    <textarea name="address" id="address" class="form-control"  placeholder="Address" data-error="This field is required." required><?php echo $getFoodDeliveryBoys['address'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                   <div class="form-group">
                    <label for="form-control-2" class="control-label">Experience</label>
                    <input type="text" name="experience" class="form-control" id="form-control-2" placeholder="Experience" data-error="Please enter Experience" required value="<?php echo $getFoodDeliveryBoys['experience'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Type</label>
                    <select id="type" name="type" class="custom-select" data-error="This field is required." required>
                      <option value="">Type</option>
                      <option value="1" <?php if($getFoodDeliveryBoys['type'] == 1) { echo "Selected=Selected"; }?>>Own</option>
                      <option value="2" <?php if($getFoodDeliveryBoys['type'] == 2) { echo "Selected=Selected"; }?>>Others</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Identity Proof Image</label>
                    <img src="<?php echo $base_url . 'uploads/food_deliveryboys_images/'.$getFoodDeliveryBoys['identity_proof_image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getFoodDeliveryBoys['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
          $("#food_category_id").show();
      } else {
          $("#food_category_id").hide();
      }
      
    $("input[name='lkp_banner_type_id']").click(function () {
      if ($("#lkp_banner_type_id").is(":checked")) {
          $("#food_category_id").show();
      } else {
          $("#food_category_id").hide();
      }
    });
  });
</script>