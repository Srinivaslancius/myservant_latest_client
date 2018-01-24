<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(1);
  if (!isset($_POST['submit']))  {
              echo "fail";
          } else  { 
            
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
    //$delivery_charges = $_POST['delivery_charges'];
    $lkp_state_id = $_POST['lkp_state_id'];
    $lkp_district_id = $_POST['lkp_district_id'];
    $lkp_city_id = $_POST['lkp_city_id'];
    $location = $_POST['location'];
    $created_at = date("Y-m-d h:i:s");
    $fileToUpload =$_FILES['fileToUpload']['name'];
    $fileToUpload1 =$_FILES['vendor_banner']['name'];

    $string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
    $random1 = substr($string1,0,3);
    $string2 = str_shuffle('1234567890');
    $random2 = substr($string2,0,3);
    $contstr = "MYSER-SERVICES";
    $vendor_id = $contstr.$random1.$random2;

      if($fileToUpload!='' && $fileToUpload1!='' ) {

       //Vendor Logo update
       $vendorLogo=$_FILES['fileToUpload']['name']; 
       $expLogo=explode('.',$vendorLogo);
       $logoxptype=$expLogo[1];
       $date = date('m/d/Yh:i:sa', time());
       $rand=rand(10000,99999);
       $encname=$date.$rand;
       $logoname=md5($encname).'.'.$logoxptype;
       $vendorLogopath="../../uploads/food_vendor_logo/".$logoname;
       //Vendor banner update
       $vendorBanner=$_FILES['vendor_banner']['name']; 
       $expBanner=explode('.',$vendorBanner);
       $bannerType=$expBanner[1];
       $date1 = date('m/d/Yh:i:sa', time());
       $rand1=rand(10000,99999);
       $encname1=$date1.$rand1;
       $bannerName=md5($encname1).'.'.$bannerType;
       $vendorbannerpath="../../uploads/food_vendor_Banner/".$bannerName; 

        if ($vendorLogo!='' && $vendorBanner!='')  {   

            move_uploaded_file($_FILES["vendor_banner"]["tmp_name"],$vendorbannerpath);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$vendorLogopath);
           $sql = "INSERT INTO food_vendors (`vendor_name`, `vendor_id`,`vendor_email`, `vendor_mobile`, `description`,  `password`, `working_timings`,`min_delivery_time`, `lkp_state_id`,`lkp_district_id`, `lkp_city_id`,`location`, `logo`, `restaurant_name`,`restaurant_address`,`delivery_type_id`,`created_at`,`pincode`,`meta_title`,`meta_keywords`,`meta_desc`,`vendor_banner`) VALUES ('$vendor_name','$vendor_id','$vendor_email','$vendor_mobile', '$description','$password','$working_timings','$min_delivery_time','$lkp_state_id','$lkp_district_id','$lkp_city_id','$location','$logoname','$restaurant_name','$restaurant_address','$delivery_type_id','$created_at','$pincode','$meta_title','$meta_keywords','$meta_desc','$bannerName')";

            if($conn->query($sql) === TRUE){
              $last_id = $conn->insert_id;
              echo "<script type='text/javascript'>window.location='vendors.php?msg=success'</script>";
            } else {
              echo "<script type='text/javascript'>window.location='vendors.php?msg=fail'</script>";
            }
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

      }
      //Cusine type add here
      if($last_id!=0) {
        $rest_cusine_types = $_REQUEST['cusine_type_id'];
        foreach($rest_cusine_types as $key=>$value){
            $vendor_cusines = $_REQUEST['cusine_type_id'][$key];          
            $sql = "INSERT INTO food_vendor_add_cusine_types ( `vendor_id`,`vendor_cusine_type_id`) VALUES ('$last_id','$vendor_cusines')";
            $result = $conn->query($sql);
        }
      }
      
      echo "<script type='text/javascript'>window.location='vendors.php?msg=success'</script>";
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Vendors</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Vendor Name</label>
                    <input type="text" name="vendor_name" class="form-control" id="form-control-2" placeholder="Vendor Name" data-error="Please enter Vendor Name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Restaurant Name</label>
                    <input type="text" name="restaurant_name" class="form-control" id="form-control-2" placeholder="Restaurant Name" data-error="Please enter restaurant name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Restaurent Address</label>
                    <textarea name="restaurant_address" id="restaurant_address" class="form-control"  placeholder="Restuarent Address" data-error="This field is required." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <?php $getDeliveryTypes = getAllDataWithStatus('food_product_delivery_type','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Delivery Type</label>
                      <select name="delivery_type_id[]" id="form-control-2" class="custom-select" data-plugin="select2" multiple="multiple" data-error="This field is required." required >
                        <?php while($row = $getDeliveryTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['delivery_type']; ?></option>
                        <?php } ?>
                      </select>                    
                    <div class="help-block with-errors"></div>
                  </div>                 

                  <?php $getAllFoodCusineTypes = getAllDataWithStatus('food_cusine_types','0');?>
                   <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Food Cusine Type</label>
                    <select name="cusine_type_id[]" class="custom-select" data-plugin="select2" multiple="multiple" data-error="This field is required." required>                     
                      <?php while($row = $getAllFoodCusineTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['title']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="vendor_email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" id="user_input" placeholder="Email"  data-error="Please enter valid email address." onkeyup="checkUserAvailTest()" required>
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="food_vendors">
                    <input type="hidden" id="column_name" value="vendor_email">

                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="vendor_mobile" class="form-control" id="form-control-2" placeholder="Mobile" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description(Add upto only 150 characters)</label>
                    <textarea name="description" maxlength="150" class="form-control" placeholder="Description" data-error="This field is required." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Password</label>
                    <input type="password" name="password" id="password" minlength="8" data-error="Please Enter Minimum 8 characters."  class="form-control" id="form-control-2" placeholder="Password" data-error="Please enter Password." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" id="form-control-2" placeholder="Confirm Password"  onChange="checkPasswordMatch();"required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div id="divCheckPasswordMatch" style="color:red"></div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Timings</label>
                    <input type="text" name="working_timings" class="form-control" id="form-control-2" placeholder="Working Timings" data-error="Please enter Working Timings" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Minimum Delivery Time</label>
                    <input type="text" name="min_delivery_time" class="form-control" id="form-control-2" placeholder="Minimum Delivery Time" data-error="Please enter Minimum Delivery Time" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="form-control-2" class="control-label">Delivery charges</label>
                    <input type="text" name="delivery_charges" class="form-control valid_price_dec" id="form-control-2" placeholder="Delivery charges" data-error="Please enter Delivery charges" required>
                    <div class="help-block with-errors"></div>
                  </div> -->
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Logo&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" required data-error="Please Select Image." >
                      </label> (Width : 98 px ; height : 62 px)
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Banner</label>
                    <img id="output1" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="vendor_banner" id="fileToUpload1"  onchange="loadFile1(event)"  multiple="multiple" required data-error="Please Select Banner.">
                      </label> (Width : 1400 px ; height : 350 px)
                  </div>
                   <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a state', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                                    
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select name="lkp_district_id" id="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a District', allowClear: true }">
                      <option value="">Select District</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select name="lkp_city_id" id="lkp_city_id" class="custom-select" data-error="This field is required." required data-plugin="select2" onChange="getPincodes(this.value);" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Pincode</label>
                    <select name="pincode" id="lkp_pincode_id" class="custom-select" data-error="This field is required." required data-plugin="select2" onChange="getLocations(this.value);" data-options="{ placeholder: 'Select a pincode', allowClear: true }">
                      <option value="">Select Pincode</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Location</label>
                    <select name="location" id="lkp_location_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a location', allowClear: true }">
                      <option value="">Select Location</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                   <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter meta title" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter Meta Keywords" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="category_description" placeholder="Description" data-error="This field is required." required></textarea>
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
<style type="text/css">
    .cke_top, .cke_contents, .cke_bottom {
        border: 1px solid #333;
    }
</style>
<script type="text/javascript">
      
      function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        if (confirmPassword != password) {
            $("#divCheckPasswordMatch").html("Passwords do not match!");
            $("#confirm_password").val("");
        } else {
            $("#divCheckPasswordMatch").html("");
        }
    }
    </script>