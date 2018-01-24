<?php include_once 'admin_includes/main_header.php'; error_reporting(0);?>
<?php $getGroupServiceNames = getAllDataWithActiveRecent('services_group_service_names'); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_services_group_service_names.php" style="float:right">Add Service Names</a>
            <h3 class="m-t-0 m-b-5">Service Names</h3>
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
                    <th>Group Service Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getGroupServiceNames->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php $getServicesCategories = getAllData('services_category'); while($getServicesCategories1 = $getServicesCategories->fetch_assoc()) { if($row['services_category_id'] == $getServicesCategories1['id']) { echo $getServicesCategories1['category_name']; } } ?></td>
                    <td><?php $getServicesSubCategories = getAllData('services_sub_category'); while($getServicesSubCategories1 = $getServicesSubCategories->fetch_assoc()) { if($row['services_sub_category_id'] == $getServicesSubCategories1['id']) { echo $getServicesSubCategories1['sub_category_name']; } } ?></td>
                    <td><?php $getServiceGroups = getAllData('services_groups'); while($getServiceGroups1 = $getServiceGroups->fetch_assoc()) { if($row['services_group_id'] == $getServiceGroups1['id']) { echo $getServiceGroups1['group_name']; } } ?></td>
                    <td><?php echo $row['group_service_name'];?></td>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='services_group_service_names'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='services_group_service_names'>In Active</span>" ;} ?></td>
                    <td> <a href="edit_services_group_service_names.php?gsnid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "services_group_service_names" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> &nbsp;<a href="#"><i class="zmdi zmdi-eye zmdi-hc-fw" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class=""></i></a></td>
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
                              <div class="col-sm-4">Category Name:</div>
                              <div class="col-sm-6"><?php while($getServicesCategories1 = $getServicesCategories->fetch_assoc()) { if($row['services_category_id'] == $getServicesCategories1['id']) { echo $getServicesCategories1['category_name']; } } ?></div>
                            </div>
                            <div class="row">
                              <?php $getServicesSubCategories = getAllData('services_sub_category'); ?>
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Sub Category Name:</div>
                              <div class="col-sm-6"><?php while($getServicesSubCategories1 = $getServicesSubCategories->fetch_assoc()) { if($row['services_sub_category_id'] == $getServicesSubCategories1['id']) { echo $getServicesSubCategories1['sub_category_name']; } } ?></div>
                            </div>
                            <div class="row">
                              <?php $getGroupsData = getAllData('services_groups'); ?>
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Group Name:</div>
                              <div class="col-sm-6"><?php while($getGroupsData1 = $getGroupsData->fetch_assoc()) { if($row['services_sub_category_id'] == $getGroupsData1['id']) { echo $getGroupsData1['group_name']; } } ?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Group Service Name:</div>
                              <div class="col-sm-6"><?php echo $row['group_service_name'];?></div>
                            </div>
                            <div class="row">
                              <div class="col-sm-2"></div>
                              <div class="col-sm-4">Group Service Description:</div>
                              <div class="col-sm-6"><?php echo $row['group_service_description'];?></div>
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