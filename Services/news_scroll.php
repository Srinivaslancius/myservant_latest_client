 <div class="row">
                	
					<marquee scrollamount="10" style="color:white;font-size:15px">
					<?php while($getServiceNewsFeed = $getAllServiceNewsFeedData->fetch_assoc()) {  ?><span><a href="<?php echo $getServiceNewsFeed['news_feed_url']; ?>" target= "_blank" style="color:white;"><?php echo $getServiceNewsFeed['title'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  } ?>
					</marquee> 
					 
                </div>