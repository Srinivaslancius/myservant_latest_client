<!DOCTYPE html>

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
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:20px;width:1000px;">         
  <table class="table" style="border:1px solid gray">
    <thead>
      <tr style="background-color:#f2f2f2">
        <th colspan="2"></th>
        <th colspan="2" style="padding-bottom:40px;padding-left:120px"><center><img src="<?php echo $base_url . 'uploads/food_logo/'.$getSiteSettingsData['logo'] ?>" class="logo-responsive" width="210px" height="100px;"></center></th>
		<th></th>
		<th colspan="2"><h3 style="color:#f26226">Invoice</h3>
		<p>Oreder Id:<?php echo $getOrdersData1['order_id']; ?></p>
		<p>Order Date:<?php echo $getOrdersData1['created_at']; ?></p>
		</th>	
      </tr>
    </thead>
    <tbody>
      <tr>     
        <td colspan="2"></td>
        <td colspan="2" style="padding-left:150px"><center><h4 style="color:#f26226">ORDER DETAILS</h4></center></td>
		<td colspan="3"></td>
      </tr>
      <tr  style="border-top:0px">
	  
       <td colspan="3"><p style="color:#f26226">Order Information</p>
		<p>Restaurant Name: <?php echo $getRestaurants['restaurant_name']; ?></p>
		<p>Payment Method: <?php echo $getpaymentTypes['status']; ?></p>
		<p>Order Type: <?php echo $order_type; ?></p>
		<p>Order Status: <?php echo $orderStatus['order_status']; ?></p>
		<p>Payment Status: <?php echo $paymentStatus['payment_status']; ?></p>
		</td>
		
        <td colspan="2"><p style="color:#f26226">Billing Address</p>
		<p><?php echo $getOrdersData1['first_name']; ?></p>
		<p><?php echo $getOrdersData1['email']; ?></p>
		<p><?php echo $getOrdersData1['mobile']; ?></p>
		<p><?php echo $getOrdersData1['address']; ?></p>
		<p><?php echo $getOrdersData1['postal_code']; ?></p>
		
		</td>
		
        <td colspan="2"><p style="color:#f26226">Shipping Address</p>
		<p><?php echo $getOrdersData1['first_name']; ?></p>
		<p><?php echo $getOrdersData1['email']; ?></p>
		<p><?php echo $getOrdersData1['mobile']; ?></p>
		<p><?php echo $getOrdersData1['address']; ?></p>
		<p><?php echo $getOrdersData1['postal_code']; ?></p></td>
		
      </tr>
      <?php $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
		$getOrdersData3 = $conn->query($getOrders1); ?>
      <tr style="color:#f26226">
        <td colspan="2">PRODUCT NAME</td>
        <td>CATEGORY NAME</td>
        <td>ITEM WEIGHT</td>
		<td>QUANTITY</td>
		<td>PRICE</td>
		<td></td>
      </tr>
      <?php while($getOrdersData2 = $getOrdersData3->fetch_assoc()) { 
      	$getCategories = getIndividualDetails('food_category','id',$getOrdersData2['category_id']);
      	$getProducts = getIndividualDetails('food_products','id',$getOrdersData2['product_id']);
      	$getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
      ?>
	   <tr>
        <td colspan="2"><?php echo $getProducts['product_name'] ?></td>
        <td><?php echo  $getCategories['category_name']?></td>
        <td><?php echo $getItemWeights['weight_type'] ?></td>
		<td><?php echo $getOrdersData2['item_quantity'] ?></td>
		<td><?php echo $getOrdersData2['item_price'] ?></td>
		<td></td>
      </tr>
      <?php  } ?>
	   <tr style="background-color:#f2f2f2">
        <td colspan="5"></td>
		<td>
		<p>Subtotal:</p>
		<p>Tax:</p>
		<?php if($getOrdersData1['delivery_charges'] != '0') { ?>
		<p>Delivery Charges:</p>
		<?php } ?>
		<?php if($getAddontotalCount > 0) { ?>
		<p>Ingredients Price:</p>
		<?php } ?>
		<?php if($getOrdersData1['coupen_code'] != '') { ?>
		<p>Discount:</p>
		<?php } ?>
		<p style="color:#f26226">Grand Total:</p>
		</td>
		<td style="color:#f26226"><p>Rs. <?php echo $getOrdersData1['sub_total']?></p>
		<p>Rs. <?php echo $service_tax.'('.$getSiteSettingsData['service_tax'].'%)' ?></p>
		<?php if($getOrdersData1['delivery_charges'] != '0') { ?>
		<p>Rs. <?php echo $delivery_charges?></p>
		<?php } ?>
		<?php if($getAddontotalCount > 0) { ?>
		<p>Rs. <?php echo $getAdstotal?></p>
		<?php } ?>
		<?php if($getOrdersData1['coupen_code'] != '') { ?>
		<p>Rs. <?php echo $getOrdersData1['discout_money']?>(<span style="color:green">Coupon Applied.</span>)</p>
		<?php } ?>
		<p>Rs. <?php echo $getOrdersData1['order_total']?></p></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
