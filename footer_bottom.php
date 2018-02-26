
<div class="container">

<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>

				<div class="row">
					<div class="col-md-12">
						<p class="copyright"> <?php echo $getSiteSettingsData1['footer_text']; ?></p>
						<!--<p class="btn-scroll">
							<a href="#" title="">
								<img src="images/icons/top.png" alt="">
							</a>
						</p>-->
						<div align = "right">
						<a href="javascript:;" id="scrollToTop" title="Scroll To Top"><img src="images/icons/top.png"></a>
						</div>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
			<script type = "text/javascript">
        $(function () {
            $('#scrollToBottom').bind("click", function () {
                $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                return false;
            });
            $('#scrollToTop').bind("click", function () {
                $('html, body').animate({ scrollTop: 0 }, 1200);
                return false;
            });
        });
    </script>