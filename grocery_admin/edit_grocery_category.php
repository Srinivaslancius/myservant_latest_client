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
      <?php $category_id = $_GET['category_id']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  {
            //echo "<pre>"; print_r($_FILES); die;

            $category_name = $_POST['category_name'];
            if($_FILES["category_web_image"]["name"]!='' || $_FILES["category_app_image"]["name"]!='' || $_FILES["category_icon"]["name"]!='') {
                $category_web_image = uniqid().$_FILES["category_web_image"]["name"];
                $target_dir = "uploads/grocery_category_web_image/";
                $target_file = $target_dir . basename($category_web_image);

                $category_app_image = uniqid().$_FILES["category_app_image"]["name"];
                $category_app_image_dir = "uploads/grocery_category_app_image/";
                $category_app_image_file = $category_app_image_dir . basename($category_app_image);

                $category_icon = uniqid().$_FILES["category_icon"]["name"];
                $category_icon_dir = "uploads/grocery_category_icon/";
                $category_icon_file = $category_icon_dir . basename($category_icon);
                
                if($_FILES["category_web_image"]["name"]!='' && $_FILES["category_app_image"]["name"]!='' && $_FILES["category_icon"]["name"]!='') {
                    move_uploaded_file($_FILES["category_web_image"]["tmp_name"], $target_file);
                    move_uploaded_file($_FILES["category_app_image"]["tmp_name"], $category_app_image_file);
                    move_uploaded_file($_FILES["category_icon"]["tmp_name"], $category_icon_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_web_image = '$category_web_image', category_app_image = '$category_app_image', category_icon = '$category_icon' WHERE id = '$category_id' ";
                } elseif($_FILES["category_web_image"]["name"]!='' && $_FILES["category_app_image"]["name"]!='') {
                    move_uploaded_file($_FILES["category_web_image"]["tmp_name"], $target_file);
                    move_uploaded_file($_FILES["category_app_image"]["tmp_name"], $category_app_image_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_web_image = '$category_web_image', category_app_image = '$category_app_image' WHERE id = '$category_id' ";
                } elseif($_FILES["category_app_image"]["name"]!='' && $_FILES["category_icon"]["name"]!='') {
                    move_uploaded_file($_FILES["category_app_image"]["tmp_name"], $category_app_image_file);
                    move_uploaded_file($_FILES["category_icon"]["tmp_name"], $category_icon_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_app_image = '$category_app_image', category_icon = '$category_icon' WHERE id = '$category_id' ";
                } elseif($_FILES["category_web_image"]["name"]!='' && $_FILES["category_icon"]["name"]!='') {
                    move_uploaded_file($_FILES["category_web_image"]["tmp_name"], $target_file);
                    move_uploaded_file($_FILES["category_icon"]["tmp_name"], $category_icon_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_web_image = '$category_web_image', category_icon = '$category_icon' WHERE id = '$category_id' ";
                } elseif($_FILES["category_web_image"]["name"]!='') {
                    move_uploaded_file($_FILES["category_web_image"]["tmp_name"], $target_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_web_image = '$category_web_image' WHERE id = '$category_id' ";
                } elseif($_FILES["category_app_image"]["name"]!='') {
                    move_uploaded_file($_FILES["category_app_image"]["tmp_name"], $category_app_image_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_app_image = '$category_app_image' WHERE id = '$category_id' ";
                } elseif($_FILES["category_icon"]["name"]!='') {
                    move_uploaded_file($_FILES["category_icon"]["tmp_name"], $category_icon_file);
                    $sql = "UPDATE `grocery_category` SET category_name = '$category_name', category_icon = '$category_icon' WHERE id = '$category_id' ";
                } 

            } else{
               $sql = "UPDATE `grocery_category` SET category_name = '$category_name' WHERE id = '$category_id' ";
               //$conn->query($sql);
            }          
            //echo $sql; die;

            $conn->query($sql);
            //if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='manage_categories.php?msg=success'</script>";
            //} else {
               // echo "<script type='text/javascript'>window.location='manage_categories.php?msg=fail'</script>";
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
                        <?php $getCategories = getIndividualDetails('grocery_category','id',$category_id); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Category Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Category Name" name="category_name" required value="<?php echo $getCategories['category_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getCategories['category_web_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_category_web_image/'.$getCategories['category_web_image']; ?>" id="output" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="category_web_image" accept="image/*" onchange="loadFile(event)">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getCategories['category_app_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_category_app_image/'.$getCategories['category_app_image']; ?>"  id="output1" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="category_app_image" accept="image/*" onchange="loadFile1(event)"> 
                                    </label> (Width : 100 px ; height : 100 px)
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Icon</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getCategories['category_icon']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_category_icon/'.$getCategories['category_icon']; ?>"  id="output2" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="category_icon" accept="image/*" onchange="loadFile2(event)">
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