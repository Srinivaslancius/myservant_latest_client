<?php
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
// array for JSON response

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if (isset($_REQUEST['userId']) && isset($_REQUEST['firstName']) && !empty($_REQUEST['lastName']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile']) && !empty($_REQUEST['state']) && !empty($_REQUEST['district']) && !empty($_REQUEST['city']) && !empty($_REQUEST['pincode']) && !empty($_REQUEST['location']) && !empty($_REQUEST['address']) ) {

        $userId = $_REQUEST['userId'];        
        $first_name= $_REQUEST['firstName'];
        $last_name= $_REQUEST['lastName'];
        $email = $_REQUEST['email'];
        $mobile= $_REQUEST['mobile'];
        $state = $_REQUEST['state'];
        $district = $_REQUEST['district'];
        $city= $_REQUEST['city'];
        $pincode= $_REQUEST['pincode'];
        $location= $_REQUEST['location'];
        $address= $_REQUEST['address'];
        $date = date("Y-m-d h:i:s");
        $lkp_status_id = 0;
        $make_it_default = 1;

        if($updateAddress = 1) {
            $sql = "UPDATE food_add_address SET user_id = '$userId',first_name = '$first_name',last_name = '$last_name',email = '$email',phone = '$mobile',lkp_state_id = '$state',lkp_district_id = '$district',lkp_city_id = '$city',lkp_pincode_id = '$pincode',lkp_location_id = '$location',address = '$address'"
        } else {
            $default = "UPDATE food_add_address SET make_it_default = 0 WHERE user_id = '$userId'";
            $conn->query($default);

            $sql = "INSERT INTO food_add_address (`user_id`,`first_name`,`last_name`,`email`,`phone`,`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`lkp_location_id`,`address`,`created_at`, `lkp_status_id`, `make_it_default`) VALUES ('$userId','$first_name', '$last_name', '$email', '$mobile', '$state','$district','$city','$pincode', '$location', '$address', '$date', '$lkp_status_id', '$make_it_default')";
        }

            if ($conn->query($sql) === TRUE) {

                $response["success"] = 0;            
                $response["message"] = "Save Successfully"; 

            } else {
                // fail query insert problem
                $response["success"] = 2;
                $response["message"] = "Oops! An error occurred.";
            }

    } else {
        $response["success"] = 2;
        $response["message"] = "Required field(s) is missing";
        
    }   
    
} else {

    $response["success"] = 4;
    $response["message"] = "Invalid request";
}
echo json_encode($response);

?>