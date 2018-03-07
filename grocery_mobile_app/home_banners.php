<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	//$result = getAllDataWhere('grocery_banners','lkp_status_id','0');

	if (isset($_REQUEST['cityId']) && !empty($_REQUEST['cityId']) ) {
        $lkp_city_id = $_REQUEST['cityId'];
	} else {
		$lkp_city_id = 1;
	}

	$getBanners = "SELECT * FROM grocery_banners WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id'";
	$result = $conn->query($getBanners);
	if ($result->num_rows > 0) {
			$response["lists"] = array();
			while($row = $result->fetch_assoc()) {
				//Chedck the condioton for emptty or not		
				$lists = array();
		    	$lists["id"] = $row["id"];
		    	$lists["title"] = $row["title"];		    	
		    	
		    	if($row["banner_image_type"] ==1) {
		    		$lists["min_percentage"] = $row["min_percentage"];
		    		$lists["max_percentage"] = $row["max_percentage"];
		    	} else {
		    		$lists["min_percentage"] = '0';
		    		$lists["max_percentage"] = '0';
		    	}

		    	if($row['type'] == 1) {
		    		$lists["categoryId"] = $row["category_id"];
		    		$lists["subCategoryId"] = '0';
		    	} elseif($row['type'] == 2) {
		    		$lists["subCategoryId"] = $row["sub_category_id"];
		    		$lists["categoryId"] = '0';
		    	} elseif($row['type'] == 3) {
		    	    $lists["subCategoryId"] = '0';
		    		$lists["categoryId"] = '0';
		    	} else {
		    		$lists["subCategoryId"] = '0';
		    		$lists["categoryId"] = '0';
		    	}

		    	$lists["title"] = $row["title"];
		    	$lists["banner"] = $base_url."grocery_admin/uploads/grocery_banner_app_image/".$row["app_image"];			
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