<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['cityId']) ) {

        $lkp_city_id = $_REQUEST['cityId'];
        $catId = $_REQUEST['catId'];
        $subCatId = $_REQUEST['subCatId'];
        $offerId = $_REQUEST['offerId'];

        if($catId!='' && $catId!=0) {

        	$getProducts = "SELECT * from grocery_products WHERE grocery_category_id ='$catId' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
			$getProducts1 = $conn->query($getProducts);
        } elseif($subCatId!='' && $subCatId!=0) {

        	$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = $subCatId  AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id')";
			$getProducts1 = $conn->query($getProducts);
        } elseif($offerId!='' && $offerId!=0) {

        	$offerProducts = getIndividualDetails('grocery_offer_module','id',$offerId);
		    $min_percentage = $offerProducts['min_offer_percentage'];
		    $max_percentage = $offerProducts['max_offer_percentage'];
		    $type = $offerProducts['offer_level'];
		    $offer_type = $offerProducts['offer_type'];
		    $category_id = $offerProducts['category_id'];
        	$sub_category_id = $offerProducts['sub_category_id'];
        	if($offer_type == 1) {
        		$offer_percentage = ' AND (offer_percentage BETWEEN '.$min_percentage.' AND '.$max_percentage.')';
        	} else {
        		$offer_percentage = '';
        	}
        	if($type == 1) {
        		$getCategories = getIndividualDetails('grocery_category','id',$category_id);
				$getName = $getCategories['category_name'];
        		$getProducts = "SELECT * from grocery_products WHERE grocery_category_id = '$category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage) ORDER BY id DESC";
				$getProducts1 = $conn->query($getProducts);				
        	} else {
        		$getSubCategories = getIndividualDetails('grocery_sub_category','id',$sub_category_id);
				$getName = $getSubCategories['sub_category_name'];
				$getProducts = "SELECT * from grocery_products WHERE grocery_sub_category_id = '$sub_category_id' AND lkp_status_id = 0 AND id IN (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = '$lkp_city_id' $offer_percentage) ORDER BY id DESC";
				$getProducts1 = $conn->query($getProducts);				
        	}
        }
		
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
		    		$lists["offer_type"] .=  $getPriceDet['offer_type'] .",";
		    		$lists["offer_percentage"] .=  $getPriceDet['offer_percentage'] .",";
		    		$lists["mrp_price"] .=  $getPriceDet['mrp_price'] .",";
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