<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

        $getProducts = "SELECT * FROM grocery_product_name_bind_languages WHERE product_id IN (SELECT id FROM grocery_products WHERE `lkp_status_id`= 0) ORDER BY id DESC";
		$getProducts1 = $conn->query($getProducts);
		if ($getProducts1->num_rows > 0) {

			$response["lists"] = array();
			while($getProductDetails = $getProducts1->fetch_assoc()) {

				$lists = array();
				//$lists["productId"] = $getProductDetails["id"];
				$splittedstring=explode(",",$getProductDetails['search_tags']);
				foreach ($splittedstring as $key => $value) {
					 if(!empty($value)){
					 	//echo "splittedstring[".$key."] = ".$value."<br>";
					 	$lists["search_tags"] = $value; 
					 	array_push($response["lists"], $lists);
					 }				
				}		
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