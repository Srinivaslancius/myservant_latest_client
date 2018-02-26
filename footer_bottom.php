
<div class="container">


<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>

				<div class="row">
					<div class="col-md-12">
						<p class="copyright"> <?php echo $getSiteSettingsData1['footer_text']; ?></p>
						<p class="pull-right">
							Designed and developed by <a href="https://www.lanciussolutions.com" target="_blank"> Lancius IT Solutions</a>.
						</p>
						
						<a id="back-to-top" href="javascript:void(0)" class="btn btn-default btn-sm back-to-top pull-right" role="button"style="background: #333;border-color:#333"><img  title="Scroll To Top" src="images/ic_back_to_top.png"></span></a>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
			<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
			<script>
$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});
</script>