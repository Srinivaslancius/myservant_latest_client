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
     
        <div class="site-content">
             <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Admin Login History</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Service Name</th>
                                    <th>Type</th>
                                    <th>IP</th>
                                    <th>Login Date and Time</th>
                                    <!-- <th>Logout Date and Time</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getAllDaLog = "SELECT * FROM admin_log_history ORDER BY log_id DESC"; $getAdminLogs=$conn->query($getAllDaLog); $i=1; ?>
                                <?php while ($row = $getAdminLogs->fetch_assoc()) { ?>
                                <?php if($row['message'] == "Admin") {
                                    $getAdminName = getIndividualDetails('admin_users','id',$row['user_id']);
                                    $name = $getAdminName['admin_name'];
                                } elseif($row['message'] == "User") {
                                    $getWebname = getIndividualDetails('users','id',$row['user_id']);
                                    $name = $getWebname['user_full_name'];
                                } ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <?php $getServName = getIndividualDetails('lkp_admin_service_types','id',$row['service_id']); ?>
                                    <td><?php echo $getServName['admin_service_type']; ?></td>
                                    <td><?php echo $row['message']; ?></td>
                                    <td><?php echo $row['remote_addr']; ?></td>
                                    <td><?php echo dateFormat($row['log_start_date']); ?></td>
                                    <!-- <td><?php if($row['log_end_date']!='') { echo $row['log_end_date']; } else { echo "---"; } ?></td> -->                                    
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