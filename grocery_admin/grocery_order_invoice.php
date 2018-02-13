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
$content .= '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>INVOICE</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-main">  
      <div class="site-content">
        <div class="panel panel-default m-b-0">
          <div class="panel-heading">
            <h3 class="m-y-0">Invoice</h3>
            <img src="'.$img.'" class="logo-responsive" >
          </div>
          <div class="panel-body">
            <div class="row m-b-30">
              <div class="col-sm-6">                
                <p><strong>Customer Address</strong></p>
                <p>'.$getOrdersData1['first_name'].'
                  <br>'.$getOrdersData1['email'].'
                  <br>'.$getOrdersData1['address'].','.$getOrdersData1['postal_code'].'</p>
                <p class="m-b-0">Mobile: '.$getOrdersData1['mobile'].'</p>
              </div>
              <div class="col-sm-6">                
                <p><strong>Order Info</strong></p>
                <p>Order Id: '.$getOrdersData1['order_id'].'
                  <br>Delivery Slot Date: '.changeDateFormat($getOrdersData1['delivery_slot_date']).'
                  <br>Delivery Slot Time: '.$getOrdersData1['delivery_time'].'
                  <br>Order Date: '.$getOrdersData1['created_at'].'
                  <br>Order Status : '.$orderStatus['order_status'].'
                  <br>Payment Status : '.$paymentStatus['payment_status'].'
                  <br>Payment Method: '.$getpaymentTypes['status'].'
              	</p>               
              </div>
            </div>
            <table class="table table-bordered m-b-30">
              <thead>
                <tr>
                  <th>
                    S.No
                  </th>
                  <th>
                    Product Name
                  </th>
                  <th>
                    Product Image
                  </th>
                  <th>
                    Product Weight
                  </th>                
                  <th>
                    Quantity
                  </th>
                  <th>
                    Item Price
                  </th>
                  <th>
                    Item Total
                  </th>
                </tr>
              </thead>
              <tbody>';
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
                  <td>'.$i.'</td>
                  <td>'.$getProducts['product_name'].'</td>     
                  <td><img src="'.$product_image.'" width="70px" height="70px"></td>             
                  <td>'.$getItemWeights['weight_type'].'</td>
                  <td>'.$getOrdersData2['item_quantity'].'</td>                  
                  <td>'.$getOrdersData2['item_price'].'</td>
                  <td>'.$product_price.'</td>
                </tr>'; 
                $i++; }
                $content .= '<tr>
                  <td scope="row" colspan="6">
                    <div class="text-right">
                      Subtotal';
                      if($getOrdersData1['delivery_charges'] != '0') {
                      	$content .= '<br>Delivery Charges:';
                      }
                      $content .= '<br> Service Tax';
                      if($getOrdersData1['coupen_code'] != '') {
                      	$content .= '<br> Discount';
                      }
                      $content .= '<br>
                      <strong>TOTAL</strong>
                    </div>
                  </td>
                  <td>
                    Rs .'.$getOrdersData1['sub_total'].'';
                    if($getOrdersData1['delivery_charges'] != '0') { 
                    	$content .= '<br>Rs. '.$delivery_charges.'';
                    }
                    $content .= '<br> Rs .'.$service_tax.' ( '.$getSiteSettingsData['service_tax'].' % )';
                    if($getOrdersData1['coupen_code'] != '') {
                    	$content = '<br>Rs .Rs. '.$getOrdersData1['discout_money'].'(<span style="color:green">Coupon Applied.</span>)';
                    }
                    $content .= '<br>
                    <strong>Rs .'.$getOrdersData1['order_total'].'</strong>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
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
$html2pdf->Output('uploads/groce_order_invoice/'.$getOrdersData1['order_id'].'.pdf', 'F');

// Email attachment to user
$to = $getOrdersData1['email'];
$from = $getSiteSettingsData['from_email'];
$subject = "MY SERVANT ORDER INVOICE";

$message = "<p>Dear ". $getOrdersData1['first_name'] . ", <br /><br />Please see MY SERVANT Grocery Order Details attachment.</p><br /><br />Thank You<br/>MY SERVANT. ";
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
header("Location: view_orders.php?order_id=".$getOrdersData1['order_id']."&msg=success");
?>