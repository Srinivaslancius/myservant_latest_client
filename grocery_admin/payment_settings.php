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
      <?php  if (!isset($_POST['submit']))  {
          //If fail
          echo "fail";
        } else  {
            //If success
            $id= 1;

                $delivery = $_POST['delivery'];
                $delivery_charges = $_POST['delivery_charges'];
                $tax_percentage = $_POST['tax_percentage'];
                $coupons = $_POST['coupons'];
                $cash_on_delivery = $_POST['cash_on_delivery'];
                $pay_u_payments = $_POST['pay_u_payments'];
                $hdfc_payments = $_POST['hdfc_payments'];
                $paytm_payments = $_POST['paytm_payments'];
                $order_cancellation_time = $_POST['order_cancellation_time'];

                
                $sql = "UPDATE grocery_payments_settings SET delivery ='$delivery',delivery_charges = '$delivery_charges',tax_percentage ='$tax_percentage',coupons ='$coupons',cash_on_delivery ='$cash_on_delivery',pay_u_payments ='$pay_u_payments',hdfc_payments ='$hdfc_payments',paytm_payments ='$paytm_payments',order_cancellation_time ='$order_cancellation_time' WHERE id = '$id'";                    
                if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='payment_settings.php?msg=success'</script>";
                } else {
                    echo "<script type='text/javascript'>window.location='payment_settings.php?msg=fail'</script>";
                    }
        }
        
?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Payment Settings</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <?php 
                              $checked = "checked";
                            ?>

                            <?php if(isset($_POST['RadioGroup1']) && $_POST['RadioGroup1']=='value2') { echo ' checked="checked"'; } ?>

                          <?php $getAllPaymentsSettings = getAllDataWhere('grocery_payments_settings','id','1'); 
                                $getPaymentsSettings = $getAllPaymentsSettings->fetch_assoc(); ?>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Delivery</label>
                                <div class="col-sm-6 col-md-4 btn-group">
                                    <label class="btn btn-outline-primary  <?php if($getPaymentsSettings['delivery'] == 1) {  ?> active <?php } ?>  ">
                                       <input type="radio" name="delivery" id="delivery"  value="1" <?php if($getPaymentsSettings['delivery'] == 1) echo 'checked="checked"'; ?>
                                        hidden> Yes 
                                    </label>
                                    <label class="btn btn-outline-primary <?php if($getPaymentsSettings['delivery'] == 2) {  ?> active <?php } ?>">
                                        <input type="radio" name="delivery" id="delivery" autocomplete="off" value="2" <?php if($getPaymentsSettings['delivery'] == 2)  echo 'checked="checked"'; ?> hidden> No &nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Delivery Charges</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="delivery_charges" class="form-control" id="form-control-3" placeholder="Enter Delivery Charges" required value="<?php echo $getPaymentsSettings['delivery_charges'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Tax Percentage</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="tax_percentage" class="form-control" id="form-control-3" placeholder="Enter Tax Percentage" required value="<?php echo $getPaymentsSettings['tax_percentage'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Coupons</label>
                                <div class="btn-group col-sm-6 col-md-4">
                                     <label class="btn btn-outline-primary <?php if($getPaymentsSettings['coupons'] == 1) {  ?> active <?php } ?>">
                                        <input type="radio" name="coupons" id="buttonRadios1" autocomplete="off"  value="1" <?php if($getPaymentsSettings['coupons'] == 1) echo $checked; ?> hidden> Yes
                                    </label>
                                    <label class="btn btn-outline-primary <?php if($getPaymentsSettings['coupons'] == 2) {  ?> active <?php } ?>">
                                        <input type="radio" name="coupons" id="buttonRadios2" autocomplete="off" value="2" <?php if($getPaymentsSettings['coupons'] == 2) echo $checked; ?> hidden> No &nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Cash On Delivery</label>
                                <div class="col-sm-6 col-md-4 btn-group">
                                     <label class="btn btn-outline-primary <?php if($getPaymentsSettings['cash_on_delivery'] == 1) {  ?> active <?php } ?>">
                                        <input type="radio" name="cash_on_delivery" id="buttonRadios1" autocomplete="off"  value="1" <?php if($getPaymentsSettings['cash_on_delivery'] == 1) echo $checked; ?> hidden> Yes
                                    </label>
                                    <label class="btn btn-outline-primary <?php if($getPaymentsSettings['cash_on_delivery'] == 2) {  ?> active <?php } ?>">
                                        <input type="radio" name="cash_on_delivery" id="buttonRadios2" autocomplete="off" value="2" <?php if($getPaymentsSettings['cash_on_delivery'] == 2) echo $checked; ?> hidden> No &nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Pay U Payment</label>
                                <div class="col-sm-6 col-md-4 btn-group">
                                     <label class="btn btn-outline-primary <?php if($getPaymentsSettings['pay_u_payments'] == 1) {  ?> active <?php } ?>">
                                        <input type="radio" name="pay_u_payments" id="buttonRadios1" autocomplete="off"  value="1" <?php if($getPaymentsSettings['pay_u_payments'] == 1) echo $checked; ?> hidden> Yes
                                    </label>
                                    <label class="btn btn-outline-primary <?php if($getPaymentsSettings['pay_u_payments'] == 2) {  ?> active <?php } ?>">
                                        <input type="radio" name="pay_u_payments" id="buttonRadios2" autocomplete="off" value="2" <?php if($getPaymentsSettings['pay_u_payments'] == 2) echo $checked; ?> hidden> No &nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">HDFC Payment</label>
                                <div class="col-sm-6 col-md-4 btn-group">
                                     <label class="btn btn-outline-primary <?php if($getPaymentsSettings['hdfc_payments'] == 1) {  ?> active <?php } ?>">
                                        <input type="radio" name="hdfc_payments" id="buttonRadios1" autocomplete="off"  value="1" <?php if($getPaymentsSettings['hdfc_payments'] == 1) echo $checked; ?> hidden> Yes
                                    </label>
                                    <label class="btn btn-outline-primary <?php if($getPaymentsSettings['hdfc_payments'] == 2) {  ?> active <?php } ?>">
                                        <input type="radio" name="hdfc_payments" id="buttonRadios2" autocomplete="off" value="2" <?php if($getPaymentsSettings['hdfc_payments'] == 2) echo $checked; ?> hidden> No &nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Paytm Payment</label>
                                <div class="col-sm-6 col-md-4 btn-group">
                                     <label class="btn btn-outline-primary <?php if($getPaymentsSettings['paytm_payments'] == 1) {  ?> active <?php } ?>">
                                        <input type="radio" name="paytm_payments" id="buttonRadios1" autocomplete="off" value="1" <?php if($getPaymentsSettings['paytm_payments'] == 1) echo $checked; ?> hidden> Yes
                                    </label>
                                    <label class="btn btn-outline-primary <?php if($getPaymentsSettings['paytm_payments'] == 2) {  ?> active <?php } ?>">
                                        <input type="radio" name="paytm_payments" id="buttonRadios2" autocomplete="off" value="2" <?php if($getPaymentsSettings['paytm_payments'] == 2) echo $checked; ?> hidden> No &nbsp; 
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Order Cancellation Time</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="order_cancellation_time" class="form-control" id="form-control-3" placeholder="Enter Tax Order Cancellation Time" required value="<?php echo $getPaymentsSettings['order_cancellation_time'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="site-footer">
         Design & Developed By Lancius IT Solutions
        </div>

    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>