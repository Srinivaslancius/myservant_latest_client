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
      <?php $banner_id = $_GET['banner_id']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  {
            //echo "<pre>"; print_r($_FILES); die;
            $link = $_POST['link'];
            $title = $_POST['title'];
            $lkp_city_id = $_POST['lkp_city_id'];
            $category_id = $_POST['category_id'];
            $sub_category_id = $_POST['sub_category_id'];
            $product_id = $_POST['product_id'];
            $type = $_POST['type'];
            if($_FILES["web_image"]["name"]!='' || $_FILES["app_image"]["name"]!='') {
                $web_image = uniqid().$_FILES["web_image"]["name"];
                $web_image_dir = "uploads/grocery_banner_web_image/";
                $web_image_file = $web_image_dir . basename($web_image);

                $app_image = uniqid().$_FILES["app_image"]["name"];
                $app_image_dir = "uploads/grocery_banner_app_image/";
                $app_image_file = $app_image_dir . basename($app_image);
                
                if(move_uploaded_file($_FILES["web_image"]["tmp_name"], $web_image_file) && move_uploaded_file($_FILES["app_image"]["tmp_name"], $app_image_file)) {
                    $sql = "UPDATE `grocery_banners` SET link = '$link',title = '$title',lkp_city_id = '$lkp_city_id',category_id = '$category_id',sub_category_id = '$sub_category_id',product_id = '$product_id',type = '$type', web_image = '$web_image', app_image = '$app_image' WHERE id = '$banner_id' ";
                } elseif($_FILES["web_image"]["name"]!='') {
                    move_uploaded_file($_FILES["web_image"]["tmp_name"], $web_image_file);
                    $sql = "UPDATE `grocery_banners` SET link = '$link',title = '$title',lkp_city_id = '$lkp_city_id',category_id = '$category_id',sub_category_id = '$sub_category_id',product_id = '$product_id',type = '$type', web_image = '$web_image' WHERE id = '$banner_id' ";
                } elseif($_FILES["app_image"]["name"]!='') {
                    move_uploaded_file($_FILES["app_image"]["tmp_name"], $app_image_file);
                    $sql = "UPDATE `grocery_banners` SET link = '$link',title = '$title',lkp_city_id = '$lkp_city_id',category_id = '$category_id',sub_category_id = '$sub_category_id',product_id = '$product_id',type = '$type', app_image = '$app_image' WHERE id = '$banner_id' ";
                } 

            } else{
               $sql = "UPDATE `grocery_banners` SET link = '$link',title = '$title',lkp_city_id = '$lkp_city_id',category_id = '$category_id',sub_category_id = '$sub_category_id',product_id = '$product_id',type = '$type' WHERE id = '$banner_id' ";
               //$conn->query($sql);
            }          
            //echo $sql; die;

            $conn->query($sql);
            //if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='grocery_banners.php?msg=success'</script>";
            //} else {
               // echo "<script type='text/javascript'>window.location='grocery_banners.php?msg=fail'</script>";
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
                        <?php $getBrands = getIndividualDetails('grocery_banners','id',$banner_id); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select City</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_city_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select City --</option>
                                        <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                                        <?php while($row = $getCities->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getBrands['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['city_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Link</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="url" name="link" class="form-control" id="form-control-3" placeholder="Enter link" value="<?php echo $getBrands['link']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Title</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="title" class="form-control" id="form-control-3" placeholder="Enter Title" value="<?php echo $getBrands['title']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getBrands['web_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$getBrands['web_image']; ?>"  id="output" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="web_image" multiple="multiple" accept="image/*" onchange="loadFile(event)">
                                    </label> (width : 1110px ; height : 416px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getBrands['app_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_app_image/'.$getBrands['app_image']; ?>"  id="output1" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="app_image" accept="image/*" onchange="loadFile1(event)">
                                    </label> (width : 550px ; height : 200px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="type" name="type" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Type --</option>
                                        <?php $getTypes = getAllDataWithStatus('grocery_banner_types','0');?>
                                        <?php while($row = $getTypes->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getBrands['type']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['banner_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="category">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="category_id" class="form-control category" data-plugin="select2" data-options="{ theme: bootstrap }">
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getBrands['category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="sub_category">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Sub Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="sub_category_id" class="form-control sub_category" data-plugin="select2" data-options="{ theme: bootstrap }">
                                        <option value="">-- Select Sub Category --</option>
                                        <?php $getSubacategories = getAllDataWithStatus('grocery_sub_category','0');?>
                                        <?php while($row = $getSubacategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getBrands['sub_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="product">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Product</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="product_id" class="form-control product" data-plugin="select2" data-options="{ theme: bootstrap }">
                                        <option value="">-- Select Product --</option>
                                        <?php $getProducts = getAllDataWithStatus('grocery_products','0');?>
                                        <?php while($row = $getProducts->fetch_assoc()) {  
                                        $getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$row['id']); ?>
                                            <option <?php if($row['id'] == $getBrands['product_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $getProductNames['product_name']; ?></option>
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
    <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>

    <script type="text/javascript">
    $("#category,#sub_category,#product").hide();
      $(document).ready(function () {
        $("#type").change(function() {
            if($(this).val() == 1) {
                $("#category").show();
                $("#sub_category,#product").hide();
                $('.category').val("");
                $(".category").attr("required", "true");
                $(".sub_category,.product").removeAttr('required');
            } else if($(this).val() == 2) {
                $("#sub_category").show();
                $("#category,#product").hide();
                $('.sub_category').val("");
                $(".sub_category").attr("required", "true");
                $(".category,.product").removeAttr('required');
            } else {
                $("#product").show();
                $("#category,#sub_category").hide();
                $('.product').val("");
                $(".product").attr("required", "true");
                $(".category,.product").removeAttr('required');
            }   
        });
            if($('#type').val() == 1) {
                $("#category").show();
                $("#sub_category,#product").hide();
            } else if($('#type').val() == 2) {
                $("#sub_category").show();
                $("#category,#product").hide();
            } else {
                $("#product").show();
                $("#category,#sub_category").hide();
            }
      });
    </script>
  </body>
</html>