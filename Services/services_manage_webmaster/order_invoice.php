<?php
error_reporting(0);
include_once('../../admin_includes/config.php');
include_once('../../admin_includes/common_functions.php');

$id = $_GET['id'];

$getOrders = "SELECT * FROM services_orders WHERE id='$id'";
$getOrdersData = $conn->query($getOrders);
$getOrdersData1 = $getOrdersData->fetch_assoc();

$ordersCount = "SELECT * FROM services_orders WHERE order_id='".$getOrdersData1['order_id']."'";
$ordersCount1 = $conn->query($ordersCount); 
$ordersCount2 = $ordersCount1->num_rows;

$getServiceNames = getAllDataWhere('services_group_service_names','id',$getOrdersData1['service_id']); 
$getServiceNamesData = $getServiceNames->fetch_assoc();

$getPaymentMethod = getAllDataWhere('lkp_payment_types','id',$getOrdersData1['payment_method']); 
$getPaymentMethodData = $getPaymentMethod->fetch_assoc();

$getSiteSettingsData = getIndividualDetails('services_site_settings','id',1);

if($getOrdersData1['lkp_order_status_id'] == 2 && $getOrdersData1['lkp_payment_status_id'] == 1) {

$content ='';

if($getOrdersData1['coupon_code'] == '') {
	$discount_money = 0;
} else {
	$discount_money = $getOrdersData1['discount_money']/$ordersCount2;
}
if($getOrdersData1['service_price_type_id'] == 1) {
	$service_tax = 0;
} else {
	$service_tax = $getOrdersData1['order_price']*$getOrdersData1['service_quantity']*$getSiteSettingsData['service_tax']/100;
}
$order_price = ($getOrdersData1['order_price']*$getOrdersData1['service_quantity'])+($service_tax-$discount_money);
$sub_total = $getOrdersData1['order_price']*$getOrdersData1['service_quantity'];

$content .='<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:20px;width:1000px;">         
  <table class="table" style="border:1px solid gray">
    <thead>
      <tr style="background-color:#f2f2f2">
        <th colspan="2"></th>
        <th colspan="2" style="padding-bottom:40px;padding-left:120px"><img src="img/logo2.png" class="logo-responsive" width="210px" height="100px;"></th>
		<th></th>
		<th colspan="2"><h3 style="color:#f26226">Invoice</h3>
		<p>Oreder Id: '.$getOrdersData1['order_id'].'</p>
		<p>Created Date:  '.$getOrdersData1['created_at'].'</p>
		</th>	
      </tr>
    </thead>
    <tbody>
      <tr>     
        <td colspan="2"></td>
        <td colspan="2" style="padding-left:150px"><h4 style="color:#f26226">ORDER DETAILS</h4></td>
		<td colspan="3"></td>
      </tr>
      <tr  style="border-top:0px">
	  
       <td colspan="3"><p style="color:#f26226">Order Information</p>
		<p>Order Sub Id: '.$getOrdersData1['order_sub_id'].'</p>
		<p>Order Date: '.$getOrdersData1['created_at'].'</p>
		<p>Invoice Date: '.$getOrdersData1['delivery_date'].'</p>
		<p>Payment method: '.$getPaymentMethodData['status'].'</p>
		<p>Note:'.$getOrdersData1['service_provider_note'].'</p>
		</td>
		
        <td colspan="2"><p style="color:#f26226">Billing Address</p>
		<p>'.$getOrdersData1['first_name'].'</p>
		<p>'.$getOrdersData1['email'].'</p>
		<p>'.$getOrdersData1['mobile'].'</p>
		<p>'.$getOrdersData1['address'].'</p>
		<p>'.$getOrdersData1['postal_code'].'</p>
		</td>
		
        <td colspan="2"><p style="color:#f26226">Shipping Address</p>
		<p>'.$getOrdersData1['first_name'].'</p>
		<p>'.$getOrdersData1['email'].'</p>
		<p>'.$getOrdersData1['mobile'].'</p>
		<p>'.$getOrdersData1['address'].'</p>
		<p>'.$getOrdersData1['postal_code'].'</p>
		</td>
      </tr>
      <tr style="color:#f26226">
        <td>SERVICE NAME</td>
        <td></td>
        <td>PRICE</td>
        <td>QUANTITY</td>
		<td>SELECTED DATE</td>
		<td></td>
		<td>SELECTED TIME</td>
      </tr>
	   <tr>
        <td>'.$getServiceNamesData['group_service_name'].'</td>
        <td></td>
        <td>Rs. '.$getOrdersData1['order_price'].'</td>
        <td>'.$getOrdersData1['service_quantity'].'</td>
		<td>'.$getOrdersData1['service_selected_date'].'</td>
		<td></td>
		<td>'.$getOrdersData1['service_selected_time'].'</td>
      </tr>
	  <tr style="background-color:#f2f2f2">
        <td colspan="5"></td>
		<td>
		<p>Subtotal:</p>
		<p>Discount Money:</p>
		<p>Service Tax:</p>
		<p style="color:#f26226">Grand Total:</p>
		</td>
		<td style="color:#f26226"><p>Rs. '.$sub_total.'</p>
		<p>Rs.'.$discount_money.'</p>
		<p>Rs.'.$service_tax.'('.$getSiteSettingsData['service_tax'].'%)</p>
		<p>Rs. '.$order_price.'</p></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>';

//echo $content; die;

require_once('html2pdf/html2pdf.class.php');


$html2pdf = new HTML2PDF('P', 'A3', 'fr');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

$html2pdf = new HTML2PDF('P', 'A3', 'fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('../../uploads/generate_invoice/'.$getOrdersData1['order_sub_id'].'.pdf', 'F');

// Email attachment to user
$to = $getOrdersData1['email'];
$from = $getSiteSettingsData['from_email'];
$subject = "MY SERVANT ORDER INVOICE";

$message = "<p>Dear ". $getOrdersData1['first_name'] . ", <br /><br />Please see MY SERVANT Service Details attachment.</p><br /><br />Thank You<br/>MY SERVANT. ";
$separator = md5(time());
$eol = PHP_EOL;
$filename = "".$getOrdersData1['order_sub_id'].".pdf";
$pdfdoc = $html2pdf->Output('', 'S');
$attachment = chunk_split(base64_encode($pdfdoc));

$headers = "From: " . $from . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

$body = '';

$body .= "Content-Transfer-Encoding: 7bit" . $eol;
$body .= "This is a MIME encoded message." . $eol; //had one more .$eol

$body .= "--" . $separator . $eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
$body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$body .= $message . $eol;

$body .= "--" . $separator . $eol;
$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment" . $eol . $eol;
$body .= $attachment . $eol;
$body .= "--" . $separator . "--";

if (mail($to, $subject, $body, $headers)) {

    $msgsuccess = 'Mail Send Successfully';
} else {

    $msgerror = 'Main not send';
}

//Email Attachment to admin
$getAdminData = $orderStatus = getIndividualDetails('admin_users','id',$_SESSION['services_admin_user_id']);

$to = $getAdminData['admin_email'];
$from = $getSiteSettingsData['from_email'];
$subject = "MY SERVANT ORDER INVOICE";

$message = "<p>Dear Admin, <br /><br />Please see MY SERVANT Service Details attachment.</p><br /><br />Thank You<br/>MY SERVANT. ";
$separator = md5(time());
$eol = PHP_EOL;
$filename = "".$getOrdersData1['order_sub_id'].".pdf";
$pdfdoc = $html2pdf->Output('', 'S');
$attachment = chunk_split(base64_encode($pdfdoc));

$headers = "From: " . $from . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

$body = '';

$body .= "Content-Transfer-Encoding: 7bit" . $eol;
$body .= "This is a MIME encoded message." . $eol; //had one more .$eol

$body .= "--" . $separator . $eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
$body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$body .= $message . $eol;

$body .= "--" . $separator . $eol;
$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment" . $eol . $eol;
$body .= $attachment . $eol;
$body .= "--" . $separator . "--";

if (mail($to, $subject, $body, $headers)) {

    $msgsuccess = 'Mail Send Successfully';
} else {

    $msgerror = 'Main not send';
}

echo "Message has been sent";
}
header("Location: view_category_orders.php?order_id=".$getOrdersData1['order_id']."&msg=success");
?>