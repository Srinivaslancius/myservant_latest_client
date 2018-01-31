<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from big-bang-studio.com/cosmos/pages-invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2017 10:14:32 GMT -->
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

<?php
error_reporting(0);
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');

$id = $_GET['id'];
$getServiceEmployeeDetails = getIndividualDetails('services_employee_registration','id',$id);
$getEmployeBelongsto = getIndividualDetails('service_employee_belongs_to','id',$getServiceEmployeeDetails['employee_belongs_to']);
$employee_belongs_to = $getEmployeBelongsto['services_employee_belongs'];
$img = $base_url . 'uploads/service_employee_photo/'.$getServiceEmployeeDetails['photo'];
if($getServiceEmployeeDetails['employee_belongs_to'] == 1) {
$service_provider = '--';
} else {
  $serviceProvider = getIndividualDetails('service_provider_registration','id',$getServiceEmployeeDetails['service_provider_registration_id']);
  $service_provider = $serviceProvider['name'];
}

?>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    
    <div class="site-main">      
     
      <div class="site-content">
        <div class="panel panel-default m-b-0">
          <img src=<?php echo $img; ?> style="height:50px">
          <div class="panel-heading">
            <h3 class="m-y-0" style="text-align:center">SERVICE EMPLOYEE DETAILS</h3>
          </div>
          <div class="panel-body">
           
            <table class="table table-bordered m-b-30">
              <thead>
                <tr>
                  <th>
                    Name
                  </th>
                  <th>
                    Mobile
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Created Date
                  </th>                
                  <th>
                    Address
                  </th>
                  <th>
                    Experience
                  </th>
                  <th>
                    Specalization
                  </th>
                  <th>
                    Employee Belongs to
                  </th>
                  <th>
                    Service Provider
                  </th>
                  <th>
                    Description
                  </th>
                </tr>
              </thead>

              <tbody>                
                <tr>
                  <td><?php echo $getServiceEmployeeDetails['name']; ?></td>
                  <td><?php echo $getServiceEmployeeDetails['mobile_number']; ?></td>
                  <td><?php echo $getServiceEmployeeDetails['email']; ?></td>
                  <td><?php echo $getServiceEmployeeDetails['created_at']; ?></td>
                  <td><?php echo $getServiceEmployeeDetails['address']; ?></td>                  
                  <td><?php echo $getServiceEmployeeDetails['experience']; ?></td>
                  <td><?php echo $getServiceEmployeeDetails['specalization']; ?></td>
                  <td><?php echo $employee_belongs_to; ?></td>
                  <td><?php echo $service_provider; ?></td>
                  <td><?php echo $getServiceEmployeeDetails['description']; ?></td>                  
                </tr>  
              </tbody>
            </table>
          
          </div>
          <div class="panel-footer text-right">
            <button type="button" class="btn btn-primary btn-labeled" onclick="myFunction()">Print
              <span class="btn-label btn-label-right p-x-10">
                <i class="zmdi zmdi-print"></i>
              </span>
            </button>
            
          </div>
        </div>
      </div>
      <div class="site-footer">
        2017 © LANCIUS IT SOLUTIONS
      </div>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
  </body>
    <script>
  function myFunction() {
      window.print();
  }
  </script>

</html>