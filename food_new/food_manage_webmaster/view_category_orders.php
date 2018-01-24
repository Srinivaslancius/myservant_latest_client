<?php include_once 'admin_includes/main_header.php';
$order_id = $_GET['order_id'];
    $FoodOrders = "SELECT * FROM food_orders WHERE order_id = '$order_id' GROUP BY category_id ORDER BY id DESC"; 
    $getFoodOrderData = $conn->query($FoodOrders);
    $i=1;
?>
     <div class="site-content">
        <div class="row">
          <div class="col-md-12">
            <?php  while ($row = $getFoodOrderData->fetch_assoc()) { ?>
            <div class="panel-group" id="<?php echo $row['category_id']; ?>" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#<?php echo $row['category_id']; ?>" href="#accordion-<?php echo $row['category_id']; ?>" aria-expanded="true">
                      <i class="zmdi zmdi-chevron-down"></i> <?php $getCatname = getIndividualDetails('food_category','id',$row['category_id']); echo $getCatname['category_name']; ?>
                    </a>
                  </h4>
                </div>
                <div id="accordion-<?php echo $row['category_id']; ?>" class="panel-collapse collapse <?php if($i==1){ echo "in"; } ?>" role="tabpanel">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered dataTable" id="table-3">
                        <thead>
                          <tr>
                            <th>Cart Id</th>                           
                            <!-- <th>User Name</th> -->
                            <th>Food Name</th>
                            <th>Order Price</th> 
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Order Date</th>
                            <th>Assign To</th>
                            <th>Order Created</th>                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $category_id = $row['category_id']; 
                                $getServiceOrders1 = "SELECT * FROM food_orders WHERE order_id = '$order_id' AND category_id = '$category_id' AND lkp_payment_status_id != 3 AND lkp_order_status_id != 3 ORDER BY id DESC";
                            $getServiceOrders = $conn->query($getServiceOrders1); 
                          ?>
                            <?php while ($row = $getServiceOrders->fetch_assoc()) { ?>
                                <tr>
                                  <?php $getServicenames = getAllDataWhere('services_group_service_names','id',$row['order_id']); 
                                    $getServicenamesData = $getServicenames->fetch_assoc();?>
                                  <td><?php echo $row['order_sub_id'];?></a></td>
                                  <!-- <td><?php echo $row['first_name'] . $row['last_name'];?></td>-->
                                  <td><?php echo $getServicenamesData['group_service_name'];?></td>
                                   <td><?php echo $row['order_price'];?></td>
                                  <td><?php $orderStatus = getIndividualDetails('lkp_order_status','id',$row['lkp_order_status_id']); echo $orderStatus['order_status']; ?></td>
                                  <td><?php $orderPaymentStatus = getIndividualDetails('lkp_payment_status','id',$row['lkp_payment_status_id']); echo $orderPaymentStatus['payment_status']; ?></td>
                                  <td><?php echo $row['created_at'];?></td> 
                                  <?php if($row['assign_service_provider_id'] == '0') { ?>
                                 <td><a href="assign_to.php?assign_id=<?php echo $row['id']; ?>&subcat_id=<?php echo $row['sub_category_id'] ?>&order_id=<?php echo $row['order_id']; ?>&category_id=<?php echo $category_id ?>">Assign To</a></td>
                                 <?php } else { 
                                  $getServiceProviderNames = getAllDataWhere('service_provider_registration','id',$row['assign_service_provider_id']); $getServiceProviderData = $getServiceProviderNames->fetch_assoc();
                                  ?>
                                 <td><a href="assign_to.php?assign_id=<?php echo $row['id']; ?>&subcat_id=<?php echo $row['sub_category_id'] ?>&order_id=<?php echo $row['order_id']; ?>&category_id=<?php echo $category_id ?>"><?php if($getServiceProviderData['id'] == $row['assign_service_provider_id']) { echo $getServiceProviderData['name']; } ?>(Assigned)</a></td>
                                 <?php } ?>
                                 <?php if($row['lkp_order_status_id'] == 2 && $row['lkp_payment_status_id'] == 1) { ?>
                                 <td><a href="../../uploads/generate_invoice/<?php echo $row['order_sub_id']; ?>.pdf" target="_blank"><i class="zmdi zmdi-local-printshop"></i></a></td>
                                 <?php } else { ?>
                                  <td><a href="edit_services_orders.php?id=<?php echo $row['id']; ?>&subcat_id=<?php echo $row['sub_category_id'] ?>&order_id=<?php echo $row['order_id']; ?>&category_id=<?php echo $category_id ?>"><i class="zmdi zmdi-edit"></i></a></td>
                                  <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                
                      </table>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
            <?php $i++; }  ?>
             
          </div>
          
        </div>
      </div>
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>