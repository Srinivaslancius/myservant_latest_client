<div class="sidebar ">
	<?php if($product_id = $_GET['cat_id']) { ?>
	<div class="widget widget-categories">
		<div class="widget-title">
			<h3> Sub Categories<span></span></h3>
			<div style="height:1px"></div>
		</div>
		<?php $SubCategoriesData = "SELECT * FROM grocery_sub_category WHERE lkp_status_id = 0 AND grocery_category_id ='$product_id' AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id)) ORDER BY id DESC LIMIT 0,6";
		$SubCategoriesData1 = $conn->query($SubCategoriesData);?>
		
		
		<div class="widget-content">
		<form id="category_filters">
		<input type="hidden" name="category_id" value="<?php echo $product_id ?>">
			<div style="height: 0px"></div>
			<ul class="box-checkbox scroll">
				<?php while($SubCategoriesData2 = $SubCategoriesData1->fetch_assoc() ) { ?>
				<li class="check-box">
					<input type="checkbox" id="sub_cat_id<?php echo $SubCategoriesData2['id']; ?>" name="categories[]" class="categories" value="<?php echo $SubCategoriesData2['id']; ?>">
					<label for="sub_cat_id<?php echo $SubCategoriesData2['id']; ?>"><?php echo $SubCategoriesData2['sub_category_name']; ?></label>
				</li>
				<?php } ?>
			</ul>
			</form>
		</div>
		
	</div><!-- /.widget widget-color -->
	<?php } ?>
	<div class="widget widget-brands">
		<?php if($_GET['cat_id']) {
				$cat_id = $_GET['cat_id'];			
				$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = '$cat_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
				?>
			 <?php } elseif($_GET['sub_cat_id']) { 
				$sub_cat_id = $_GET['sub_cat_id'];
				$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '$sub_cat_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
				?>
			<?php } elseif($_GET['offer_id']) { 
				$getOffers = getIndividualDetails('grocery_offer_module','id',$_GET['offer_id']);
				if($getOffers['offer_level'] == 1) { 
					$category_id = $getOffers['category_id'];
					$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0  AND grocery_category_id = '$category_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
					?>
				<?php } elseif($getOffers['offer_level'] == 2) {
					$sub_category_id = $getOffers['sub_category_id'];
					$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '$sub_category_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
					?>
				<?php } ?>
			<?php } elseif($_GET['id']) { 
				$getBanners = getIndividualDetails('grocery_banners','id',$_GET['id']);
				if($getBanners['type'] == 1) {
					$category_id = $getBanners['category_id'];
					$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_category_id = '$category_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
					?>
				<?php } elseif($getBanners['type'] == 2) { 
					$sub_category_id = $getBanners['sub_category_id'];
					$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND grocery_sub_category_id = '$sub_category_id' AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
					?>
				<?php } ?>
			<?php } ?>
		<?php $getAllBrands = $conn->query($getBrnds); ?>
		<?php if($getAllBrands->num_rows > 0) { ?>
		<div class="widget-title">
			<h3>Brands<span></span></h3>	
		</div>
		<div class="widget-content">
			<form id="check_filter_form">
				<?php if($_GET['cat_id']) { ?>
					<input type="hidden" name="category_id" value="<?php echo $_GET['cat_id']; ?>">
				 <?php } elseif($_GET['sub_cat_id']) { ?>
					<input type="hidden" name="sub_category_id" value="<?php echo $_GET['sub_cat_id']; ?>">
				<?php } elseif($_GET['offer_id']) { 
					$getOffers1 = getIndividualDetails('grocery_offer_module','id',$_GET['offer_id']);
					if($getOffers1['offer_level'] == 1) { ?>
						<input type="hidden" name="category_id" value="<?php echo $getOffers1['category_id']; ?>">
					<?php } elseif($getOffers1['offer_level'] == 2) { ?>
						<input type="hidden" name="sub_category_id" value="<?php echo $getOffers1['sub_category_id']; ?>">
					<?php } ?>
				<?php } elseif($_GET['id']) { 
					$getBanners1 = getIndividualDetails('grocery_banners','id',$_GET['id']);
					if($getBanners1['type'] == 1) { ?>
						<input type="hidden" name="category_id" value="<?php echo $getBanners1['category_id']; ?>">
					<?php } elseif($getBanners1['type'] == 2) { ?>
						<input type="hidden" name="sub_category_id" value="<?php echo $getBanners1['sub_category_id']; ?>">
					<?php } ?>
				<?php } ?>
				<ul class="box-checkbox scroll">
					<?php while($getAllBrandsNames = $getAllBrands->fetch_assoc() ) { ?>
					<li class="check-box">
						<input type="checkbox" id="checkbox<?php echo $getAllBrandsNames['id']; ?>" name="product_brands_filt[]" class="brand_filters" value="<?php echo $getAllBrandsNames['id']; ?>">
						<label for="checkbox<?php echo $getAllBrandsNames['id']; ?>"><?php echo $getAllBrandsNames['brand_name']; ?></label>
					</li>	
					<?php } ?>									
				</ul>
			</form>
		</div>
		<?php } ?>
	</div><!-- /.widget widget-brands -->

	<div class="widget widget-price">
		<div class="widget-title">
			<h3>Price<span></span></h3>
			<div style="height: 2px"></div>
		</div>
		
			<div class="widget-content">
