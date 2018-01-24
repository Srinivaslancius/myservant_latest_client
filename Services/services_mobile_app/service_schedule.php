<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response["lists"] = array();
$user_array = array();
$note_array = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) )  {

		$user_id = $_REQUEST['userId'];
		//$result = getAllDataWhere('services_cart','user_id',$user_id); 
		$cartItemUserId = "SELECT * FROM services_cart WHERE user_id='$user_id' GROUP BY service_sub_category_id";
		$result = $conn->query($cartItemUserId);
		if ($result->num_rows > 0) {		
				while($row = $result->fetch_assoc()) {			
					//Check the condioton for empty or not
			    	$user_array["cartId"] = $row["id"];		
			    	$subCatName= getIndividualDetails('services_sub_category','id',$row["service_sub_category_id"]);
			    	$user_array["subCatName"] = $subCatName["sub_category_name"];

			    	$user_array['serviceDetails'] = array();	

			    	//$getServicenames = getAllDataWhereWithThreeConditions('services_group_service_names','services_category_id',$row['service_category_id'],'services_sub_category_id',$row['service_sub_category_id'],'services_group_id',$row["group_id"]); 

			    	$subCatId = $row["service_sub_category_id"];
			    	$getCartItems = "SELECT * FROM services_cart WHERE user_id='$user_id' AND service_sub_category_id = '$subCatId' ";
					$getServicenames = $conn->query($getCartItems);

			    	if ($getServicenames->num_rows > 0) {
			    		$row1 = array();
			    		while($row1 = $getServicenames->fetch_assoc()) {
			    			$note_array["groupServiceId"] = $row1["service_id"];
			    			$serviceName = getIndividualDetails('services_group_service_names','id',$row1["service_id"]);
			    			$note_array["groupServiceName"] = $serviceName["group_service_name"];
			    			$note_array["servicePrice"] = $row1["service_price"];
			    			array_push($user_array['serviceDetails'],$note_array);
			    		}
			    		array_push($response['lists'],$user_array);

			    	} else {
					    $response["success"] = 1;
					    $response["message"] = "No Records found";	   
					}		    	
					//array_push($response["lists"], $lists);		 
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