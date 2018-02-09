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

	$sub_cat_id = $_GET['subCatId'];
	$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '$sub_cat_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC LIMIT 1";
	$getAllBrnds = $conn->query($getBrnds);

	if ($getAllBrnds->num_rows > 0) {
			//$response["lists"] = array();
			while($row = $getAllBrnds->fetch_assoc()) {
				//Chedck the condioton for emptty or not
		    	$user_array["filteName"] = "Brands";		    			    	
		    	$user_array['brandDetails'] = array();	
		    	$user_array["filteName"] = "Brands";
		    	$row1 = array();
		    	$catId = $row["id"];
		    	$getBrnds1 = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '$sub_cat_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
				$getAllBrnds1 = $conn->query($getBrnds1);
				$row1 = array();
	    		while($row1 = $getAllBrnds1->fetch_assoc()) {
	    			$note_array["brandId"] = $row1["id"];
	    			$note_array["brandName"] = $row1["brand_name"];	    			
	    			array_push($user_array['brandDetails'],$note_array);
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