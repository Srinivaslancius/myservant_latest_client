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

            $brand_name = $_POST['brand_name'];
            if($_FILES["web_logo"]["name"]!='' || $_FILES["app_logo"]["name"]!='') {
                $web_logo = uniqid().$_FILES["web_logo"]["name"];
                $target_dir = "uploads/grocery_brands_web_logo/";
                $target_file = $target_dir . basename($web_logo);
                //$getImgUnlink = getImageUnlink('web_logo','grocery_brands_web_logo','id',$brand_id,$target_dir);

                $app_logo = uniqid().$_FILES["app_logo"]["name"];
                $app_logo_dir = "uploads/grocery_brands_app_logo/";
                $app_logo_file = $app_logo_dir . basename($app_logo);
                //$getImgUnlink = getImageUnlink('app_logo','grocery_brands_app_logo','id',$brand_id,$app_logo_dir);
                if(move_uploaded_file($_FILES["web_logo"]["tmp_name"], $target_file)) {
                   // move_uploaded_file($_FILES["web_logo"]["tmp_name"], $target_file);
                    $sql = "UPDATE `grocery_brands` SET brand_name = '$brand_name', web_logo = '$web_logo' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                } elseif(move_uploaded_file($_FILES["app_logo"]["tmp_name"], $app_logo_file)) {
                    //move_uploaded_file($_FILES["app_logo"]["tmp_name"], $app_logo_file);
                    $sql = "UPDATE `grocery_brands` SET brand_name = '$brand_name', app_logo = '$app_logo' WHERE id = '$brand_id' ";
                    //$conn->query($sql);
                } 

            } else{
               $sql = "UPDATE `grocery_brands` SET brand_name = '$brand_name' WHERE id = '$brand_id' ";
               //$conn->query($sql);
            }          
            //echo $sql; die;

            $conn->query($sql);
            //if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='manage_brands.php?msg=success'</script>";
            //} else {
               // echo "<script type='text/javascript'>window.location='manage_brands.php?msg=fail'</script>";
            //}
        }
        ?>
        
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Edit Brands</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getBrands = getIndividualDetails('grocery_brands','id',$brand_id); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Brand Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Brand Name" name="brand_name" required value="<?php echo $getBrands['brand_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Web Logo</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getBrands['web_logo']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_brands_web_logo/'.$getBrands['web_logo']; ?>" id="output" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="web_logo" accept="image/*" onchange="loadFile(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">App Logo</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getBrands['app_logo']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_brands_app_logo/'.$getBrands['app_logo']; ?>"  id="output1" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="app_logo" accept="image/*" onchange="loadFile1(event)">
                                    </label>
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