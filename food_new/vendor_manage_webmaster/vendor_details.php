<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_SESSION['food_vendor_user_id'];

if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $vendor_name = $_POST['vendor_name'];
    $restaurant_name = $_POST['restaurant_name'];
    $restaurant_address = $_POST['restaurant_address'];
    $pincode = $_POST['pincode'];
    $delivery_type_id = implode(',',$_POST["delivery_type_id"]);    
    $meta_title = $_POST['meta_title'];
    $meta_keywords = $_POST['meta_keywords'];
    $meta_desc = $_POST['meta_desc'];
    $vendor_email = $_POST['vendor_email'];
    $vendor_mobile = $_POST['vendor_mobile'];
    $description = $_POST['description'];
    $password = encryptPassword($_POST['password']);
    $working_timings = $_POST['working_timings'];
    $min_delivery_time = $_POST['min_delivery_time'];    
    $lkp_state_id = $_POST['lkp_state_id'];
    $lkp_district_id = $_POST['lkp_district_id'];
    $lkp_city_id = $_POST['lkp_city_id'];
    $location = $_POST['location'];
    $created_at = date("Y-m-d h:i:s"); 

      if($_FILES["fileToUpload"]["name"]!='' || $_FILES["vendor_banner"]["name"]!='') {

             //Vendor Logo update
             $vendorLogo=$_FILES['fileToUpload']['name']; 
             $expLogo=explode('.',$vendorLogo);
             $logoxptype=$expLogo[1];
             $date = date('m/d/Yh:i:sa', time());
             $rand=rand(10000,99999);
             $encname=$date.$rand;
             $logoname=md5($encname).'.'.$logoxptype;
             $vendorLogopath="../../uploads/food_vendor_logo/".$logoname;     
             $getImgUnlink = getImageUnlink('logo','food_vendors','id',$id,$vendorLogopath);       

             //Vendor banner update
             $vendorBanner=$_FILES['vendor_banner']['name']; 
             $expBanner=explode('.',$vendorBanner);
             $bannerType=$expBanner[1];
             $date1 = date('m/d/Yh:i:sa', time());
             $rand1=rand(10000,99999);
             $encname1=$date1.$rand1;
             $bannerName=md5($encname1).'.'.$bannerType;
             $vendorbannerpath="../../uploads/food_vendor_Banner/".$bannerName; 
             $getImgUnlink1 = getImageUnlink('vendor_banner','food_vendors','id',$id,$vendorbannerpath);
              
              
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if ($vendorLogo!='' && $vendorBanner!='') {
                    move_uploaded_file($_FILES["vendor_banner"]["tmp_name"],$vendorbannerpath);
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$vendorLogopath);
                    $sql = "UPDATE food_vendors SET vendor_name = '$vendor_name', vendor_email = '$vendor_email', vendor_mobile = '$vendor_mobile',description = '$description', password = '$password',working_timings = '$working_timings',min_delivery_time = '$min_delivery_time',lkp_state_id = '$lkp_state_id',lkp_district_id = '$lkp_district_id',lkp_city_id = '$lkp_city_id',location = '$location', logo = '$logoname', vendor_banner = '$bannerName', restaurant_address = '$restaurant_address',pincode = '$pincode', delivery_type_id ='$delivery_type_id', meta_title ='$meta_title', meta_desc= '$meta_desc',meta_keywords='$meta_keywords' , restaurant_name ='$restaurant_name',cusine_type_id= '$cusine_type_id'  WHERE id = '$id' ";
                      $conn->query($sql);
              } elseif($vendorBanner!='') {
                    move_uploaded_file($_FILES["vendor_banner"]["tmp_name"],$vendorbannerpath);
                    $sql = "UPDATE food_vendors SET vendor_name = '$vendor_name', vendor_email = '$vendor_email', vendor_mobile = '$vendor_mobile',description = '$description', password = '$password',working_timings = '$working_timings',min_delivery_time = '$min_delivery_time',lkp_state_id = '$lkp_state_id',lkp_district_id = '$lkp_district_id',lkp_city_id = '$lkp_city_id',location = '$location', vendor_banner = '$bannerName',restaurant_address = '$restaurant_address',pincode = '$pincode', delivery_type_id ='$delivery_type_id', meta_title ='$meta_title', meta_desc= '$meta_desc',meta_keywords='$meta_keywords' , restaurant_name ='$restaurant_name',cusine_type_id= '$cusine_type_id'  WHERE id = '$id' "; 
                    $conn->query($sql);
              } elseif($vendorLogo!='') {
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$vendorLogopath);
                    $sql = "UPDATE food_vendors SET vendor_name = '$vendor_name', vendor_email = '$vendor_email', vendor_mobile = '$vendor_mobile',description = '$description', password = '$password',working_timings = '$working_timings',min_delivery_time = '$min_delivery_time',lkp_state_id = '$lkp_state_id',lkp_district_id = '$lkp_district_id',lkp_city_id = '$lkp_city_id',location = '$location', logo = '$logoname',restaurant_address = '$restaurant_address',pincode = '$pincode', delivery_type_id ='$delivery_type_id', meta_title ='$meta_title', meta_desc= '$meta_desc',meta_keywords='$meta_keywords' , restaurant_name ='$restaurant_name' WHERE id = '$id' "; 
                    $conn->query($sql);
              }
            //echo $sql; die;
            //echo "<script type='text/javascript'>window.location='vendors.php?msg=success'</script>";
} else {
        $sql = "UPDATE food_vendors SET vendor_name = '$vendor_name', vendor_email = '$vendor_email', vendor_mobile = '$vendor_mobile',description = '$description', password = '$password',working_timings = '$working_timings',min_delivery_time = '$min_delivery_time',lkp_state_id = '$lkp_state_id',lkp_district_id = '$lkp_district_id',lkp_city_id = '$lkp_city_id',location = '$location', restaurant_address = '$restaurant_address',pincode = '$pincode', delivery_type_id ='$delivery_type_id', meta_title ='$meta_title', meta_desc= '$meta_desc',meta_keywords='$meta_keywords' , restaurant_name ='$restaurant_name' WHERE id = '$id' ";
          $conn->query($sql);
      }

      //Cusine type add here

      //Cusine type add here
      if($id!=0) {
        $cusDel = "DELETE FROM food_vendor_add_cusine_types WHERE vendor_id = '$id' ";
        $conn->query($cusDel);
        $rest_cusine_types = $_REQUEST['cusine_type_id'];
        foreach($rest_cusine_types as $key=>$value){
            $vendor_cusines = $_REQUEST['cusine_type_id'][$key];          
            $sql = "INSERT INTO food_vendor_add_cusine_types ( `vendor_id`,`vendor_cusine_type_id`) VALUES ('$id','$vendor_cusines')";
            $result = $conn->query($sql);
        }
      }

      echo "<script type='text/javascript'>window.location='vendor_details.php?msg=success'</script>";
      //echo $sql; die;
}   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Vendors</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getAllVendorsData = getAllDataWhere('food_vendors','id',$id);
              $getVendorsData = $getAllVendorsData->fetch_assoc(); ?> 
              <?php
                  $getDeliveryTypeId = explode(',',$getVendorsData['delivery_type_id']);
                  $getDeliveryTypes = getAllDataWithStatus('food_product_delivery_type','0');
              ?> 
              <?php

                  $getSelectedCustypes = "SELECT * FROM food_vendor_add_cusine_types WHERE vendor_id='$id' ";
                  $getSelCs = $conn->query($getSelectedCustypes);
                  $getCus = array();
                  while ($impCusids = $getSelCs->fetch_assoc()){
                    $getCus[] = $impCusids['vendor_cusine_type_id'];
                  }
                  //echo "<pre>"; print_r($getCus);
                  $getVendorsDataCusines = implode(',', $getCus);
                  $getCusineTypeId = explode(',',$getVendorsDataCusines);
                  $getCusineTypes = getAllDataWithStatus('food_cusine_types','0');
              ?> 
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Vendor Name</label>
                    <input type="text" name="vendor_name" class="form-control" id="form-control-2" placeholder="Vendor Name" data-error="Please enter Vendor Name" required value="<?php echo $getVendorsData['vendor_name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Restaurant Name</label>
                    <input type="text" name="restaurant_name" class="form-control" id="form-control-2" placeholder="Restaurant Name" data-error="Please enter restaurant name" required value="<?php echo $getVendorsData['restaurant_name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Restaurent Address</label>
                    <textarea name="restaurant_address" id="restaurant_address" class="form-control"  placeholder="Restuarent Address" data-error="This field is required." required><?php echo $getVendorsData['restaurant_address'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Delivery Type</label>
                    <select name="delivery_type_id[]" class="custom-select" data-plugin="select2" multiple="multiple" data-error="This field is required." required>                      
                      <?php while($row = $getDeliveryTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == in_array($row['id'], $getDeliveryTypeId)) { echo "selected=selected"; }?> ><?php echo $row['delivery_type']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Cusine Type</label>
                    <select name="cusine_type_id[]" data-plugin="select2" class="custom-select" multiple="multiple" data-error="This field is required." required>                      
                      <?php while($row1 = $getCusineTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == in_array($row1['id'], $getCusineTypeId)) { echo "selected=selected"; } ?> ><?php echo $row1['title']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="vendor_email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_input" placeholder="Email" data-error="Please enter a valid email address." required value="<?php echo $getVendorsData['vendor_email'];?>">
                    <div class="help-block with-errors"></div>
            
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="vendor_mobile" class="form-control" id="form-control-2" placeholder="Mobile" data-error="Please enter Correct Mobile Number." required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getVendorsData['vendor_mobile'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description(Add upto only 150 characters)</label>
                    <textarea name="description" class="form-control" maxlength="150" data-error="Please enter a valid email address." required><?php echo $getVendorsData['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
      
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Password</label>
                    <input type="password" name="password" id="password" minlength="8" data-error="Please Enter Minimum 8 characters."  class="form-control" id="form-control-2" placeholder="Password" data-error="Please enter Password." required value="<?php echo decryptPassword($getVendorsData['password']);?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Timings</label>
                    <input type="text" name="working_timings" class="form-control" id="form-control-2" placeholder="Working Timings" data-error="Please enter Working Timings" required  value="<?php echo $getVendorsData['working_timings'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Minimum Delivery Time</label>
                    <input type="text" name="min_delivery_time" class="form-control" id="form-control-2" placeholder="Minimum Delivery Time" data-error="Please enter Minimum Delivery Time" required  value="<?php echo $getVendorsData['min_delivery_time'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                
                   <?php $getStates = getAllDataWithStatus('lkp_states','0');?>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getVendorsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getDistrcits = getAllDataWithStatus('lkp_districts','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select id="lkp_district_id" name="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select District</option>
                      <?php while($row = $getDistrcits->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getVendorsData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                   <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select id="lkp_city_id" name="lkp_city_id" class="custom-select" data-error="This field is required." required data-plugin="select2" onChange="getPincodes(this.value);"  data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getVendorsData['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                   <?php $getPincodes = getAllDataWithStatus('lkp_pincodes','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Pincode</label>
                    <select id="lkp_pincode_id" name="pincode" class="custom-select" data-error="This field is required." required data-plugin="select2" onChange="getLocations(this.value);" data-options="{ placeholder: 'Select a pincode', allowClear: true }">
                      <option value="">Select Pincode</option>
                      <?php while($row = $getPincodes->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getVendorsData['pincode']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['pincode']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getLocations = getAllDataWithStatus('lkp_locations','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Location</label>
                    <select id="lkp_location_id" name="location" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a location', allowClear: true }">
                      <option value="">Select Location</option>
                      <?php while($row = $getLocations->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getVendorsData['location']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['location_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                    <div class="form-group">
                    <label for="form-control-4" class="control-label">logo</label>
                    <img src="<?php echo $base_url . 'uploads/food_vendor_logo/'.$getVendorsData['logo'] ?>"  id="output" height="100" width="100"/ >
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Banner</label>
                    <img src="<?php echo $base_url . 'uploads/food_vendor_Banner/'.$getVendorsData['vendor_banner'] ?>"   id="output1" height="100" width="100"/>
                    
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="vendor_banner" id="fileToUpload1"   onchange="loadFile1(event)">
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter meta title" required value="<?php echo $getVendorsData['meta_title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter Meta Keywords" required value="<?php echo $getVendorsData['meta_keywords'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="category_description" placeholder="Description" data-error="This field is required." required ><?php echo $getVendorsData['meta_desc'];?></textarea>
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

<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'meta_desc' );

</script>
<script type="text/javascript">
    function getDistricts(val) { 
        $.ajax({
        type: "POST",
        url: "../food_manage_webmaster/get_districts.php",
        data:'lkp_state_id='+val,
        success: function(data){
            $("#lkp_district_id").html(data);
        }
        });
    }
    function getCities(val) { 
        $.ajax({
        type: "POST",
        url: "../food_manage_webmaster/get_cities.php",
        data:'lkp_district_id='+val,
        success: function(data){
            $("#lkp_city_id").html(data);
        }
        });
    }
    function getPincodes(val) { 
        $.ajax({
        type: "POST",
        url: "../food_manage_webmaster/get_pincodes.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
    function getLocations(val) { 
        $.ajax({
        type: "POST",
        url: "../food_manage_webmaster/get_locations.php",
        data:'lkp_pincode_id='+val,
        success: function(data){
            $("#lkp_location_id").html(data);
        }
        });
    }
    </script>
<style type="text/css">
    .cke_top, .cke_contents, .cke_bottom {
        border: 1px solid #333;
    }
</style>