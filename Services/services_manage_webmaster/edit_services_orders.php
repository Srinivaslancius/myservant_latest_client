<?php include_once 'admin_includes/main_header.php';
$getSiteSettingsData = getIndividualDetails('services_site_settings','id',1);

$id = $_GET['id'];
$subcat_id = $_GET['subcat_id'];
$order_id = $_GET['order_id'];
if (!isset($_POST['submit'])) {
  //If fail
    echo "fail";
} else {
    //If success
  $order_price = $_POST['order_price'];
  $lkp_order_status_id = $_POST['lkp_order_status_id'];
  $lkp_payment_status_id = $_POST['lkp_payment_status_id'];
  $order_total = $_POST['order_total'];
  $delivery_date = date("Y-m-d h:i:s");

  if($_POST['service_tax'] != 0) {
    if($lkp_payment_status_id == 1 AND $lkp_order_status_id == 2) {
      $sql = "UPDATE `services_orders` SET lkp_order_status_id='$lkp_order_status_id', lkp_payment_status_id='$lkp_payment_status_id', delivery_date ='$delivery_date' WHERE id = '$id'";
      $res = $conn->query($sql);
    } else {
      $sql = "UPDATE `services_orders` SET lkp_order_status_id='$lkp_order_status_id', lkp_payment_status_id='$lkp_payment_status_id' WHERE id = '$id'";
      $res = $conn->query($sql);
    }
  } else {
    $service_tax = $getSiteSettingsData['service_tax'];
    //Update total and price when payment status success and order status completed
    if($lkp_payment_status_id == 1 AND $lkp_order_status_id == 2) {

      if($_POST['service_price_type_id'] == 1) {
        $order_total = $_POST['order_total']+($order_price*$_POST['service_quantity']*$service_tax/100);
        $sql = "UPDATE `services_orders` SET service_tax = '$service_tax',lkp_order_status_id='$lkp_order_status_id', lkp_payment_status_id='$lkp_payment_status_id', delivery_date ='$delivery_date' WHERE id = '$id'";
        $res = $conn->query($sql);
      } else {
        $order_total = $_POST['order_total']+($order_price*$_POST['service_quantity'])+($order_price*$_POST['service_quantity']*$service_tax/100);
        $sql = "UPDATE `services_orders` SET service_tax = '$service_tax',order_price='$order_price',lkp_order_status_id='$lkp_order_status_id', lkp_payment_status_id='$lkp_payment_status_id', delivery_date ='$delivery_date' WHERE id = '$id'";
        $res = $conn->query($sql);
      }
      $updateTotal = "UPDATE `services_orders` SET order_total = '$order_total' WHERE order_id = '$order_id'";
      $updateOrdertotal = $conn->query($updateTotal);
    } else {
      $sql = "UPDATE `services_orders` SET order_price='$order_price',lkp_order_status_id='$lkp_order_status_id', lkp_payment_status_id='$lkp_payment_status_id' WHERE id = '$id'";
        $res = $conn->query($sql);
    }
  }

  header("Location:order_invoice.php?id=".$id."");
}   
?>
 <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <center><h3 class="m-y-0">Service Orders</h3></center>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getServiceOrders1 = "SELECT * FROM services_orders WHERE id = '$id' AND sub_category_id = '$subcat_id'"; 
              $getServiceOrders = $conn->query($getServiceOrders1);
              $getServiceOrdersData = $getServiceOrders->fetch_assoc(); 
              ?>
              <div class="row">
                <div class="col-sm-3">
                  Name: <?php echo $getServiceOrdersData['first_name']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getCategories = getAllDataWhere('services_category','id',$getServiceOrdersData['category_id']); $getCategoriesData = $getCategories->fetch_assoc();?>
                  Category Name: <?php echo $getCategoriesData['category_name']; ?>
                </div>
                <div class="col-sm-3">
                  Service price: <?php echo $getServiceOrdersData['service_price']; ?>
                </div>
                <div class="col-sm-3">
                  Order Id: <?php echo $getServiceOrdersData['order_id']; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                Email: <?php echo $getServiceOrdersData['email']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getSubCategories = getAllDataWhere('services_sub_category','id',$getServiceOrdersData['sub_category_id']); $getSubCategoriesData = $getSubCategories->fetch_assoc();?>
                  Sub Category Name: <?php echo $getSubCategoriesData['sub_category_name']; ?>
                </div>
                <div class="col-sm-3">
                  Service Quantity: <?php echo $getServiceOrdersData['service_quantity']; ?>
                </div>
                <div class="col-sm-3">
                  Order Sub Id: <?php echo $getServiceOrdersData['order_sub_id']; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  Mobile: <?php echo $getServiceOrdersData['mobile']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getGroups = getAllDataWhere('services_groups','id',$getServiceOrdersData['group_id']); $getGroupsData = $getGroups->fetch_assoc();?>
                  Group Name: <?php echo $getGroupsData['group_name']; ?>
                </div>
                <div class="col-sm-3">
                  Service Selected Date: <?php echo $getServiceOrdersData['service_selected_date']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getorderStatus = getAllDataWhere('lkp_order_status','id',$getServiceOrdersData['lkp_order_status_id']); $getorderStatusData = $getorderStatus->fetch_assoc();?>
                  Order Status: <?php echo $getorderStatusData['order_status']; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  Adderss: <?php echo $getServiceOrdersData['address']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getServiceNames = getAllDataWhere('services_group_service_names','id',$getServiceOrdersData['service_id']); $getServiceNamesData = $getServiceNames->fetch_assoc();?>
                  Service Name: <?php echo $getServiceNamesData['group_service_name']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getPaymentMethod = getAllDataWhere('lkp_payment_types','id',$getServiceOrdersData['payment_method']); $getPaymentMethodData = $getPaymentMethod->fetch_assoc();?>
                  Payment Method: <?php echo $getPaymentMethodData['status']; ?>
                </div>
                <div class="col-sm-3">
                  <?php $getPaymentStatus = getAllDataWhere('lkp_payment_status','id',$getServiceOrdersData['lkp_payment_status_id']); $getPaymentStatusData = $getPaymentStatus->fetch_assoc();?>
                  Payment Status: <?php echo $getPaymentStatusData['payment_status']; ?>
                </div>
              </div>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" name="order_total" value="<?php echo $getServiceOrdersData['order_total'];?>">
                  <input type="hidden" name="service_tax" value="<?php echo $getServiceOrdersData['service_tax'];?>">
                  <input type="hidden" name="service_price_type_id" value="<?php echo $getServiceOrdersData['service_price_type_id'];?>">
                  <input type="hidden" name="service_quantity" value="<?php echo $getServiceOrdersData['service_quantity'];?>">
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Service Provider</label>
                      <?php $getServiceProviderNames = getAllDataWhere('service_provider_registration','id',$getServiceOrdersData['assign_service_provider_id']); $getServiceProviderData = $getServiceProviderNames->fetch_assoc(); 
                      ?>
                      <input type="text" readonly name="assign_service_provider_id" class="form-control" id="form-control-2" placeholder="Service Provider" data-error="Please enter Service Provider." value="<?php echo $getServiceProviderData['name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php if($getServiceOrdersData['service_price_type_id'] == 1) { ?>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Order Price</label>
                    <input type="text" readonly name="order_price" class="form-control" id="form-control-2" placeholder="Service Price" data-error="Please enter Service Price." value="<?php echo $getServiceOrdersData['order_price'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php } else { ?>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Order Price</label>
                    <input type="text" name="order_price" class="form-control valid_price_dec" id="form-control-2" placeholder="Service Price" data-error="Please enter Service Price." required value="<?php echo $getServiceOrdersData['order_price'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php } ?>

                  <?php 
                  $getPaymentStatusData = "SELECT * FROM lkp_payment_status WHERE id != 3";
                  $getPaymentStatus = $conn->query($getPaymentStatusData);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Payment status</label>
                    <select id="form-control-3" name="lkp_payment_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Payment status</option>
                      <?php while($row = $getPaymentStatus->fetch_assoc()) {  ?>
                      <option <?php if($row['id'] == $getServiceOrdersData['lkp_payment_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['payment_status']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <?php 
                  $getStatusData = "SELECT * FROM lkp_order_status WHERE id != 3";
                  $getStatus = $conn->query($getStatusData);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Order status</label>
                    <select id="form-control-3" name="lkp_order_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Order status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getServiceOrdersData['lkp_order_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['order_status']; ?></option>
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