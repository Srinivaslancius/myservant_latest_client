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
  $lkp_payment_status_id = $_POST['lkp_payment_status_id'];
  $lkp_order_status_id = $_POST['lkp_order_status_id'];
  $lkp_order_tracking_status_id = $_POST['lkp_order_tracking_status_id'];
  $user_id = $_POST['user_id'];
  $delivery_date = date("Y-m-d h:i:s");
  $getSiteSettings1 = getIndividualDetails('grocery_site_settings','id','1');
  $getAmount = getIndividualDetails('user_wallet','wallet_id',$_SESSION['wallet_id']);
  
  if($lkp_order_status_id == 2) {
    $sql = "UPDATE `grocery_orders` SET delivery_date ='$delivery_date' WHERE order_id = '$order_id' ";
    $res = $conn->query($sql);
  }

  if($lkp_order_status_id == 2 && $lkp_payment_status_id == 1) {
    //Sending SMS after order completion
    $getUserDetails = getIndividualDetails('users','id',$user_id);
    $user_mobile = $getUserDetails['user_mobile'];
    $message1 = urlencode('Delivered: Your order ('.$order_id.') delivered Successfully. We hope you enjoy your stay at myservant.com.'); // Message text required to deliver on mobile number
    $sendSMS = sendMobileSMS($message1,$user_mobile);

    //Changing transaction status of referd email
    $getfriendDetails2 = "SELECT * FROM grocery_refer_a_friend WHERE refer_email_id = '".$_SESSION['user_login_session_email']."' AND register_status = '1'";
    $getfriendDetails1 = $conn->query($getfriendDetails2);
    //echo $getfriendDetails1->num_rows; die;
    if($getfriendDetails1->num_rows > 0) {
      $getFirstTran1 = "SELECT * FROM grocery_orders WHERE user_id = '$user_id' GROUP BY order_id";
      $getFirstTran = $conn->query($getFirstTran1);
      if($getFirstTran->num_rows == 1) {
        $getfriendDetails = $getfriendDetails1->fetch_assoc();
        $updateRefer = "UPDATE `grocery_refer_a_friend` SET first_transaction_status = '1' WHERE refer_email_id = '".$_SESSION['user_login_session_email']."' AND register_status = '1'";
        $conn->query($updateRefer);
        $refer_amount = $getSiteSettings1["reffer_amount"]+$getAmount['amount'];
        $updateWalletAmount1 = "UPDATE user_wallet SET amount = '$refer_amount' WHERE user_id = '$user_id' ";
        $conn->query($updateWalletAmount1);
        $updateWalletAmount2 = "UPDATE user_wallet SET amount = '$refer_amount' WHERE user_id = '".$getfriendDetails['refered_user_id']."' ";
        $conn->query($updateWalletAmount2);
        $description = "Money Credited for refer a friend";
        $updated_date1 = date('Y-m-d H:i:s');
        $insertTransaction1 = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `credit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('".$_SESSION['wallet_id']."','$user_id','".$getSiteSettings1["reffer_amount"]."','$description','1','$updated_date1')";
        $conn->query($insertTransaction1);
        $insertTransaction1 = "INSERT INTO `user_wallet_transactions`( `wallet_id`, `user_id`, `credit_amnt`, `description`, `lkp_payment_status_id`, `updated_date`) VALUES ('".$_SESSION['wallet_id']."','".$getfriendDetails['refered_user_id']."','".$getSiteSettings1["reffer_amount"]."','$description','1','$updated_date1')";
        $conn->query($insertTransaction1);
      }
    }
  }

  $sql = "UPDATE `grocery_orders` SET lkp_payment_status_id = '$lkp_payment_status_id',lkp_order_status_id = '$lkp_order_status_id',lkp_order_tracking_status_id = '$lkp_order_tracking_status_id' WHERE order_id = '$order_id' ";
  $res = $conn->query($sql);
  header("Location: edit_orders.php?order_id=".$order_id."&msg=success");
  //header("Location:javascript://history.go(-1)");
}   
?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Order Details</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getGroceryOrdersData = "SELECT * FROM grocery_orders WHERE order_id = '$order_id'"; $getGroceryOrdersData1 = $conn->query($getGroceryOrdersData);
                        $getGroceryOrdersData = $getGroceryOrdersData1->fetch_assoc(); 
                        ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                          <?php 
                        $getPaymentStatusData = "SELECT * FROM lkp_payment_status WHERE id != 3";
                        $getPaymentStatus = $conn->query($getPaymentStatusData);?>
                        <input type="hidden" name="user_id" value="<?php echo $getGroceryOrdersData['user_id']; ?>">
                        <div class="form-group">
                          <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Order Id</label>
                          <div class="col-sm-6 col-md-4">
                            <input type="text" class="form-control" readonly name="order_id" value="<?php echo $order_id; ?>">
                          </div>
                        </div>
                           <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose your Payment status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_payment_status_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Payment status</option>
                                      
                                      <?php while($row = $getPaymentStatus->fetch_assoc()) { ?>
                                      <option <?php if($row['id'] == $getGroceryOrdersData['lkp_payment_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['payment_status']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            if($getGroceryOrdersData['lkp_order_status_id'] == 1) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_status WHERE id != 1";
                            } elseif ($getGroceryOrdersData['lkp_order_status_id'] == 4) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_status WHERE id NOT IN (1,4)";
                            } elseif ($getGroceryOrdersData['lkp_order_status_id'] == 2) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_status WHERE id NOT IN (1,2,4)";
                            } elseif ($getGroceryOrdersData['lkp_order_status_id'] == 5) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_status WHERE id NOT IN (1,2,4)";
                            }
                            $getStatusData = $conn->query($getOrderStatusData);?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose your Order status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_order_status_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Order status</option>
                                      
                                      <?php while($row = $getStatusData->fetch_assoc()) { ?>
                                      <option <?php if($row['id'] == $getGroceryOrdersData['lkp_order_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['order_status']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            if($getGroceryOrdersData['lkp_order_tracking_status_id'] == 1) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_tracking_status WHERE id != 1";
                            } elseif ($getGroceryOrdersData['lkp_order_tracking_status_id'] == 2) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_tracking_status WHERE id NOT IN (1,2)";
                            } elseif ($getGroceryOrdersData['lkp_order_tracking_status_id'] == 3) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_tracking_status WHERE id NOT IN (1,2,3)";
                            } elseif ($getGroceryOrdersData['lkp_order_tracking_status_id'] == 4) {
                              $getOrderStatusData = "SELECT * FROM lkp_order_tracking_status WHERE id NOT IN (1,2,3)";
                            }
                            $getStatusData = $conn->query($getOrderStatusData);?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Order Tracking Status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_order_tracking_status_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">Select Order Tracking Status</option>
                                      
                                      <?php while($row = $getStatusData->fetch_assoc()) { ?>
                                      <option <?php if($row['id'] == $getGroceryOrdersData['lkp_order_tracking_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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