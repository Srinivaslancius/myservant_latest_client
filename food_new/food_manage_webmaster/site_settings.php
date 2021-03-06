<?php include_once 'admin_includes/main_header.php'; ?>

<?php  
 if (!isset($_POST['submit']))  {
      //If fail
        echo "fail";
    } else {
    //If success
    $id=1;
    $admin_title = $_POST['admin_title'];  
    $email = $_POST['email'];
    $from_email = $_POST['from_email'];
    $orders_email = $_POST['orders_email'];
    $contact_email = $_POST['contact_email'];
    $google_analytics_code  = $_POST['google_analytics_code'];
    $service_tax = $_POST['service_tax'];
    $mobile = $_POST['mobile'];    
    $footer_text = $_POST['footer_text'];
    $open_timings = $_POST['open_timings'];
    $closing_time = $_POST['closing_time'];
    $address = $_POST['address'];
    $delivery_charges = $_POST['delivery_charges'];
    $paytm = $_POST['paytm'];

    if($_FILES["logo"]["name"]!='') {
                                          
        $logo = $_FILES["logo"]["name"];
        $target_dir = "../../uploads/food_logo/";
        $target_file = $target_dir . basename($_FILES["logo"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        $getImgUnlink = getImageUnlink('logo','food_site_settings','id',$id,$target_dir);
        //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            $sql = "UPDATE `food_site_settings` SET admin_title = '$admin_title',from_email = '$from_email',orders_email ='$orders_email', contact_email = '$contact_email', delivery_charges = '$delivery_charges',closing_time = '$closing_time', google_analytics_code ='$google_analytics_code', service_tax = '$service_tax',email='$email', mobile='$mobile', logo = '$logo',footer_text='$footer_text', address='$address', paytm='$paytm' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='site_settings.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='site_settings.php?msg=fail'</script>";
            }
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }  else {
        $sql = "UPDATE `food_site_settings` SET admin_title = '$admin_title', from_email = '$from_email', orders_email ='$orders_email', contact_email = '$contact_email', delivery_charges = '$delivery_charges',closing_time = '$closing_time', google_analytics_code ='$google_analytics_code', service_tax = '$service_tax', email='$email', mobile='$mobile',footer_text='$footer_text', address='$address', paytm='$paytm' WHERE id = '$id' ";
        if($conn->query($sql) === TRUE){
           echo "<script type='text/javascript'>window.location='site_settings.php?msg=success'</script>";
        } else {
           echo "<script type='text/javascript'>window.location='site_settings.php?msg=fail'</script>";
        }
    }   
    
}
?>

      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Site Settings</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <?php $getSiteSettings = getAllDataWhere('food_site_settings','id','1'); 
                  $getSiteSettingsData = $getSiteSettings->fetch_assoc(); ?>
                    <label for="form-control-2" class="control-label">Admin Title</label>
                    <input type="text" name="admin_title" class="form-control" id="form-control-2" placeholder="Admin Title" data-error="Please enter a valid Title." value="<?php echo $getSiteSettingsData['admin_title'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Email</label>
                    <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="form-control-2" placeholder="Email" data-error="Please enter a valid email address." value="<?php echo $getSiteSettingsData['email'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">From Email</label>
                    <input type="email" name="from_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="form-control-2" placeholder="From Email" data-error="Please enter from email address." value="<?php echo $getSiteSettingsData['from_email'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Orders Email</label>
                    <input type="email" name="orders_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="form-control-2" placeholder="Orders Email" data-error="Please enter orders email address." value="<?php echo $getSiteSettingsData['orders_email'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Contact Email</label>
                    <input type="email" name="contact_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="form-control-2" placeholder="Contact Email" data-error="Please enter contact email address." value="<?php echo $getSiteSettingsData['contact_email'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control valid_mobile_num" id="form-control-2"  placeholder="Mobile" data-error="Please enter valid Mobile." value="<?php echo $getSiteSettingsData['mobile'];?>" maxlength="10" pattern="[0-9]{10}" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Google Analytics Code</label>
                    <textarea type="text" name="google_analytics_code" class="form-control" id="form-control-2" placeholder="Google Analytics Code" data-error="This field is required." required><?php echo $getSiteSettingsData['google_analytics_code'];?></textarea>
                  </div>
                  <div class="form-group">
                    <img src="<?php echo $base_url . 'uploads/food_logo/'.$getSiteSettingsData['logo'] ?>" accept="image/*" height="100" width="100" id="output"/>
                  </div>

                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Banner</label>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input name="logo" id="form-control-22" class="file-upload-input" type="file" multiple="multiple" onchange="loadFile(event)" accept="image/*">
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">GST (%)</label>
                    <input type="text" name="service_tax" class="form-control" id="form-control-2" placeholder="GST" data-error="Please enter valid GST." value="<?php echo $getSiteSettingsData['service_tax'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Delivery Charges</label>
                    <input type="text" name="delivery_charges" class="form-control" id="form-control-2" placeholder="Delivery Charges" data-error="Please enter Delivery Charges." value="<?php echo $getSiteSettingsData['delivery_charges'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Closing Time(In Minutes only)</label>
                    <input type="text" name="closing_time" class="form-control valid_mobile_num" id="form-control-2" placeholder="Closing Time" data-error="Please enter Closing Time." value="<?php echo $getSiteSettingsData['closing_time'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Footer Text</label>
                    <input type="text" name="footer_text" class="form-control" id="form-control-2" placeholder="Footer Text" data-error="Please enter valid Footer text." value="<?php echo $getSiteSettingsData['footer_text'];?>" required>
                    <div class="help-block with-errors"></div>
                  </div>                            

                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Address</label>
                    <textarea type="text" name="address" class="form-control" id="form-control-2" placeholder="Address" data-error="This field is required." required><?php echo $getSiteSettingsData['address'];?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Paytm</label>
                    <select id="form-control-3" name="paytm" class="custom-select" data-error="This field is required." required>
                      <option value="">Paytm</option>
                      <option <?php if($getSiteSettingsData['paytm'] == 1) { echo "Selected"; } ?> value="1">Yes</option>
                      <option <?php if($getSiteSettingsData['paytm'] == 2) { echo "Selected"; } ?> value="2">No</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>           
          </div>
        </div>
      </div>
  
<?php include_once 'admin_includes/footer.php'; ?>