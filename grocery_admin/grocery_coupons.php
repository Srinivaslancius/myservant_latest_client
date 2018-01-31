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
          $coupon_code = $_POST['coupon_code'];
          $price_type_id = $_POST['price_type_id'];
          $discount_price = $_POST['discount_price'];
          $sql = "INSERT INTO grocery_coupons (`coupon_code`, `price_type_id`, `discount_price`) VALUES (UPPER('$coupon_code'), '$price_type_id', '$discount_price')";
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
                    <h3 class="m-y-0 font_sz_view">Add Coupons</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Coupon Code</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" style="text-transform:uppercase" name="coupon_code" class="form-control" id="form-control-3" placeholder="Enter Coupon Code" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Price Types</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="price_type_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Price Types</option>
                                        <option value="1">Price</option>
                                        <option value="2">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Discount Price / Percentage</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="discount_price" class="form-control valid_price_dec" id="form-control-2" placeholder="Discount Price / Percentage" data-error="Please enter Correct Discount Price / Percentage." required>
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
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Coupons</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Coupon Code</th>
                                    <th>Price Type</th>
                                    <th>Discount Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getGroceryCoupons = getAllDataWithActiveRecent('grocery_coupons'); $i=1;
                                while ($row = $getGroceryCoupons->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $row['coupon_code'];?></td>
                                    <td><?php if($row['price_type_id'] == 1) { echo "Price"; } else { echo "Percentage"; }?></td>
                                    <td><?php echo $row['discount_price'];?></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_coupons'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_coupons'>In Active</span>" ;} ?></td>
                                   <td> <a href="edit_grocery_coupons.php?coupon_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
                                </tr>
                                <?php  $i++; } ?>
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

    
  </body>
</html>