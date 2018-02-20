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
      <?php $offer_id = $_GET['offer_id']; ?>
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
            if($offer_level == 1) {
                $category_id = $_POST['category_id'];
                $sub_category_id = '';
            } elseif($offer_level == 2) {
                $category_id = '';
                $sub_category_id = $_POST['sub_category_id'];
            }
            if($_FILES["image"]["name"]!='' || $_FILES["app_image"]["name"]!='') {
                $image = uniqid().$_FILES["image"]["name"];
                $target_dir = "uploads/grocery_offer_module_image/";
                $target_file = $target_dir . basename($image);

                $app_image = uniqid().$_FILES["app_image"]["name"];
                $target_dir1 = "uploads/grocery_offer_module_app_image/";
                $target_file1 = $target_dir1 . basename($app_image);
                // $getImgUnlink = getImageUnlink('image','grocery_offer_module','id',$offer_id,$target_dir);
                if($_FILES["image"]["name"]!='' && $_FILES["app_image"]["name"]!='') {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    move_uploaded_file($_FILES["app_image"]["tmp_name"], $target_file1);
                    $sql = "UPDATE `grocery_offer_module` SET name = '$name', image = '$image', app_image = '$app_image', offer_type = '$offer_type', offer_level = '$offer_level', max_offer_percentage = '$max_offer_percentage', min_offer_percentage = '$min_offer_percentage', category_id = '$category_id', sub_category_id = '$subcatId' WHERE id = '$offer_id' ";
                } elseif($_FILES["image"]["name"]!='') {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $sql = "UPDATE `grocery_offer_module` SET name = '$name', image = '$image', offer_type = '$offer_type', offer_level = '$offer_level', max_offer_percentage = '$max_offer_percentage', min_offer_percentage = '$min_offer_percentage', category_id = '$category_id', sub_category_id = '$subcatId' WHERE id = '$offer_id' ";
                } elseif($_FILES["app_image"]["name"]!='') {
                    move_uploaded_file($_FILES["app_image"]["tmp_name"], $target_file1);
                    $sql = "UPDATE `grocery_offer_module` SET name = '$name', app_image = '$app_image', offer_type = '$offer_type', offer_level = '$offer_level', max_offer_percentage = '$max_offer_percentage', min_offer_percentage = '$min_offer_percentage', category_id = '$category_id', sub_category_id = '$subcatId' WHERE id = '$offer_id' ";
                }
            } else {
                $sql = "UPDATE `grocery_offer_module` SET offer_type = '$offer_type', offer_level = '$offer_level', max_offer_percentage = '$max_offer_percentage', min_offer_percentage = '$min_offer_percentage', category_id = '$category_id', sub_category_id = '$sub_category_id' WHERE id = '$offer_id' ";
            }
            //echo $sql; die;
            $result = $conn->query($sql);
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
                        <?php $getOffers = getIndividualDetails('grocery_offer_module','id',$offer_id); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Name" name="name" required value="<?php echo $getOffers['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOffers['image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_module_image/'.$getOffers['image']; ?>"  id="output" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="image" accept="image/*" onchange="loadFile(event)">
                                    </label> (width : 555px ; height : 179px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOffers['app_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_module_app_image/'.$getOffers['app_image']; ?>"  id="output1" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="app_image" accept="image/*" onchange="loadFile1(event)">
                                    </label> (width : 555px ; height : 179px)
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Offer Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="radio" <?php if($getOffers['offer_type'] == 0) { echo "checked"; } ?> name="offer_type" id="banner_image_type" value="0">Normal
                                    <input type="radio" <?php if($getOffers['offer_type'] == 1) { echo "checked"; } ?> name="offer_type" id="banner_image_type1" value="1">Offer
                                    <input type="hidden" id="banner_type" value="<?php echo $getOffers['offer_type']; ?>">
                                </div>
                            </div>
                            <div id="offer_percentage">
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Minimum Offer Percentage</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="min_offer_percentage" class="form-control valid_price_dec" id="min_offer_percentage" value="<?php echo $getOffers['min_offer_percentage']; ?>" placeholder="Enter Minimum Offer Percentage">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Maximum Offer Percentage</label>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="max_offer_percentage" class="form-control valid_price_dec" id="max_offer_percentage" value="<?php echo $getOffers['max_offer_percentage']; ?>" placeholder="Enter Maximum Offer Percentage" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Select Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="type" name="offer_level" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" >
                                        <option value="">-- Select Type --</option>
                                        <?php $getTypes = getAllDataWithStatus('grocery_banner_types','0');?>
                                        <?php while($row = $getTypes->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getOffers['offer_level']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['banner_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="category_id" class="form-control category" data-plugin="select2" data-options="{ theme: bootstrap }" >
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getOffers['category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="sub_category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Select Sub Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="sub_category_id" class="form-control sub_category" data-plugin="select2" data-options="{ theme: bootstrap }" >
                                        <option value="">-- Select Sub Category --</option>
                                        <?php $getSubacategories = getAllDataWithStatus('grocery_sub_category','0');?>
                                        <?php while($row = $getSubacategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getOffers['sub_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
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
    <script type="text/javascript">
    $("#category,#sub_category,#product,#offer_percentage").hide();
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
        $("#banner_image_type1").click(function() {
            $("#offer_percentage").show();
            $("#min_offer_percentage,#max_offer_percentage").attr("required", "true");
        });
        $("#banner_image_type").click(function() {
            $("#offer_percentage").hide();
            $("#min_offer_percentage,#max_offer_percentage").removeAttr('required');
        });
        //alert($('#banner_type').val());
        if($('#banner_type').val() == 1) {
            $("#offer_percentage").show();
            $("#min_offer_percentage,#max_offer_percentage").attr("required", "true");
        }
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