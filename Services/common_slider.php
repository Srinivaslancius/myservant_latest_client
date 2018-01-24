   <div id="layerslider" style="width:100%;height:400px;">
<?php  
	$getBanners = getCommonBanners();      
?>
	<?php while($getBannerData = $getBanners->fetch_assoc()) { ?>
	<div class="ls-slide" data-ls="slidedelay: 1500; transition2d:5;">
			<img src="<?php echo $base_url . 'uploads/services_banner_images/'.$getBannerData['banner'] ?>" style="width:100%; height:400px;" class="ls-bg" alt="<?php echo $getBannerData['title'];?>" >
		</div>
	<?php } ?>
</div>