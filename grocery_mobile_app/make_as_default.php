<?php
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
// array for JSON response

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if (isset($_REQUEST['userId']) && isset($_REQUEST['addressId']) ) {

        $userId = $_REQUEST['userId'];        
        $addressId= $_REQUEST['addressId'];

        $default = "UPDATE grocery_add_address SET make_it_default = 0 WHERE user_id = '$userId'";
        $conn->query($default);

        $defaultAddress = "UPDATE grocery_add_address SET make_it_default = 1 WHERE user_id = '$userId' AND id = '$addressId'";
        $conn->query($defaultAddress);

        $response["success"] = 0;            
        $response["message"] = "Success";

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