<?php include_once 'admin_includes/main_header.php';?>
<?php //$getServiceOrderData = getAllData('services_orders'); $i=1; ?>
<?php 
    $order_id = $_GET['order_id'];
    $serviceOrders = "SELECT * FROM services_orders WHERE order_id ='$order_id' "; 
    $getServiceOrderData = $conn->query($serviceOrders);
    $i=1;
?>
              <?php 
              $sql ="SELECT * FROM services_orders WHERE order_id ='$order_id'";
              $sql1 = $conn->query($sql);
              $sql2 = $sql1->fetch_assoc();
              ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-9">
              <h3 class="m-t-0 m-b-5">View Orders</h3>
              </div>
          <div class="col-sm-3">
            <p style="font-size:13px;">Order Id:<span style="color:#f26226;font-size:15px;">  <?php echo $sql2['order_id'];?></span><br>Address:<span style="color:#f26226;;font-size:15px;">  <?php echo $sql2['address'];?></span><br>Email: <span style="color:#f26226;;font-size:15px;">  <?php echo $sql2['email'];?></span></p>
          </div>
          </div>
          </div>
          
          
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Sub Order ID</th>                    
                    <th>Service Name</th>
                    <th>Service Price</th>                    
                    <td>Status</td>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServiceOrderData->fetch_assoc()) { ?>
                  <?php $getServicenamesData = getAllDataWhereWithActive('services_group_service_names','id',$row['service_id']); 
                  $getServicenames = $getServicenamesData->fetch_assoc();?>                  
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['order_sub_id'];?></td>                    
                    <td><?php echo $getServicenames['group_service_name'];?></td>
                    <td><?php echo $row['service_price'];?></td>                   
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='services_orders'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='services_orders'>In Active</span>" ;} ?></td>
                    <td> <a href="edit_services_orders.php?order_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp;<a href="view_order.php"><i class="zmdi zmdi-eye zmdi-hc-fw"  class=""></i></a></td>
                    <!-- Open Modal Box  here -->
                    <?php $getGroupsData = getAllDataWhereWithActive('services_groups','id',$row['group_id']); 
                    $getGroups = $getGroupsData->fetch_assoc();
                    $getCountriesData = getAllDataWhereWithActive('lkp_countries','id',$row['country']); 
                    $getCountries = $getCountriesData->fetch_assoc();
                    $getCitiesData = getAllDataWhereWithActive('lkp_cities','id',$row['city']); 
                    $getCities = $getCitiesData->fetch_assoc();?>
                    <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content animated flipInX">
                          <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                              </span>
                            </button>
                            <center><h4 class="modal-title">Order Information</h4></center>
                          </div>
                          <div class="modal-body" id="modal_body">
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Name:</div>
                              <div class="col-sm-6"><?php echo $row['first_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Last Name:</div>
                              <div class="col-sm-6"><?php echo $row['last_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Company Name:</div>
                              <div class="col-sm-6"><?php echo $row['company_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Email:</div>
                              <div class="col-sm-6"><?php echo $row['email'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Mobile:</div>
                              <div class="col-sm-6"><?php echo $row['mobile'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Address:</div>
                              <div class="col-sm-6"><?php echo $row['address'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Country:</div>
                              <div class="col-sm-6"><?php echo $getCountries['country_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Postal Code:</div>
                              <div class="col-sm-6"><?php echo $row['postal_code'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">City:</div>
                              <div class="col-sm-6"><?php echo $getCities['city_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Order Note:</div>
                              <div class="col-sm-6"><?php echo $row['order_note'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Group Name:</div>
                              <div class="col-sm-6"><?php echo $getGroups['group_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Service Name:</div>
                              <div class="col-sm-6"><?php echo $getServicenames['group_service_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Service Price:</div>
                              <div class="col-sm-6"><?php echo $row['service_price'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Selected Date:</div>
                              <div class="col-sm-6"><?php echo $row['service_selected_date'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Selected Time:</div>
                              <div class="col-sm-6"><?php echo $row['service_selected_time'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Sub Total:</div>
                              <div class="col-sm-6"><?php echo $row['sub_total'];?></div>
                            </div>
                            <?php if($row['coupon_code'] != '') { ?>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Coupon Code:</div>
                              <div class="col-sm-6"><?php echo $row['coupon_code'];?></div>
                            </div>
                            <?php } ?>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Order Total:</div>
                              <div class="col-sm-6"><?php echo $row['order_total'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Payment Method:</div>
                              <div class="col-sm-6"><?php echo $row['payment_method'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Created Date:</div>
                              <div class="col-sm-6"><?php echo $row['created_at'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Order ID</div>
                              <div class="col-sm-6"><?php echo $row['order_id'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Status:</div>
                              <div class="col-sm-6"><?php if($row['lkp_status_id'] == 0 ){ echo "Active";} else{ echo "InActive";}?></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-success">Close</button>
                            <style>
                              #modal_body{
                                font-size:14px;
                                padding-top:30px;
                                padding-left: 0px;
                                font-family:Roboto,sans-serif;
                              }
                            </style>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Box  here -->
                  </tr>
                  <?php  $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>