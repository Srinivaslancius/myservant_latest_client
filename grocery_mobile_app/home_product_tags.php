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

	$getTags = "SELECT * FROM grocery_tags WHERE lkp_status_id = 0 AND id IN (SELECT tag_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC";
	$tagNames = $conn->query($getTags);

	if ($tagNames->num_rows > 0) {
			//$response["lists"] = array();
			while($row = $tagNames->fetch_assoc()) {
				//Chedck the condioton for emptty or not			    	
		    	$user_array["tagName"] = $row["tag_name"];		    			    	
		    	$user_array['productDetails'] = array();	
		    	$row1 = array();
		    	$tagId= $row['id'];
		    	$getProducts = "SELECT * FROM grocery_products WHERE lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_tags WHERE lkp_status_id = 0 AND tag_id = '$tagId' AND product_id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')) ORDER BY id DESC LIMIT 0,8";
				$getProducts1 = $conn->query($getProducts);
				$row1 = array();
	    		while($getProductDetails = $getProducts1->fetch_assoc()) { 	    			
	    			$productId = $getProductDetails['id'];
					//Chedck the condioton for emptty or not		
					$note_array = array();
					$getProductImages = getIndividualDetails('grocery_product_bind_images','product_id',$getProductDetails['id']);
					$getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getProductDetails['id']);

			    	$note_array["productId"] = $getProductDetails["id"];
			    	$note_array["productName"] = $getProductNames['product_name']; 	
			    	$note_array["productImage"] = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImages['image'];		
			    	//get products weights and product weight type names with prices
			    	$getPriceDetails = getAllDataWhere('grocery_product_bind_weight_prices','product_id',$productId);
			    	$getPriceDet = array();
			    	while($getPriceDet = $getPriceDetails->fetch_assoc()) {		    		
			    		$note_array["offer_type"] .=  $getPriceDet['offer_type'] .",";
			    		$note_array["offer_percentage"] .=  $getPriceDet['offer_percentage'] .",";
			    		$note_array["mrp_price"] .=  $getPriceDet['mrp_price'] .",";
			    		$note_array["sellingPrice"] .=  $getPriceDet['selling_price'] .",";
			    		$note_array["priceTypeId"] .=  $getPriceDet['id'] .",";			    	
			    		$note_array["weightType"] .=  $getPriceDet['weight_type'] .",";		    		
			    	}    

	    			array_push($user_array['productDetails'],$note_array);
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