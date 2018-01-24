<?php
error_reporting(0);
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');

$id = $_GET['id'];

$getServiceProviderDetails = getIndividualDetails('service_provider_registration','id',$id);

if($getServiceProviderDetails['service_provider_type_id'] == 1) { 
    $getImage = getIndividualDetails('service_provider_business_registration','service_provider_registration_id',$id);
   $img = $base_url . 'uploads/service_provider_business_logo/'.$getImage['logo'];
} else {
	$getPesronalImage = getIndividualDetails('service_provider_personal_registration','service_provider_registration_id',$id);
   $img = $base_url . 'uploads/service_provider_personal_iamge/'.$getPesronalImage['image'];
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
        <th colspan="2" style="border-bottom:1px solid gray"><h4 style="color:#f26226;text-align:center"><b>SERVICE PROVIDER DETAILS</b></h4></th>
    <th style="border-bottom:1px solid gray"></th>
      </tr>
    </thead>
    <tbody>
      <tr  style="border-top:0px">    
      <td style="border-bottom:1px solid gray;color:#f26226">Name:</td>
    <td style="border-bottom:1px solid gray">'.$getServiceProviderDetails['name'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Mobile:</td>
    <td style="border-bottom:1px solid gray">'.$getServiceProviderDetails['mobile_number'].'</td>
      </tr>
      <tr>
       <td style="border-bottom:1px solid gray;color:#f26226">Email</td>
    <td style="border-bottom:1px solid gray">'.$getServiceProviderDetails['email'].'</td>
    <td style="border-bottom:1px solid gray;color:#f26226">Created Date</td>
    <td style="border-bottom:1px solid gray">'.$getServiceProviderDetails['created_at'].'</td>
      </tr>
    <tr>
        <td style="border-bottom:1px solid gray;color:#f26226">Address</td>
    <td colspan="3" style="border-bottom:1px solid gray">'.$getServiceProviderDetails['address'].'</td>
      </tr>';
      if($getServiceProviderDetails['service_provider_type_id'] == 1) { 
      	$getServiceBusinessProviderDetails = getIndividualDetails('service_provider_business_registration','service_provider_registration_id',$id);
      	if($getServiceBusinessProviderDetails['sub_category_id'] == 0) { 
      	$specialization_name = $getServiceBusinessProviderDetails['specialization_name']; 
      } else {
      	$getSpecialization = getIndividualDetails('services_sub_category','id',$getServiceBusinessProviderDetails['sub_category_id']);
      	$specialization_name = $getSpecialization['sub_category_name'];
      }
      if($getServiceBusinessProviderDetails['associate_or_not'] == 0) { 
      	$associate_or_not = 'Yes'; 
      } else {
      	$associate_or_not = 'No';
      }
    $content .= '<tr>
      <td style="border-bottom:1px solid gray"></td>
    <td colspan="2" style="border-bottom:1px solid gray"><h5 style="color:#f26226;text-align:center"><b>SERVICE PROVIDER BUSINESS DETAILS</b></h5></td>
    <td style="border-bottom:1px solid gray"></td>
      </tr>
      <tr>
       <td style="border-bottom:1px solid gray;color:#f26226">Comapny Name</td>
    <td style="border-bottom:1px solid gray">'.$getServiceBusinessProviderDetails['company_name'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">No.Of Employees</td>
     <td style="border-bottom:1px solid gray">'.$getServiceBusinessProviderDetails['total_no_of_emp'].'</td>
      </tr>
    <tr>
        <td style="border-bottom:1px solid gray;color:#f26226">Total Working Hrs</td>
     <td style="border-bottom:1px solid gray">'.'mrng :'.$getServiceBusinessProviderDetails['working_hours'].'  '.'evng :'.$getServiceBusinessProviderDetails['evening_hours'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">E-Mail</td>
     <td style="border-bottom:1px solid gray">'.$getServiceBusinessProviderDetails['email_id'].'</td>
      </tr>
     <tr>
         <td style="border-bottom:1px solid gray;color:#f26226">Company Mobile No:</td>
     <td style="border-bottom:1px solid gray">'.$getServiceBusinessProviderDetails['contact_numbers'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Specialization</td>
    <td style="border-bottom:1px solid gray">'.$specialization_name.'</td>
      </tr>
    <tr>
        <td style="border-bottom:1px solid gray;color:#f26226">Associate</td>
    <td style="border-bottom:1px solid gray">'.$associate_or_not.'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Certification</td>
     <td style="border-bottom:1px solid gray">'.$getServiceBusinessProviderDetails['certification'].'</td>
      </tr>
    <tr>
        <td style="color:#f26226">Description</td>
    <td colspan="3">'.$getServiceBusinessProviderDetails['description'].'</td>
      </tr>'; 
  } else {
  	$getServicePersonalProviderDetails = getIndividualDetails('service_provider_personal_registration','service_provider_registration_id',$id);
  	if($getServicePersonalProviderDetails['sub_category_id'] == 0) { 
      	$specialization_name = $getServicePersonalProviderDetails['specialization_name']; 
      } else {
        $getSubCategoryTypeId = explode(',',$getServicePersonalProviderDetails['sub_category_id']);
        $getSubCategories = getAllDataWithStatus('services_sub_category','0');
        while($row = $getSubCategories->fetch_assoc()) {
          if($row['id'] == in_array($row['id'], $getSubCategoryTypeId)) {
      	   $specialization_name = $row['sub_category_name'];
         }
      }
    }
  	$content .= '<tr>
      <td style="border-bottom:1px solid gray"></td>
    <td colspan="2" style="border-bottom:1px solid gray"><h5 style="color:#f26226;text-align:center"><b>SERVICE PROVIDER PERSONAL DETAILS</b></h5></td>
    <td style="border-bottom:1px solid gray"></td>
      </tr>
      <tr>
       <td style="border-bottom:1px solid gray;color:#f26226">Experience</td>
    <td style="border-bottom:1px solid gray">'.$getServicePersonalProviderDetails['experience'].'</td>
     <td style="border-bottom:1px solid gray;color:#f26226">Working Hours</td>
     <td style="border-bottom:1px solid gray">'.'mrng :'.$getServicePersonalProviderDetails['working_hours'].'  '.'evng :'.$getServicePersonalProviderDetails['evening_hours'].'</td>
      </tr>
    <tr>
        <td style="color:#f26226">Specialization</td>
    <td>'.$specialization_name.'</td>
     <td style="color:#f26226"></td>
     <td></td>
      </tr>';
    }
  $content .= '</tbody>
  </table>
</div>

</body>
</html>';

//echo $content; die;

require_once('html2pdf/html2pdf.class.php');


$html2pdf = new HTML2PDF('P', array(450,250), 'en', true, 'UTF-8', array(30, 30, 40, 40));
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML($content);
$html2pdf->Output($getOrdersData1['order_id'].'.pdf');
?>