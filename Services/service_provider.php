<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php include_once 'meta.php';?>
	<?php $getContentPageData = getAllDataWhere('services_content_pages','id',9);
		  $getPartnersBanner = $getContentPageData->fetch_assoc();
	?>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/base.css" rel="stylesheet">
        <link href="site_launch/css/style.css" rel="stylesheet">

	<!-- REVOLUTION SLIDER CSS -->
	<link href="layerslider/css/layerslider.css" rel="stylesheet">


</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
        <header id="plain">
		<?php include_once './top_header.php';?>
		<!-- End top line-->

		<div class="container">
                    <?php include_once './menu.php';?>
		</div>
		<!-- container -->
                
        </header>
	<!-- End Header -->
<?php  
error_reporting(0);
if (!isset($_POST['submit']))  {


  //If fail
  //echo "fail";

}else  {

  //If success
  //echo "<pre>";print_r($_POST);exit;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile_number = $_POST['mobile_number'];
  $landline_number = $_POST['landline_number'];
  $website = $_POST['website'];
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

  $lkp_state_id = $_POST['lkp_state_id'];
  $lkp_district_id = $_POST['lkp_district_id'];
  $lkp_city_id = $_POST['lkp_city_id'];
  $lkp_pincode_id = $_POST['lkp_pincode_id'];
  $lkp_location_id = $_POST['lkp_location_id'];

  $sub_category_id = implode(',',$_POST["sub_category_id"]);
  $sub_category_id1 = implode(',',$_POST["sub_category_id1"]);
  $associate_or_not = $_POST['associate_or_not'];
  $experience = $_POST['experience'];
  $created_at = date("Y-m-d h:i:s");
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
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
  
  $service_provider = "INSERT INTO service_provider_registration (`name`, `email`, `mobile_number`,`landline_number`,`website`, `lkp_state_id`, `lkp_district_id`, `lkp_city_id`, `lkp_pincode_id`, `lkp_location_id`, `address`,`service_provider_type_id`,`created_at`) VALUES ('$name', '$email', '$mobile_number', '$landline_number', '$website','$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$lkp_location_id', '$address','$service_provider_type_id', '$created_at')";
  $result1 = $conn->query($service_provider);
  $last_id = $conn->insert_id;

  if($service_provider_type_id == 1) {

    if($fileToUpload!='') {

      $target_dir = "../uploads/service_provider_business_logo/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $sql = "INSERT INTO service_provider_business_registration (`service_provider_registration_id`,`service_provider_type_id`, `company_name`,`est_year`, `total_no_of_emp`, `description`, `certification`, `working_hours`, `contact_numbers`, `email_id`, `sub_category_id`, `specialization_name`, `associate_or_not`,`logo`) VALUES ('$last_id','$service_provider_type_id', '$company_name', '$est_year', '$total_no_of_emp', '$description', '$certification', '$working_hours', '$contact_numbers', '$email_id','$sub_category_id', '$specialization_name', '$associate_or_not','$fileToUpload')"; 
          $res = $conn->query($sql);
      }
    }
  } else {

    if($fileToUpload1!='') {

      $target_dir1 = "../uploads/service_provider_personal_iamge/";
      $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
      $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);

      if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)) {
          $sql1 = "INSERT INTO service_provider_personal_registration (`service_provider_registration_id`,`service_provider_type_id`, `experience`,`image`, `working_hours`, `sub_category_id`, `specialization_name`) VALUES ('$last_id','$service_provider_type_id', '$experience', '$fileToUpload1', '$working_hours1','$sub_category_id1', '$specialization_name1')"; 
          $res = $conn->query($sql1);
      }
    }
  }
 
  if($result1 == 1) {
    echo "<script type='text/javascript'>alert('My Servant approved your Details.');location.href='index.php'</script>";
  } else {
    header('Location: service_provider.php?err=log-fail');
  }
}
?>
	<main>
		<!-- Slider -->
		 <div class="container-fluid page-title">
			<?php  
				  if(!empty($getPartnersBanner['image'])) { ?> 	
					<div class="row">
						<?php include_once './common_slider.php';?>
					</div>
				<?php } else { ?>
					<div class="row">
						<img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php }?>
    	</div>
                <div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					
					</li>
					<li>Service Provider</li>
				</ul>
			</div>
		</div>
		<div class="container margin_60">


			<div class="row"> 
			
			 <div class="col-sm-7 col-md-7">
                             <div class="main_title">
				<h2>Service Provider Registration</h2>
				
			</div>
					<div class="feature">
					<div class="row">
              
                <form autocomplete="off" data-toggle="validator" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter Name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                    </div> 
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="user_input" placeholder="Email" data-error="Please enter Valid Email Address" onkeyup="checkUserAvailTest()" required>
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="service_provider_registration">
                    <input type="hidden" id="column_name" value="email">
                  </div>
                </div> 
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile Number</label>
                    <input type="text" name="mobile_number" class="form-control valid_mobile_num" id="form-control-2" placeholder="Mobile Number" data-error="Please enter mobile number." required maxlength="10" pattern="[0-9]{10}">
                    <div class="help-block with-errors"></div>
                  </div>
                        </div>
                  <div class="col-sm-12 col-md-6 ">
                    <div class="form-group">
                      <label for="form-control-2" class="control-label">Landline Number</label>
                      <input type="text" name="landline_number" class="form-control valid_mobile_num" id="form-control-2" placeholder="landline Number" data-error="Please enter landline number." >
                      <div class="help-block with-errors"></div>
                    </div>
                  </div> 
                  <div class="col-sm-12 col-md-6 ">
                    <label for="form-control-2" class="control-label">Website</label>
                    <input type="url" name="website" class="form-control" id="form-control-2" placeholder="Website" data-error="Please enter Website." required >
                    <div class="help-block with-errors"></div>
                  </div> 
                    <div class="col-sm-12 col-md-6 ">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="form-control" data-error="This field is required." required onChange="getDistricts(this.value);">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
