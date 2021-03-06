<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from big-bang-studio.com/cosmos/pages-invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2017 10:14:32 GMT -->
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

<?php
error_reporting(0);
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');

$order_id = $_GET['order_id'];

$getOrders = "SELECT * FROM food_orders WHERE order_id='$order_id'";
$getOrdersData = $conn->query($getOrders);
$getOrdersData1 = $getOrdersData->fetch_assoc();

$getSiteSettingsData = getIndividualDetails('food_site_settings','id',1);
$getRestaurants = getIndividualDetails('food_vendors','id',$getOrdersData1['restaurant_id']);
$getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$getOrdersData1['payment_method']);
$orderStatus = getIndividualDetails('lkp_food_order_status','id',$getOrdersData1['lkp_order_status_id']);
$paymentStatus = getIndividualDetails('lkp_payment_status','id',$getOrdersData1['lkp_payment_status_id']);
$getAddOnsPrice = "SELECT * FROM food_order_ingredients WHERE order_id = '$order_id'";
$getAddontotal = $conn->query($getAddOnsPrice);
$getAddontotalCount = $getAddontotal->num_rows;
$getAdstotal = 0;
while($getAdTotal = $getAddontotal->fetch_assoc()) {
    $getAdstotal += $getAdTotal['item_ingredient_price'];
}
$service_tax = $getOrdersData1['sub_total']*$getSiteSettingsData['service_tax']/100;
if($getOrdersData1['delivery_charges'] == '0') {
  $order_type = "Take Away";
  $delivery_charges = 0;
} else {
  $order_type = "Delivery";
  $delivery_charges = $getOrdersData1['delivery_charges'];
}
?>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    
    <div class="site-main">     
     
      <div class="site-content">
        <div class="panel panel-default m-b-0">
          <div class="panel-heading">
            <h3 class="m-y-0">Invoice</h3>           
          </div>
          <div class="panel-body">
            <div class="row m-b-30">              
              <div class="col-sm-6">                
                <p><strong>Order Info</strong></p>
                <p>Order Id: <?php echo $getOrdersData1['order_id']; ?>
                  <br>Restaurant Name: <?php echo $getRestaurants['restaurant_name']; ?>
                  <br>Order Date: <?php echo $getOrdersData1['created_at']; ?>                  
                </p>               
              </div>
            </div>
            <table class="table table-bordered m-b-30">
              <thead>
                <tr>
                  <th>
                    S.No
                  </th>
                  <th>
                    Item Name
                  </th>
                  <th>
                    Menu Name
                  </th>
                  <th>
                    Item Weight
                  </th>                
                  <th>
                    Quantity
                  </th>
                  
                </tr>
              </thead>

              <tbody>
                <?php 
                  $i=1;
                  $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
          $getOrdersData3 = $conn->query($getOrders1);
          while($getOrdersData2 = $getOrdersData3->fetch_assoc()) {
          $getCategories = getIndividualDetails('food_category','id',$getOrdersData2['category_id']);
              $getProducts = getIndividualDetails('food_products','id',$getOrdersData2['product_id']);
              $getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);         
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $getProducts['product_name'] ?></td>
                  <td><?php echo $getCategories['category_name'] ?></td>
                  <td><?php echo $getItemWeights['weight_type']; ?></td>
                  <td><?php echo $getOrdersData2['item_quantity']; ?></td>                  
                  
                </tr>  
                <?php $i++; } ?>                              
              </tbody>
            </table>
          
          </div>
          <div class="panel-footer text-right">
            <button type="button" class="btn btn-primary btn-labeled" onclick="myFunction()">Print
              <span class="btn-label btn-label-right p-x-10">
                <i class="zmdi zmdi-print"></i>
              </span>
            </button>
            
          </div>
        </div>
      </div>
      <div class="site-footer">
        2017 © LANCIUS IT SOLUTIONS
      </div>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
  </body>
    <script>
  function myFunction() {
      window.print();
  }
  </script>

</html>