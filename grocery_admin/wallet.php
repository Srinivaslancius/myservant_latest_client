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
      <?php 
       $getUserWalletData ="SELECT * FROM user_wallet";
       $getUserWalletData1 = $conn->query($getUserWalletData);

        $i=1; ?>
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">Wallet</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                          <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($row = $getUserWalletData1->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php $getAllUsersData = getAllData('users'); 
                                while($getUsersData = $getAllUsersData->fetch_assoc()) { 
                                  if($row['user_id'] == $getUsersData['id']) { echo $getUsersData['user_full_name']; } } ?>
                                </td>
                                <td><?php echo $row['amount']; ?></td>      
                                <td><?php echo $row['created_at']; ?></td>
                                </td>
                                <td><span><a href="invoice1.php?id=<?php echo $row['id']; ?>" target="_blank"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a></span></td>
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