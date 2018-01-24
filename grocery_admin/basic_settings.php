<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Cosmos</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
        <?php include_once './main_header.php';?>
    </div>
    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
            <?php include_once './side_menu.php';?>
        </div>
      </div>
      <div class="site-right-sidebar">
        <?php include_once './right_slide_toggle.php';?>
      </div>

      <?php  
 if (!isset($_POST['submit']))  {
      //If fail
        echo "fail";
    } else {
    //If success
      
    $id=1;
    $admin_title = $_POST['admin_title']; 
    $meta_title = $_POST['meta_title'];  
    $meta_description = $_POST['meta_description']; 
    $meta_key_words = $_POST['meta_key_words']; 
    $from_email = $_POST['from_email']; 
    $contact_email = $_POST['contact_email']; 
    $forgot_password_email = $_POST['forgot_password_email'];
    $mobile = $_POST['mobile'];
    $minimum_time_to_delivery = $_POST['minimum_time_to_delivery']; 
    $address = $_POST['address'];
    $service_tax = $_POST['service_tax'];
    $google_analytics_code  = $_POST['google_analytics_code'];
    $contact_number = $_POST['contact_number'];
    $customer_care_number = $_POST['customer_care_number'];
    $orders_email = $_POST['orders_email'];
    $footer_text = $_POST['footer_text'];

    if($_FILES["logo"]["name"]!='' && $_FILES["fav_icon_image"]["name"]!='' ) {
            
         /*logo*/                                 
        $logo = $_FILES["logo"]["name"];
        $target_dir = "uploads/logo/";
        $target_file = $target_dir . basename($_FILES["logo"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
/*        fav-icon */        
        $fav_icon_image = $_FILES["fav_icon_image"]["name"];
        $target_dir1 = "uploads/fav_icon_image/";
        $target_file1 = $target_dir1 . basename($_FILES["fav_icon_image"]["name"]);
        $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
        && $imageFileType1 != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        $getImgUnlink = getImageUnlink('logo','grocery_site_settings','id',$id,$target_dir);
        $getImgUnlink1 = getImageUnlink('fav_icon_image','grocery_site_settings','id',$id,$target_dir1);
        //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
          move_uploaded_file($_FILES["fav_icon_image"]["tmp_name"], $target_file1);
            $sql = "UPDATE `grocery_site_settings` SET admin_title = '$admin_title', meta_title= '$meta_title', meta_description = '$meta_description', meta_key_words='$meta_key_words', from_email = '$from_email', contact_email ='$contact_email', forgot_password_email = '$forgot_password_email', mobile = '$mobile',minimum_time_to_delivery = '$minimum_time_to_delivery',address='$address', google_analytics_code ='$google_analytics_code',contact_number='$contact_number', orders_email='$orders_email', logo = '$logo', fav_icon_image='$fav_icon_image', footer_text='$footer_text',customer_care_number = '$customer_care_number',service_tax = '$service_tax' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='basic_settings.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='basic_settings.php?msg=fail'</script>";
            }
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    } elseif($_FILES["logo"]["name"]!='' ) {
            
         /*logo*/                                 
        $logo = $_FILES["logo"]["name"];
        $target_dir = "uploads/logo/";
        $target_file = $target_dir . basename($_FILES["logo"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
        && $imageFileType1 != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        $getImgUnlink = getImageUnlink('logo','grocery_site_settings','id',$id,$target_dir);

        
        move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
          
            $sql = "UPDATE `grocery_site_settings` SET admin_title = '$admin_title', meta_title= '$meta_title', meta_description = '$meta_description', meta_key_words='$meta_key_words', from_email = '$from_email', contact_email ='$contact_email', forgot_password_email = '$forgot_password_email', mobile = '$mobile',minimum_time_to_delivery = '$minimum_time_to_delivery',address='$address', google_analytics_code ='$google_analytics_code',contact_number='$contact_number', orders_email='$orders_email', logo = '$logo', footer_text='$footer_text',customer_care_number = '$customer_care_number',service_tax = '$service_tax' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='basic_settings.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='basic_settings.php?msg=fail'</script>";
            }
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
    }  elseif($_FILES["fav_icon_image"]["name"]!='' ) {
                  
        $fav_icon_image = $_FILES["fav_icon_image"]["name"];
        $target_dir1 = "uploads/fav_icon_image/";
        $target_file1 = $target_dir1 . basename($_FILES["fav_icon_image"]["name"]);
        $imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
        && $imageFileType1 != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        $getImgUnlink1 = getImageUnlink('fav_icon_image','grocery_site_settings','id',$id,$target_dir1);

          move_uploaded_file($_FILES["fav_icon_image"]["tmp_name"], $target_file1);
            $sql = "UPDATE `grocery_site_settings` SET admin_title = '$admin_title', meta_title= '$meta_title', meta_description = '$meta_description', meta_key_words='$meta_key_words', from_email = '$from_email', contact_email ='$contact_email', forgot_password_email = '$forgot_password_email', mobile = '$mobile',minimum_time_to_delivery = '$minimum_time_to_delivery',address='$address', google_analytics_code ='$google_analytics_code',contact_number='$contact_number', orders_email='$orders_email', fav_icon_image='$fav_icon_image', footer_text='$footer_text',customer_care_number = '$customer_care_number',service_tax = '$service_tax' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='basic_settings.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='basic_settings.php?msg=fail'</script>";
            }
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
    }
     else {
        $sql = "UPDATE `grocery_site_settings` SET admin_title = '$admin_title', meta_title= '$meta_title', meta_description = '$meta_description', meta_key_words='$meta_key_words', from_email = '$from_email', contact_email ='$contact_email', forgot_password_email = '$forgot_password_email', mobile = '$mobile',minimum_time_to_delivery = '$minimum_time_to_delivery',address='$address', google_analytics_code ='$google_analytics_code',contact_number='$contact_number', orders_email='$orders_email', footer_text='$footer_text', customer_care_number = '$customer_care_number',service_tax = '$service_tax' WHERE id = '$id' ";
        if($conn->query($sql) === TRUE){
           echo "<script type='text/javascript'>window.location='basic_settings.php?msg=success'</script>";
        } else {
           echo "<script type='text/javascript'>window.location='basic_settings.php?msg=fail'</script>";
        }
    }   
    
}
?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Basic Settings</h3>
                </div>
                <?php $getAllGrocerySiteSettings = getAllDataWhere('grocery_site_settings','id','1'); 
                              $getGrocerySiteSettings = $getAllGrocerySiteSettings->fetch_assoc(); ?>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Site Title</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Site Title" name="admin_title" value="<?php echo $getGrocerySiteSettings['admin_title'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Meta Title</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Meta Title" name="meta_title" required value="<?php echo $getGrocerySiteSettings['meta_title'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Meta Description</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" name= "meta_description" class="form-control" rows="3" required value=""><?php echo $getGrocerySiteSettings['meta_description'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Meta Keywords</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" name="meta_key_words" id="form-control-3" placeholder="Enter Meta Keywords" required value="<?php echo $getGrocerySiteSettings['meta_key_words'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Receive Email Id</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" name="from_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" id="form-control-3" placeholder="Enter Receive Email Id" required value="<?php echo $getGrocerySiteSettings['from_email'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Send Email Id</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="contact_email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" id="form-control-3" placeholder="Enter Send Email Id" required value="<?php echo $getGrocerySiteSettings['contact_email'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Forgot Password Email</label>
                                <div class="col-sm-6 col-md-4">
                                   <input type="text" class="form-control" name="forgot_password_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" id="form-control-3" placeholder="Enter Forgot password Email Id" required value="<?php echo $getGrocerySiteSettings['forgot_password_email'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Mobile Number</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" name="mobile" id="form-control-3" placeholder="Enter Mobile Number" required value="<?php echo $getGrocerySiteSettings['mobile'];?>" required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Minimum Time to Deliver</label>
                                <div class="col-sm-6 col-md-4">
                                   <input type="text" name="minimum_time_to_delivery" class="form-control" id="form-control-3" placeholder="Minimum Time To Deliver" required value="<?php echo $getGrocerySiteSettings['minimum_time_to_delivery'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Address</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" name="address" class="form-control" rows="3" required><?php echo $getGrocerySiteSettings['address'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">GST (%)</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="service_tax" class="form-control" id="form-control-3" placeholder="Enter GST" value="<?php echo $getGrocerySiteSettings['service_tax'];?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Contact Number</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="contact_number" class="form-control" id="form-control-3" placeholder="Enter Contact Number" required value="<?php echo $getGrocerySiteSettings['contact_number'];?>" required maxlength="10" pattern="[0-9]{10}" onkeypress="return isNumberKey(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Customer Care Number</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="customer_care_number" class="form-control" id="form-control-3" placeholder="Enter Customer Care Number" required value="<?php echo $getGrocerySiteSettings['customer_care_number'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Logo</label>
                                <div class="col-sm-6 col-md-4">
                                    <img src="<?php echo $base_url . 'grocery_admin/uploads/logo/'.$getGrocerySiteSettings['logo'] ?>" accept="image/*" height="100" width="100" id="output"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" name="logo" class="file-upload-input" type="file"  multiple="multiple"  onchange="loadFile(event)" accept="image/*">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Favicon</label>
                               <div class="col-sm-6 col-md-4">
                                    <img src="<?php echo $base_url . 'grocery_admin/uploads/fav_icon_image/'.$getGrocerySiteSettings['fav_icon_image'] ?>" accept="image/*" height="100" width="100" id="output1"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" name="fav_icon_image" class="file-upload-input" type="file" onchange="loadFile1(event)"  multiple="multiple" >
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Google Analytics Code</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" name="google_analytics_code" class="form-control" rows="3" required ><?php echo $getGrocerySiteSettings['google_analytics_code'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Footer Code</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" name="footer_text" class="form-control" rows="3" required><?php echo $getGrocerySiteSettings['footer_text'];?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <?php include_once 'footer.php'; ?>
        <script src="js/dashboard-3.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>