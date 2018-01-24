<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$order_id = $_GET['order_id'];
if (!isset($_POST['submit'])) {
  //If fail
    echo "fail";
} else {
    //If success            
  $assign_delivery_id = $_POST['assign_delivery_id'];
  
  $sql = "UPDATE `food_orders` SET assign_delivery_id = '$assign_delivery_id',lkp_order_status_id = 3 WHERE order_id = '$order_id' ";
  if($conn->query($sql) === TRUE){
     echo "<script type='text/javascript'>window.location='food_orders.php?order_id=$order_id&msg=success'</script>";
  } else {
     echo "<script type='text/javascript'>window.location='food_orders.php?order_id=$order_id&msg=fail'</script>";
  }
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
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Delivery Boy</label>
                    <select name="assign_delivery_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Delivery Boy</option>
                      <?php $getDeliveryBoys = getAllDataWhere('food_delivery_boys','lkp_status_id','0');
                      while($getDeliveryBoysData = $getDeliveryBoys->fetch_assoc()) { ?>
                      <option <?php if($getDeliveryBoysData['id'] == $getFoodOrdersData['assign_delivery_id']) { echo "Selected"; } ?> value="<?php echo $getDeliveryBoysData['id']; ?>"><?php echo $getDeliveryBoysData['name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="form-control-3" class="control-label">Service Provider Note</label>
                    <input type="text" name="service_provider_note" class="form-control" id="form-control-2" value="<?php echo $getServiceOrdersData['service_provider_note'] ?>" placeholder="Service Provider Note" data-error="Please enter Service Provider Note." required>
                    <div class="help-block with-errors"></div>
                  </div> -->
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
<?php include_once 'admin_includes/footer.php'; ?>