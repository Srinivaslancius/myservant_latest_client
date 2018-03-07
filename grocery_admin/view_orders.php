
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
	.modal-body{
		padding-left:15px !important;
	}
	</style>
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
        <?php include_once './main_header.php';?>
    </div>
    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
            <?php include_once './side_menu.php';?>
        </div>
      </div>
      <div class="site-right-sidebar">
        <?php include_once './right_slide_toggle.php';?>
      </div>
      <div class="site-content">
        <?php 
          $groceryOrders = "SELECT * FROM grocery_orders WHERE lkp_payment_status_id != 3 AND lkp_order_status_id != 3 GROUP BY order_id ORDER BY id DESC"; 
          $groceryOrdersData = $conn->query($groceryOrders);
          $i=1;
        ?>
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5 font_sz_view">View Orders</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <div class="col s12 m12 l12">                  
                <?php $sql = "SELECT * FROM grocery_orders WHERE lkp_payment_status_id != 3 AND lkp_order_status_id != 3 GROUP BY email"; $getUsersData1 = $conn->query($sql);?>
                  <div class="form-group col-md-3">                    
                    <select id="select-email" class="custom-select">
                       <option value="">Select email</option>
                        <?php while ($row = $getUsersData1->fetch_assoc()) { ?>
                          <option value="<?php echo $row['email']; ?>"><?php echo $row['email']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="clear_fix"></div>
                <p id="date_filter">
                  <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                  <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
                </p>
                <div class="clear_fix"></div>
              <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Order Date</th>
                    <!-- <th>Delivery Date</th> -->
                    <th>Payment Option</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Delivery Boy</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $groceryOrdersData->fetch_assoc()) { ?> 
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="#" data-toggle="modal" data-target="#<?php echo $row['id']; ?>"><?php echo $row['order_id'];?></a></td>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['mobile'];?></td>
                        <td><?php echo dateFormat($row['created_at']);?></td>
                        <!-- <td><?php echo $row['delivery_date'];?></td> -->
                        <td><?php $getGroceryPaymentsTypes = getAllData('lkp_payment_types');
                         while($getPaymentsTypes = $getGroceryPaymentsTypes->fetch_assoc()) { if($row['payment_method'] == $getPaymentsTypes['id']) { echo $getPaymentsTypes['status']; } } ?></td>
                        <td><?php $getGroceryPaymentsStatus = getAllData('lkp_payment_status');
                         while($getPaymentsStatus = $getGroceryPaymentsStatus->fetch_assoc()) { if($row['lkp_payment_status_id'] == $getPaymentsStatus['id']) { echo $getPaymentsStatus['payment_status']; } } ?></td>
                         <td><?php $getGroceryOrderStatus = getAllData('lkp_order_status');
                         while($getOrderStatus = $getGroceryOrderStatus->fetch_assoc()) { if($row['lkp_order_status_id'] == $getOrderStatus['id']) { echo $getOrderStatus['order_status']; } } ?></td>
                        <?php if($row['assign_delivery_id'] == 0 || $row['assign_delivery_id'] == '') { ?>
                        <td><a href="assign_to.php?order_id=<?php echo $row['order_id']; ?>">Assign To</a></td>
                        <?php } else { 
                          $getDeliveryBoysNames = getAllDataWhere('grocery_delivery_boys','id',$row['assign_delivery_id']); $getDeliveryBoysNamesData = $getDeliveryBoysNames->fetch_assoc(); ?>
                          <td><a href="assign_to.php?order_id=<?php echo $row['order_id']; ?>"><?php if($getDeliveryBoysNamesData['id'] == $row['assign_delivery_id']) { echo $getDeliveryBoysNamesData['deliveryboy_name']; } ?>(Assigned)</a></td>
                          <?php }?>
                        <td><span><a href="invoice.php?order_id=<?php echo $row['order_id']; ?>" target="_blank"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a></span>&nbsp;<?php if($row['lkp_order_status_id'] == 2 && $row['lkp_payment_status_id'] == 1) {  } elseif($row['assign_delivery_id'] > 0) { ?> <a href="edit_orders.php?order_id=<?php echo $row['order_id']; ?>"><i class="zmdi zmdi-edit"></i></a><?php } ?> </td>

                        <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">
                            <i class="zmdi zmdi-close"></i>
                          </span>
                        </button>
                          <h4 class="modal-title">Order Details (Order Id: <?php echo $row['order_id'];?>)<span><a href="#"><i class="zmdi zmdi-print zmdi-hc-fw" style="color: #fff;"></i></a></span></h4>
                      </div>
                      <div class="modal-body">
                        <div class="col-md-12 fr1">
						
                           <div class="col-md-8">
                               <h3 class="m-t-0 m-b-5 font_sz_view"><b>User Details</b></h3><br>
                               <p>Name : <?php echo $row['first_name'];?></p>
                               <p>Email : <?php echo $row['email'];?></p>
                               <p>Mobile Number: <?php echo $row['mobile'];?></p>
                               <p>Order Date: <?php echo dateFormat($row['created_at']);?></p>
                           </div>
						 
                            <div class="col-md-4">
                              <h3 class="m-t-0 m-b-5 font_sz_view"><b>Delivery Details</b></h3><br>
                              <p>Delivery Date: <?php echo changeDateFormat($row['delivery_slot_date']);?></p>
                              <p>Delivery Time: <?php echo $row['delivery_time'];?></p>
                              <p>Mode of Payment : <?php $getGroceryPaymentsTypes = getAllData('lkp_payment_types');
                              while($getPaymentsTypes = $getGroceryPaymentsTypes->fetch_assoc()) { if($row['payment_method'] == $getPaymentsTypes['id']) { echo $getPaymentsTypes['status']; } } ?></p>
                              <p>Payment Status : <?php $getGroceryPaymentsStatus = getAllData('lkp_payment_status');
                              while($getPaymentsStatus = $getGroceryPaymentsStatus->fetch_assoc()) { if($row['lkp_payment_status_id'] == $getPaymentsStatus['id']) { echo $getPaymentsStatus['payment_status']; } } ?></p>
                              <p>Order Status : <?php $getGroceryOrderStatus = getAllData('lkp_order_status');
                              while($getOrderStatus = $getGroceryOrderStatus->fetch_assoc()) { if($row['lkp_order_status_id'] == $getOrderStatus['id']) { echo $getOrderStatus['order_status']; } } ?></p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Address:</strong></p>
                               <p><?php echo $row['address'];  ?></p>
                            </div>
                        </div>
                        <?php if($row['assign_delivery_id'] == '0' || $row['assign_delivery_id'] == '') { 
                          $deliveryboy_name = '-';
                          $deliveryboy_mobile = '-';
                        } else { 
                          $deliveryBoyDetails = getIndividualDetails('grocery_delivery_boys','id',$row['assign_delivery_id']);
                          $deliveryboy_name = $deliveryBoyDetails['deliveryboy_name'];
                          $deliveryboy_mobile = $deliveryBoyDetails['deliveryboy_mobile'];
                        } ?>
                        <div class="col-md-12 fr1 mt5">
                            <h3 class="m-t-0 m-b-5 font_sz_view"><b>Delivery Boy Details</b></h3><br>
                            <p class="col-md-8">Name: <?php echo $deliveryboy_name;  ?></p>
                            <p class="col-md-4">Mobile Number: <?php echo $deliveryboy_mobile;  ?></p>
                        </div>
                          <div class="col-md-12 fr1 mt5">
                              <h3 class="m-t-0 m-b-5 font_sz_view"><b>Ordered Items</b></h3>
                          </div>
                          <?php 
                          $groceryOrders1 = "SELECT * FROM grocery_orders WHERE lkp_payment_status_id != 3 AND lkp_order_status_id != 3 AND order_id = '".$row['order_id']."'"; 
                          $groceryOrdersData1 = $conn->query($groceryOrders1); ?>
                          <?php while($OrderDetails = $groceryOrdersData1->fetch_assoc()) { 
                          $getProducts = getIndividualDetails('grocery_product_name_bind_languages','product_id',$OrderDetails['product_id']);
                          $getProducts1 = getIndividualDetails('grocery_product_bind_images','product_id',$OrderDetails['product_id']);

                          $getProductsWeights = getIndividualDetails('grocery_product_bind_weight_prices','id',$OrderDetails['item_weight_type_id']);

                          ?>
                          <div class="col-md-12 fr1 padd0">
                              <div class="col-md-12 mt5 padd0">
                                  <div class="col-md-2 mb5">
                                      <img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProducts1['image'] ?>" width="100px" height="100px">
                                  </div>
                                  <div class="col-md-10">
                                      <p><b>Product Name: </b> <?php echo $getProducts['product_name'] ?></p>
                                      <p><b>Product Weight: </b> <?php echo $getProductsWeights['weight_type'];  ?></p>
                                      <p><b>Quantity: </b> <?php echo $OrderDetails['item_quantity'];  ?></p>
                                      <p><b>Price: </b> Rs. <?php echo $OrderDetails['item_price'];  ?></p>
                                  </div>
                                  <!--<div class="col-md-4">
                                      <p>Sub Total: Rs. <?php echo $OrderDetails['item_quantity']*$OrderDetails['item_price'];  ?></p>
                                  </div>-->
                              </div>
                          </div>
                          <?php } ?>
                      </div>
                      <?php $getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1); ?>
                      <div class="modal-footer" style="text-align:left">
					  
                          <div class="col-md-12">
                              <div class="col-md-9"></div>
                              <div class="col-md-3"><br>
                                  <p><b>Sub Total: </b> Rs. <?php echo $row['sub_total'];  ?></p>
                                  <p><b>GST: </b> Rs. <?php echo $row['service_tax'].'('.$getSiteSettingsData['service_tax'].'%)' ?></p>
                                  <p><b>Delivery Charges: </b> Rs. <?php echo $row['delivery_charges'];  ?></p>
                                  <?php if($row['discout_money'] != 0) { ?>
                                  <p><b>Discount Amount: </b> Rs. <?php echo $row['discout_money'];  ?></p>
                                  <?php } ?>
                                  <h3 class="m-t-0 m-b-5 font_sz_view">Total Amount: Rs. <?php echo $row['order_total'];  ?></h3>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                    </tr>
                  <?php  $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/forms-plugins.min.js"></script>
    <!-- <script src="js/tables-datatables.min.js"></script> -->
    <script type="text/javascript">
      var table =  $('#table-2').DataTable({
        dom:"Bfrtip",buttons:["copy","excel","csv","pdf","print"]
    });

    $('#select-email').on('change', function () {
        table.columns(3).search( this.value ).draw();
    } );
      //Date picker for filters
    $("#datepicker_from").datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: false,
      "onSelect": function(date) {
        minDateFilter = new Date(date).getTime();
        table.draw();
      }
    }).keyup(function() {
      minDateFilter = new Date(this.value).getTime();
      table.draw();
    });

    $("#datepicker_to").datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: false,
      "onSelect": function(date) {
        maxDateFilter = new Date(date).getTime();
        table.draw();
      }
    }).keyup(function() {
      maxDateFilter = new Date(this.value).getTime();
      table.draw();
    });
    // Date range filter
      minDateFilter = "";
      maxDateFilter = "";

      $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
          if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[5]).getTime();
          }

          if (minDateFilter && !isNaN(minDateFilter)) {
            if (aData._date < minDateFilter) {
              return false;
            }
          }

          if (maxDateFilter && !isNaN(maxDateFilter)) {
            if (aData._date > maxDateFilter) {
              return false;
            }
          }

          return true;
        }
      );

    // End  Date range filter
    //End here
    </script>
  </body>
</html>