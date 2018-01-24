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
  $title = $_POST['title'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $reason = $_POST['reason'];
  $description = $_POST['description'];
  $created_at = date('Y-m-d H:i:s', time() + 24 * 60 * 60);

  $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
  if($fileToUpload!='') {

    $target_dir = "../uploads/services_testimonials_images/";
    $target_file = $target_dir . basename($fileToUpload);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO services_testimonials (`title`,`email`,`phone_number`,`reason`, `description`, `image`, `lkp_status_id`, `created_at`) VALUES ('$title','$email','$phone_number','$reason', '$description','$fileToUpload', 1, '$created_at')";
        if($conn->query($sql) === TRUE){
           echo "<script type='text/javascript'>window.location='user_feedback_form.php?succ=log-success'</script>";
        } else {
           header('Location: user_feedback_form.php?err=log-fail');
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

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
          <img src="img/slides/slide_1.jpg" class="img-responsive">
        </div>
      <?php }?>
    	</div>
                <div id="position">
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a>
					</li>
					<li>Feedback Form</li>
				</ul>
			</div>
		</div>
		<div class="container-fluid marg10 search_back">
            	
              <?php include_once './news_scroll.php';?> 
               
                </div>
		<div class="container margin_60">
<div class="main_title">
				<h2>FEEDBACK FORM</h2>
				
			</div>
      <?php if(isset($_GET['succ']) && $_GET['succ'] == 'log-success' ) {  ?>
      		<div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 alert alert-success" style="top:10px; display:block" id="set_valid_msg">
                  <strong>Success!</strong> Thank You for Your Feedback.
                </div>
                <div class="col-sm-3"></div>
            </div>
            <?php }?>
        <?php if(isset($_GET['err']) && $_GET['err'] == 'log-fail' ) {  ?>
        	<div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 alert alert-danger" style="top:10px; display:block" id="set_valid_msg">
                  <strong>Failed!</strong> Data Updation Failed.
                </div>
                <div class="col-sm-3"></div>
            </div>
        <?php }?>

			<div class="row"> 
<div class="col-sm-1">
</div>			
			 <div class="col-sm-10">
					<div class="feature">
					<div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form autocomplete="off" data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Name</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Name" data-error="Please enter title" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" id="form-control-2" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control valid_mobile_num" id="form-control-2" placeholder="Phone Number" required maxlength="10" pattern="[0-9]{10}">
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getFeedReasons = getAllDataWithStatus('services_customer_feedback_reasons','0');?>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose reason</label>
                    <select name="reason" class="form-control" required>
                      <option value="">Select reason</option>
                      <?php while($row = $getFeedReasons->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['title']; ?>" ><?php echo $row['title']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Profile</label>
                    <!-- <img id="output" height="100" width="100"/> -->
                    <label for="exampleFormControlFile1">                    
                        <input id="form-control-22" class="file-upload-input service_provider_business" type="file" accept="image/*" name="fileToUpload" id="fileToUpload" multiple="multiple" required>
                      </label>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Descriptiopn</label>
                    <textarea name="description" class="form-control" placeholder="Descriptiopn" data-error="Please enter Descriptiopn." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                
                  <button type="submit" name="submit" value="submit" class="btn btn-default btn-block">Submit</button>
                </form>
              </div>
            </div>
				</div>
                 
			</div>
			<div class="col-sm-1">
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
	    setTimeout(function () {
	      $('#set_valid_msg').hide();
	    }, 2000);
	  });
	</script>
</body>

</html>