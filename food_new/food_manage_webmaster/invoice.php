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
	<style>
	.site-content {
    padding: 15px 200px 65px 200px;
	margin:0 auto;
	margin-left:0px !important;
	}
	.site-footer{
		margin-left:0px !important;
	}
	.layout{
		padding-top:20px !important;
	}
	</style>
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
$getState = getIndividualDetails('lkp_states','id',$getOrdersData1['lkp_state_id']);
$getDistrict = getIndividualDetails('lkp_districts','id',$getOrdersData1['lkp_district_id']);
$getPincode = getIndividualDetails('lkp_pincodes','id',$getOrdersData1['lkp_pincode_id']);
$getCity = getIndividualDetails('lkp_cities','id',$getOrdersData1['lkp_city_id']);
$getArea = getIndividualDetails('lkp_locations','id',$getOrdersData1['lkp_location_id']);
?>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    
    <div class="site-main">     
     
      <div class="site-content">
        <div class="panel panel-default m-b-0">
          <div class="panel-heading">
            <h3 class="m-y-0">Invoice</h3>
            <center><img src="<?php echo $base_url . 'uploads/food_logo/'.$getSiteSettingsData['logo'] ?>" class="logo-responsive" ></center>
          </div>
          <div class="panel-body">
            <div class="row m-b-30">
              <div class="col-sm-6">                
                <p><strong>Customer Address</strong></p>
                <p><?php echo $getOrdersData1['first_name']; ?>
                  <br><?php echo $getOrdersData1['email']; ?>
                  <br><?php echo $getOrdersData1['address']; ?>,<?php echo $getState['state_name']; ?>,<?php echo $getDistrict['district_name']; ?>,<?php echo $getCity['city_name']; ?>,<?php echo $getArea['location_name']; ?> - <?php echo $getPincode['pincode']; ?></p>
                <p class="m-b-0">Mobile: <?php echo $getOrdersData1['mobile']; ?></p>
              </div>
              <div class="col-sm-6">                
                <p><strong>Order Info</strong></p>
                <p>Order Id: <?php echo $getOrdersData1['order_id']; ?>
                  <br>Restaurant Name: <?php echo $getRestaurants['restaurant_name']; ?>
                  <br>Order Date: <?php echo dateFormat($getOrdersData1['created_at']); ?>
                  <br>Order Status : <?php echo $orderStatus['order_status']; ?> 
                  <br>Payment Status : <?php echo $paymentStatus['payment_status']; ?>
                  <br>Payment Method: <?php echo $getpaymentTypes['status']; ?>
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
                  <th>
                    Item Price
                  </th>
                  <th>
                    Item Total
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
                  <td><?php echo $getOrdersData2['item_price']; ?></td>
                  <td><?php echo $getOrdersData2['item_price']*$getOrdersData2['item_quantity']; ?></td>
                </tr>  
                <?php $i++; } ?>              
                <tr>
                  <td scope="row" colspan="6">
                    <div class="text-right">
                      Subtotal    
                      <?php if($getAddontotalCount > 0) { ?>
                      	<br> Ingredients Price:
                      <?php } ?>   
                      <?php if($getOrdersData1['delivery_charges'] != '0') { ?>
                      	<br>Delivery Charges:
                      <?php } ?>                       
                      <br> Service Tax<?php if($getOrdersData1['coupen_code'] != '') { ?>              
                      	<br> Discount
                      <?php } ?>
                      <br>
                      <strong>TOTAL</strong>
                    </div>
                  </td>
                  <td>
                    Rs .<?php echo $getOrdersData1['sub_total']; ?>
                    <?php if($getAddontotalCount > 0) { ?>
                    	<br>Rs. <?php echo $getAdstotal?>
                    <?php } ?>
                    <?php if($getOrdersData1['delivery_charges'] != '0') { ?>
                    	<br>Rs. <?php echo $delivery_charges?>
                    <?php } ?>
                    <br> Rs .<?php echo $service_tax; ?> ( <?php echo $getSiteSettingsData['service_tax']; ?> % )
                    <?php if($getOrdersData1['coupen_code'] != '') { ?>
                    	<br>Rs .Rs. <?php echo $getOrdersData1['discout_money']?>(<span style="color:green">Coupon Applied.</span>)
                    <?php } ?>                    
                    <br>
                    <strong>Rs .<?php echo $getOrdersData1['order_total']; ?></strong>
                  </td>
                </tr>
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
        2017 © Designed & Developed By Lancius IT Solutions
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