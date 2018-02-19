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
          echo "fail";
        } else  { 

            //echo "<pre>"; print_r($_POST); die;  
            $name = $_REQUEST['name'];
            $offer_type = $_POST['offer_type'];
            $offer_level = $_POST['offer_level'];
            if($offer_type == 0) {
                $max_offer_percentage = '';
                $min_offer_percentage = '';
            } else {
                $max_offer_percentage = $_POST['max_offer_percentage'];
                $min_offer_percentage = $_POST['min_offer_percentage'];
            }
            $category_id = $_POST['category_id'];
            $sub_category_id = $_POST['sub_category_id'];
            if($_FILES["image"]["name"]!='' && $_FILES["app_image"]["name"]!='') {
                $image = uniqid().$_FILES["image"]["name"];
                $target_dir = "uploads/grocery_offer_module_image/";
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $app_image = uniqid().$_FILES["app_image"]["name"];
                $target_dir1 = "uploads/grocery_offer_module_app_image/";
                $target_file1 = $target_dir1 . basename($app_image);
                move_uploaded_file($_FILES["app_image"]["tmp_name"], $target_file1);
                $sql = "INSERT INTO grocery_offer_module (`name`,`image`,`app_image`, `offer_type`, `offer_level`, `category_id`, `sub_category_id`, `min_offer_percentage`, `max_offer_percentage`) VALUES ('$name', '$image', '$app_image', '$offer_type', '$offer_level', '$category_id', '$sub_category_id', '$min_offer_percentage', '$max_offer_percentage')";
                $result = $conn->query($sql);
            }
           
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='grocery_offer_module.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='grocery_offer_module.php?msg=fail'</script>";
            }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Offers</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="image" accept="image/*"  onchange="loadFile(event)" required>
                                    </label> (width:360px;height:200px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output1" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="app_image" accept="image/*"  onchange="loadFile1(event)" required>
                                    </label>(width:360px;height:200px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Offer Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="radio" name="offer_type" id="banner_image_type" value="0">Normal
                                    <input type="radio" name="offer_type" id="banner_image_type1" value="1">Offer
                                </div>
                            </div>
                            <div id="offer_percentage">
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Minimum Offer Percentage</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="min_offer_percentage" class="form-control valid_price_dec" id="min_offer_percentage" placeholder="Enter Minimum Offer Percentage" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Maximum Offer Percentage</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="max_offer_percentage" class="form-control valid_price_dec" id="max_offer_percentage" placeholder="Enter Maximum Offer Percentage" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Select Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="type" name="offer_level" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Type --</option>
                                        <?php $getTypes = getAllDataWithStatus('grocery_banner_types','0');?>
                                        <?php while($row = $getTypes->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['banner_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Select Category</label>
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
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Select Sub Category</label>
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
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

             <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Offers</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Web Image</th>
                                    <th>App Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getOffers = getAllDataWithActiveRecent('grocery_offer_module'); $i=1; ?>
                                <?php while ($row = $getOffers->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_module_image/'.$row['image']; ?>"  id="output" height="60" width="60"/></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_module_app_image/'.$row['app_image']; ?>"  id="output" height="60" width="60"/></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_offer_module'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_offer_module'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_grocery_offer_module.php?offer_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
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
    $("#category,#sub_category,#product,#offer_percentage").hide();
    $("#min_offer_percentage,#max_offer_percentage").removeAttr('required');
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
        $("#banner_image_type1").click(function() {
            $("#offer_percentage").show();
            $("#min_offer_percentage,#max_offer_percentage").attr("required", "true");
        });
        $("#banner_image_type").click(function() {
            $("#offer_percentage").hide();
            $("#min_offer_percentage,#max_offer_percentage").removeAttr('required');
        });
        $("#min_offer_percentage,#max_offer_percentage").blur(function () {
            if(parseInt($('#min_offer_percentage').val()) > parseInt($('#max_offer_percentage').val())) {
              alert("The Maximum Percentage must be larger than the Minimum Percentage");
              $('#min_offer_percentage').val('');
              $('#max_offer_percentage').val('');
              return false;
            }
            if(parseInt($('#min_offer_percentage').val()) == 0 && parseInt($('#max_offer_percentage').val()) == 0) {
              alert("The Maximum Percentage and the Minimum Percentage should be greater than zero");
              $('#min_offer_percentage').val('');
              $('#max_offer_percentage').val('');
              return false;
            }
        });
      });
    </script>
  </body>
</html>