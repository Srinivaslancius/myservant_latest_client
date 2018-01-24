<?php 
error_reporting(1);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_REQUEST['categoryId']) && !empty($_REQUEST['categoryId']))  {

		$result = getAllDataWhereWithActive('services_sub_category','services_category_id',$_REQUEST['categoryId']);
		if ($result->num_rows > 0) {
				$response["lists"] = array();

				$cat_id=$_REQUEST['categoryId'];
		    	$getBanners1 = "SELECT * FROM `services_banners` WHERE lkp_status_id = 0 ANd service_category_id = $cat_id ORDER BY id DESC";
			    $getBanners = $conn->query($getBanners1);
			    $getAllBanners = $getBanners->fetch_assoc();

			    if(!empty($getAllBanners['banner'])) {
			    	$response["categoryBannerImage"] = $base_url."uploads/services_banner_images/".$getAllBanners["banner"];
			    } else {
			    	$response["categoryBannerImage"] = $base_url."Services/img/slides/slide_1.jpg";
			    }
				    
				while($row = $result->fetch_assoc()) {
					//Chedck the condioton for emptty or not		
					$lists = array();
			    	$lists["subCategoryId"] = $row["id"];
			    	$lists["categoryId"] = $_REQUEST['categoryId'];
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
		$response["success"] = 2;
		$response["message"] = "Required field(s) is missing";
	}	

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>