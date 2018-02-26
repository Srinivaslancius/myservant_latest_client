<!DOCTYPE html>
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
<style>
.one{
	 background-color: #FE6003 !important;
    display: inline-block;
    height: 30px;
    width: 30px;
    text-align: center;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    color: #fff;
    margin-right: 15px;
    float: left;
    padding:5px;
}
.icon-mobile,.icon-mail-1{
    background-color: #FE6003;
    display: inline-block;
    height: 30px;
    width: 30px;
    text-align: center;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    color: #fff;
    margin-right: 15px;
    float: left;
    padding:5px;
}
</style>
</head>


<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->
<?php

if(!empty($_POST['name_contact']) && !empty($_POST['how_can_help']) && !empty($_POST['email_contact']) && !empty($_POST['phone_contact']) && !empty($_POST['message_contact']) && !empty($_POST['subject']) && !empty($_POST['priority']))  {

    $name_contact = $_POST['name_contact'];
    $how_can_help = $_POST['how_can_help'];
    $email_contact = $_POST['email_contact'];
    $phone_contact = $_POST['phone_contact'];
    $message_contact = $_POST['message_contact'];
    $subject1 = $_POST['subject'];
    $priority = $_POST['priority'];

$dataem = $getFoodSiteSettingsData["contact_email"];
//$to = "srinivas@lanciussolutions.com";
$to = $dataem;
$subject = "Myservent - Contact Us ";
$message = '';      
$message .= '<body>
    <div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
    <header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
     <center><img src='.$base_url . "uploads/food_logo/".$getFoodSiteSettingsData["logo"].' class="logo-responsive"></center>
    </header>
    <article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
        <h1 style="color:#fe6003">User Feedback Information.</h1>
        <h4>First Name: </h4><p>'.$name_contact.'</p>
        
        <h4>Email: </h4><p>'.$email_contact.'</p>
        <h4>Mobile: </h4><p>'.$phone_contact.'</p>
        <h4>How Can I Help You: </h4><p>'.$how_can_help.'</p>
        <h4>Subject: </h4><p>'.$subject1.'</p>
        <h4>Priority: </h4><p>'.$priority.'</p>
        <h4>Message: </h4><p>'.$message_contact.'</p>
    </article>
    <footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getFoodSiteSettingsData['footer_text'].'</footer>
    </div>

    </body>';
//echo $message; die;
//$sendMail = sendEmail($to,$subject,$message,$email_contact);
$name = "My Servant";
$from = $email_contact;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
$headers .= 'From: '.$name.'<'.$from.'>'. "\r\n";
if(mail($to, $subject, $message, $headers)) {
    echo  "<script>alert('Thank You For Your feedback');window.location.href('contact.php');</script>";
}

}
?>
<?php $getAllContactdata = getAllDataWithStatus('food_how_can_i_help_you','0'); ?>
          
   

    <!-- Header ================================================== -->
     <header>
      <?php include_once './header.php';?>
     </header>
    <!-- End Header =============================================== -->
 <div class="container1">
 <img src="img/sub_header_home.jpg" class="img-responsive immgg" style="width:100%;height:400px">
 <div class="centered">Contact Us</div>
</div>
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Contact Us</li>
               
            </ul>
           
        </div>
    </div><!-- Position -->
<?php $getAllCustomerServicesdata = getAllDataWhere('food_content_pages','id',12);
          $getCustomerServicesdata = $getAllCustomerServicesdata->fetch_assoc();
?>

<?php $getAllRestaurantData = getAllDataWhere('food_content_pages','id',13);
          $getRestaurantData = $getAllRestaurantData->fetch_assoc();
?>
<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row" id="contacts">
        <div class="col-md-6 col-sm-6">
            <div class="box_style_2">
                <h2 class="inner"><?php echo $getCustomerServicesdata['title']; ?></h2>
                <p class="add_bottom_30">
                    <?php echo substr(strip_tags($getCustomerServicesdata['description']), 0,200);?>
                </p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="box_style_2">
                <h2 class="inner"><?php echo $getRestaurantData['title']; ?></h2>
                <p class="add_bottom_30"><?php echo substr(strip_tags($getRestaurantData['description']), 0,200);?>
                </p>
            </div>
        </div>
    </div><!-- End row -->  
    <div class="box_style_2">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <form method="post" action="" id="contactform" name="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="text">Name:</label>
                            <p><input type="text" name= "name_contact" class="form-control " placeholder="Name" required></p>
                        </div>
                        <div class="col-sm-6">
                            <label for="email">Email:</label>               
                            <p><input type="email" name="email_contact" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control " placeholder="Email" required></p>
                        </div>
                        <div class="col-sm-6">
                            <label for="text">Mobile No:</label>                
                            <input type="text" class="form-control valid_mobile_num" maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)" name="phone_contact" placeholder="Mobile Number" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="text">Select:</label>
                            <p>
                                <select class="form-control" name="how_can_help" id="sel1" required>
                                    <option value="">How can we help you?*</option>
                                    <?php while($getContactdata = $getAllContactdata->fetch_assoc()) { ?>
                                    <option><?php echo $getContactdata['description'] ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <label for="text">Subject:</label>                
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter Subject" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="text">Select Priority:</label>
                            <p>
                                <select class="form-control" name="priority" id="sel1" required>
                                    <option value="">Select Priority</option>
                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="Option3">Option3</option>
                                </select>
                            </p>
                        </div>
                        <div class="col-sm-12">
                            <label for="text">Message:</label>                
                            <p> <textarea class="form-control" name="message_contact" rows="4" id="comment" placeholder="Message*" required></textarea></p>
                        </div>
                        <div class="col-sm-3">  
                            <button type="submit" class="btn btn-submit" style="background-color:#f26226;color:white">Send Message</button>
                        </div>
                        <div class="col-sm-9"></div>
                    </div>
                </form>
				 </div>
                <div class="col-md-4 col-sm-4">
                    <h4 style="color:#FE6003">Information</h4><br>
                    <p style="margin-bottom:5px"><span class="icon-location one"></span> <?php echo $getFoodSiteSettingsData["address"]; ?></p>
                    <p style="margin-bottom:20px"><span class="icon-mobile"></span> <a href="Tel:<?php echo $getFoodSiteSettingsData['mobile']; ?>"><?php echo $getFoodSiteSettingsData['mobile']; ?></a> Toll Free (24*7)</p>
                    <p><span class="icon-mail-1"></span> <a href="mailto::<?php echo $getFoodSiteSettingsData['contact_email']; ?>"><?php echo $getFoodSiteSettingsData['email']; ?></a></p>
                </div>
           
        </div>
    </div>
</div><!-- End container -->
<div class="high_light">
       <?php include_once 'view_restaurants.php'; ?>
      </div>

<!-- Footer ================================================== -->
    <footer>
         <?php include_once 'footer.php'; ?>
    </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->    
<!-- COMMON SCRIPTS -->
<script src="../cdn-cgi/scripts/84a23a00/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>
<script>
      function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
      }
    </script>
</body>
</html>