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
  $working_hours = $_POST['working_hours'];
  $working_hours1 = $_POST['working_hours1'];
  $contact_numbers = $_POST['contact_numbers'];
  $email_id = $_POST['email_id'];
  $specialization = $_POST['specialization'];
  $specialization1 = $_POST['specialization1'];
  $associate_or_not = $_POST['associate_or_not'];
  $experience = $_POST['experience'];
  $lkp_status_id = $_POST['lkp_status_id'];
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
  
   $service_provider = "UPDATE service_provider_registration SET name = '$name',email ='$email',mobile_number ='$mobile_number',address = '$address',lkp_status_id ='$lkp_status_id' WHERE id = '$id'";
    $result1 = $conn->query($service_provider);

  if($service_provider_type_id == 'Business') {

    if($fileToUpload!='') {

      $target_dir = "../../uploads/service_provider_business_logo/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $sql = "UPDATE service_provider_business_registration SET company_name ='$company_name',est_year = '$est_year',total_no_of_emp ='$total_no_of_emp',description ='$description',certification ='$certification',working_hours ='$working_hours',contact_numbers ='$contact_numbers',email_id ='$email_id',specialization ='$specialization',associate_or_not ='$associate_or_not',logo ='$fileToUpload' WHERE service_provider_registration_id = '$id'";
        $res = $conn->query($sql);
      }
    } else {
       $sql = "UPDATE service_provider_business_registration SET company_name ='$company_name',est_year = '$est_year',total_no_of_emp ='$total_no_of_emp',description ='$description',certification ='$certification',working_hours ='$working_hours',contact_numbers ='$contact_numbers',email_id ='$email_id',specialization ='$specialization',associate_or_not ='$associate_or_not' WHERE service_provider_registration_id = '$id'";
        $res = $conn->query($sql);
    }
  } else {

    if($fileToUpload1!='') {

      $target_dir1 = "../../uploads/service_provider_personal_iamge/";
      $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
      $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);

      if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)) {
       $sql1 = "UPDATE service_provider_personal_registration SET experience ='$experience',image = '$fileToUpload1',working_hours ='$working_hours1',specialization ='$specialization1' WHERE service_provider_registration_id = '$id'";
        $res1 = $conn->query($sql1);
      }
    } else {
      $sql1 = "UPDATE service_provider_personal_registration SET experience ='$experience',working_hours ='$working_hours1',specialization ='$specialization1' WHERE service_provider_registration_id = '$id'"; 
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
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter Name" value="<?php echo $getServiceProviderRegistrationsData['name'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="user_input" placeholder="email" data-error="Please enter Valid Email Address" onkeyup="checkUserAvailTest()" value="<?php echo $getServiceProviderRegistrationsData['email'];?>" required>
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="service_provider_registration">
                    <input type="hidden" id="column_name" value="email">
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile Number</label>
                    <input type="text" name="mobile_number" class="form-control" id="form-control-2" placeholder="Mobile Number" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getServiceProviderRegistrationsData['mobile_number'];?>">
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
                    <input type="text" name="est_year" class="form-control service_provider_business" id="form-control-2" placeholder="Years" data-error="Please enter Years"  value="<?php echo $getServiceProviderBusinessRegistrationsData['est_year'];?>" onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Total Number of Employees</label>
                    <input type="text" name="total_no_of_emp" class="form-control service_provider_business" id="form-control-2" placeholder="Total Number of Employees" data-error="Please enter Total Number of Employees" value="<?php echo $getServiceProviderBusinessRegistrationsData['total_no_of_emp'];?>" onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Logo</label>
                    <img src="<?php echo $base_url . 'uploads/service_provider_business_logo/'.$getServiceProviderBusinessRegistrationsData['logo'] ?>"  id="output" height="100" width="100"/>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input service_provider_business" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control service_provider_business" id="meta_desc" placeholder="Description" data-error="Please enter Address."><?php echo $getServiceProviderBusinessRegistrationsData['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Certification</label>
                    <input type="text" name="certification" class="form-control service_provider_business" id="form-control-2" placeholder="Certification" data-error="Please enter Certification" value="<?php echo $getServiceProviderBusinessRegistrationsData['certification'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
                    <input type="text" name="working_hours" class="form-control service_provider_business" id="form-control-2" placeholder="Working Hours" data-error="Please enter Working Hours" value="<?php echo $getServiceProviderBusinessRegistrationsData['working_hours'];?>" onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Contact Numbers</label>
                    <input type="text" name="contact_numbers" class="form-control service_provider_business" id="form-control-2" placeholder="Contact Numbers" data-error="Please enter Contact Numbers." maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" value="<?php echo $getServiceProviderBusinessRegistrationsData['contact_numbers'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email id</label>
                    <input type="email" name="email_id" class="form-control service_provider_business" id="email" placeholder="email" data-error="Please enter Valid Email Address" value="<?php echo $getServiceProviderBusinessRegistrationsData['email_id'];?>">
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Specialization</label>
                    <input type="text" name="specialization" class="form-control service_provider_business" id="form-control-2" placeholder="Specialization" data-error="Please enter Specialization" value="<?php echo $getServiceProviderBusinessRegistrationsData['specialization'];?>">
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
                          <input type="checkbox"  value="0" <?php if($getAssoc == 0) echo $checked; ?> name="associate_or_not" />&nbsp;Yes</label>&nbsp;&nbsp;
                        <label>
                          <input type="checkbox"  value="1" <?php if($getAssoc == 1) echo $checked; ?> name="associate_or_not"/>&nbsp;No</label>
                        <label>
                   </div>

                  <?php $getServiceProviderPersonalRegistrations = getAllDataWhere('service_provider_personal_registration','service_provider_registration_id',$id);
                  $getServiceProviderPersonalRegistrationsData = $getServiceProviderPersonalRegistrations->fetch_assoc(); ?>
                  <div id="service_provider_personal_type">
                    <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
                    <input type="text" name="working_hours1" class="form-control service_provider_personal" id="form-control-2" placeholder="Working Hours" data-error="Please enter Working Hours" value="<?php echo $getServiceProviderPersonalRegistrationsData['working_hours'];?>" onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Specialization</label>
                    <input type="text" name="specialization1" class="form-control service_provider_personal" id="form-control-2" placeholder="Specialization" data-error="Please enter Specialization" value="<?php echo $getServiceProviderPersonalRegistrationsData['specialization'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Experience</label>
                    <input type="text" name="experience" class="form-control service_provider_personal" id="form-control-2" placeholder="Experience" data-error="Please enter Experience" value="<?php echo $getServiceProviderPersonalRegistrationsData['experience'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img src="<?php echo $base_url . 'uploads/service_provider_personal_iamge/'.$getServiceProviderPersonalRegistrationsData['image'] ?>"  id="output1" height="100" width="100"/>
                    <img id="output1" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input service_provider_personal" type="file" accept="image/*" name="fileToUpload1" id="fileToUpload1"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  </div>

                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                      <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $getServiceProviderRegistrationsData['lkp_status_id']) { echo "selected=selected"; }?> ><?php echo $row['status']; ?></option>
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
<!-- Script for Service Probiders -->
<script type="text/javascript">
  $(document).ready(function () { 

    if ($("#service_provider_type_id").val() == 'Business') {
      $('#service_provider_business_type').show();
      $('#service_provider_personal_type').hide();
    } else {
      $('#service_provider_business_type').hide();
        $('#service_provider_personal_type').show();
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