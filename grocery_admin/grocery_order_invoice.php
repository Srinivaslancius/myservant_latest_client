<?php
error_reporting(0);
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');

$order_id = $_GET['order_id'];

$getOrders = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
$getOrdersData = $conn->query($getOrders);
$getOrdersData1 = $getOrdersData->fetch_assoc();

$getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1);
$getpaymentTypes = getIndividualDetails('lkp_payment_types','id',$getOrdersData1['payment_method']);
$orderStatus = getIndividualDetails('lkp_order_status','id',$getOrdersData1['lkp_order_status_id']);
$paymentStatus = getIndividualDetails('lkp_payment_status','id',$getOrdersData1['lkp_payment_status_id']);

$service_tax = $getOrdersData1['sub_total']*$getSiteSettingsData['service_tax']/100;
if($getOrdersData1['delivery_charges'] == '0') {
  $order_type = "Take Away";
  $delivery_charges = 0;
} else {
  $order_type = "Delivery";
  $delivery_charges = $getOrdersData1['delivery_charges'];
}
$img = $base_url . 'grocery_admin/uploads/logo/'.$getSiteSettingsData['logo'];
if($getOrdersData1['lkp_order_status_id'] == 2 && $getOrdersData1['lkp_payment_status_id'] == 1) {
$content = '';
$content .= '<html lang="en">
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
        <th colspan="2" style="padding-bottom:40px;padding-left:120px"><img src="'.$img.'" class="logo-responsive" width="210px" height="100px;"></th>
    <th></th>
    <th colspan="2"><h3 style="color:#f26226">Invoice</h3>
    <p>Oreder Id: '.$getOrdersData1['order_id'].'</p>
    <p>Order Date:'.$getOrdersData1['created_at'].'</p>
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
    <p>Delivery Slot Date: '.changeDateFormat($getOrdersData1['delivery_slot_date']).'</p>
    <p>Delivery Slot Time: '.$getOrdersData1['delivery_time'].'</p>
    <p>Payment Method: '.$getpaymentTypes['status'].'</p>
    <p>Order Status: '.$orderStatus['order_status'].'</p>
    <p>Payment Status: '.$paymentStatus['payment_status'].'</p>
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
    <p>'.$getOrdersData1['postal_code'].'</p></td>
    
      </tr>';
        $getOrders1 = "SELECT * FROM food_orders WHERE order_id='$order_id'";
    $getOrdersData3 = $conn->query($getOrders1);
    $content .= '<tr style="color:#f26226">
        <td>PRODUCT NAME</td>
        <td>PRODUCT IMAGE</td>
        <td>PRODUCT WEIGHT</td>
    <td>QUANTITY</td>
    <td>PRICE</td>
    <td>PRODUCT TOTAL PRICE</td>
    <td></td>
      </tr>';
      $i=1;
      $getOrders1 = "SELECT * FROM grocery_orders WHERE order_id='$order_id'";
      $getOrdersData3 = $conn->query($getOrders1);
      while($getOrdersData2 = $getOrdersData3->fetch_assoc()) {         
      $getProducts = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getOrdersData2['product_id']);
      $getItemWeights = getIndividualDetails('grocery_product_bind_weight_prices','id',$getOrdersData2['item_weight_type_id']);         
      $getProducts1 = getIndividualDetails('grocery_product_bind_images','product_id',$getOrdersData2['product_id']);
      $product_image = $base_url . 'grocery_admin/uploads/product_images/'.$getProducts1['image'];
      $product_price = $getOrdersData2['item_price']*$getOrdersData2['item_quantity'];
  $content .= '<tr>
        <td>'.$getProducts['product_name'].'</td>     
        <td><img src="'.$product_image.'" width="70px" height="70px"></td>             
        <td>'.$getItemWeights['weight_type'].'</td>
        <td>'.$getOrdersData2['item_quantity'].'</td>                  
        <td>'.$getOrdersData2['item_price'].'</td>
        <td>'.$product_price.'</td>
        <td></td>
      </tr>';
        }
  $content .= '<tr style="background-color:#f2f2f2">
        <td colspan="5"></td>
    <td>
    <p>Subtotal:</p>
    <p>Tax:</p>';
    if($getOrdersData1['delivery_charges'] != '0') { 
  $content .= '<p>Delivery Charges:</p>';
    }
    if($getOrdersData1['coupen_code'] != '') {
  $content .= '<p>Discount:</p>';
    }
  $content .= '<p style="color:#f26226">Grand Total:</p>
    </td>
    <td style="color:#f26226"><p>Rs. '.$getOrdersData1['sub_total'].'</p>
    <p>Rs. '. $service_tax.'('.$getSiteSettingsData['service_tax'].'%)'.'</p>';
    if($getOrdersData1['delivery_charges'] != '0') {
  $content .= '<p>Rs. '.$delivery_charges.'</p>';
    }
    if($getOrdersData1['coupen_code'] != '') {
  $content .= '<p>Rs. '.$getOrdersData1['discout_money'].'(<span style="color:green">Coupon Applied.</span>)</p>';
    }
  $content .= '<p>Rs. '.$getOrdersData1['order_total'].'</p></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>';

//echo $content; die;
require_once('../html2pdf/html2pdf.class.php');


$html2pdf = new HTML2PDF('P', 'A3', 'fr');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

$html2pdf = new HTML2PDF('P', 'A3', 'fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('uploads/grocery_order_invoice/'.$getOrdersData1['order_id'].'.pdf', 'F');

// Email attachment to user
$to = $getOrdersData1['email'];
$from = $getSiteSettingsData['from_email'];
$subject = "MY SERVANT ORDER INVOICE";

$message = "<p>Dear ". $getOrdersData1['first_name'] . ", <br /><br />Please see MY SERVANT Food Order Details attachment.</p><br /><br />Thank You<br/>MY SERVANT. ";
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

$to = $getSiteSettingsData['from_email'];
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
header("Location: edit_orders.php?order_id=".$getOrdersData1['order_id']."&msg=success");
?>