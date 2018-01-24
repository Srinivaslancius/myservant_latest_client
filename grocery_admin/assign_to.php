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
        $order_id = $_GET['order_id'];
        if (!isset($_POST['submit'])) {
          //If fail
            echo "fail";
        } else {
            //If success            
          $assign_delivery_id = $_POST['assign_delivery_id'];
          
          $sql = "UPDATE `grocery_orders` SET assign_delivery_id = '$assign_delivery_id' WHERE order_id = '$order_id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='view_orders.php?order_id=$order_id&msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='view_orders.php?order_id=$order_id&msg=fail'</script>";
          }
        }   
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Order Details</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getGroceryOrders = "SELECT * FROM grocery_orders WHERE order_id = '$order_id'"; 
                        $getGroceryOrders1 = $conn->query($getGroceryOrders);
                            $getGroceryOrdersData = $getGroceryOrders1->fetch_assoc(); 
              ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                           <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Delivery Boy</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="assign_delivery_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Delivery Boy</option>
                                      <?php $getDeliveryBoys = getAllDataWhere('grocery_delivery_boys','lkp_status_id','0');
                                      while($getDeliveryBoysData = $getDeliveryBoys->fetch_assoc()) { ?>
                                      <option <?php if($getDeliveryBoysData['id'] == $getGroceryOrdersData['assign_delivery_id']) { echo "Selected"; } ?> value="<?php echo $getDeliveryBoysData['id']; ?>"><?php echo $getDeliveryBoysData['deliveryboy_name']; ?></option>
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
  </body>
</html>