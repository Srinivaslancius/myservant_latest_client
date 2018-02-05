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
      <?php $id = $_GET['coupon_id']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 
          //echo "<pre>"; print_r($_POST); die;
            $coupon_code = $_POST['coupon_code'];
            $price_type_id = $_POST['price_type_id'];
            $discount_price = $_POST['discount_price'];
            $coupon_type = $_POST['coupon_type'];
            $coupon_description = $_POST['coupon_description'];
            $coupon_start_date = date('y-m-d',strtotime($_POST['coupon_start_date']));
            $coupon_end_date = date('y-m-d',strtotime($_POST['coupon_end_date']));
            if($coupon_type == 1) {
                $category_id = $_POST['category_id'];
                $sub_category_id = '';
            } elseif($coupon_type == 2) {
                $category_id = '';
                $sub_category_id = $_POST['sub_category_id'];
            }
            $sql = "UPDATE `grocery_coupons` SET coupon_code=UPPER('$coupon_code'), price_type_id='$price_type_id', discount_price='$discount_price', coupon_type='$coupon_type', coupon_start_date='$coupon_start_date', coupon_end_date='$coupon_end_date', category_id='$category_id', sub_category_id='$sub_category_id', coupon_description='$coupon_description' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
              echo "<script type='text/javascript'>window.location='grocery_coupons.php?msg=success'</script>";
            } else {
              echo "<script type='text/javascript'>window.location='grocery_coupons.php?msg=fail'</script>";
            }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Edit Coupons</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getGroceryCoupons = getAllDataWhere('grocery_coupons','id',$id);
                        $getGroceryCouponsData = $getGroceryCoupons->fetch_assoc(); ?>
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Coupon Code</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" style="text-transform:uppercase" name="coupon_code" class="form-control" id="user_input" onblur="checkUserAvailTest()"  placeholder="Enter Coupon Code" required value="<?php echo $getGroceryCouponsData['coupon_code'];?>">
                                    <span id="input_status" style="color: red;"></span>
                                    <input type="hidden" id="table_name" value="grocery_coupons">
                                    <input type="hidden" id="column_name" value="coupon_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Coupon Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="coupon_type" name="coupon_type" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Coupon Type</option>
                                        <?php $getCouponTypes = getAllDataWithStatus('grocery_coupon_types','0');?>
                                        <?php while($row = $getCouponTypes->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getGroceryCouponsData['coupon_type']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['coupon_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="category_id" class="form-control category" data-plugin="select2" data-options="{ theme: bootstrap }">
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getGroceryCouponsData['category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="sub_category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Sub Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="sub_category_id" class="form-control sub_category" data-plugin="select2" data-options="{ theme: bootstrap }">
                                        <option value="">-- Select Sub Category --</option>
                                        <?php $getSubacategories = getAllDataWithStatus('grocery_sub_category','0');?>
                                        <?php while($row = $getSubacategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getGroceryCouponsData['sub_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Price Types</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="price_type_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Price Types</option>
                                        <option <?php if($getGroceryCouponsData['price_type_id'] == 1) { echo "Selected"; } ?> value="1">Price</option>
                                        <option <?php if($getGroceryCouponsData['price_type_id'] == 2) { echo "Selected"; } ?> value="2">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Discount Price / Percentage</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="discount_price" class="form-control valid_price_dec" id="form-control-2" placeholder="Discount Price / Percentage" data-error="Please enter Correct Discount Price / Percentage." required value="<?php echo $getGroceryCouponsData['discount_price'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Coupon Start Date</label>
                                <div class="col-sm-6 col-md-4">
                                    <input class="date-pick form-control" data-format="yyyy-MM-dd" type="text" placeholder="Coupon Start Date" name="coupon_start_date" required="required" value="<?php echo $getGroceryCouponsData['coupon_start_date'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Coupon End Date</label>
                                <div class="col-sm-6 col-md-4">
                                    <input class="date-pick form-control" data-format="yyyy-MM-dd" type="text" placeholder="Coupon End Date" name="coupon_end_date" required="required" value="<?php echo $getGroceryCouponsData['coupon_end_date'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Coupon Description</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea name="coupon_description" class="form-control" placeholder="Coupon Description" required><?php echo $getGroceryCouponsData['coupon_description'];?></textarea>
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
        </div>
        <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
     <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
    <script type="text/javascript">
      $('input.date-pick').datepicker({minDate: 0, maxDate: "+2M"});
    </script>
    <script type="text/javascript">
        $("#category,#sub_category").hide();
        $(document).ready(function () {
        $("#coupon_type").change(function() {
            if($(this).val() == 1) {
                $("#category").show();
                $("#sub_category").hide();
                $('.category').val("");
                $(".category").attr("required", "true");
                $(".sub_category").removeAttr('required');
            } else if($(this).val() == 2) {
                $("#sub_category").show();
                $("#category").hide();
                $('.sub_category').val("");
                $(".sub_category").attr("required", "true");
                $(".category").removeAttr('required');
            } 
        });
        if($('#coupon_type').val() == 1) {
            $("#category").show();
            $("#sub_category").hide();
            $(".category").attr("required", "true");
            $(".sub_category").removeAttr('required');
        } else if($('#coupon_type').val() == 2) {
            $("#sub_category").show();
            $("#category").hide();
            $(".sub_category").attr("required", "true");
            $(".category").removeAttr('required');
        }
      });
    </script>
    
  </body>
</html>