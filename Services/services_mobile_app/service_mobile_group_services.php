<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$response["lists"] = array();
$user_array = array();
$note_array = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['subCategoryId']) && !empty($_REQUEST['categoryId']) && !empty($_REQUEST['subCategoryId']))  {

		$result = getAllDataWhereWithTWoConditions('services_groups','services_category_id',$_REQUEST['categoryId'],'services_sub_category_id',$_REQUEST['subCategoryId']);
		if ($result->num_rows > 0) {				
				while($row = $result->fetch_assoc()) {			
					//Check the condioton for empty or not
			    	$user_array["groupId"] = $row["id"];
			    	$user_array["groupName"] = $row["group_name"];
			    	$user_array['serviceDetails'] = array();				    	
			    	$getServicenames = getAllDataWhereWithThreeConditions('services_group_service_names','services_category_id',$_REQUEST['categoryId'],'services_sub_category_id',$_REQUEST['subCategoryId'],'services_group_id',$row["id"]); 
			    	if ($getServicenames->num_rows > 0) {
			    		$row1 = array();
			    		while($row1 = $getServicenames->fetch_assoc()) {
			    			$note_array["groupServiceId"] = $row1["id"];
			    			$note_array["groupServiceName"] = $row1["group_service_name"];
			    			$note_array["groupServicePriceType"] = $row1["service_price_type_id"];
			    			if($row1['service_price_type_id'] == 1) {
								$servicePrice = $row1['service_price'];
                    		} elseif($row1['price_after_visit_type_id'] == 1) {
                    			$servicePrice = $row1['price_after_visiting'];
                    		} else {
                    			$servicePrice = $row1['service_min_price'].'-'.$row1['service_max_price']; 
                    		}
			    			$note_array["groupServicePrice"] = $servicePrice;
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