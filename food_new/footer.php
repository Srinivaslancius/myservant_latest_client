

<?php

if(!empty($_POST['email']))  {

    $email = $_POST['email'];
    $created_at = date("Y-m-d h:i:s");
    $sql = "INSERT INTO food_newsletter (`email`, `created_at`) VALUES ('$email','$created_at')";
    $conn->query($sql);

$dataem = $getFoodSiteSettingsData["email"];
//$to = "srinivas@lanciussolutions.com";
$to = $dataem;
$subject = "Myservent - Subscribe Us ";
$message = '';      
$message .= '<body>
    <div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
    <header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
     <center><img src='.$base_url . "uploads/logo/".$getFoodSiteSettingsData["logo"].' class="logo-responsive"></center>
    </header>
    <article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
        <h1 style="color:#fe6003">Subscribe Us.</h1>
        <h4>Email: </h4><p>'.$email.'</p>
        <h4>Careted Date: </h4><p>'.$created_at.'</p>
    </article>
    <footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getFoodSiteSettingsData['footer_text'].'</footer>
    </div>

    </body>';


//$sendMail = sendEmail($to,$subject,$message,$email_contact);
$name = "My Servant";
$from = $email_contact;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
$headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";
if(mail($to, $subject, $message, $headers)) {
    echo  "<script>alert('Thank You For Subscribe Us!')</script>";
}

}
?>
    <div class="container">
        <div class="row">       
            <div class="col-md-3 col-sm-3">
               <h3>Contact us</h3>
               <p><span class="glyphicon glyphicon-map-marker"></span> <?php echo $getFoodSiteSettingsData['address']; ?></p>
               <p><span class="glyphicon glyphicon-phone-alt"></span> <a href="Tel:<?php echo $getFoodSiteSettingsData['mobile']; ?>"><?php echo $getFoodSiteSettingsData['mobile']; ?></a> Toll Free (24*7)</p>
               <p><span class="glyphicon glyphicon-envelope"></span>  <a href="mailto::<?php echo $getFoodSiteSettingsData['email']; ?>"><?php echo $getFoodSiteSettingsData['email']; ?></a></p>
            </div>
            <div class="col-md-2 col-sm-2">
            <h3>Menu</h3>
                
               <ul style="list-style-type:disc">
                    <li><a href="about.php">About us</a></li>
                    <li><a href="contact.php">Contact us</a></li>
                     <li><a href="help_center.php">Help Center </a></li>
                    <li><a href="return_policy.php">Return Policy </a></li>                               
                    <li><a href="terms_conditions.php">Terms and conditions </a></li>                                   
                </ul>
        
            </div>
             <div class="col-md-3 col-sm-3">
              <h3>Newsletter</h3>
                <p>
                    Join our newsletter to keep be informed about offers and news.
                </p>
             
                <div id="message-newsletter_2">
                </div>
                <form method="post" action="" name="newsletter_2">
                    <div class="form-group">
                        <input name="email" type="email" value="" placeholder="Your mail" class="form-control" required>
                    </div>
                    <input type="submit" value="Subscribe" class="btn_1" >
                </form>
            </div>
             <div class="col-md-1 col-sm-1">
             </div>
            <div class="col-md-3 col-sm-3" id="newsletter">
                <h3>Download our app</h3>
              <p style="margin-bottom:5px"><a href="<?php echo $getFoodSiteSettingsData['android_app_link'] ?>"  target="_blank"><img src="img/googleplay.png"></a></p>
              <p><a href="<?php echo $getFoodSiteSettingsData['apple_app_link'] ?>"  target="_blank"><img src="img/applestore.png"></a></p>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="<?php echo $getFoodSiteSettingsData['fb_link']; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                        <li><a href="<?php echo $getFoodSiteSettingsData['twitter_link']; ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                        <li><a href="<?php echo $getFoodSiteSettingsData['gplus_link']; ?>" target="_blank"><i class="icon-google"></i></a></li>
                        <li><a href="<?php echo $getFoodSiteSettingsData['inst_link']; ?>" target="_blank"><i class="icon-instagram"></i></a></li>
                        <!-- <li><a href="#0"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#0"><i class="icon-vimeo"></i></a></li>
                        <li><a href="#0"><i class="icon-youtube-play"></i></a></li> -->
                    </ul>
                    <p>
                         Designed By <a href="https://www.lanciussolutions.com" target="_blank"> Lancius IT Solutions</a>.
                    </p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->

    <!-- This Script For validations -->
<script type="text/javascript" src="js/check_number_validations.js"></script>