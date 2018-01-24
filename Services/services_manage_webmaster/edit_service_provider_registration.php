<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
error_reporting(1);
$id = $_GET['registrationid'];
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  
  //If success
//echo "<pre>";print_r($_POST);exit;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile_number = $_POST['mobile_number'];
  $address = $_POST['address'];
  $service_provider_type_id = $_POST['service_provider_type_id'];
  $company_name = $_POST['company_name'];
  $est_year = $_POST['est_year'];
  $total_no_of_emp = $_POST['total_no_of_emp'];
  $description = $_POST['description'];
  $certification = $_POST['certification'];
  
  
  $contact_numbers = $_POST['contact_numbers'];
  $email_id = $_POST['email_id'];
  $sub_category_id = implode(',',$_POST["sub_category_id"]);
  $sub_category_id1 = implode(',',$_POST["sub_category_id1"]);
  
  $associate_or_not = $_POST['associate_or_not'];
  $experience = $_POST['experience'];
  $created_at = date("Y-m-d h:i:s");
  $lkp_state_id = $_POST['lkp_state_id'];
  $lkp_district_id = $_POST['lkp_district_id'];
  $lkp_city_id = $_POST['lkp_city_id'];
  $lkp_pincode_id = $_POST['lkp_pincode_id'];
  $lkp_location_id = $_POST['lkp_location_id'];
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $fileToUpload1 = $_FILES["fileToUpload1"]["name"];

  $working_hours = $_POST['working_hours'];
  $strat_time = $_POST['strat_time'];
  $evening_hours = $_POST['evening_hours'];
  $night_time = $_POST['night_time'];

  $working_hours1 = $_POST['working_hours1'];
  $strat_time1 = $_POST['strat_time1'];
  $evening_hours1 = $_POST['evening_hours1'];
  $night_time1 = $_POST['night_time1'];

  if($sub_category_id == 0) {
    $specialization_name = $_POST['specialization_name'];
  } else {
    $specialization_name = 0;
  }
  if($sub_category_id1 == 0) {
    $specialization_name1 = $_POST['specialization_name1'];
  } else {
    $specialization_name1 = 0;
  }
  
   $service_provider = "UPDATE service_provider_registration SET name = '$name',email ='$email',mobile_number ='$mobile_number',lkp_state_id ='$lkp_state_id',lkp_district_id ='$lkp_district_id',lkp_city_id ='$lkp_city_id',lkp_pincode_id ='$lkp_pincode_id',lkp_location_id ='$lkp_location_id',address = '$address' WHERE id = '$id'";
    $result1 = $conn->query($service_provider);

  if($service_provider_type_id == 'Business') {

    if($fileToUpload!='') {

      $target_dir = "../../uploads/service_provider_business_logo/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $sql = "UPDATE service_provider_business_registration SET company_name ='$company_name',est_year = '$est_year',total_no_of_emp ='$total_no_of_emp',description ='$description',certification ='$certification',contact_numbers ='$contact_numbers',email_id ='$email_id',specialization_name ='$specialization_name',sub_category_id ='$sub_category_id',associate_or_not ='$associate_or_not',logo ='$fileToUpload' ,working_hours = '$working_hours',strat_time = '$strat_time', evening_hours = '$evening_hours', night_time = '$night_time'   WHERE service_provider_registration_id = '$id'";
        $res = $conn->query($sql);
      }
    } else {
       $sql = "UPDATE service_provider_business_registration SET company_name ='$company_name',est_year = '$est_year',total_no_of_emp ='$total_no_of_emp',description ='$description',certification ='$certification',contact_numbers ='$contact_numbers',email_id ='$email_id',specialization_name ='$specialization_name',sub_category_id ='$sub_category_id',associate_or_not ='$associate_or_not' ,working_hours = '$working_hours',strat_time = '$strat_time', evening_hours = '$evening_hours', night_time = '$night_time' WHERE service_provider_registration_id = '$id'";
        $res = $conn->query($sql);
    }
  } else {

    if($fileToUpload1!='') {

      $target_dir1 = "../../uploads/service_provider_personal_iamge/";
      $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
      $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);

      if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)) {
       $sql1 = "UPDATE service_provider_personal_registration SET experience ='$experience',image = '$fileToUpload1',working_hours ='$working_hours1',specialization_name ='$specialization_name1',sub_category_id ='$sub_category_id1', strat_time = '$strat_time1', evening_hours = '$evening_hours1', night_time = '$night_time1' WHERE service_provider_registration_id = '$id'";
        $res1 = $conn->query($sql1);
      }
    } else {
      $sql1 = "UPDATE service_provider_personal_registration SET experience ='$experience',working_hours ='$working_hours1',specialization_name ='$specialization_name1',sub_category_id ='$sub_category_id1',strat_time = '$strat_time1', evening_hours = '$evening_hours1', night_time = '$night_time1' WHERE service_provider_registration_id = '$id'"; 
      $res1 = $conn->query($sql1);
    }
  }
  if($result1 == 1) {
    echo "<script type='text/javascript'>window.location='service_provider_registration.php?msg=success'</script>";
  } else {
    echo "<script type='text/javascript'>window.location='service_provider_registration.php?msg=fail'</script>";
  }

}
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Service Provider Registrations</h3>
          </div>
          <div class="panel-body">
            <?php $getServiceProviderRegistrations = getAllDataWhere('service_provider_registration','id',$id);
              $getServiceProviderRegistrationsData = $getServiceProviderRegistrations->fetch_assoc(); ?>
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form autocomplete="off" data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter Name" value="<?php echo $getServiceProviderRegistrationsData['name'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_input" placeholder="email" data-error="Please enter Valid Email Address" onkeyup="checkUserAvailTest()" value="<?php echo $getServiceProviderRegistrationsData['email'];?>" required>
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="service_provider_registration">
                    <input type="hidden" id="column_name" value="email">
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile Number</label>
                    <input type="text" name="mobile_number" class="form-control valid_mobile_num" id="form-control-2" placeholder="Mobile Number" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}" value="<?php echo $getServiceProviderRegistrationsData['mobile_number'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Landline Number</label>
                    <input type="text" name="landline_number" class="form-control valid_mobile_num" id="form-control-2" placeholder="Landline Number" data-error="Please enter Landline number." value="<?php echo $getServiceProviderRegistrationsData['landline_number'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Website</label>
                    <input type="url" name="website" class="form-control" id="form-control-2" placeholder="Website" data-error="Please enter Website." required value="<?php echo $getServiceProviderRegistrationsData['website'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a State', allowClear: true }">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceProviderRegistrationsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
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
                          <option <?php if($row['id'] == $getServiceProviderRegistrationsData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select id="lkp_city_id" name="lkp_city_id" class="custom-select" data-error="This field is required." required  onChange="getPincodes(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceProviderRegistrationsData['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getPincodes = getAllDataWithStatus('lkp_pincodes','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Pincode</label>
                    <select id="lkp_pincode_id" name="lkp_pincode_id" class="custom-select" data-error="This field is required." required   onChange="getLocations(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a Pincode', allowClear: true }">
                      <option value="">Select Pincode</option>
                      <?php while($row = $getPincodes->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceProviderRegistrationsData['lkp_pincode_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['pincode']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getLocations = getAllDataWithStatus('lkp_locations','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Location</label>
                    <select id="lkp_location_id" name="lkp_location_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a Locations', allowClear: true }">
                      <option value="">Select Location</option>
                      <?php while($row = $getLocations->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceProviderRegistrationsData['lkp_location_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['location_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Address</label>
                    <textarea name="address" class="form-control" id="category_description" placeholder="Address" data-error="Please enter Address." required><?php echo $getServiceProviderRegistrationsData['address'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Service Provider</label>
                    <input type="text" name="service_provider_type_id" readonly class="form-control" id="service_provider_type_id" placeholder="Name" data-error="Please enter Name" value="<?php if($getServiceProviderRegistrationsData['service_provider_type_id'] == 1) { echo "Business"; } else { echo "Personal";} ?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getServiceProviderBusinessRegistrations = getAllDataWhere('service_provider_business_registration','service_provider_registration_id',$id);
              $getServiceProviderBusinessRegistrationsData = $getServiceProviderBusinessRegistrations->fetch_assoc(); ?>
                  <div id="service_provider_business_type">
                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Company Name</label>
                      <input type="text" name="company_name" class="form-control service_provider_business" id="form-control-2" placeholder="Company Name" data-error="Please enter Company Name" value="<?php echo $getServiceProviderBusinessRegistrationsData['company_name'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Years</label>
                      <input type="text" name="est_year" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Years" data-error="Please enter Years"  value="<?php echo $getServiceProviderBusinessRegistrationsData['est_year'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Total Number of Employees</label>
                      <input type="text" name="total_no_of_emp" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Total Number of Employees" data-error="Please enter Total Number of Employees" value="<?php echo $getServiceProviderBusinessRegistrationsData['total_no_of_emp'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-4" class="control-label">Logo</label>
                      <img src="<?php echo $base_url . 'uploads/service_provider_business_logo/'.$getServiceProviderBusinessRegistrationsData['logo'] ?>"  id="output" height="100" width="100"/>
                      <!-- <img id="output" height="100" width="100"/> -->
                      <label class="btn btn-default file-upload-btn">
                        Choose file...
                          <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                        </label>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Description</label>
                      <textarea name="description" class="form-control" id="meta_desc" placeholder="Description" data-error="Please enter Address."><?php echo $getServiceProviderBusinessRegistrationsData['description'];?></textarea>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Certification</label>
                      <input type="text" name="certification" class="form-control service_provider_business" id="form-control-2" placeholder="Certification" data-error="Please enter Certification" value="<?php echo $getServiceProviderBusinessRegistrationsData['certification'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="row">
                        <div class="col-sm-3">
                         <p style="margin-top:8px">Morning:</p>
                        </div>
                        <div class="col-sm-4">
                         <input type="text" name="working_hours" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Morning Timings" value="<?php echo $getServiceProviderBusinessRegistrationsData['working_hours'];?>">
                        <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-sm-5">
                                <select name="strat_time" class="form-control" id="sel1">
                        <option value="1" <?php if($getServiceProviderBusinessRegistrationsData['strat_time'] == 1) { echo "Selected=Selected"; }?>>AM</option>
                        <option value="2" <?php if($getServiceProviderBusinessRegistrationsData['strat_time'] == 2) { echo "Selected=Selected"; }?>>PM</option>
                        </select>
                                  <div class="help-block with-errors"></div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-sm-6">
                                 <div class="row">
                        <div class="col-sm-3">
                         <p style="margin-top:8px">Evening:</p>
                        </div>
                        <div class="col-sm-4">
                         <input type="text" name="evening_hours" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Working Hours" value="<?php echo $getServiceProviderBusinessRegistrationsData['evening_hours'];?>">
                          <div class="help-block with-errors"></div>
                          </div>
                          <div class="col-sm-5">
                                  <select name="night_time" class="form-control" id="sel1">
                          <option value="1" <?php if($getServiceProviderBusinessRegistrationsData['night_time'] == 1) { echo "Selected=Selected"; }?>>AM</option>

                          <option value="2" <?php if($getServiceProviderBusinessRegistrationsData['night_time'] == 2) { echo "Selected=Selected"; }?>>PM</option>
                          </select>
                                    <div class="help-block with-errors"></div>
                          </div>
                          </div>
                          </div>
                          </div>
                        </div>


                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Working Hours</label>
                      <input type="text" name="working_hours1" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Working Hours" data-error="Please enter Working Hours" value="<?php echo $getServiceProviderBusinessRegistrationsData['working_hours'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Contact Numbers</label>
                      <input type="text" name="contact_numbers" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Contact Numbers" data-error="Please enter Contact Numbers." maxlength="10" pattern="[0-9]{10}" value="<?php echo $getServiceProviderBusinessRegistrationsData['contact_numbers'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Email id</label>
                      <input type="email" name="email_id" class="form-control service_provider_business" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email" placeholder="email" data-error="Please enter Valid Email Address" value="<?php echo $getServiceProviderBusinessRegistrationsData['email_id'];?>">
                      <span id="email_status" style="color: red;"></span>
                      <div class="help-block with-errors"></div>
                    </div>

                    <?php 
                    $getSubCategoryTypeId = explode(',',$getServiceProviderBusinessRegistrationsData['sub_category_id']);
                    $getSubCategories = getAllDataWithStatus('services_sub_category','0');?>
                    <div class="form-group">
                      <label for="form-control-3" class="control-label">Choose your Specialization</label>
                      <select name="sub_category_id[]" class="custom-select multi_select" multiple="multiple" id="sub_category_id" data-error="This field is required." required="true" data-plugin="select2">
                        <!-- <option value="">Select Specialization</option> -->
                        <?php while($row = $getSubCategories->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == in_array($row['id'], $getSubCategoryTypeId)) { echo "selected=selected"; }?> ><?php echo $row['sub_category_name']; ?></option>
                      <?php } ?>
                        <option value="0" <?php if($getServiceProviderBusinessRegistrationsData['sub_category_id'] == 0) { echo "selected=selected"; }?> >Others</option>
                     </select>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group" id="specialization_name">
                      <label for="form-control-2" class="control-label">Specialization Name</label>
                      <input type="text" name="specialization_name" class="form-control" id="form-control-2" placeholder="Specialization" data-error="Please enter Specialization" value="<?php echo $getServiceProviderBusinessRegistrationsData['specialization_name'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                          <?php 
                              $checked = "checked";
                              $getAssoc = $getServiceProviderBusinessRegistrationsData['associate_or_not'];
                              //if associate value = 0 Yes & if associate value = 1 No
                          ?>
                          <h4>Associate With Us</h4>
                          <label>
                            <input type="radio"  value="0" <?php if($getAssoc == 0) echo $checked; ?> name="associate_or_not" />&nbsp;Yes</label>&nbsp;&nbsp;
                          <label>
                            <input type="radio"  value="1" <?php if($getAssoc == 1) echo $checked; ?> name="associate_or_not"/>&nbsp;No</label>
                          <label>
                    </div>
                  </div>

                  <?php $getServiceProviderPersonalRegistrations = getAllDataWhere('service_provider_personal_registration','service_provider_registration_id',$id);
                  $getServiceProviderPersonalRegistrationsData = $getServiceProviderPersonalRegistrations->fetch_assoc(); ?>
                  <div id="service_provider_personal_type">
                    <!-- <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
                    <input type="text" name="working_hours1" class="form-control service_provider_personal valid_mobile_num" id="form-control-2" placeholder="Working Hours" data-error="Please enter Working Hours" value="<?php echo $getServiceProviderPersonalRegistrationsData['working_hours'];?>">
                    <div class="help-block with-errors"></div>
                    </div> -->

                    <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
                  <div class="row">
                  <div class="col-sm-6">
                  <div class="row">
                  <div class="col-sm-3">
                   <p style="margin-top:8px">Morning:</p>
                  </div>
                  <div class="col-sm-4">
                   <input type="text" name="working_hours1" class="form-control service_provider_personal valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Morning Timings" value="<?php echo $getServiceProviderPersonalRegistrationsData['working_hours'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-sm-5">
                          <select name="strat_time1" class="form-control" id="sel1">
                  <option value="1" <?php if($getServiceProviderPersonalRegistrationsData['strat_time'] == 1) { echo "Selected=Selected"; }?>>AM</option>
                  <option value="2" <?php if($getServiceProviderPersonalRegistrationsData['strat_time'] == 2) { echo "Selected=Selected"; }?>>PM</option>
                  </select>
                            <div class="help-block with-errors"></div>
                  </div>
                  </div>
                  </div>
          
                  <div class="col-sm-6">
                           <div class="row">
                  <div class="col-sm-3">
                   <p style="margin-top:8px">Evening:</p>
                  </div>
                  <div class="col-sm-4">
                           <input type="text" name="evening_hours1" class="form-control service_provider_personal valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Working Hours" value="<?php echo $getServiceProviderPersonalRegistrationsData['evening_hours'];?>">
                            <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-sm-5">
                          <select name="night_time1" class="form-control" id="sel2">
                   <option value="1" <?php if($getServiceProviderPersonalRegistrationsData['night_time'] == 1) { echo "Selected=Selected"; }?>>AM</option>
                  <option value="2" <?php if($getServiceProviderPersonalRegistrationsData['night_time'] == 2) { echo "Selected=Selected"; }?>>PM</option>
                  </select>
                            <div class="help-block with-errors"></div>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                    <?php 
                    $getSubCategoryTypeId1 = explode(',',$getServiceProviderPersonalRegistrationsData['sub_category_id']);
                    $getSubCategories1 = getAllDataWithStatus('services_sub_category','0');?>
                    <div class="form-group">
                      <label for="form-control-3" class="control-label">Choose your Specialization</label>
                      <select name="sub_category_id1[]" class="custom-select multi_select" id="sub_category_id1" multiple="multiple" data-error="This field is required." required data-plugin="select2">
                        <!-- <option value="">Select Specialization</option> -->
                        <?php while($row1 = $getSubCategories1->fetch_assoc()) {  ?>
                          <option value="<?php echo $row1['id']; ?>" <?php if($row1['id'] == in_array($row1['id'], $getSubCategoryTypeId1)) { echo "selected=selected"; } ?> ><?php echo $row1['sub_category_name']; ?></option>
                      <?php } ?>
                        <option value="0" <?php if($getServiceProviderPersonalRegistrationsData['sub_category_id'] == 0) { echo "selected=selected"; }?> >Others</option>
                     </select>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group" id="specialization_name1">
                      <label for="form-control-2" class="control-label">Specialization Name</label>
                      <input type="text" name="specialization_name1" class="form-control" id="form-control-2" placeholder="Specialization" data-error="Please enter Specialization" value="<?php echo $getServiceProviderPersonalRegistrationsData['specialization_name'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Experience</label>
                      <input type="text" name="experience" class="form-control service_provider_personal valid_mobile_num" id="form-control-2" placeholder="Experience" data-error="Please enter Experience" value="<?php echo $getServiceProviderPersonalRegistrationsData['experience'];?>">
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label for="form-control-4" class="control-label">Image</label>
                      <img src="<?php echo $base_url . 'uploads/service_provider_personal_iamge/'.$getServiceProviderPersonalRegistrationsData['image'] ?>"  id="output1" height="100" width="100"/>
                      <!-- <img id="output1" height="100" width="100"/> -->
                      <label class="btn btn-default file-upload-btn">
                        Choose file...
                          <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload1" id="fileToUpload1"  onchange="loadFile1(event)"  multiple="multiple" >
                        </label>
                    </div>
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
<!-- Script for Service Probiders -->
<script type="text/javascript">
  $(document).ready(function () { 
      $(".multi_select").attr("required", "true");
    if ($("#service_provider_type_id").val() == 'Business') {
      $('#service_provider_business_type').show();
      $('#service_provider_personal_type').hide();
      $(".service_provider_business").attr("required", "true");
      $(".service_provider_personal").removeAttr('required');
      $('#output1').removeAttr('src');
    } else {
      $('#output').removeAttr('src');
      $('#service_provider_personal_type').show();
      $('#service_provider_business_type').hide();
      $(".service_provider_personal").attr("required", "true");
      $(".service_provider_business").removeAttr('required');
    }
    $('#sub_category_id').change(function() {

      if($(this).val() == 0) {
        $('#specialization_name').show();
        $(".specialization_name").attr("required", "true");
      } else{
        $('#specialization_name').hide();
        $(".specialization_name").removeAttr('required');
      }
    });
    if ($("#sub_category_id").val() == '0') {
      $('#specialization_name').show();
      $(".specialization_name").attr("required", "true");
    } else {
      $('#specialization_name').hide();
      $(".specialization_name").removeAttr('required');
    }
    $('#sub_category_id1').change(function() {

      if($(this).val() == 0) {
        $('#specialization_name1').show();
        $(".specialization_name1").attr("required", "true");
      } else{
        $('#specialization_name1').hide();
        $(".specialization_name1").removeAttr('required');
      }
    });
    if ($("#sub_category_id1").val() == '0') {
      $('#specialization_name1').show();
      $(".specialization_name1").attr("required", "true");
    } else {
      $('#specialization_name1').hide();
      $(".specialization_name1").removeAttr('required');
    }
  });  
</script>
<script type="text/javascript">
    $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>