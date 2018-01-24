<?php include_once 'admin_includes/main_header.php'; ?>
<?php
error_reporting(0);
$id = $_GET['coupon_id'];
 if (!isset($_POST['submit']))  {
  echo "fail";
  } else  {
    $coupon_code = $_POST['coupon_code'];
    $price_type_id = $_POST['price_type_id'];
    $discount_price = $_POST['discount_price'];
    $status = $_POST['lkp_status_id'];
    $sql = "UPDATE `food_coupons` SET coupon_code=UPPER('$coupon_code'), price_type_id='$price_type_id', discount_price='$discount_price', lkp_status_id = '$status' WHERE id = '$id' ";
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
              <?php $getFoodCoupons = getAllDataWhere('food_coupons','id',$id);
              $getFoodCouponsData = $getFoodCoupons->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Coupon Code</label>
                    <input type="text" name="coupon_code" style="text-transform:uppercase" class="form-control" id="user_input" placeholder="Coupon Code" data-error="Please enter Coupon Code" onkeyup="checkUserAvailTest()" required value="<?php echo $getFoodCouponsData['coupon_code'];?>">
                    <span id="input_status" style="color: red;"></span>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" id="table_name" value="food_coupons">
                    <input type="hidden" id="column_name" value="coupon_code">
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Admin Service Types</label>
                    <select id="form-control-3" name="price_type_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Admin Service Types</option>
                      <option <?php if($getFoodCouponsData['price_type_id'] == 1) { echo "Selected"; } ?> value="1">Price</option>
                      <option <?php if($getFoodCouponsData['price_type_id'] == 2) { echo "Selected"; } ?> value="2">Percentage</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Discount Price / Percentage</label>
                    <input type="text" name="discount_price" class="form-control valid_price_dec" id="form-control-2" placeholder="Discount Price / Percentage" data-error="Please enter Discount Price / Percentage." required value="<?php echo $getFoodCouponsData['discount_price'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                 <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getFoodCouponsData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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