<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId'])) {

        //$result = getAllDataWhere('grocery_add_address','user_id',$_REQUEST['userId']);

        $user_id = $_REQUEST['userId'];
        $selDefaultAddress = "SELECT * FROM grocery_add_address WHERE user_id='$user_id' AND make_it_default = 1";
        $result = $conn->query($selDefaultAddress);
        $getAddressDetails = $result->fetch_assoc();
        
        if ($result->num_rows > 0) {
                //$response["lists"] = array();
                //while($getAddressDetails = $result->fetch_assoc()) {
                    $getState = getIndividualDetails('grocery_lkp_states','id',$getAddressDetails['lkp_state_id']);
                    $getDistrict = getIndividualDetails('grocery_lkp_districts','id',$getAddressDetails['lkp_district_id']);
                    $getPincode = getIndividualDetails('grocery_lkp_pincodes','id',$getAddressDetails['lkp_pincode_id']);
                    $getCity = getIndividualDetails('grocery_lkp_cities','id',$getAddressDetails['lkp_city_id']);
                    $getArea = getIndividualDetails('grocery_lkp_areas','id',$getAddressDetails['lkp_location_id']);
                    $getsubArea = getIndividualDetails('grocery_lkp_sub_areas','id',$getAddressDetails['lkp_sub_location_id']);
                    if($getAddressDetails['lkp_sub_location_id'] != 0) {
                        $subArea = $getsubArea["sub_area_name"];
                    } else {
                        $subArea = '';
                    }
                    //Chedck the condioton for emptty or not        
                    //$lists = array();
                    $response["id"] = $getAddressDetails["id"];
                    $response["user_id"] = $getAddressDetails["user_id"];     
                    $response["name"] = $getAddressDetails["first_name"].$getAddressDetails["last_name"];    
                    $response["state_name"] = $getState["state_name"]; 
                    $response["district_name"] = $getDistrict["district_name"]; 
                    $response["city_name"] = $getCity["city_name"]; 
                    $response["area_name"] = $getArea["area_name"]; 
                    $response["address"] = $getAddressDetails["address"]; 
                    $response["pincode"] = $getPincode["pincode"]; 
                    $response["phone"] = $getAddressDetails["phone"]; 
                    $response["subArea"] = $subArea; 
                    //$response["address_details"] = $getState["state_name"] . ',' . $getDistrict["district_name"] .',' . $getCity["city_name"] .',' . $getArea["area_name"] .',' . $subArea .', ' . $getAddressDetails["address"].',' . $getPincode["pincode"];
                    $response["status"] = $getAddressDetails["lkp_status_id"];
                    
                    //array_push($response["lists"], $lists);      
                //}
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