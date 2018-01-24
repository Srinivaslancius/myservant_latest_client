<?php include_once 'admin_includes/main_header.php'; error_reporting(0);?>
<?php $getServiceProviderRegistrations = getAllDataWithActiveRecent('service_provider_registration'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_service_provider_registration.php" style="float:right">Add Service Provider Registration</a>
            <h3 class="m-t-0 m-b-5">Service Provider Registration</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Created Date</th>
                    <th>Service Provide Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getServiceProviderRegistrations->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['mobile_number'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                    <td><?php $getServiceProviderTypes = getAllDataWithStatus('service_provider_types','0'); while($getServiceProviderTypes1 = $getServiceProviderTypes->fetch_assoc()) { if($row['service_provider_type_id'] == $getServiceProviderTypes1['id']) { echo $getServiceProviderTypes1['service_provider_type']; } } ?></td>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='service_provider_registration'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='service_provider_registration'>In Active</span>" ;} ?></td>
                    <td> <a href="edit_service_provider_registration.php?registrationid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <a href="delete_service_provider_registration.php?registrationid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> &nbsp;<a href="#"><i class="zmdi zmdi-eye zmdi-hc-fw" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class=""></i></a></td>
                     <!-- Open Modal Box  here -->
                    <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content animated flipInX">
                          <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                              </span>
                            </button>
                            <center><h4 class="modal-title">Service Provider Information</h4></center>
                          </div>
                          <div class="modal-body" id="modal_body">
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Name:</div>
                              <div class="col-sm-6"><?php echo $row['name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Email:</div>
                              <div class="col-sm-6"><?php echo $row['email'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Mobile:</div>
                              <div class="col-sm-6"><?php echo $row['mobile_number'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Address:</div>
                              <div class="col-sm-6"><?php echo $row['address'];?></div>
                            </div>
                            <div class="row">
                              <?php $getServiceProviderTypes = getAllDataWithStatus('service_provider_types','0'); ?>
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Category Name:</div>
                              <div class="col-sm-6"><?php while($getServiceProviderTypes1 = $getServiceProviderTypes->fetch_assoc()) { if($row['service_provider_type_id'] == $getServiceProviderTypes1['id']) { echo $getServiceProviderTypes1['service_provider_type']; } } ?></div>
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