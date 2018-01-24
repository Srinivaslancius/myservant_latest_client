<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html style="overflow-x:hidden">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    <?php 
    if (isset($_POST['register']))  {

        $user_mobile = $_POST['user_mobile'];
        //$mobile_otp = rand(1000, 9999); //Your message to send, Add URL encoding here.
        $mobile_otp = "1234";
        $selOTP = getAllDataWhere('user_mobile_otp','user_mobile',$user_mobile);    
        $getNoRows = $selOTP->num_rows; 

        if($getNoRows > 0) {
            $mobOtpSave = "UPDATE user_mobile_otp SET mobile_otp = '$mobile_otp' WHERE user_mobile = '$user_mobile' ";
            $saveOTP = $conn->query($mobOtpSave);
        } else {
            $mobOtpSave = "INSERT INTO `user_mobile_otp`(`user_mobile`, `mobile_otp`) VALUES ('$user_mobile', '$mobile_otp') ";
            $saveOTP = $conn->query($mobOtpSave);
        }       
    }
    ?>
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">

        
    
    <!-- SPECIFIC CSS -->
    <link href="layerslider/css/layerslider.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    <!-- Header ================================================== -->
    <header>
     <?php include_once './header.php';?>
        </header>
    <!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
        <h1>OTP</h1>
         <!-- <p>One Stop Shop for all your food needs.</p>-->
         <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>OTP</li>
               
            </ul>
            <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a>
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
        </div>
    <div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
            <div class="feature">
                <form method="post" id="opt_valid_mobile" name="opt_valid_mobile" class="popup-form" >
                <center> <h2 class="nomargin_top" style="color:#f26226">VERIFY OTP</h2></center>
                    <hr class="more_margin">


                    <input type="hidden" name="user_name" value="<?php echo $_POST['user_name']; ?>">
                    <input type="hidden" name="user_mobile_cust" value="<?php echo $_POST['user_mobile']; ?>" id="user_mobile_cust">
                    <input type="hidden" name="user_email" value="<?php echo $_POST['user_email']; ?>">
                    <input type="hidden" name="user_password" value="<?php echo encryptPassword($_POST['user_password']); ?>"><input type="hidden" name="checkout_key" value="<?php echo $_POST['checkout_key']; ?>" id="checkout_key">
                    
                    <label for="number">Mobile No:</label>
                    <input type="text" id="user_mobile" name="user_mobile" class="form-control valid_mobile_num" placeholder="Enter Phone number" value="<?php echo $_POST['user_mobile']; ?>" maxlength="10" pattern="[0-9]{10}" readonly required>
                    <label for="number">OTP:</label>
                    <input type="tel" id="mobile_otp" name="mobile_otp" class="form-control valid_mobile_num" placeholder="Enter OTP" maxlength="4" pattern="[0-9]{10}"  required >
                    <span id="return_msg" style="display:none"></span><br />
                                <div class="clear_fix"></div>
                    <button type="button" value="Verify" class="btn btn-submit" id="verify_otp">SUBMIT</button>
                
                </form>
            </div>
        </div>
        <div class="col-md-4">
    </div>
    </div><!-- End row -->
    
    
</div><!-- End container -->


<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
    <footer>
         <?php include_once 'footer.php'; ?>
         </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   
    
<!-- Register modal -->

<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- COMMON SCRIPTS -->
<script type="text/javascript" src="js/check_number_validations.js"></script>

<script type="text/javascript">

$('#verify_otp').on('click', function () {

  var user_mobile = $('#user_mobile').val();
  var mobile_otp = $('#mobile_otp').val();
  var checkout_key = $('#checkout_key').val();
  if(user_mobile!='' && mobile_otp!='') {

      $.ajax({
        type:"post",
        url:"check_otp.php",
        data:$("form").serialize(),
        success:function(result){           
          if(result == 0) {
            $("#return_msg").css("display", "block");       
            $("#return_msg").html("<span style='color:red;'>Please enter valid OTP!</span>");
            $('#mobile_otp').val('');
          } else {
            //Success
            alert("OTP verified");
            if (checkout_key == '') {
                window.location.href = 'index.php';
            } else {
                window.location.href = 'checkout.php';
            }
          }
        }
      });

  } else {
    alert("Please enter OTP!");
    $("#return_msg").css("display", "none");
    return false;
  }
  
});

</script>
</body>
</html>