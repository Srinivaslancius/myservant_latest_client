 <!DOCTYPE html>
<html style="overflow-x:hidden">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">

		
    
    <!-- SPECIFIC CSS -->
    <link href="layerslider/css/layerslider.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<style>
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom:0px;
	color:#fe6003;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
   border-top: 1px solid #ddd;
}
.button1 {
    background-color: #fe6003;
    border-color: #fe6003;
    color: white;
    padding: 4px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;
}

.button2 {
	background-color:#fe6003;
 padding: 5px 12px;
} 
h3,h5{
	color:#fe6003;
}
</style>
</head>
<body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

    <!-- Header ================================================== -->
    <header>
	  <?php include_once './header.php';?>
        </header>
    <!-- End Header =============================================== -->
<?php $getAllAboutData = getAllDataWhere('food_content_pages','id',6);
          $getAboutData = $getAllAboutData->fetch_assoc();
?>
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
    	<div id="sub_content">
    	 <h1>My Account</h1>
         <p></p>
        </div><!-- End sub_content -->
	</div><!-- End subheader -->
</section><!-- End section -->
    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="grocery_orders1.php">Grocery Orders</a></li>
                <li>Order Details</li>
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
	<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <div class="theiaStickySidebar">
        <div class="box_style_1" id="faq_box">
				  <?php include_once 'dashboard_strip.php';?>
		</div><!-- End box_style_1 -->
        </div><!-- End theiaStickySidebar -->
     </div><!-- End col-md-3 -->
        
        <div class="col-md-9 col-sm-9">      	 
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">Food Orders</h3>
                    </div>
                      <div class="panel-body">
                     <div class="table-responsive">	
								 <?php $order_id = $_GET['order_id'];
          //echo "<script>alert('$order_id')</script>";
              
    $groceryOrders1 = "SELECT * FROM grocery_orders WHERE  order_id = '$order_id' "; 
    $groceryOrdersData1 = $conn->query($groceryOrders1);
    $i=1; 
    $OrderDetails = $groceryOrdersData1->fetch_assoc();
    $getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1);

    $getProducts = getIndividualDetails('grocery_product_name_bind_languages','product_id',$OrderDetails['product_id']);

    $getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$OrderDetails['payment_method']);

    $orderStatus = getIndividualDetails('lkp_order_status','id',$OrderDetails['lkp_order_status_id']);

    $service_tax = $OrderDetails['sub_total']*$getSiteSettingsData['service_tax']/100;

if($OrderDetails['delivery_charges'] == '0') {
  $order_type = "Take Away";
  $delivery_charges = 0;
} else {
  $order_type = "Delivery";
  $delivery_charges = $OrderDetails['delivery_charges'];
}
                          ?>
        			<table class="table" style="border:1px solid #ddd;width:100%">
            		<tbody>
		  <tr>
			<td colspan="2" style="padding-left:20px">
			<h3>Order Information</h3>
			<p>Item Name: <?php echo $getProducts['product_name'] ?></p>
      <p>Payment Method:<?php echo $getpaymentTypes['status']; ?></p>
      <p>Order Type:<?php echo $order_type; ?></p>
      <p>Order Status: <?php echo $orderStatus['order_status']; ?></p>
      <p>Payment Status: InProgress</p></td>
			<td colspan="2"></td>
			<td colspan="2">
			<h3>Shipping Address</h3>
			<p><?php echo $OrderDetails['first_name']; ?></p>
          <p><?php echo $OrderDetails['email']; ?></p>
          <p><?php echo $OrderDetails['mobile']; ?></p>
          <p><?php echo $OrderDetails['address']; ?></p>
          <p><?php echo $OrderDetails['postal_code']; ?></p></td>
		  <td></td>
		  <td></td>
		  </tr>
      <?php $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
    $getOrdersData3 = $conn->query($getOrders1); ?>
		  <tr>
			<td colspan="2"><h5>ITEM NAME</h5></td>
      <td colspan="2"><h5>CATEGORY</h5></td>
      <td><h5>QUANTITY</h5></td>
      <td><h5>PRICE</h5></td>
      <td></td>
      <td></td>
		  </tr>
      <?php $getOrders1 = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
          $getOrdersData3 = $conn->query($getOrders1); ?>
      <?php while($getOrdersData2 = $getOrdersData3->fetch_assoc()) { 
        $getCategories = getIndividualDetails('grocery_category','id',$getOrdersData2['category_id']);
        $getProducts1 = getIndividualDetails('grocery_products','id',$getOrdersData2['product_id']);
        $getItemWeights = getIndividualDetails('food_product_weights','id',$getOrdersData2['item_weight_type_id']);
        ?>
		   <tr>
      <td colspan="2"><p><?php echo $getProducts['product_name'] ?></p></td>
      <td colspan="2"><p><?php echo  $getCategories['category_name']?></p></td>
      <td><p><?php echo $getOrdersData2['item_quantity'] ?></p></td>
      <td><p><?php echo $getOrdersData2['item_price'] ?></p></td>
      <td></td>
      <td></td>
      </tr>
      <?php  } ?>
	<tr style="background-color:#f2f2f2">
      <td colspan="5"></td>
      <td><p>Subtotal:</p>
      <p>Tax:</p>
      <p>Delivery Charges</p>
      <p style="color:#fe6003;">Grand Total:</p></td>
      <td><p style="color:#fe6003;">Rs. <?php echo $OrderDetails['sub_total'];  ?></p>

      <p style="color:#fe6003;">Rs. <?php echo $OrderDetails['service_tax'].'('.$getSiteSettingsData['service_tax'].'%)' ?></p>
      <p style="color:#fe6003;">Rs. <?php echo $OrderDetails['delivery_charges'];  ?></p>
      <?php $total_price = round($OrderDetails['sub_total'] + $OrderDetails['delivery_charges'] + $OrderDetails['service_tax']); ?>
        <p style="color:#fe6003;"><?php echo $total_price;  ?></p></td>
		<td></td>
      </tr>
		</tbody>
					
        	</table>    
				
        	  </div>
                      </div>
                  </div>
                  
                </div><!-- End panel-group -->
                
            
        </div><!-- End col-md-9 -->
    </div><!-- End row -->
</div><!-- End container -->
</div>
<!-- End Content =============================================== -->

<div class="high_light">
       <?php include_once 'view_restaurants.php'; ?>
      </div>
	  
	  <!-- Footer ================================================== -->
	<footer>
         <?php include_once 'footer.php'; ?>
		 </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   

	<!-- End Search Menu -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>


</body>

</html>