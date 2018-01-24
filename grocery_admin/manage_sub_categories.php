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
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 
          //echo "<pre>"; print_r($_POST); die;
          $grocery_category_id = $_POST['grocery_category_id'];
          $sub_category_name = $_POST['sub_category_name'];
          $priority = 1;
          $brands = implode(',',$_POST['brands']);

          if($_POST['make_it_popular'] == 1) {
            $checkboxVal = 1;
          } else {
            $checkboxVal = 0;
          }

          $sql = "INSERT INTO grocery_sub_category (`grocery_category_id`,`sub_category_name`,`priority`,`brands`,`make_it_popular`) VALUES ('$grocery_category_id','$sub_category_name','$priority','$brands','$checkboxVal')";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='manage_sub_categories.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='manage_sub_categories.php?msg=fail'</script>";
          }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Sub Categories</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="grocery_category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Sub Category Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="sub_category_name" class="form-control" id="form-control-3" placeholder="Enter Sub Category Name" required>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Priority</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="priority" class="form-control" id="form-control-3" placeholder="Enter Priority" required>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="form-control-1" class="col-sm-3 col-md-4 control-label">Brands Applicable</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select id="form-control-2" name="brands[]" class="form-control" data-plugin="select2" multiple="multiple">
                                            <?php $getBrands = getAllDataWithStatus('grocery_brands','0');
                                            while($row = $getBrands->fetch_assoc()) {  ?>
                                                <option value="<?php echo $row['id']; ?>" ><?php echo $row['brand_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label"></label>
                                <div class="col-sm-3 col-md-4">
                                    <input type="checkbox" name="make_it_popular"  id="form-control-3" value="1"> &nbsp; &nbsp;Make It Popular
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Sub Categories</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <!-- <th>Sub Category Id</th> -->
                                    <th>Sub Category Name</th>
                                    <th>Category Name</th>
                                    <th>Brands Applicable</th>
                                    <!-- <th>Priority</th> -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getSubCategories = getAllDataWithActiveRecent('grocery_sub_category'); $i=1; ?>
                                <?php while ($row = $getSubCategories->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td>Subcat21234</td> -->
                                    <td><?php echo $row['sub_category_name']; ?></td>
                                    <td><?php $getCategories = getAllData('grocery_category'); while($getCategoriesData = $getCategories->fetch_assoc()) { if($row['grocery_category_id'] == $getCategoriesData['id']) { echo $getCategoriesData['category_name']; } } ?></td>
                                    <td><a href="#" data-toggle="modal" data-target="#<?php echo $row['id']; ?>">View Brands Applicable</a></td>
                                    <!-- Modal Popup for brands applicable -->
                                    <?php 
                                    $getBrandId = explode(',',$row['brands']);
                                    $getBrands = getAllDataWithStatus('grocery_brands','0');?>
                                    <div class="col-lg-2 col-sm-4 col-xs-6 m-y-5">
                                        <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content animated flipInX">
                                                    <div class="modal-header bg-info">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">
                                                                <i class="zmdi zmdi-close"></i>
                                                            </span>
                                                        </button>
                                                        <h4 class="modal-title">View Brands</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <?php while($getBrandsData = $getBrands->fetch_assoc()) {  ?>
                                                                <div class="col-md-2 marg1"><span class="label label-default m-w-60 font_sz_view"><?php if($getBrandsData['id'] == in_array($getBrandsData['id'], $getBrandId)) { echo $getBrandsData['brand_name']; } ?></span></div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal" class="btn btn-info">Continue</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Popup -->
                                    <!-- <td><?php echo $row['priority']; ?></td>-->
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_sub_category'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_sub_category'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_grocery_sub_category.php?sub_category_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp;<!--  <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "grocery_sub_category" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
     <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>