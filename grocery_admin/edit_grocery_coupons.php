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
            $status = $_POST['lkp_status_id'];
            $sql = "UPDATE `grocery_coupons` SET coupon_code=UPPER('$coupon_code'), price_type_id='$price_type_id', discount_price='$discount_price', lkp_status_id = '$status' WHERE id = '$id' ";
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
                                    <input type="text" style="text-transform:uppercase" name="coupon_code" class="form-control" id="form-control-3" placeholder="Enter Coupon Code" required value="<?php echo $getGroceryCouponsData['coupon_code'];?>">
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

    
  </body>
</html>