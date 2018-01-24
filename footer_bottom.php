
<div class="container">

<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>

				<div class="row">
					<div class="col-md-12">
						<p class="copyright"> <?php echo $getSiteSettingsData1['footer_text']; ?></p>
						<p class="btn-scroll">
							<a href="#" title="">
								<img src="images/icons/top.png" alt="">
							</a>
						</p>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->