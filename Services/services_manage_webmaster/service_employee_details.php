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

$content .='<!DOCTYPE html>
<html lang="en">
<head>
  <title>SERVICE PROVIDER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:20px;width:900px;">         
  <table class="table" style="border:1px solid gray">
    <thead>
      <tr>
        <th style="border-bottom:1px solid gray"><img src="'.$img.'" style="height:50px"></th>
        <th colspan="2" style="border-bottom:1px solid gray"><h4 style="color:#f26226;text-align:center"><b>SERVICE EMPLOYEE DETAILS</b></h4></th>
    <th style="border-bottom:1px solid gray"></th>
      </tr>
    </thead>
    <tbody>
      <tr  style="border-top:0px">    
      <td style="border-bottom:1px solid gray;color:#f26226">Name:</td>
    <td style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['name'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Mobile:</td>
    <td style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['mobile_number'].'</td>
      </tr>
      <tr>
       <td style="border-bottom:1px solid gray;color:#f26226">Email</td>
    <td style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['email'].'</td>
    <td style="border-bottom:1px solid gray;color:#f26226">Created Date</td>
    <td style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['created_at'].'</td>
      </tr>
    <tr>
        <td style="border-bottom:1px solid gray;color:#f26226">Address</td>
    <td colspan="3" style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['address'].'</td>
      </tr>
      <tr>
       <td style="border-bottom:1px solid gray;color:#f26226">Experience</td>
    <td style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['experience'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Specalization</td>
     <td style="border-bottom:1px solid gray">'.$getServiceEmployeeDetails['specalization'].'</td>
      </tr>
    <tr>
        <td style="border-bottom:1px solid gray;color:#f26226">Employee Belongs to</td>
     <td style="border-bottom:1px solid gray">'.$employee_belongs_to.'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Service Provider</td>
     <td style="border-bottom:1px solid gray">'.$service_provider.'</td>
      </tr>
    <tr>
        <td style="color:#f26226">Description</td>
    <td colspan="3">'.$getServiceEmployeeDetails['description'].'</td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
';

//echo $content; die;

require_once('html2pdf/html2pdf.class.php');


$html2pdf = new HTML2PDF('P', array(450,250), 'en', true, 'UTF-8', array(30, 30, 40, 40));
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML($content);
$html2pdf->Output($getOrdersData1['order_id'].'.pdf');
?>