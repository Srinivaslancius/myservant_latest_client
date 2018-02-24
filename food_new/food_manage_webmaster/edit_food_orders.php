<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$order_id = $_GET['order_id'];
if (!isset($_POST['submit'])) {
  //If fail
    echo "fail";
} else {
    //If success 
  $lkp_payment_status_id = $_POST['lkp_payment_status_id'];
  $lkp_order_status_id = $_POST['lkp_order_status_id'];
  $user_id = $_POST['user_id'];
  $delivery_date = date("Y-m-d h:i:s");
  
  if($lkp_order_status_id == 2) {
    $sql = "UPDATE `food_orders` SET delivery_date ='$delivery_date' WHERE order_id = '$order_id' ";
    $res = $conn->query($sql);
  }

  if($lkp_order_status_id == 5 && $lkp_payment_status_id == 1) {
    //Sending SMS after order completion
    $getUserDetails = getIndividualDetails('users','id',$user_id);
    $user_mobile = $getUserDetails['user_mobile'];
    $message1 = urlencode('Your order ('.$order_id.') is placed. We hope you enjoy your stay at myservant.com.'); // Message text required to deliver on mobile number
    $sendSMS = sendMobileSMS($message1,$user_mobile);
  }

  $sql = "UPDATE `food_orders` SET lkp_payment_status_id = '$lkp_payment_status_id',lkp_order_status_id = '$lkp_order_status_id' WHERE order_id = '$order_id' ";
  $res = $conn->query($sql);
  header("Location:food_order_invoice.php?id=".$order_id."");
}   
?>
 <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <center><h3 class="m-y-0">Order Details</h3></center>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getFoodOrders = "SELECT * FROM food_orders WHERE order_id = '$order_id'"; $getFoodOrders1 = $conn->query($getFoodOrders);
              $getFoodOrdersData = $getFoodOrders1->fetch_assoc(); 
              ?>

              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">

                  <?php 
                  $getPaymentStatusData = "SELECT * FROM lkp_payment_status WHERE id != 3";
                  $getPaymentStatus = $conn->query($getPaymentStatusData);?>
                  <input type="hidden" name="user_id" value="<?php echo $getFoodOrdersData['user_id']; ?>">
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Payment status</label>
                    <select id="form-control-3" name="lkp_payment_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Payment status</option>
                      <?php while($row = $getPaymentStatus->fetch_assoc()) {  ?>
                      <option <?php if($row['id'] == $getFoodOrdersData['lkp_payment_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['payment_status']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <?php
                  $getOrderStatusData = "SELECT * FROM lkp_food_order_status WHERE lkp_status_id = 0 LIMIT 2,6";
                  $getStatusData = $conn->query($getOrderStatusData);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Order status</label>
                    <select id="form-control-3" name="lkp_order_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Order status</option>
                      <?php while($row = $getStatusData->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getFoodOrdersData['lkp_order_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['order_status']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
<?php include_once 'admin_includes/footer.php'; ?>