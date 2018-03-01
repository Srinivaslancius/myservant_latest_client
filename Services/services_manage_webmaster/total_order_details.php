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

$id = $_GET['order_id'];
$getOrders = "SELECT * FROM services_orders WHERE order_id='$id'";
$getOrdersData = $conn->query($getOrders);
$getOrdersData1 = $getOrdersData->fetch_assoc();
$getPaymentMethod = getAllDataWhere('lkp_payment_types','id',$getOrdersData1['payment_method']); 
$getPaymentMethodData = $getPaymentMethod->fetch_assoc();
$getSiteSettingsData = getIndividualDetails('services_site_settings','id',1);

//below condition for check service type prices fixed or variant for payment gateway display
$getPriceType = "SELECT * FROM services_orders WHERE service_price_type_id=2 AND order_id='$id' ";
$getCount = $conn->query($getPriceType);

if($getCount->num_rows == 0) {
$service_tax = $getOrdersData1['sub_total']*$getSiteSettingsData['service_tax']/100;
} else {
	$service_tax = 0;
}

if($getOrdersData1['discount_money'] != 0) {
$discount_money = $getOrdersData1['discount_money'].'(<span style="color:green">Coupon Applied Successfully.</span>)';
} else {
	$discount_money = 0;
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
                <p><strong>Customer Address</strong></p>
                <p><?php echo $getOrdersData1['first_name']; ?>
                  <br><?php echo $getOrdersData1['email']; ?>
                  <br><?php echo $getOrdersData1['address']; ?>,<?php echo $getOrdersData1['postal_code']; ?></p>
                <p class="m-b-0">Mobile: <?php echo $getOrdersData1['mobile']; ?></p>
              </div>
              <div class="col-sm-6">                
                <p><strong>Order Info</strong></p>
                <p>Order Id: <?php echo $getOrdersData1['order_id']; ?>
                  <br>Order Date:<?php echo $getOrdersData1['created_at']; ?>
                  <br>Payment Mode :<?php echo $getPaymentMethodData['status']; ?></p>               
              </div>
            </div>
            <table class="table table-bordered m-b-30">
              <thead>
                <tr>
                  <th>
                    S.No
                  </th>
                  <th>
                    Service Name
                  </th>
                  <th>
                    Service Price
                  </th>
                  <th>
                    Quantity
                  </th>                
                  <th>
                    Selected Date
                  </th>
                  <th>
                    Selected Time
                  </th>
                  <th>
                    Service Total
                  </th>
                </tr>
              </thead>

              <tbody>
              	<?php 
              		$i=1;
	              	$getOrders1 = "SELECT * FROM services_orders WHERE order_id='$id'";
					$getOrdersData3 = $conn->query($getOrders1);
					while($getOrdersData2 = $getOrdersData3->fetch_assoc()) {
					$getServiceNames = getAllDataWhere('services_group_service_names','id',$getOrdersData2['service_id']); 
					$getServiceNamesData = $getServiceNames->fetch_assoc();
              	?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo wordwrap($getServiceNamesData['group_service_name'],20,"<br>\n",TRUE); ?></td>
                  <td><?php echo wordwrap($getOrdersData2['service_price'],22,"<br>\n",TRUE); ?></td>
                  <td><?php echo $getOrdersData2['service_quantity']; ?></td>
                  <td><?php echo $getOrdersData2['service_selected_date']; ?></td>                  
                  <td><?php echo $getOrdersData2['service_selected_time']; ?></td>
                  <td><?php echo $getOrdersData2['order_price']; ?></td>
                </tr>  
                <?php $i++; } ?>              
                <tr>
                  <td scope="row" colspan="6">
                    <div class="text-right">
                      Subtotal                      
                      <br> Discount
                      <br> Service Tax
                      <br>
                      <strong>TOTAL</strong>
                    </div>
                  </td>
                  <td>
                    Rs .<?php echo $getOrdersData1['sub_total']; ?>
                    <br>Rs .<?php echo $discount_money; ?>
                    <br> Rs .<?php echo $service_tax; ?> ( <?php echo $getSiteSettingsData['service_tax']; ?> % )
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
      <?php include_once 'admin_includes/footer.php'; ?>
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