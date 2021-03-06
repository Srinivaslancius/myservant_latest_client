<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(0);
  if (!isset($_POST['submit']))  {
      echo "fail";
  } else  { 
    //echo "<pre>"; print_r($_POST); exit;
      $coupon_code = $_POST['coupon_code'];
      $coupon_device_type = $_POST['coupon_device_type'];
      $price_type_id = $_POST['price_type_id'];
      $discount_price = $_POST['discount_price'];
      $min_order_amount = $_POST['min_order_amount'];
      $status = $_POST['lkp_status_id'];
      $sql = "INSERT INTO food_coupons (`coupon_code`, `coupon_device_type`, `price_type_id`, `discount_price`, `min_order_amount`, `lkp_status_id`) VALUES (UPPER('$coupon_code'), '$coupon_device_type', '$price_type_id', '$discount_price', '$min_order_amount','$status')";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='food_coupons.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='food_coupons.php?msg=fail'</script>";
      }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Food Coupons</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Coupon Code</label>
                    <input type="text" name="coupon_code" style="text-transform:uppercase" class="form-control" id="user_input" placeholder="Coupon Code" data-error="Please enter Coupon Code" onkeyup="checkUserAvailTest()" required>
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="food_coupons">
                    <input type="hidden" id="column_name" value="coupon_code">
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Coupon Device Type</label>
                    <select id="coupon_device_type" name="coupon_device_type" class="custom-select" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                      <option value="">Select Coupon Device Type</option>
                      <?php $getCouponDeviceTypes = getAllData('lkp_register_device_types');?>
                      <?php while($row = $getCouponDeviceTypes->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>" ><?php echo $row['user_type']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Price Types</label>
                    <select id="form-control-3" name="price_type_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Price Types</option>
                      <option value="1">Price</option>
                      <option value="2">Percentage</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Discount Price / Percentage</label>
                    <input type="text" name="discount_price" class="form-control valid_price_dec" id="form-control-2" placeholder="Discount Price / Percentage" data-error="Please enter Correct Discount Price / Percentage." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Min Order Amount</label>
                    <input type="text" name="min_order_amount" class="form-control valid_price_dec" id="form-control-2" placeholder="Min Order Amount" data-error="Please enter Correct Min Order Amount." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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