<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

  if(!empty($_REQUEST['userId']) && !empty($_REQUEST['orderId']) )  {

      $userId = $_REQUEST['userId'];
      $orderId = $_REQUEST['orderId'];   
      
      $result = "UPDATE `grocery_orders` SET `lkp_payment_status_id`='3' WHERE `user_id`='$userId' AND order_id='$orderId' ";
      if ($conn->query($result) === TRUE) {
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