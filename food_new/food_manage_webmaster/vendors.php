<?php include_once 'admin_includes/main_header.php'; ?>
<?php 
$getVendors = "SELECT * FROM food_vendors ORDER BY id DESC ";
$getVendorsData = $conn->query($getVendors);$i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_vendors.php" style="float:right">Add Vendors</a>
            <h3 class="m-t-0 m-b-5">Vendors</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Vendor Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Admin Comission</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getVendorsData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['vendor_name'];?></td>
                    <td><?php echo $row['vendor_email'];?></td>
                    <td><?php echo $row['vendor_mobile'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                    <?php if ($row['vendor_charges_approved']==1 || ($row['delivery_charges'] == '' && $row['admin_comission'] == '')) { ?>
                    <td>--</td>
                    <?php } else { ?>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='food_vendors'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='food_vendors'>In Active</span>" ;} ?>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if ($row['vendor_charges_approved']==1 || ($row['delivery_charges'] == '' && $row['admin_comission'] == '')) { ?>
                      <p data-toggle="modal" data-target="#<?php echo $row['id']; ?>_1" class="open_cursor">Pending</p>
                      <?php } else { ?>
                      <p>Approved</p>
                      <?php } ?>

                    </td>
                    <td><a href="edit_vendors.php?bid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a>&nbsp;<a href="#"><i class="zmdi zmdi-eye zmdi-hc-fw" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class=""></i></a></td>
                    <!-- Open Modal Box  here -->

                     <div id="<?php echo $row['id']; ?>_1" class="modal fade" tabindex="-1" role="dialog">
                     
                      <div class="modal-dialog">
                        <div class="modal-content animated flipInX">
                          <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                              </span>
                            </button>
                            <center><h4 class="modal-title">Update Charges</h4></center>
                          </div>
                          <form method="POST" action="update_vendor_prices.php">

                          <input type="hidden" name="vid" value="<?php echo $row['id']; ?>">
                          <div class="modal-body" id="modal_body">

                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Delivery Charges:</div>
                              <div class="col-sm-6"><input type="text" name="delivery_charges" class="form-control valid_price_dec" id="form-control-2" placeholder="Delivery charges" data-error="Please enter Delivery charges" required></div>
                            </div>  <br /> 

                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Admin Comission (%) :</div>
                              <div class="col-sm-6"><input type="text" name="admin_comin" class="form-control valid_price_dec" id="form-control-2" placeholder="Admin Comission" data-error="Please enter Delivery charges" required></div>
                            </div>  <br /> 

                            <div class="row">
                              <div class="col-sm-6"></div>                              
                              <div class="col-sm-2"><button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button></div>
                            </div>

                          </div>
                          </form>
                          <div class="modal-footer">                           
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


                    <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content animated flipInX">
                          <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                              </span>
                            </button>
                            <center><h4 class="modal-title">Vendor Information</h4></center>
                          </div>
                          <div class="modal-body" id="modal_body">
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Vendor Name:</div>
                              <div class="col-sm-6"><?php echo $row['vendor_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Vendor Email:</div>
                              <div class="col-sm-6"><?php echo $row['vendor_email'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Vendor Mobile:</div>
                              <div class="col-sm-6"><?php echo $row['vendor_mobile'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Resturant Name:</div>
                              <div class="col-sm-6"><?php echo $row['restaurant_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Resturant Address:</div>
                              <div class="col-sm-6"><?php echo $row['restaurant_address'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Pincode:</div>
                              <div class="col-sm-6"><?php echo $row['pincode'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Meta Title:</div>
                              <div class="col-sm-6"><?php echo $row['meta_title'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Meta Keywords:</div>
                              <div class="col-sm-6"><?php echo $row['meta_keywords'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Meta Description:</div>
                              <div class="col-sm-6"><?php echo substr(strip_tags($row['meta_desc']), 0,150);?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Description:</div>

                              <div class="col-sm-6"><?php echo substr(strip_tags($row['description']), 0,150);?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Working Timings:</div>
                              <div class="col-sm-6"><?php echo $row['working_timings'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Minimum Delivery Time:</div>
                              <div class="col-sm-6"><?php echo $row['min_delivery_time'];?></div>
                            </div>
                            <?php $getState = getIndividualDetails('lkp_states','id',$row['lkp_state_id']);  ?>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">State:</div>
                              <div class="col-sm-6"><?php echo $getState['state_name']; ?></div>
                            </div>
                            <?php $getDistrict = getIndividualDetails('lkp_districts','id',$row['lkp_district_id']);  ?>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">District:</div>
                              <div class="col-sm-6"><?php echo $getDistrict['district_name']; ?></div>
                            </div>
                            <?php $getCity = getIndividualDetails('lkp_cities','id',$row['lkp_city_id']);  ?>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">City:</div>
                              <div class="col-sm-6"><?php echo $getCity['city_name']; ?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Location:</div>
                              <div class="col-sm-6"><?php echo $row['location'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Status:</div>
                              <div class="col-sm-6"><?php if($row['lkp_status_id'] == 0 ){ echo "Active";} else{ echo "InActive";}?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Logo:</div>
                              <div class="col-sm-6"><img src="<?php echo $base_url . 'uploads/food_vendor_logo/'.$row['logo'] ?>" height="100" width="100"/></div>
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