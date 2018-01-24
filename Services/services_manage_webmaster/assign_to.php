<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$order_id = $_GET['order_id'];
$category_id = $_GET['category_id'];
$assign_id = $_GET['assign_id'];
$subcat_id = $_GET['subcat_id'];
if (!isset($_POST['submit'])) {
  //If fail
    echo "fail";
} else {
    //If success            
  $assign_service_provider_id = $_POST['assign_service_provider_id'];
  $service_provider_note = $_POST['service_provider_note'];
  
  $sql = "UPDATE `services_orders` SET assign_service_provider_id = '$assign_service_provider_id',service_provider_note = '$service_provider_note' WHERE id = '$assign_id' AND sub_category_id = '$subcat_id'";
  if($conn->query($sql) === TRUE){
     echo "<script type='text/javascript'>window.location='view_category_orders.php?order_id=$order_id&msg=success'</script>";
  } else {
     echo "<script type='text/javascript'>window.location='view_category_orders.php?order_id=$order_id&msg=fail'</script>";
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
              <?php $getServiceOrders1 = "SELECT * FROM services_orders WHERE id = '$assign_id' AND sub_category_id = '$subcat_id'"; $getServiceOrders = $conn->query($getServiceOrders1);
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
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Service Provider</label>
                    <select name="assign_service_provider_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Service Provider</option>
                      <?php $getServiceProvider = "SELECT spr.id,spr.name,spr.lkp_status_id FROM service_provider_registration spr LEFT JOIN service_provider_business_registration spb ON spr.id = spb.service_provider_registration_id LEFT JOIN service_provider_personal_registration spp ON spr.id = spp.service_provider_registration_id WHERE spr.lkp_status_id=0 AND ( FIND_IN_SET('$subcat_id', spb.sub_category_id)  OR FIND_IN_SET('$subcat_id', spp.sub_category_id)  )";
                      $getServiceProviderNames = $conn->query($getServiceProvider); 
                      while($getServiceProviderData = $getServiceProviderNames->fetch_assoc()) { ?>
                      <option <?php if($getServiceProviderData['id'] == $getServiceOrdersData['assign_service_provider_id']) { echo "Selected"; } ?> value="<?php echo $getServiceProviderData['id']; ?>"><?php echo $getServiceProviderData['name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Service Provider Note</label>
                    <input type="text" name="service_provider_note" class="form-control" id="form-control-2" value="<?php echo $getServiceOrdersData['service_provider_note'] ?>" placeholder="Service Provider Note" data-error="Please enter Service Provider Note." required>
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