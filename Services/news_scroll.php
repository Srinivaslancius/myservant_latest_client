
				<div class="container1" style="height:40px">
				<div class="marquee-sibling">
					Latest News
				</div>
				<div class="marquee">
					<ul class="marquee-content-items">
						<?php while($getServiceNewsFeed = $getAllServiceNewsFeedData->fetch_assoc()) {  ?>
						<a href="<?php echo $getServiceNewsFeed['news_feed_url']; ?>" target= "_blank"><li><?php echo $getServiceNewsFeed['title'];?></li></a>
						<?php } ?>
					</ul>
				</div>
			</div>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
				<script type="text/javascript" src="js/marquee.js"></script>
				<script>
					$(function (){

						createMarquee({
						});

						//example of overwriting defaults: 
						
						// createMarquee({
						// 		duration:30000, 
						// 		padding:20, 
						// 		marquee_class:'.example-marquee', 
						// 		container_class: '.example-container', 
						// 		sibling_class: '.example-sibling', 
						// 		hover: false});
						// });
					});

				</script>