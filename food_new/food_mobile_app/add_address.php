<?php
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
// array for JSON response

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if (isset($_REQUEST['userId']) && isset($_REQUEST['name']) && !empty($_REQUEST['landmark']) && !empty($_REQUEST['city']) && !empty($_REQUEST['address']) && !empty($_REQUEST['location']) && !empty($_REQUEST['state']) && !empty($_REQUEST['phone']) ) {

        $userId = $_REQUEST['userId'];        
        $name= $_REQUEST['name'];
        $address= $_REQUEST['address'];
        $landmark = $_REQUEST['landmark'];
        $location= $_REQUEST['location'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $pincode= $_REQUEST['pincode'];
        $phone= $_REQUEST['phone'];
        $date = date("Y-m-d h:i:s");
        $lkp_status_id = 0;

        $sql = "INSERT INTO food_add_address (`user_id`,`name`, `address`, `landmark`,`location`,`city`,`state`, `pincode`,`phone`,`created_at`, `lkp_status_id`) VALUES ('$userId','$name', '$address', '$landmark', '$location', '$city','$state','$pincode','$phone', '$date', '$lkp_status_id')";

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