<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['cityId']) && !empty($_REQUEST['catId']) && !empty($_REQUEST['subCatId']) ) {

        $lkp_city_id = $_REQUEST['cityId'];
        $catId = $_REQUEST['catId'];
        $subCatId = $_REQUEST['subCatId'];

		$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = $subCatId AND grocery_category_id ='$catId' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
			$getProducts1 = $conn->query($getProducts);
		if ($getProducts1->num_rows > 0) {

			$response["lists"] = array();
			while($getProductDetails = $getProducts1->fetch_assoc()) {
				$productId = $getProductDetails['id'];
				//Chedck the condioton for emptty or not		
				$lists = array();
				$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductDetails['id']);
				$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductDetails['id']);

		    	$lists["productId"] = $getProductDetails["id"];
		    	$lists["productName"] = $getProductNames['product_name']; 	
		    	$lists["productImage"] = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'];		
		    	//get products weights and product weight type names with prices
		    	$getPriceDetails = getAllDataWhere('grocery_product_bind_weight_prices','product_id',$productId);
		    	$getPriceDet = array();
		    	while($getPriceDet = $getPriceDetails->fetch_assoc()) {
		    		$lists["sellingPrice"] .=  $getPriceDet['selling_price'] .",";
		    		$lists["priceTypeId"] .=  $getPriceDet['id'] .",";			    	
		    		$lists["weightType"] .=  $getPriceDet['weight_type'] .",";		    		
		    	}    			
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