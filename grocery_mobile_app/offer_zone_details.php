<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

    if(!empty($_REQUEST['offerZoneId']))  {

        $offerZoneId = $_REQUEST['offerZoneId'];
        $offerZoneDetails = getAllDataWhere('grocery_offer_zone','id',$offerZoneId);
        $row = $offerZoneDetails->fetch_assoc();
        //$response["lists"] = array();
        //while($row = $offerZoneDetails->fetch_assoc()) {
            //$lists = array();
            $response["offerImage"] = $base_url."grocery_admin/uploads/grocery_offer_zone_images/".$row["offer_image"];
            $response["offerDescription"] = $row["offer_description"];
            $response["offerStartDate"] = $row["offer_start_date"];
            $response["offerEndDateate"] = $row["offer_end_date"];
            $response["offerRewardPoints"] = $row["offer_reward_points"];
           
            //array_push($response["lists"], $lists); 
        //}       
        
        $response["success"] = 0;
        $response["message"] = "Success";               
        
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