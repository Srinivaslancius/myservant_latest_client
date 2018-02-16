<?php
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

  if(!empty($_REQUEST['userId']) && !empty($_REQUEST['orderId']) && !empty($_REQUEST['payment_mode']) )  {

      $userId = $_REQUEST['userId'];
      $orderId = $_REQUEST['orderId'];   
      $payment_mode = $_REQUEST['payment_mode']; 
      
      if($payment_mode == 1) {
        $payment_status = 2;
      } else {
        $payment_status = 1;
      }

      $coupon_code = $_REQUEST['coupon_code'];   
      $coupon_applied_amount = $_REQUEST['coupon_applied_amount'];  

      $result = "UPDATE `food_orders` SET `lkp_payment_status_id`='$payment_status',`coupen_code`='$coupon_code',`discout_money`='$coupon_applied_amount' WHERE `user_id`='$userId' AND order_id='$orderId' ";
      if ($conn->query($result) === TRUE) {

        //$orderDEtails = getIndividualDetails($orderId,'orders','order_id');

        //$sendSMS = sendMobileOrderPlaced($orderId,$orderDEtails['mobile'],$orderDEtails['order_total']);

        $response['success']=0;
        $response['message']='Success';        
      } else {
        $response['success']=4;
        $response['message']='Error oops!';
      }         

    } else {
      $response['success']=2;
      $response['message']='Parameters missing';     
    }
    
} else {
    $response['success']=3;
    $response['message']='Invalid request';   
}
  echo json_encode($response);
?>