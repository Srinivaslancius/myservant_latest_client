<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getAdminUsers = "SELECT * FROM admin_users WHERE lkp_admin_service_type_id = 1 ORDER BY lkp_status_id,id DESC";
$getAdminUsersData = $conn->query($getAdminUsers); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_admin_users.php" style="float:right">Add Admin User</a>
            <h3 class="m-t-0 m-b-5">Admin Users</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <div class="clear_fix"></div>

                <div class="form-group col-md-4">
                  <div class="custom-controls-stacked checkbox_new_div">
                    <label class="custom-control custom-control-primary custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="test5" name="type" onchange="filterme()" value="Active">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-label" for="test5">Active Users</span>
                    </label>
                    <label class="custom-control custom-control-primary custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="test6" name="type" onchange="filterme()" value="In Active">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-label" for="test6">In Active Users</span>
                    </label>
                  </div>
                </div>
                <div class="clear_fix"></div>
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Admin Name</th>
                    <th>Admin Email</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getAdminUsersData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['admin_name'];?></td>
                    <td><?php echo $row['admin_email'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                   <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='admin_users'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='admin_users'>In Active</span>" ;} ?></td>
                   <td> <a href="edit_admin_users.php?uid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "admin_users";?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> &nbsp;<a href="#"><i class="zmdi zmdi-eye zmdi-hc-fw" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class=""></i></a></td>
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
                            <center><h4 class="modal-title">Admin User Information</h4></center>
                          </div>
                          <div class="modal-body" id="modal_body">
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Name:</div>
                              <div class="col-sm-6"><?php echo $row['admin_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Email:</div>
                              <div class="col-sm-6"><?php echo $row['admin_email'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Date:</div>
                              <div class="col-sm-6"><?php echo $row['created_at'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Admin Service Type:</div>
                              <div class="col-sm-6"><?php $adminServiceTypes = getIndividualDetails('lkp_admin_service_types','id',$row['lkp_admin_service_type_id']); echo $adminServiceTypes['admin_service_type']; ?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Admin User Type:</div>
                              <div class="col-sm-6"><?php $adminUserTypes = getIndividualDetails('lkp_admin_user_types','id',$row['lkp_admin_user_type_id']); echo $adminUserTypes['admin_type']; ?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Status:</div>
                              <div class="col-sm-6"><?php $getStatus = getIndividualDetails('lkp_status','id',$row['lkp_status_id']); echo $getStatus['status']; ?></div>
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