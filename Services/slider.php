    <div id="layerslider" style="width:100%;height:400px;">
<?php  
	$getBanners = getBanners();      
?>
	<!-- first slide -->
	<?php while($getBannerData = $getBanners->fetch_assoc()) { ?>
		<?php if($getBannerData['lkp_banner_type_id']==1) { ?>
			<a href='sub_categories.php?key=<?php echo encryptPassword($getBannerData['service_category_id'])?>'>
		<?php } ?>
		<div class="ls-slide" data-ls="slidedelay: 1500; transition2d:5;">
			<img src="<?php echo $base_url . 'uploads/services_banner_images/'.$getBannerData['banner'] ?>" class="ls-bg" alt="<?php echo $getBannerData['title'];?>">
		</div>
		<?php if($getBannerData['lkp_banner_type_id']==1) { ?>
			</a>
		<?php } ?>
	<?php } ?>

</div>