<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['seid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mobile_number'];
        $fileToUpload = $_FILES["fileToUpload"]["name"];
        $experience = $_POST['experience'];
        $description = $_POST['description'];
        $specalization = $_POST['specalization'];
        $address = $_POST['address'];
        $created_at = date("Y-m-d h:i:s");
        $employee_belongs_to = $_POST['employee_belongs_to'];
        $service_provider_registration_id = $_POST['service_provider_registration_id'];
       if ($employee_belongs_to  == 1) {
          $service_provider_registration_id = 0;
       }
        $status = $_POST['lkp_status_id'];

    if($_FILES["fileToUpload"]["name"]!='') {

              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/service_employee_photo/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('photo','services_employee_registration','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE `services_employee_registration` SET name = '$name',email = '$email',mobile_number = '$mobile_number',photo='$fileToUpload',experience = '$experience', description='$description',specalization='$specalization',address = '$address', employee_belongs_to='$employee_belongs_to',service_provider_registration_id='$service_provider_registration_id',lkp_status_id='$status' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='service_employee_registration.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='service_employee_registration.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      } else {
          $sql = "UPDATE `services_employee_registration` SET name = '$name',email = '$email',mobile_number = '$mobile_number',experience = '$experience', description='$description',specalization='$specalization',address = '$address', employee_belongs_to='$employee_belongs_to',service_provider_registration_id='$service_provider_registration_id',lkp_status_id='$status' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='service_employee_registration.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='service_employee_registration.php?msg=fail'</script>";
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
              <?php $getServiceEmployees = getAllDataWhere('services_employee_registration','id',$id);
              $getServiceEmployeesData = $getServiceEmployees->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter a valid service employee Name" required value="<?php echo $getServiceEmployeesData['name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="user_input" placeholder="Email" data-error="Please enter a valid email address." required onkeyup="checkUserAvailTest()" value="<?php echo $getServiceEmployeesData['email'];?>">
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="services_employee_registration">
                    <input type="hidden" id="column_name" value="email">
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Mobile" data-error="Please enter mobile number." required onkeypress="return isNumberKey(event)" maxlength="10" pattern="[0-9]{10}" value="<?php echo $getServiceEmployeesData['mobile_number'];?>">
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Photo</label>
                    <img src="<?php echo $base_url . 'uploads/service_employee_photo/'.$getServiceEmployeesData['photo'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple">
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Experience</label>
                    <input type="text" name="experience" class="form-control" id="experience" placeholder="Experience" data-error="Please enter experience." required value="<?php echo $getServiceEmployeesData['experience'];?>">
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="category_description" placeholder="Description" data-error="Please enter description." required><?php echo $getServiceEmployeesData['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Specalization</label>
                    <input type="text" name="specalization" class="form-control" id="form-control-2" placeholder="Specalization" data-error="Please enter a valid service specalization" required value="<?php echo $getServiceEmployeesData['specalization'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Address</label>
                    <textarea type="text" name="address" class="form-control" id="meta_desc" placeholder="Address" data-error="This field is required." required><?php echo $getServiceEmployeesData['address'];?></textarea>
                  </div>
                  <?php $getServiceEmployeeBelongs = getAllDataWithStatus('service_employee_belongs_to','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Service Employee Belongs To</label>
                    <select id="employee_belongs_to" name="employee_belongs_to" class="custom-select service_provider_type" data-error="This field is required." required>
                      <option value="">Select Service Employee</option>
                      <?php while($row = $getServiceEmployeeBelongs->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceEmployeesData['employee_belongs_to']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['services_employee_belongs']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getServiceProReg = getAllDataWithStatus('service_provider_registration','0');?>
                  <div id = "select_service_provider_id">
                    <div class="form-group">
                      <label for="form-control-3" class="control-label">Choose Service Provider</label>
                      <select id="service-provider-type1" name="service_provider_registration_id" class="custom-select service_provider_type1" data-error="This field is required.">
                        <option value="0">Select Service Provider</option>
                        <?php while($row1 = $getServiceProReg->fetch_assoc()) {  ?>
                            <option <?php if($row1['id'] == $getServiceEmployeesData['service_provider_registration_id']) { echo "Selected"; } ?> value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                        <?php } ?>
                     </select>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceEmployeesData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
          $('#employee_belongs_to').change(function() {
             if($(this).val() == 2) {
                $('#select_service_provider_id').show();
             }else{
                $('#service_provider_type1').val(0);
                $('#select_service_provider_id').hide();
             }  
          });
          if ($('#employee_belongs_to').val() == 1) {
                $('#service_provider_type1').val(0);
                $('#select_service_provider_id').hide();
             } 
        });  
    </script>