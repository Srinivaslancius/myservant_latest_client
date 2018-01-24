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
            $admin_name = $_REQUEST['admin_name'];
            $admin_email = $_REQUEST['admin_email'];
            $admin_password = encryptPassword($_REQUEST['admin_password']);
            $lkp_admin_service_type_id = $_POST['lkp_admin_service_type_id'];
            $lkp_admin_user_type_id = $_POST['lkp_admin_user_type_id'];
            $lkp_status_id = $_REQUEST['lkp_status_id'];

        $sql = "INSERT INTO admin_users (`admin_name`,`admin_email`,`admin_password`, `lkp_admin_service_type_id`, `lkp_admin_user_type_id`,`lkp_status_id`) VALUES ('$admin_name', '$admin_email','$admin_password','$lkp_admin_service_type_id','$lkp_admin_user_type_id','$lkp_status_id')"; 
           
            
            $result = $conn->query($sql);
           
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='admin_users.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='admin_users.php?msg=fail'</script>";
            }
        }
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Admin Users</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="admin_name" class="form-control" id="form-control-3" placeholder="Enter Name"  required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Email</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="email"  name="admin_email" class="form-control" id="user_input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" placeholder="Enter Email"  required="required" onkeyup="checkUserAvailTest()">
                                    <span id="input_status" style="color: red;"></span>
                                    <div class="help-block with-errors"></div>
                                    <input type="hidden" id="table_name" value="admin_users">
                                    <input type="hidden" id="column_name" value="admin_email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Password</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="password" name="admin_password" class="form-control" id="form-control-3" placeholder="Enter Password"  minlength="8" required="required">
                                </div>
                            </div>
                            <?php $getAdminSetviceTypes = getAllDataWhereWithActive('lkp_admin_service_types','id',3);?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Admin Service Types</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_admin_service_type_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Admin Service Types --</option>

                                        <?php while($row1 = $getAdminSetviceTypes->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row1['id']; ?>" ><?php echo $row1['admin_service_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php $getAdminUserTypes = getAllDataWithStatus('lkp_admin_user_types','0');?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Choose Admin User Types</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_admin_user_type_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Admin User Types --</option>

                                        <?php while($row2 = $getAdminUserTypes->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row2['id']; ?>" ><?php echo $row2['admin_type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php $getStatus = getAllData('lkp_status');?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="lkp_status_id" name="lkp_status_id" class="form-control" required>
                                        <option value="">-- Select Status --</option>
                                         <?php while($row = $getStatus->fetch_assoc()) {  ?>
                                              <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                                          <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                   <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

             <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Admin Users</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getAdminUsers = getAllDataWithActiveRecent('admin_users'); $i=1; ?>
                                <?php while ($row = $getAdminUsers->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['admin_name']; ?></td>
                                    <td><?php echo $row['admin_email']; ?></td>
                                    <td><?php echo $row['admin_mobile']; ?></td>

                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='admin_users'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='admin_users'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_admin_users.php?cid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
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