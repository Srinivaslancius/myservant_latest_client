<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

		$result = getAllDataWithStatus('services_sub_category','0');
		if ($result->num_rows > 0) {
				$response["lists"] = array();

				while($row = $result->fetch_assoc()) {
					//Chedck the condioton for emptty or not		
					$lists = array();
			    	$lists["subCategoryId"] = $row["id"];			    	
			    	$lists["categoryId"] = $row["services_category_id"];
			    	$lists["subCategoryName"] = $row["sub_category_name"];		    	
			    	$lists["subCategoryImage"] = $base_url."uploads/services_sub_category_images/".$row["sub_category_image"];
					array_push($response["lists"], $lists);		 
				}
				$response["success"] = 0;
				$response["message"] = "Success";				
		} else {
		    $response["success"] = 1;
		    $response["message"] = "No Records found";	   
		}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>