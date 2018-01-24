<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html style="overflow-x:hidden">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
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
        <h1>Reset Password</h1>
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
                <li>Reset Password</li>
               
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
        </div>
        <?php
    error_reporting(0);
    if(isset($_GET['token']) && $_GET['token']!='')  {
        //Login here
        $token = $_GET['token'];
    }
    if(isset($_POST["token"]) && $_POST["token"]!="") { 
        $token = decryptPassword($_POST['token']);
        $encNewPass = encryptPassword($_POST["user_password"]);
        $updateq = "UPDATE users SET user_password='$encNewPass' WHERE id = '" . $token . "'";
        if($conn->query($updateq) === TRUE){             
            echo "<script type='text/javascript'>alert('Your Password Updated Successfully');window.location='login.php?succ=log-success'</script>";
        } else {
            echo "<script type='text/javascript'>alert('Your Password not Updated');window.location='login.php?succ=log-fail'</script>";
        }
    }
?>
    <div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
            <div class="feature">
                
                <center> <h2 class="nomargin_top" style="color:#f26226">Reset Password</h2></center>
                    <hr class="more_margin">
                    <form action="" method="POST" class="popup-form">
                     <label for="user_password">New Password</label>
                     <input type="password" class="form-control" minlength="8" id="user_password" name="user_password" placeholder="New Password" data-error ="please entre atleast 8 characters" required>
                     <input type="hidden" name="token" value="<?php echo $token; ?>">
                     <label for="email">Retype Password</label>
                     <input type="password"  class="form-control" id="retypr_user_password" name="retypr_user_password" placeholder="Retype Password" onChange="checkPasswordMatch();" required>
                     <div id="divCheckPasswordMatch" style="color:red"></div>
                    <button type="submit" name="submit" class="btn btn-submit">SUBMIT</button>
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
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<script type="text/javascript">
function checkPasswordMatch() {
            var password = $("#user_password").val();
            var confirmPassword = $("#retypr_user_password").val();
            if (confirmPassword != password) {
                $("#divCheckPasswordMatch").html("Passwords do not match!");
                $("#retypr_user_password").val("");
            } else {
                $("#divCheckPasswordMatch").html("");
            }
        }
</script>
</body>
</html>