<form id="search_form">
			<?php if($_GET['cat_id']) { ?>
				<input type="hidden" name="category_id" value="<?php echo $_GET['cat_id']; ?>">
			 <?php } elseif($_GET['sub_cat_id']) { ?>
				<input type="hidden" name="sub_category_id" value="<?php echo $_GET['sub_cat_id']; ?>">
			<?php } elseif($_GET['offer_id']) { 
				$getOffers1 = getIndividualDetails('grocery_offer_module','id',$_GET['offer_id']);
				if($getOffers1['offer_level'] == 1) { ?>
					<input type="hidden" name="category_id" value="<?php echo $getOffers1['category_id']; ?>">
				<?php } elseif($getOffers1['offer_level'] == 2) { ?>
					<input type="hidden" name="sub_category_id" value="<?php echo $getOffers1['sub_category_id']; ?>">
				<?php } ?>
			<?php } elseif($_GET['id']) { 
				$getBanners1 = getIndividualDetails('grocery_banners','id',$_GET['id']);
				if($getBanners1['type'] == 1) { ?>
					<input type="hidden" name="category_id" value="<?php echo $getBanners1['category_id']; ?>">
				<?php } elseif($getBanners1['type'] == 2) { ?>
					<input type="hidden" name="sub_category_id" value="<?php echo $getBanners1['sub_category_id']; ?>">
				<?php } ?>
			<?php } elseif($_GET['brand_id']) { 
				$getBrands = getIndividualDetails('grocery_brands','id',$_GET['brand_id']); ?>
				<input type="hidden" name="brand_id" value="<?php echo $getBrands['id']; ?>">
			<?php } elseif($_GET['tagId']) { 
				$getTags = getIndividualDetails('grocery_tags','id',$_GET['tagId']); ?>
				<input type="hidden" name="tagId" value="<?php echo $getTags['id']; ?>">
			<?php } ?>
				<ul class="box-checkbox scroll">
					<li class="check-box check_price_type">
						<input type="checkbox" id="check1" name="product_price[]" value="0 - 500">
						<label for="check1">0 - 500/-</label>
					</li>
					<li class="check-box check_price_type">
						<input type="checkbox" id="check2" name="product_price[]" value="500 - 1000">
						<label for="check2">500 - 1000/-</label>
					</li>
					<li class="check-box check_price_type">
						<input type="checkbox" id="check3" name="product_price[]" value="1000 - 1500">
						<label for="check3">1000 - 1500/-</label>
					</li>
					<li class="check-box check_price_type">
						<input type="checkbox" id="check4" name="product_price[]" value="1500 - 2000">
						<label for="check4">1500 - 2000/-</label>
					</li>
					<li class="check-box check_price_type">
						<input type="checkbox" id="check5" name="product_price[]" value="2000 - 2500">
						<label for="check5">2000 - 2500/-</label>
					</li>
					<li class="check-box check_price_type">
						<input type="checkbox" id="check6" name="product_price[]" value="2500 - 3000">
						<label for="check6">2500 - 3000/-</label>
					</li>
				</ul>
				</form>
			</div>
		
	</div><!-- /.widget widget-color -->

	
</div><!-- /.sidebar -->