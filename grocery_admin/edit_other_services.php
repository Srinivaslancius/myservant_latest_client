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
      <?php $brand_id = $_GET['brand_id']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  {
            //echo "<pre>"; print_r($_FILES); die;

            $lkp_status_id = $_REQUEST['lkp_status_id'];

            if($_FILES["fileToUpload"]["name"]!='' || $_FILES["fileToUpload1"]["name"]!='' || $_FILES["fileToUpload2"]["name"]!='' || $_FILES["fileToUpload3"]["name"]!='' || $_FILES["fileToUpload4"]["name"]!='' || $_FILES["fileToUpload5"]["name"]!='') {
                $grocery_app_image = uniqid().$_FILES["fileToUpload"]["name"];
                $grocery_app_image_target_dir = "uploads/other_services_images/";
                $target_grocery_app_image_file = $grocery_app_image_target_dir . basename($grocery_app_image);
                //$getImgUnlink = getImageUnlink('web_logo','grocery_brands_web_logo','id',$brand_id,$target_dir);

                $grocery_web_image = uniqid().$_FILES["fileToUpload1"]["name"];
                $grocery_web_image_target_dir = "uploads/other_services_images/";
                $target_grocery_web_image_file = $grocery_web_image_target_dir . basename($grocery_web_image);

                $food_app_image = uniqid().$_FILES["fileToUpload2"]["name"];
                $food_app_image_target_dir = "uploads/other_services_images/";
                $target_food_app_image_file = $food_app_image_target_dir . basename($food_app_image);

                $food_web_image = uniqid().$_FILES["fileToUpload3"]["name"];
                $food_web_image_target_dir = "uploads/other_services_images/";
                $target_food_web_image_file = $food_web_image_target_dir . basename($food_web_image);

                $services_app_image = uniqid().$_FILES["fileToUpload4"]["name"];
                $services_app_image_target_dir = "uploads/other_services_images/";
                $target_services_app_image_file = $services_app_image_target_dir . basename($services_app_image);

                $services_web_image = uniqid().$_FILES["fileToUpload5"]["name"];
                $services_web_image_target_dir = "uploads/other_services_images/";
                $target_services_web_image_file = $services_web_image_target_dir . basename($services_web_image);
                //$getImgUnlink = getImageUnlink('app_logo','grocery_brands_app_logo','id',$brand_id,$app_logo_dir);
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_grocery_app_image_file) && move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_grocery_web_image_file) && move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_food_app_image_file) && move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_food_web_image_file) && move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"], $target_services_app_image_file) && move_uploaded_file($_FILES["fileToUpload5"]["tmp_name"], $target_services_web_image_file)) {
                    $sql = "UPDATE `myservant_other_services` SET grocery_app_image = '$grocery_app_image', grocery_web_image = '$grocery_web_image', food_app_image = '$food_app_image', food_web_image = '$food_web_image',services_app_image = '$services_app_image',services_web_image = '$services_web_image',lkp_status_id='$lkp_status_id' WHERE id = '$brand_id' ";
                } elseif($_FILES["fileToUpload"]["tmp_name"]!='') {
                   move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_grocery_app_image_file);
                    $sql = "UPDATE `myservant_other_services` SET grocery_app_image = '$grocery_app_image', lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                } elseif($_FILES["fileToUpload1"]["tmp_name"]!='') {
                    move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_grocery_web_image_file);
                    $sql = "UPDATE `myservant_other_services` SET grocery_web_image = '$grocery_web_image', lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                } 
                 elseif($_FILES["fileToUpload2"]["tmp_name"]!='') {
                    move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_food_app_image_file);
                    $sql = "UPDATE `myservant_other_services` SET food_app_image = '$food_app_image', lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                }
                elseif($_FILES["fileToUpload3"]["tmp_name"]!='') {
                    move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_food_web_image_file);
                    $sql = "UPDATE `myservant_other_services` SET food_web_image = '$food_web_image', lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                }
                elseif($_FILES["fileToUpload4"]["tmp_name"]!='') {
                    move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"], $target_services_app_image_file);
                    $sql = "UPDATE `myservant_other_services` SET services_app_image = '$services_app_image', lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                }
                elseif($_FILES["fileToUpload5"]["tmp_name"]!='') {
                    move_uploaded_file($_FILES["fileToUpload5"]["tmp_name"], $target_services_web_image_file);
                    $sql = "UPDATE `myservant_other_services` SET services_web_image = '$services_web_image', lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                }
            } else{
               $sql = "UPDATE `myservant_other_services` SET  lkp_status_id = '$lkp_status_id' WHERE id = '$brand_id' ";
               //$conn->query($sql);
            }          
            //echo $sql; die;

            $conn->query($sql);
            //if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='other_services.php?msg=success'</script>";
            //} else {
               // echo "<script type='text/javascript'>window.location='manage_brands.php?msg=fail'</script>";
            //}
        }
        ?>
        
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Edit Other Services</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getOtherServices = getIndividualDetails('myservant_other_services','id',$brand_id); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Grocery App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOtherServices['grocery_app_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$getOtherServices['grocery_app_image']; ?>" id="output" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="fileToUpload" accept="image/*" onchange="loadFile(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Grocery Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOtherServices['grocery_web_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$getOtherServices['grocery_web_image']; ?>"  id="output1" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="fileToUpload1" accept="image/*" onchange="loadFile1(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Food App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOtherServices['food_app_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$getOtherServices['food_app_image']; ?>"  id="output2" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="fileToUpload2" accept="image/*" onchange="loadFile2(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Food Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOtherServices['food_web_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$getOtherServices['food_web_image']; ?>"  id="output3" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="fileToUpload3" accept="image/*" onchange="loadFile3(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Services App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOtherServices['services_app_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$getOtherServices['services_app_image']; ?>"  id="output4" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="fileToUpload4" accept="image/*" onchange="loadFile4(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Services Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOtherServices['services_web_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$getOtherServices['services_web_image']; ?>"  id="output5" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="fileToUpload5" accept="image/*" onchange="loadFile5(event)">
                                    </label>
                                </div>
                            </div> 
                            <?php $getStatus = getAllData('lkp_status');?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="lkp_status_id" name="lkp_status_id" class="form-control" required>
                                        <option value="">-- Select Status --</option>
                                         <?php while($row = $getStatus->fetch_assoc()) {  ?>
                                              <option <?php if($row['id'] == $getOtherServices['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                                          <?php } ?>
                                    </select>
                                </div>
                            </div>                       
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
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