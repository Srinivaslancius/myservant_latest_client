<div>
	<div class="container">
		<div class="banner colored">
			<h4>Are You  <span>Professional</span> Looking to grow your service Business</h4>
			<a href="service_provider.php" class="btn_1 white">Join With Us</a>
		</div>				
		<!-- End row -->
	</div>
	<!-- End container -->
</div>
<!-- End white_bg -->
	<?php 	$getPremiumServicesData = getAllDataWhere('services_content_pages','id',2);
		  	$getPremiumServices = $getPremiumServicesData->fetch_assoc();
	?>
<div class="container margin_60">
	<div class="main_title">
		<h2>Some <span>good</span> reasons</h2>		
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-4 wow zoomIn" data-wow-delay="0.2s">
			<div class="feature_home prdct">
				<i class="icon_set_1_icon-41"></i>
				<h3><span><?php echo $getPremiumServices['title'];?></span></h3>
				<p><?php echo substr(strip_tags($getPremiumServices['description']), 0,200);?></p>
				<center><a href="content_details.php?key=<?php echo encryptPassword(2) ?>" class="btn_1 outline">Read more</a></center>
			</div>
		</div>
		<?php 	$getCustomersData = getAllDataWhere('services_content_pages','id',3);
		  		$getCustomers = $getCustomersData->fetch_assoc();
		?>
		<div class="col-md-4 col-sm-4 wow zoomIn" data-wow-delay="0.4s">
			<div class="feature_home prdct">
				<i class="icon_set_1_icon-30"></i>
				<h3><span><?php echo $getCustomers['title'];?></span></h3>
				<p><?php echo substr(strip_tags($getCustomers['description']), 0,200);?></p>
				<center><a href="content_details.php?key=<?php echo encryptPassword(3) ?>" class="btn_1 outline">Read more</a></center>
			</div>
		</div>
		<?php 	$getSupportData = getAllDataWhere('services_content_pages','id',4);
		  		$getSupport = $getSupportData->fetch_assoc();
		?>
		<div class="col-md-4 col-sm-4 wow zoomIn" data-wow-delay="0.6s">
			<div class="feature_home prdct">
				<i class="icon_set_1_icon-57"></i>
				<h3><span><?php echo $getSupport['title'];?></span></h3>
				<p><?php echo substr(strip_tags($getSupport['description']), 0,200);?></p>
				<center><a href="content_details.php?key=<?php echo encryptPassword(4) ?>" class="btn_1 outline">Read more</a></center>
			</div>
		</div>
	</div>
	<!--End row -->
</div>

