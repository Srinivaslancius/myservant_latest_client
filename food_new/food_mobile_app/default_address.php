<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) ) {

        //$result = getAllDataWhere('food_add_address','user_id',$_REQUEST['user_id']);
        $user_id = $_REQUEST['user_id'];
        $address_id = $_REQUEST['address_id'];
        $sqlSel ="SELECT * FROM food_add_address WHERE user_id='$user_id' AND lkp_status_id = 1 ";
        $result = $conn->query($sqlSel);
        
        if ($result->num_rows > 0) {
                $response["lists"] = array();
                while($getAddressDetails = $result->fetch_assoc()) {
                    //Chedck the condioton for emptty or not        
                    $lists = array();
                    $lists["id"] = $getAddressDetails["id"];
                    $lists["user_id"] = $getAddressDetails["user_id"];                   
                    $lists["address_details"] = $getAddressDetails["location"] . ',' . $getAddressDetails["city"] ;
                    
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