</div> 
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose your District</label>
                    <select name="lkp_district_id" id="lkp_district_id" class="form-control" data-error="This field is required." required onChange="getCities(this.value);">
                      <option value="">Select District</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
</div> 
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose your City</label>
                    <select name="lkp_city_id" id="lkp_city_id" class="form-control" data-error="This field is required." required onChange="getPincodes(this.value);">
                      <option value="">Select City</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
</div> 
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose your Pincode</label>
                    <select name="lkp_pincode_id" id="lkp_pincode_id" class="form-control" data-error="This field is required." required onChange="getLocations(this.value);">
                      <option value="">Select Pincode</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
</div> 
                    <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose your Locations</label>
                    <select name="lkp_location_id" id="lkp_location_id" class="form-control" data-error="This field is required." required>
                      <option value="">Select Locations</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                        </div> 
                    <div class="col-sm-12 col-md-12 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Address</label>
                    <textarea name="address" class="form-control" id="category_description" placeholder="Address" data-error="Please enter Address." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
</div> 
                    <div class="col-sm-12 col-md-6 ">
                  <?php $getServiceProviderTypes = getAllDataWithStatus('service_provider_types','0');?>
                  <div class="form-group">
				 
                  <label for="form-control-3" class="control-label">Choose your Service Provider</label><br>
                    <select name="service_provider_type_id" class="custom-select service_provider_type_id" id="service_provider_type_id" data-error="This field is required." required style="width:100%;height:38px">
                      <option value="">Select Service Provider</option>
                      <?php while($row = $getServiceProviderTypes->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['service_provider_type']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                    </div>
					
                  <div id="service_provider_business_type">
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Company Name</label>
                    <input type="text" name="company_name" class="form-control service_provider_business" id="form-control-2" placeholder="Company Name" data-error="Please enter Company Name">
                    <div class="help-block with-errors"></div>
                  </div>
                      </div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Years</label>
                    <input type="text" name="est_year" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Years" data-error="Please enter Years">
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Total Number of Employees</label>
                    <input type="text" name="total_no_of_emp" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Total Number of Employees" data-error="Please enter Total Number of Employees">
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Logo</label><br>
                    <!-- <img id="output" height="100" width="100"/> -->
						<label for="exampleFormControlFile1">                    
                        <input id="form-control-22" class="file-upload-input service_provider_business" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
</div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Description</label>
                    <textarea name="description" class="form-control" id="meta_desc" placeholder="Description" data-error="Please enter Description."></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Certification</label>
                    <input type="text" name="certification" class="form-control service_provider_business" id="form-control-2" placeholder="Certification" data-error="Please enter Certification">
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                     
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Contact Numbers</label>
                    <input type="text" name="contact_numbers" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Contact Numbers" data-error="Please enter Contact Numbers." maxlength="10" pattern="[0-9]{10}">
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                      <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email id</label>
                    <input type="email" name="email_id" id="user_input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control service_provider_business" id="email" placeholder="email" data-error="Please enter Valid Email Address">
                    <span id="email_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                  </div>
				</div>
				 <div class="col-sm-12 col-md-12 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
					<div class="row">
					<div class="col-sm-6 col-md-6">
                    <div class="row">
					<div class="col-sm-3">
					 <p style="margin-top:8px">Morning:</p>
					</div>
					<div class="col-sm-4">
                   <input type="text" name="working_hours" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Morning Timings">
                    <div class="help-block with-errors"></div>
					</div>
					<div class="col-sm-4">
                  <select name="strat_time" class="form-control" id="sel1">
					<option value="1">AM</option>
					<option value="2">PM</option>
				  </select>
                    <div class="help-block with-errors"></div>
					</div>
					</div>
					</div>
					<div class="col-sm-6 col-md-6"style="padding-left:5px">
                    <div class="row">
					<div class="col-sm-3">
					 <p style="margin-top:8px">Evening:</p>
					</div>
					<div class="col-sm-4">
                   <input type="text" name="evening_hours" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Working Hours">
                    <div class="help-block with-errors"></div>
					</div>
					<div class="col-sm-4">
                  <select name="night_time" class="form-control" id="sel1">
					<option value="1">AM</option>
          <option value="2">PM</option>
				  </select>
                    <div class="help-block with-errors"></div>
					</div>
					</div>
					</div>
					</div>
                  </div>
						</div> 
                      <div class="col-sm-12 col-md-6 ">
                  <?php $getSubCategories = getAllDataWithStatus('services_sub_category','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Specialization</label>
                    <select name="sub_category_id[]" class="form-control service_provider_business multi_select" multiple="multiple" id="sub_category_id" data-error="This field is required.">
                      <!-- <option value="">Select Specialization</option> -->
                      <?php while($row = $getSubCategories->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                      <?php } ?>
                      <option value="0">Others</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
				</div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group" id="specialization_name">
                    <label for="form-control-2" class="control-label">Specialization Name</label>
                    <input type="text" name="specialization_name" class="form-control specialization_name" id="form-control-2" placeholder="Specialization" data-error="Please enter Specialization">
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                      <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                      <!--- //if associate value = 0 (Yes) & if associate value = 1 (No) -->
                        <h4>Associate with us</h4>
                        <label>
                          <input type="radio" value="0" name="associate_or_not" required/>&nbsp;Yes</label>&nbsp;&nbsp;
                        <label>
                          <input type="radio" value="1" name="associate_or_not" required/>&nbsp;No</label>
                  </div>
                      </div>
                  </div>
                   
                  <div id="service_provider_personal_type">
                      <div class="col-sm-12 col-md-12 ">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Working Hours</label>
					<div class="row">
					<div class="col-sm-6 col-md-6">
                    <div class="row">
					<div class="col-sm-3">
					 <p style="margin-top:8px">Morning:</p>
					</div>
					<div class="col-sm-4">
                   <input type="text" name="working_hours" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Morning Timings">
                    <div class="help-block with-errors"></div>
					</div>
					<div class="col-sm-4">
                  <select name="strat_time" class="form-control" id="sel1">
					<option value="1">AM</option>
					<option value="2">PM</option>
				  </select>
                    <div class="help-block with-errors"></div>
					</div>
					</div>
					</div>
					<div class="col-sm-6 col-md-6"style="padding-left:5px">
                    <div class="row">
					<div class="col-sm-3">
					 <p style="margin-top:8px">Evening:</p>
					</div>
					<div class="col-sm-4">
                   <input type="text" name="evening_hours" class="form-control service_provider_business valid_mobile_num" id="form-control-2" placeholder="Time" data-error="Please enter Working Hours">
                    <div class="help-block with-errors"></div>
					</div>
					<div class="col-sm-4">
                  <select name="night_time" class="form-control" id="sel1">
					<option value="1">AM</option>
          <option value="2">PM</option>
				  </select>
                    <div class="help-block with-errors"></div>
					</div>
					</div>
					</div>
					</div>
                  </div>
						</div> 
                       <div class="col-sm-12 col-md-6 ">
                  <?php $getSubCategories = getAllDataWithStatus('services_sub_category','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Specialization</label>
                    <select name="sub_category_id1[]" class="form-control service_provider_personal multi_select" multiple="multiple" id="sub_category_id1" data-error="This field is required.">
                      <!-- <option value="">Select Specialization</option> -->
                      <?php while($row = $getSubCategories->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                      <?php } ?>
                      <option value="0">Others</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                       <div class="col-sm-12 col-md-6 ">
                  <div class="form-group" id="specialization_name1">
                    <label for="form-control-2" class="control-label">Specialization Name</label><br>
                    <input type="text" name="specialization_name1" class="form-control specialization_name1" id="form-control-2" placeholder="Specialization" data-error="Please enter Specialization" style="width:100%;height:40px">
                    <div class="help-block with-errors"></div>
                  </div>
</div>
                   
 <div class="col-sm-12 col-md-6 ">
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">image</label>
                    <!-- <img id="output1" height="100" width="100"/> -->
                   <label for="exampleFormControlFile1">
                        <input id="form-control-22" class="file-upload-input service_provider_personal" type="file" accept="image/*" name="fileToUpload1" id="fileToUpload1"  onchange="loadFile1(event)"  multiple="multiple" >
                      </label>
                  </div>
                       </div>
                  </div>
                <div class="col-sm-12 col-md-12">
					 <div class="form-group">
					  <label class="checkb1">Terms and Conditions
					<input type="checkbox" checked="checked">
					<span class="checkmark1"></span>
					</label>
					 </div>
					</div>
					 <div class="col-sm-4">
				  </div>
					<div class="col-sm-4">
                  <button type="submit" name="submit" value="submit" class="btn btn-default btn-block">Submit</button>
				  </div>
				  <div class="col-sm-4">
				  </div>
                </form>
              </div>
            </div>
				</div>
                 <div class="col-sm-5 col-md-5">
                        <div class="main_title">
				<h2>Benefits</h2>
				
			</div>
                    </div> 
			
</div>
                   
			<!-- End row -->
			</div>
			
		</div>
		
		<!-- End section -->

	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
    </footer><!-- End footer -->

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	
	<!-- Common scripts -->
	<script src="../cdn-cgi/scripts/78d64697/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>

	<!-- Specific scripts -->
	<script src="layerslider/js/greensock.js"></script>
	<script src="layerslider/js/layerslider.transitions.js"></script>
	<script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			'use strict';
			$('#layerslider').layerSlider({
				autoStart: true,
				responsive: true,
				responsiveUnder: 1280,
				layersContainer: 1170,
				skinsPath: 'layerslider/skins/'
					// Please make sure that you didn't forget to add a comma to the line endings
					// except the last line!
			});
		});
	</script>
<script type="text/javascript">
  $(document).ready(function () { 
    $(".multi_select").attr("required", "true");
    $('#service_provider_business_type, #service_provider_personal_type,#specialization_name,#specialization_name1').hide();
    $('.service_provider_type_id').change(function() {

      if($(this).val() == 1) {
        $('#service_provider_business_type').show();
        $('.service_provider_business').val('');
        $('#output1').removeAttr('src');
        $('#service_provider_personal_type').hide();
        $(".service_provider_business").attr("required", "true");
        $(".service_provider_personal").removeAttr('required');
      } else if($(this).val() == 2) {
        $('#output').removeAttr('src');
        $('#service_provider_business_type').hide();
        $('.service_provider_personal').val("");
        $('#service_provider_personal_type').show();
        $(".service_provider_personal").attr("required", "true");
        $(".service_provider_business").removeAttr('required');
      }  
    });
    $('#sub_category_id').change(function() {

      if($(this).val() == 0) {
        $('#specialization_name').show();
        $('.specialization_name').val("");
        $(".specialization_name").attr("required", "true");
      } else{
        $('#specialization_name').hide();
        $(".specialization_name").removeAttr('required');
      }
    });
    $('#sub_category_id1').change(function() {

      if($(this).val() == 0) {
        $('#specialization_name1').show();
        $('.specialization_name1').val("");
        $(".specialization_name1").attr("required", "true");
      } else{
        $('#specialization_name1').hide();
        $(".specialization_name1").removeAttr('required');
      }
    });
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
<script type="text/javascript">
      function checkUserAvailTest() {
        var userInput = document.getElementById("user_input").value;
        var table = document.getElementById("table_name").value;
        var columnName = document.getElementById("column_name").value;
        if (userInput){
          $.ajax({
          type: "POST",
          url: "common_user_avail_check.php",
          data: {
            userInput:userInput,table:table,columnName:columnName,
          },
          success: function (response) {
            if (response > 0){
              $('#input_status').html("<span>Already Exist</span>");
              $("#user_input").val("");
            } else {
              $('#input_status').html("");        
            }
          }
          });          
        }
      }
    </script>
    <script type="text/javascript">
    function getDistricts(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_districts.php",
        data:'lkp_state_id='+val,
        success: function(data){
            $("#lkp_district_id").html(data);
        }
        });
    }
    function getCities(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_cities.php",
        data:'lkp_district_id='+val,
        success: function(data){
            $("#lkp_city_id").html(data);
        }
        });
    }
    function getPincodes(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_pincodes.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
    function getLocations(val) { 
        $.ajax({
        type: "POST",
        url: "services_manage_webmaster/get_locations.php",
        data:'lkp_pincode_id='+val,
        success: function(data){
            $("#lkp_location_id").html(data);
        }
        });
    }
    </script>
</body>

</html>