<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {

        $result = getAllDataWhere('grocery_add_address','user_id',$_REQUEST['user_id']);
        
        if ($result->num_rows > 0) {
                $response["lists"] = array();
                while($getAddressDetails = $result->fetch_assoc()) {
                    $getState = getIndividualDetails('grocery_lkp_states','id',$result['lkp_state_id']);
                    $getDistrict = getIndividualDetails('grocery_lkp_districts','id',$result['lkp_district_id']);
                    $getPincode = getIndividualDetails('grocery_lkp_pincodes','id',$result['lkp_pincode_id']);
                    $getCity = getIndividualDetails('grocery_lkp_cities','id',$result['lkp_city_id']);
                    $getArea = getIndividualDetails('grocery_lkp_areas','id',$result['lkp_location_id']);
                    $getsubArea = getIndividualDetails('grocery_lkp_sub_areas','id',$result['lkp_sub_location_id']);
                    //Chedck the condioton for emptty or not        
                    $lists = array();
                    $lists["id"] = $getAddressDetails["id"];
                    $lists["user_id"] = $getAddressDetails["user_id"];     
                    $lists["name"] = $getAddressDetails["name"];              
                    $lists["address_details"] = $getState["state_name"] . ',' . $getDistrict["district_name"] .',' . $getCity["city_name"] .',' . $getArea["area_name"] .', ' . $getAddressDetails["address"].',' . $getPincode["pincode"];
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