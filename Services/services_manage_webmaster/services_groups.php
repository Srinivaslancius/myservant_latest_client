<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getGroupsData = getAllDataWithActiveRecent('services_groups'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_services_groups.php" style="float:right">Add Groups</a>
            <h3 class="m-t-0 m-b-5">Groups</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Group Name</th>
                    <th>Meta Title</th>
                    <th>Meta Keywords</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getGroupsData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php $getServicesCategories = getAllData('services_category'); while($getServicesCategories1 = $getServicesCategories->fetch_assoc()) { if($row['services_category_id'] == $getServicesCategories1['id']) { echo $getServicesCategories1['category_name']; } } ?></td>
                    <td><?php $getServicesSubCategories = getAllData('services_sub_category'); while($getServicesSubCategories1 = $getServicesSubCategories->fetch_assoc()) { if($row['services_sub_category_id'] == $getServicesSubCategories1['id']) { echo $getServicesSubCategories1['sub_category_name']; } } ?></td>
                    <td><?php echo $row['group_name'];?></td>
                    <td><?php echo $row['meta_title'];?></td>
                    <td><?php echo $row['meta_keywords'];?></td>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='services_groups'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='services_groups'>In Active</span>" ;} ?></td>
                    <td> <a href="edit_services_groups.php?gid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "services_groups";?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> &nbsp;
                    <!-- <a href="#"><i class="zmdi zmdi-eye zmdi-hc-fw" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class=""></i></a> --></td>
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
                            <center><h4 class="modal-title">Group Information</h4></center>
                          </div>
                          <div class="modal-body" id="modal_body">
                            <div class="row">
                              <?php $getServicesCategories = getAllData('services_category'); ?>
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Service Category Name:</div>
                              <div class="col-sm-6"><?php while($getServicesCategories1 = $getServicesCategories->fetch_assoc()) { if($row['services_category_id'] == $getServicesCategories1['id']) { echo $getServicesCategories1['category_name']; } } ?></div>
                            </div>
                            <div class="row">
                              <?php $getServicesSubCategories = getAllData('services_sub_category'); ?>
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Service Category Name:</div>
                              <div class="col-sm-6"><?php while($getServicesSubCategories1 = $getServicesSubCategories->fetch_assoc()) { if($row['services_sub_category_id'] == $getServicesSubCategories1['id']) { echo $getServicesSubCategories1['sub_category_name']; } } ?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Group Name:</div>
                              <div class="col-sm-6"><?php echo $row['group_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Group Description:</div>
                              <div class="col-sm-6"><?php echo $row['group_description'];?></div>
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
                              <div class="col-sm-6"><?php echo $row['meta_desc'];?></div>
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