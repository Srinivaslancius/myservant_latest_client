<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId'])) {

        $userId = $_REQUEST['userId'];
        $UpdateWallet = "SELECT * FROM user_wallet_transactions WHERE user_id='$userId' ";
        $UpDateWallet1 = $conn->query($UpdateWallet);
        
        if ($UpDateWallet1->num_rows > 0) {
                $response["lists"] = array();
                while($UpDateWallet2 = $UpDateWallet1->fetch_assoc()) {
                    $getUserDetails = getIndividualDetails('users','id',$UpDateWallet2['user_id']);
                    $PaymentStatus = getIndividualDetails('lkp_payment_status','id',$UpDateWallet2['lkp_payment_status_id']);
                    //Chedck the condioton for emptty or not        
                    $lists = array();
                    $lists["userFullName"] = $getUserDetails['user_full_name'];
                    $lists["creditAmount"] = $UpDateWallet2['credit_amnt'];     
                    $lists["paymentStatus"] = $PaymentStatus['payment_status'];
                    $lists["description"] = $UpDateWallet2['description'];
                    $lists["updatedDate"] = $UpDateWallet2['updated_date'];
                    $lists["debitAmount"] = $UpDateWallets2['debit_amnt'];
                    $lists["amountType"] = 1; //1-Debit,2-Credit
                    
                    array_push($response["lists"], $lists);      
                }
                $response["success"] = 0;
                $response["message"] = "Success";               
        } else {
            $response["success"] = 1;
            $response["message"] = "No Records found";     
        }

    } else {
        $response["success"] = 2;
        $response["message"] = "Required field(s) is missing";    
    }
    
} else {
    $response["success"] = 3;
    $response["message"] = "Invalid request";
}
echo json_encode($response);

?>