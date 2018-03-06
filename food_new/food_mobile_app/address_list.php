<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId'])) {

        $result = getAllDataWhere('food_add_address','user_id',$_REQUEST['userId']);
        
        if ($result->num_rows > 0) {
                $response["lists"] = array();
                while($getAddressDetails = $result->fetch_assoc()) {
                    $getState = getIndividualDetails('lkp_states','id',$getAddressDetails['lkp_state_id']);
                    $getDistrict = getIndividualDetails('lkp_districts','id',$getAddressDetails['lkp_district_id']);
                    $getPincode = getIndividualDetails('lkp_pincodes','id',$getAddressDetails['lkp_pincode_id']);
                    $getCity = getIndividualDetails('lkp_cities','id',$getAddressDetails['lkp_city_id']);
                    $getArea = getIndividualDetails('lkp_locations','id',$getAddressDetails['lkp_location_id']);
                    //Chedck the condioton for emptty or not        
                    $lists = array();
                    $lists["id"] = $getAddressDetails["id"];
                    $lists["user_id"] = $getAddressDetails["user_id"];     
                    $lists["name"] = $getAddressDetails["first_name"].$getAddressDetails["last_name"];
                    $lists["address_details"] = $getState["state_name"] . ',' . $getDistrict["district_name"] .',' . $getCity["city_name"] .',' . $getArea["location_name"] .', ' . $getPincode["pincode"].',' . $getAddressDetails["address"];
                    $lists["status"] = $getAddressDetails["lkp_status_id"];
                    
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