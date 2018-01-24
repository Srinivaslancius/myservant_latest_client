<?php include_once 'admin_includes/main_header.php'; ?>
<?php  if (!isset($_POST['submit']))  {
        echo "";
	} else  {
	    $product_type = $_POST['product_type'];
	    $lkp_status_id = $_POST['lkp_status_id'];                                                    
	    $sql = "INSERT INTO food_product_type (`product_type`,`lkp_status_id`) VALUES ('$product_type','$lkp_status_id')";
        if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='food_product_type.php?msg=success'</script>";
        } else {
         echo "<script type='text/javascript'>window.location='food_product_type.php?msg=fail'</script>";
        }            
	 }
?>
<div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Item Type</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Item Type</label>
                    <input type="text" name="product_type" class="form-control" id="product_type" placeholder="Item Type" data-error="Please enter Item type" required>
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