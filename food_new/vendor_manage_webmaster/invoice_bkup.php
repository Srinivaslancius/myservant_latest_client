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
        <th colspan="2" style="padding-bottom:40px;padding-left:120px"><center><img src="<?php echo $base_url . 'uploads/logo/'.$getSiteSettingsData['logo'] ?>" class="logo-responsive" width="210px" height="100px;"></center></th>
		<th></th>
		<th colspan="2"><h3 style="color:#f26226">Invoice</h3>
		<p>Oreder Id:<?php echo $getOrdersData1['order_id']; ?></p>
		<p>Order Date:<?php echo $getOrdersData1['created_at']; ?></p>
		</th>	
      </tr>
    </thead>
    <tbody>
      <?php $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
		$getOrdersData3 = $conn->query($getOrders1); ?>
      <tr style="color:#f26226">
        <td colspan="2">PRODUCT NAME</td>
        <td>CATEGORY NAME</td>
        <td>ITEM WEIGHT</td>
		<td>QUANTITY</td>
		<td></td>
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
		<td></td>
		<td></td>
      </tr>
      <?php  } ?>
    </tbody>
  </table>
</div>

</body>
</html>
