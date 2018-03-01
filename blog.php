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
									<a href="index.php" title="">Home</a>
									<span><img src="images/icons/arrow-right.png" alt=""></span>
								</li>
								<li class="trail-item">
									<a href="" title="">Blog</a>
									<!-- <span><img src="images/icons/arrow-right.png" alt=""></span> -->
								</li>
								<!-- <li class="trail-end">
									<a href="#" title="">Sample heading</a>
								</li> -->
							</ul><!-- /.breacrumbs -->
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.flat-breadcrumb -->

			<section class="main-blog">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="post-wrap style2">
								<?php $getBlogData = getAllDataWithStatus('grocery_blog',0); ?>

							<?php while($getBlog = $getBlogData->fetch_assoc()) {?>
								<article class="main-post style2">
									<div class="featured-post">
										<a href="blog-single.php?id=<?php echo $getBlog['id']; ?>" title="">
											<img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_blog/'.$getBlog['image']; ?>" alt="">
										</a>
									</div><!-- /.featured-post -->
									<div class="divider26"></div>
									<div class="content-post">
										<h3 class="title-post">
											<a href="blog-single.php?id=<?php echo $getBlog['id']; ?>" title=""><?php echo $getBlog['title']; ?></a>
										</h3>
										<ul class="meta-post">
											<!-- <li class="comment">
												<a href="#" title="">
													2 Comments
												</a>
											</li> -->
											<li class="date">
												<a href="" title="">
													<?php echo $getBlog['created_at']; ?>
												</a>
											</li>
										</ul>
										<div class="entry-post">
											<p><?php echo substr(strip_tags($getBlog['short_description']), 0,300);?></p>
											<div class="more-link">
												<a href="blog-single.php?id=<?php echo $getBlog['id']; ?>" title="">Read More
													<span>
														<img src="images/icons/right-2.png" alt="">
													</span>
												</a>
											</div>
										</div>
									</div><!-- /.content-post -->
								</article><!-- /.main-post style2 -->
								<?php } ?>
								
								<div class="clearfix"></div>
							</div><!-- /.post-wrap style2 -->
							<!-- <div class="blog-pagination style3">
								<ul class="flat-pagination">
									<li class="prev">
										<a href="#" title="">
											<img src="images/icons/left-1.png" alt="">Prev Page
										</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">01</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">02</a>
									</li>
									<li class="active">
										<a href="#" class="waves-effect" title="">03</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">04</a>
									</li>
									<li class="next">
										<a href="#" title="">
											Next Page<img src="images/icons/right-1.png" alt="">
										</a>
									</li>
								</ul><!-- /.flat-pagination -->
							</div><!-- /.blog-pagination style3 -->
						</div><!-- /.col-md-8 col-lg-9 -->
						<div class="col-md-4 col-lg-3">
						
						</div><!-- /.col-md-4 col-lg-3 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section><!-- /.main-blog -->
			<section class="main-blog">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<div class="post-wrap style2">
							<?php for($i=0; $i<6; $i++) {?>
								<article class="main-post style2">
									<div class="featured-post">
										<a href="blog-single.php" title="">
											<img src="images/blog/05.jpg" alt="">
										</a>
									</div><!-- /.featured-post -->
									<div class="divider26"></div>
									<div class="content-post">
										<h3 class="title-post">
											<a href="blog-single.php" title="">There are many variations of passages</a>
										</h3>
										<ul class="meta-post">
											<li class="comment">
												<a href="#" title="">
													2 Comments
												</a>
											</li>
											<li class="date">
												<a href="#" title="">
													February 20, 2017
												</a>
											</li>
										</ul>
										<div class="entry-post">
											<p>This is a Rebel that surrendered to us. Although he denies it, I believe there may be more of them, and I request permission to conduct a further search of the area. He was armed only with this.</p>
											<div class="more-link">
												<a href="blog-single.php" title="">Read More
													<span>
														<img src="images/icons/right-2.png" alt="">
													</span>
												</a>
											</div>
										</div>
									</div><!-- /.content-post -->
								</article><!-- /.main-post style2 -->
								<?php } ?>
								
								<div class="clearfix"></div>
							</div><!-- /.post-wrap style2 -->
							<div class="blog-pagination style3">
								<ul class="flat-pagination">
									<li class="prev">
										<a href="#" title="">
											<img src="images/icons/left-1.png" alt="">Prev Page
										</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">01</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">02</a>
									</li>
									<li class="active">
										<a href="#" class="waves-effect" title="">03</a>
									</li>
									<li>
										<a href="#" class="waves-effect" title="">04</a>
									</li>
									<li class="next">
										<a href="#" title="">
											Next Page<img src="images/icons/right-1.png" alt="">
										</a>
									</li>
								</ul><!-- /.flat-pagination -->
							</div><!-- /.blog-pagination style3 -->
						</div><!-- /.col-md-8 col-lg-9 -->
						<div class="col-md-4 col-lg-3">
						
						</div><!-- /.col-md-4 col-lg-3 -->
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
<script type="text/javascript" src="javascript/jquery.zoom.min.js"></script>
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
	    
	</body>	
</html>