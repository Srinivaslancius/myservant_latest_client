<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(1);
  if (!isset($_POST['submit']))  {
              echo "fail";
          } else  {
        //echo "<pre>";print_r($_POST);  exit;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mobile_number'];
        $fileToUpload = $_FILES["fileToUpload"]["name"];
        $experience = $_POST['experience'];
        $description = $_POST['description'];
        $specalization = $_POST['specalization'];
        $address = $_POST['address'];
        $lkp_state_id = $_POST['lkp_state_id'];
        $lkp_district_id = $_POST['lkp_district_id'];
        $lkp_city_id = $_POST['lkp_city_id'];
        $created_at = date("Y-m-d h:i:s");
        $employee_belongs_to = $_POST['employee_belongs_to'];
        $service_provider_registration_id = $_POST['service_provider_registration_id'];
        $status = $_POST['lkp_status_id'];
        if($_POST['employee_belongs_to'] == 1) {
          $service_provider_registration_id = 0;
        } else {
          $service_provider_registration_id = $_POST['service_provider_registration_id'];
        }
        if($fileToUpload!='') {
          $target_dir = "../../uploads/service_employee_photo/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO services_employee_registration (`name`, `email`, `mobile_number`, `photo`,`experience`, `description`, `specalization`, `address`,`employee_belongs_to`,`service_provider_registration_id`,`created_at`,`lkp_status_id`, `lkp_state_id`, `lkp_district_id`, `lkp_city_id`) VALUES ('$name', '$email', '$mobile_number','$fileToUpload','$experience','$description','$specalization','$address','$employee_belongs_to','$service_provider_registration_id','$created_at','$status','$lkp_state_id','$lkp_district_id','$lkp_city_id')";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='service_employee_registration.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='service_employee_registration.php?msg=fail'</script>";
          }
        }else {
            echo "Sorry, there was an error uploading your file.";
        }  
      }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Service Employee Registration</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter a valid service employee Name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_input" placeholder="Email" data-error="Please enter a valid email address." required onkeyup="checkUserAvailTest()">
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="services_employee_registration">
                    <input type="hidden" id="column_name" value="email">
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="mobile_number" class="form-control valid_mobile_num" id="mobile_number" placeholder="Mobile" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}" >
                    <div class="help-block with-errors"></div>
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
                    <select name="lkp_city_id" id="lkp_city_id" class="custom-select" data-error="This field is required." required onChange="getPincodes(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a City', allowClear: true }">
                      <option value="">Select City</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Photo</label>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" required >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Experience</label>
                    <input type="text" name="experience" class="form-control" id="experience" placeholder="Experience" data-error="Please enter experience." required>
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="category_description" placeholder="Description" data-error="Please enter description." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Specalization</label>
                    <input type="text" name="specalization" class="form-control" id="form-control-2" placeholder="Specalization" data-error="Please enter a valid service specalization" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Address</label>
                    <textarea type="text" name="address" class="form-control" id="meta_desc" placeholder="Address" data-error="This field is required." required></textarea>
                  </div>
                  <?php $getServiceEmployeeBelongs = getAllDataWithStatus('service_employee_belongs_to','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Service Employee Belongs To</label>
                    <select id="employee_belongs_to" name="employee_belongs_to" class="custom-select service_provider_type" data-error="This field is required." required>
                      <option value="">Select Service Employee</option>
                      <?php while($row = $getServiceEmployeeBelongs->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['services_employee_belongs']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getServiceProReg = getAllDataWithStatus('service_provider_registration','0');?>
                  <div id = "select_service_provider_id">
                    <div class="form-group">
                      <label for="form-control-3" class="control-label">Choose Service Provider</label>
                      <select  name="service_provider_registration_id" class="custom-select service_provider_type1" data-error="This field is required." data-plugin="select2" data-options="{ placeholder: 'Select a Provider', allowClear: true }">
                        <option value="">Select Service Provider</option>
                        <?php while($row = $getServiceProReg->fetch_assoc()) {  ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                     </select>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
    <script type="text/javascript">
        $(document).ready(function () {
          $('#select_service_provider_id').hide();
          $('.service_provider_type').change(function() {
             if($(this).val() == 2) {
                $('#select_service_provider_id').show();
                $('.service_provider_type1').val("");
                $(".service_provider_type1").attr("required", "true");
             }else{
                $('#select_service_provider_id').hide();
                $('.service_provider_type1').val("");
                $(".service_provider_type1").removeAttr('required');
             }   
          });
        });  
    </script>