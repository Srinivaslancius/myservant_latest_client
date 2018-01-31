<style>
.icon-rupee{
	font-size:15px;
}
</style>
<div id="filters_col">
	<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 pull-right"></i></a>
	<div class="collapse" id="collapseFilters">
		<form id="search_form">
		<div class="filter_type">
        	<?php //$getFoodCusineData = getAllDataWhere('food_cusine_types','lkp_status_id','0'); ?>
        	<?php
        		$getCus = "SELECT * FROM food_vendor_add_cusine_types GROUP BY vendor_cusine_type_id ";
        		$getFoodCusineData = $conn->query($getCus);
        	?>
			<h6>Cusine Types</h6>
			<ul>
				<?php while($getFoodCusineData1 = $getFoodCusineData->fetch_assoc()) { ?>
				<?php //$exp= explode(",", $getFoodCusineData1['cusine_type_id']); ?>				
					<li><label class="checkb check_cousin_type"><?php $getRestCusItem = getIndividualDetails('food_cusine_types','id',$getFoodCusineData1['vendor_cusine_type_id']); ?><?php echo $getRestCusItem['title']; ?><input type="checkbox" class="filter" name="cusine_type[]" value="<?php echo $getFoodCusineData1['vendor_cusine_type_id']; ?>">
					<span class="checkmark1"></span></label></li>				
				<?php } ?>
			</ul>
		</div>
		</form>
		<form id="rating-filters">
		<div class="filter_type">
			<h6>Rating</h6>
			<ul>
				<li><label class="checkb"><input type="checkbox" name="ratings[]" value="5" class="ratings"><span class="checkmark1"></span><span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
				</span></label></li>
				<li><label class="checkb"><input type="checkbox" name="ratings[]" value="4" class="ratings"><span class="checkmark1"></span><span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star mrgn_rgt"></i>
				</span></label></li>
				<li><label class="checkb"><input type="checkbox" name="ratings[]" value="3" class="ratings"><span class="checkmark1"></span><span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star mrgn_rgt"></i><i class="icon_star mrgn_rgt"></i>
				</span></label></li>
				<li><label class="checkb"><input type="checkbox" name="ratings[]" value="2" class="ratings"><span class="checkmark1"></span><span class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star mrgn_rgt"></i><i class="icon_star mrgn_rgt"></i><i class="icon_star mrgn_rgt"></i>
				</span></label></li>
				<li><label class="checkb"><input type="checkbox" name="ratings[]" value="1" class="ratings"><span class="checkmark1"></span><span class="rating"><i class="icon_star voted"></i><i class="icon_star mrgn_rgt"></i><i class="icon_star mrgn_rgt"></i><i class="icon_star mrgn_rgt"></i><i class="icon_star mrgn_rgt"></i>
				</span></label></li>
			</ul>
		</div> 
		</form>
		<!--<form id="price_filter" method="post">
		<div class="filter_type">
			<h6>Budget</h6>
			<ul>
			<li><label class="containerR"><i class="icon-rupee"></i>
			  <input type="checkbox" name="price_filt[]" value="1" class="price_filt">
			  <span class="checkmarkR"></span>
			</label></li>
			<li><label class="containerR"><span class="icon-rupee"></span><span class="icon-rupee"></span>
			  <input type="checkbox" name="price_filt[]" value="2" class="price_filt">
			  <span class="checkmarkR"></span>
			</label></li>
			<li><label class="containerR"><span class="icon-rupee"></span><span class="icon-rupee"></span><span class="icon-rupee"></span>
			  <input type="checkbox" name="price_filt[]" value="3" class="price_filt">
			  <span class="checkmarkR"></span>
			</label></li>
			<li><label class="containerR"><span class="icon-rupee"></span><span class="icon-rupee"></span><span class="icon-rupee"></span><span class="icon-rupee"></span>
			  <input type="checkbox" name="price_filt[]" value="4" class="price_filt">
			  <span class="checkmarkR"></span>
			</label></li>
			</ul>
			<ul class="nomargin">
                <li><label class=""><div class="icheckbox_square-grey" style="position: relative;"><input class="price_filt" style="position: absolute; opacity: 0;" type="checkbox" name="price_filt[]" value="1"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div><i class="icon-rupee"></i></label></li>
				
                <li><label class=""><div class="icheckbox_square-grey" style="position: relative;"><input class="price_filt" style="position: absolute; opacity: 0;" type="checkbox" name="price_filt[]" value="2"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div><i class="icon-rupee"></i><i class="icon-rupee"></i></label></li>
                <li><label class=""><div class="icheckbox_square-grey" style="position: relative;"><input class="price_filt" style="position: absolute; opacity: 0;" type="checkbox" name="price_filt[]" value="3"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div><i class="icon-rupee"></i><i class="icon-rupee"></i><i class="icon-rupee"></i></label></li>
                <li><label class=""><div class="icheckbox_square-grey" style="position: relative;"><input class="price_filt" style="position: absolute; opacity: 0;" type="checkbox" name="price_filt[]" value="4"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div><i class="icon-rupee"></i><i class="icon-rupee"></i><i class="icon-rupee"></i><i class="icon-rupee"></i></label></li>
			</ul>
		</div>
		</form> -->

	</div><!--End collapse -->
</div><!--End filters col-->
