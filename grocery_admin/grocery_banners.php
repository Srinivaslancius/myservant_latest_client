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
        }else  {
          //If success
          $link = $_POST['link'];
          $title = $_POST['title'];
          $lkp_city_id = $_POST['lkp_city_id'];
          $category_id = $_POST['category_id'];
          $sub_category_id = $_POST['sub_category_id'];
          $product_id = $_POST['product_id'];
          $type = $_POST['type'];
          $web_image = $_FILES["web_image"]["name"];
          $app_image = $_FILES["app_image"]["name"];
          if($web_image!='' && $app_image!='') {
            $target_dir = "uploads/grocery_banner_web_image/";
            $target_file = $target_dir . basename($_FILES["web_image"]["name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $target_dir1 = "uploads/grocery_banner_app_image/";
            $target_file1 = $target_dir1 . basename($_FILES["app_image"]["name"]);
            $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES["web_image"]["tmp_name"], $target_file)) {
                move_uploaded_file($_FILES["app_image"]["tmp_name"], $target_file1);
                $sql = "INSERT INTO grocery_banners (`link`,`title`,`lkp_city_id`,`category_id`,`sub_category_id`,`product_id`,`type`,`web_image`,`app_image`) VALUES ('$link','$title', '$lkp_city_id','$category_id','$sub_category_id', '$product_id','$type','$web_image', '$app_image')"; 
                if($conn->query($sql) === TRUE){
                   echo "<script type='text/javascript'>window.location='grocery_banners.php?msg=success'</script>";
                } else {
                   echo "<script type='text/javascript'>window.location='grocery_banners.php?msg=fail'</script>";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
          }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Banners</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select City</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_city_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select City --</option>
                                        <?php $getCities = getAllDataWithStatus('grocery_lkp_cities','0');?>
                                        <?php while($row = $getCities->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['city_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Link</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="url" name="link" class="form-control" id="form-control-3" placeholder="Enter link" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Title</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="title" class="form-control" id="form-control-3" placeholder="Enter Title" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="web_image" multiple="multiple" accept="image/*" id="web_image" onchange="loadFile(event)" required>
                                    </label> (width : 1110px ; height : 416px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output1" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="app_image" multiple="multiple" accept="image/*" id="app_image" onchange="loadFile1(event)" required>
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
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['banner_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="category">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="category_id" class="form-control category" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="sub_category">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Sub Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="sub_category_id" class="form-control sub_category" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Sub Category --</option>
                                        <?php $getSubacategories = getAllDataWithStatus('grocery_sub_category','0');?>
                                        <?php while($row = $getSubacategories->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="product">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Product</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="product_id" class="form-control product" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Product --</option>
                                        <?php $getProducts = getAllDataWithStatus('grocery_products','0');?>
                                        <?php while($row = $getProducts->fetch_assoc()) { 
                                            $getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$row['id']); ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $getProductNames['product_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Brands</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <!-- <th>Brand Id</th> -->
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Web Image</th>
                                    <th>App Image</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getBanners = getAllDataWithActiveRecent('grocery_banners'); $i=1; ?>
                                <?php while ($row = $getBanners->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td>Brnd345</td> -->
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['link']; ?></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$row['web_image'] ?>" width="100" height="100"></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_app_image/'.$row['app_image'] ?>" width="100" height="100"></td>
                                    <td><?php $getCities = getAllData('grocery_lkp_cities'); while($getCitiesData = $getCities->fetch_assoc()) { if($row['lkp_city_id'] == $getCitiesData['id']) { echo $getCitiesData['city_name']; } } ?></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_banners'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_banners'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_grocery_banners.php?banner_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "grocery_banners" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
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
      });
    </script>
  </body>
</html>