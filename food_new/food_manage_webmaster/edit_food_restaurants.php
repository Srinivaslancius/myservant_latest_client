<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['frid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
      $restaurant_name = $_POST['restaurant_name'];
      $opens_at = $_POST['opens_at'];
      $lkp_state_id = $_POST['lkp_state_id'];
      $lkp_city_id = $_POST['lkp_city_id'];
      $lkp_district_id = $_POST['lkp_district_id'];
      $lkp_location_id = $_POST['lkp_location_id'];
      $lkp_pincode_id = $_POST['lkp_pincode_id'];
      $description = $_POST['description'];
      $delivery_type_id = implode(',',$_POST["delivery_type_id"]);
      $meta_title = $_POST['meta_title'];
      $meta_keywords = $_POST['meta_keywords'];
      $meta_desc = $_POST['meta_desc'];
      $lkp_status_id = $_POST['lkp_status_id'];
      $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];

      if($_FILES["fileToUpload"]["name"]!='') {

              $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/food_restaurants_images/";
              $target_file = $target_dir . basename($fileToUpload);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('image','food_restaurants','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `food_restaurants` SET restaurant_name = '$restaurant_name',opens_at = '$opens_at',lkp_state_id = '$lkp_state_id',lkp_city_id = '$lkp_city_id',lkp_district_id = '$lkp_district_id',lkp_location_id = '$lkp_location_id',lkp_pincode_id = '$lkp_pincode_id',description = '$description',delivery_type_id = '$delivery_type_id', image = '$fileToUpload', meta_title = '$meta_title', meta_keywords = '$meta_keywords', meta_desc = '$meta_desc', lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='food_restaurants.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='food_restaurants.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      } else {

          $sql = "UPDATE `food_restaurants` SET restaurant_name = '$restaurant_name',opens_at = '$opens_at',lkp_state_id = '$lkp_state_id',lkp_city_id = '$lkp_city_id',lkp_district_id = '$lkp_district_id',lkp_location_id = '$lkp_location_id',lkp_pincode_id = '$lkp_pincode_id', description = '$description',delivery_type_id = '$delivery_type_id', meta_title = '$meta_title', meta_keywords = '$meta_keywords', meta_desc = '$meta_desc', lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='food_restaurants.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='food_restaurants.php?msg=fail'</script>";
          }

      }
  }   
?>
<div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Restuarants</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getResturants = getAllDataWhere('food_restaurants','id',$id);
                    $getResturantsData = $getResturants->fetch_assoc(); ?>
                    <?php
                        $getDeliveryTypeId = explode(',',$getResturantsData['delivery_type_id']);
                        $getDeliveryTypes = getAllDataWithStatus('food_product_delivery_type','0');
                    ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getResturantsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getDistrcits = getAllDataWithStatus('lkp_districts','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select name="lkp_district_id" id="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);">
                      <option value="">Select District</option>
                      <?php while($row = $getDistrcits->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getResturantsData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select name="lkp_city_id" id="lkp_city_id" class="custom-select" data-error="This field is required." required onChange="getLocations(this.value);">
                      <option value="">Select City</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getResturantsData['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getCities = getAllDataWithStatus('food_lkp_locations','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Location</label>
                    <select name="lkp_location_id" id="lkp_location_id" class="custom-select" data-error="This field is required." required onChange="getPincode(this.value);">
                      <option value="">Select Location</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getResturantsData['lkp_location_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['location_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getCities1 = getAllDataWithStatus('food_lkp_locations','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Pincode</label>
                    <select name="lkp_pincode_id" id="lkp_pincode_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Pincode</option>
                      <?php while($row = $getCities1->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getResturantsData['lkp_pincode_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['location_pincode']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Restaurant Name</label>
                    <input type="text" name="restaurant_name" class="form-control" id="form-control-2" placeholder="Restaurant Name" data-error="Please enter restaurant name" required value="<?php echo $getResturantsData['restaurant_name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Opens At</label>
                    <input type="text" name="opens_at" class="form-control" id="form-control-2" placeholder="Restaurant Opens At" data-error="Please enter opening time" required value="<?php echo $getResturantsData['opens_at'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img src="<?php echo $base_url . 'uploads/food_restaurants_images/'.$getResturantsData['image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="category_description" placeholder="Group Description" data-error="Please enter Description." required><?php echo $getResturantsData['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter meta title" required value="<?php echo $getResturantsData['meta_title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter Meta Keywords" required value="<?php echo $getResturantsData['meta_keywords'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" placeholder="Description" data-error="This field is required." required ><?php echo $getResturantsData['meta_desc'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Delivery Type</label>
                    <select name="delivery_type_id[]" class="custom-select" multiple="multiple" data-error="This field is required." required>
                      <option value="">Select Delivery Type</option>
                      <?php while($row = $getDeliveryTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == in_array($row['id'], $getDeliveryTypeId)) { echo "selected=selected"; }?> ><?php echo $row['delivery_type']; ?></option>
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
                          <option <?php if($row['id'] == $getResturantsData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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