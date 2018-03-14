<?php include_once 'meta.php';?>
<style>
.queue .fa{
	padding:0px;
	display: inline;
}
.entry-post p{
	text-align:justify !important;
}
</style>
	<body class="header_sticky">
		<div class="boxed">

			<div class="overlay"></div>

			<!-- Preloader -->
			<div class="preloader">
				<div class="clear-loading loading-effect-2">
					<span></span>
				</div>
			</div><!-- /.preloader -->

			<section id="header" class="header">
			<div class="header-top">
			<?php include_once 'top_header.php';?>
			</div><!-- /.header-top -->
			<div class="header-middle">
			<?php include_once 'middle_header.php';?>
			</div><!-- /.header-middle -->
			<div class="header-bottom">
			<?php include_once 'bottom_header.php';?>
			</div><!-- /.header-bottom -->
		</section><!-- /#header -->
		
			<section class="flat-breadcrumb">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul class="breadcrumbs">
								<li class="trail-item">
									<a href="<?php echo $base_url; ?>" title="">Home</a>
									<span><img src="images/icons/arrow-right.png" alt=""></span>
								</li>
								<li class="trail-item">
									<a href="blog.php" title="">Blog</a>
									<span><img src="images/icons/arrow-right.png" alt=""></span>
								</li>
								<li class="trail-end">
									<a href="" title="">Blog-detail</a>
								</li>
							</ul><!-- /.breacrumbs -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-breadcrumb -->
<?php 
        $id = $_GET['id'];
        $getAllGroceryBlogData ="SELECT * FROM grocery_blog WHERE id='$id' ";
        $getAllGroceryBlog = $conn->query($getAllGroceryBlogData);
        ?>  
        <?php $getBlog = $getAllGroceryBlog->fetch_assoc(); ?>
			<section class="main-blog">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="post-wrap">
								<article class="main-post single">
									<div class="featured-post">
										<a href="" title="">
											<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_blog/'.$getBlog['image']; ?>" alt="<?php echo $getBlog['title']; ?>">
										</a>
									</div><!-- /.featured-post -->
									<div class="divider25"></div>
									<div class="content-post">
										<h3 class="title-post">
											<a href="" title=""><?php echo $getBlog['title']; ?></a>
										</h3>
										<ul class="meta-post">
											<!-- <li class="comment">
												<a href="#" title="">
													1 Comment
												</a>
											</li> -->
											<li class="date">
												<a href="" title="">
													<?php echo $getBlog['created_at']; ?>
												</a>
											</li>
										</ul><!-- /.meta-post -->
										<div class="entry-post">
											<?php echo $getBlog['long_description']; ?>
										</div><!-- /.entry-post -->
									</div><!-- /.content-post -->
								</article><!-- /.main-post single -->
							</div><!-- /.post-wrap -->
						</div>
						
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.main-blog -->
		<footer>
			<?php include_once 'footer.php';?>
		</footer><!-- /footer -->

		<section class="footer-bottom">
			<?php include_once 'footer_bottom.php';?>
		</section><!-- /.footer-bottom -->

		</div>

		<!-- Javascript -->
		<script type="text/javascript" src="javascript/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/tether.min.js"></script>
		<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
		<script type="text/javascript" src="javascript/waypoints.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.circlechart.js"></script>
		<script type="text/javascript" src="javascript/easing.js"></script>
		<script type="text/javascript" src="javascript/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="javascript/owl.carousel.js"></script>
		<script type="text/javascript" src="javascript/smoothscroll.js"></script>
		<script type="text/javascript" src="javascript/jquery-ui.js"></script>
		<script type="text/javascript" src="javascript/jquery.mCustomScrollbar.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="javascript/waves.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.countdown.js"></script>

		<script type="text/javascript" src="javascript/main.js"></script>
		<?php include "search_js_script.php"; ?>
	</body>	
</html>