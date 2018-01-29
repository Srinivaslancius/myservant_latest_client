<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$response["lists"] = array();
$user_array = array();
$note_array = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['cityId']) && !empty($_REQUEST['cityId']) ) {

        $lkp_city_id = $_REQUEST['cityId'];
	} else {
		$lkp_city_id = 1;
	}

	$getCategories1 = "SELECT * FROM grocery_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_category_id FROM grocery_sub_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
	$getCategories = $conn->query($getCategories1);

	if ($getCategories->num_rows > 0) {
			//$response["lists"] = array();
			while($row = $getCategories->fetch_assoc()) {
				//Chedck the condioton for emptty or not	
		    	$user_array["catId"] = $row["id"];
		    	$user_array["categoryName"] = $row["category_name"];		    	
		    	$user_array["categoryImage"] = $base_url . 'grocery_admin/uploads/grocery_category_app_image/'.$row['category_app_image'];	
		    	$user_array['categoryDetails'] = array();	
		    	$row1 = array();
		    	$catId = $row["id"];
		    	$getSubCategories1 = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id='$catId' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC";
				$getSubCategories = $conn->query($getSubCategories1);
				$row1 = array();
	    		while($row1 = $getSubCategories->fetch_assoc()) {
	    			$note_array["subCatId"] = $row1["id"];
	    			$note_array["subCategoryName"] = $row1["sub_category_name"];	    			
	    			array_push($user_array['categoryDetails'],$note_array);
	    		}	
		    	array_push($response['lists'],$user_array);	
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