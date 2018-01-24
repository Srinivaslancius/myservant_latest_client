<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['cityId']) && !empty($_REQUEST['cityId']) && !empty($_REQUEST['catId']) ) {

        $lkp_city_id = $_REQUEST['cityId'];
		$getSubCategories = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id ='".$_REQUEST['catId']."' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC LIMIT 0,6";
		$getSubCategories1 = $conn->query($getSubCategories);

		if ($getSubCategories1->num_rows > 0) {

			$response["lists"] = array();
			while($row = $getSubCategories1->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["subCatId"] = $row["id"];
		    	$lists["subCategoryName"] = $row["sub_category_name"];  			    			
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