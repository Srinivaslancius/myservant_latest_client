<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>MYSERVANT</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
	<style>
	.site-footer{
		margin:0 auto;
	}
	.layout{
		padding-top:0px;
	}
	.site-content {
   padding: 60px 200px 65px 200px;
}
	</style>
  </head>

<?php
error_reporting(0);
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');

$order_id = $_GET['order_id'];

$getOrders = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
$getOrdersData = $conn->query($getOrders);
$getOrdersData1 = $getOrdersData->fetch_assoc();

$getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1);
$getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$getOrdersData1['payment_method']);
$orderStatus = getIndividualDetails('lkp_order_status','id',$getOrdersData1['lkp_order_status_id']);
$paymentStatus = getIndividualDetails('lkp_payment_status','id',$getOrdersData1['lkp_payment_status_id']);

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
  
    
    <div class="site-main">     
     
      <div class="site-content" style="margin:0 auto">
	  
        <div class="panel panel-default m-b-0">
          <div class="panel-heading">
           
          <img src="<?php echo $base_url . 'grocery_admin/uploads/logo/'.$getSiteSettingsData['logo'] ?>" class="logo-responsive" >
		   <center><h3 class="m-y-0">Invoice</h3></center>
          </div>
          <div class="panel-body">
            <div class="row m-b-30">
			
              <div class="col-sm-8">                
                <p><strong>Customer Address</strong></p>
                <p><?php echo $getOrdersData1['first_name']; ?>
                  <br><?php echo $getOrdersData1['email']; ?>
                  <br><?php echo $getOrdersData1['address']; ?>,<?php echo $getOrdersData1['postal_code']; ?></p>
                <p class="m-b-0">Mobile: <?php echo $getOrdersData1['mobile']; ?></p>
              </div>
			  
              <div class="col-sm-4">                
                <p><strong>Order Info</strong></p>
                <p>Order Id: <?php echo $getOrdersData1['order_id']; ?>
                  <br>Delivery Slot Date: <?php echo changeDateFormat($getOrdersData1['delivery_slot_date']);?>
                  <br>Delivery Slot Time: <?php echo $getOrdersData1['delivery_time'];?>
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
                    Product Name
                  </th>
                  <th>
                    Product Image
                  </th>
                  <th>
                    Product Weight
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
	              	$getOrders1 = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
					$getOrdersData3 = $conn->query($getOrders1);
					while($getOrdersData2 = $getOrdersData3->fetch_assoc()) {					
			      	$getProducts = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getOrdersData2['product_id']);
			      	$getItemWeights = getIndividualDetails('grocery_product_bind_weight_prices','id',$getOrdersData2['item_weight_type_id']);					
              $getProducts1 = getIndividualDetails('grocery_product_bind_images','product_id',$getOrdersData2['product_id']);
              	?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $getProducts['product_name'] ?></td>     
                  <td><img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProducts1['image'] ?>" width="70px" height="70px"></td>             
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
                        
                      <?php if($getOrdersData1['delivery_charges'] != '0') { ?>
                      	<br>Delivery Charges:
                      <?php } ?>                       
                      <br> Service Tax
                      <?php if($getOrdersData1['coupen_code'] != '') { ?>              
                      	<br> Discount
                      <?php } ?>
                      <br>
                      <strong>TOTAL</strong>
                    </div>
                  </td>
                  <td>
                    Rs .<?php echo $getOrdersData1['sub_total']; ?>
                    
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
      </div>
      <?php include_once 'footer.php'; ?>
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