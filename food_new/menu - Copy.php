
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- Radio and check inputs -->
    <link href="css/skins/square/grey.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	<div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->

    <!-- Header ================================================== -->
    <header>
        <?php include_once 'header.php';?>
    </header>
    <!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" data-parallax="scroll" data-image-src="img/sub_header_2.jpg" data-natural-width="1400" data-natural-height="470">
    <div id="subheader">
	<div id="sub_content">
    	<div id="thumb"><img src="img/thumb_restaurant.jpg" alt=""></div>
                     <div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#">Read 98 reviews</a></small>)</div>
                    <h1>Mexican TacoMex</h1>
                    <div><em>Mexican / American</em></div>
                    <div><i class="icon_pin"></i> Address will be display here - <strong>Delivery charge:</strong> Rs. 10, free over Rs.500.</div>
    </div><!-- End sub_content -->
</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="#0">Home</a></li>
                <li><a href="#0">Category</a></li>
                <li>Page active</li>
            </ul>
            
        </div>
    </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
		<div class="row">
        
			<div class="col-md-3">
                            <p><a href="list.php" class="btn_side">Back to search</a></p>
				<div class="box_style_1">
					<ul id="cat_nav">
						<li><a href="#starters" class="active">Starters <span>(141)</span></a></li>
						<li><a href="#main_courses">Main Courses <span>(20)</span></a></li>
						<li><a href="#beef">Beef <span>(12)</span></a></li>
						<li><a href="#desserts">Desserts <span>(11)</span></a></li>
						<li><a href="#drinks">Drinks <span>(20)</span></a></li>
					</ul>
				</div><!-- End box_style_1 -->
                
				<div class="box_style_2 hidden-xs" id="help">
					<i class="icon_lifesaver"></i>
					<h4>Need <span>Help?</span></h4>
					<a href="tel://004542344599" class="phone">+91- 999 999 9999</a>
					<small>Monday to Friday 9.00am - 7.30pm</small>
				</div>
			</div><!-- End col-md-3 -->
            
			<div class="col-md-6">
				<div class="box_style_2" id="main_menu">
                                    <h2 class="inner">Menu <span class="pull-right"><label style="color: #fff;"><input name="mobile" type="checkbox" value="" class="icheck">Veg </label></span></h2>
					<h3 class="nomargin_top" id="starters">Starters</h3>
					<p>
						Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro. Fuisset mentitum deleniti sit ea.
					</p>
					<table class="table table-striped cart-list">
					<thead>
					<tr>
						<th>
							 Item
						</th>
						<th>
							 Price
						</th>
						<th>
							 Order
						</th>
					</tr>
					</thead>
					<tbody>
                                            <?php for($i=0; $i<3; $i++) {?>
					<tr>
						<td>
                        	<figure class="thumb_menu_list"><img src="img/menu-thumb-1.jpg" alt="thumb"></figure>
							<h5>1. Mexican Enchiladas</h5>
							<p>
								Fuisset mentitum deleniti sit ea.
							</p>
						</td>
						<td>
							<strong>Rs. 150</strong>
						</td>
						<td class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                            <div class="dropdown-menu">
                                <h5>Select an option</h5>
                                <label>
                                <input type="radio" value="option1" name="options_1" checked>Medium <span>+ $3.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option2" name="options_1" >Large <span>+ $5.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option3" name="options_1" >Extra Large <span>+ $8.30</span>
                                </label>
                                <h5>Add ingredients</h5>
                                <label>
                                <input type="checkbox" value="">Extra Tomato <span>+ $4.30</span>
                                </label>
                                <label>
                                <input type="checkbox" value="">Extra Peppers <span>+ $2.50</span>
                                </label>
                                <a href="#0" class="add_to_basket">Add to cart</a>
                            </div>
                        </div>
                    </td>
					</tr>
                                            <?php } ?>
					</tbody>
					</table>
					<hr>
					<h3 id="main_courses">Main courses</h3>
					<p>
						Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro. Fuisset mentitum deleniti sit ea.
					</p>
					<table class="table table-striped cart-list ">
					<thead>
					<tr>
						<th>
							 Item
						</th>
						<th>
							 Price
						</th>
						<th>
							 Order
						</th>
					</tr>
					</thead>
					<tbody>
                                            <?php for($i=0; $i<3; $i++) {?>
					<tr>
						<td>
                        	<figure class="thumb_menu_list"><img src="img/menu-thumb-1.jpg" alt="thumb"></figure>
							<h5>1. Mexican Enchiladas</h5>
							<p>
								Fuisset mentitum deleniti sit ea.
							</p>
						</td>
						<td>
							<strong>Rs. 150</strong>
						</td>
						<td class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                            <div class="dropdown-menu">
                                <h5>Select an option</h5>
                                <label>
                                <input type="radio" value="option1" name="options_1" checked>Medium <span>+ $3.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option2" name="options_1" >Large <span>+ $5.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option3" name="options_1" >Extra Large <span>+ $8.30</span>
                                </label>
                                <h5>Add ingredients</h5>
                                <label>
                                <input type="checkbox" value="">Extra Tomato <span>+ $4.30</span>
                                </label>
                                <label>
                                <input type="checkbox" value="">Extra Peppers <span>+ $2.50</span>
                                </label>
                                <a href="#0" class="add_to_basket">Add to cart</a>
                            </div>
                        </div>
                    </td>
					</tr>
                                            <?php } ?>
					</tbody>
					</table>
					<hr>
					<h3 id="beef">Beef</h3>
					<p>
						Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro. Fuisset mentitum deleniti sit ea.
					</p>
					<table class="table table-striped cart-list ">
					<thead>
					<tr>
						<th>
							 Item
						</th>
						<th>
							 Price
						</th>
						<th>
							 Order
						</th>
					</tr>
					</thead>
					<tbody>
                                            <?php for($i=0; $i<3; $i++) {?>
					<tr>
						<td>
                        	<figure class="thumb_menu_list"><img src="img/menu-thumb-1.jpg" alt="thumb"></figure>
							<h5>1. Mexican Enchiladas</h5>
							<p>
								Fuisset mentitum deleniti sit ea.
							</p>
						</td>
						<td>
							<strong>Rs. 150</strong>
						</td>
						<td class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                            <div class="dropdown-menu">
                                <h5>Select an option</h5>
                                <label>
                                <input type="radio" value="option1" name="options_1" checked>Medium <span>+ $3.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option2" name="options_1" >Large <span>+ $5.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option3" name="options_1" >Extra Large <span>+ $8.30</span>
                                </label>
                                <h5>Add ingredients</h5>
                                <label>
                                <input type="checkbox" value="">Extra Tomato <span>+ $4.30</span>
                                </label>
                                <label>
                                <input type="checkbox" value="">Extra Peppers <span>+ $2.50</span>
                                </label>
                                <a href="#0" class="add_to_basket">Add to cart</a>
                            </div>
                        </div>
                    </td>
					</tr>
                                            <?php } ?>
					</tbody>
					</table>
					<hr>
					<h3 id="desserts">Desserts</h3>
					<p>
						Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro. Fuisset mentitum deleniti sit ea.
					</p>
					<table class="table table-striped cart-list ">
					<thead>
					<tr>
						<th>
							 Item
						</th>
						<th>
							 Price
						</th>
						<th>
							 Order
						</th>
					</tr>
					</thead>
					<tbody>
                                            <?php for($i=0; $i<3; $i++) {?>
					<tr>
						<td>
                        	<figure class="thumb_menu_list"><img src="img/menu-thumb-1.jpg" alt="thumb"></figure>
							<h5>1. Mexican Enchiladas</h5>
							<p>
								Fuisset mentitum deleniti sit ea.
							</p>
						</td>
						<td>
							<strong>Rs. 150</strong>
						</td>
						<td class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                            <div class="dropdown-menu">
                                <h5>Select an option</h5>
                                <label>
                                <input type="radio" value="option1" name="options_1" checked>Medium <span>+ $3.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option2" name="options_1" >Large <span>+ $5.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option3" name="options_1" >Extra Large <span>+ $8.30</span>
                                </label>
                                <h5>Add ingredients</h5>
                                <label>
                                <input type="checkbox" value="">Extra Tomato <span>+ Rs. 4.30</span>
                                </label>
                                <label>
                                <input type="checkbox" value="">Extra Peppers <span>+ Rs. 2.50</span>
                                </label>
                                <a href="#0" class="add_to_basket">Add to cart</a>
                            </div>
                        </div>
                    </td>
					</tr>
                                            <?php } ?>
					</tbody>
					</table>
					<hr>
					<h3 id="drinks">Drinks</h3>
					<p>
						Te ferri iisque aliquando pro, posse nonumes efficiantur in cum. Sensibus reprimique eu pro. Fuisset mentitum deleniti sit ea.
					</p>
					<table class="table table-striped cart-list ">
					<thead>
					<tr>
						<th>
							 Item
						</th>
						<th>
							 Price
						</th>
						<th>
							 Order
						</th>
					</tr>
					</thead>
					<tbody>
                                            <?php for($i=0; $i<3; $i++) {?>
					<tr>
						<td>
                        	<figure class="thumb_menu_list"><img src="img/menu-thumb-1.jpg" alt="thumb"></figure>
							<h5>1. Mexican Enchiladas</h5>
							<p>
								Fuisset mentitum deleniti sit ea.
							</p>
						</td>
						<td>
							<strong>Rs. 150</strong>
						</td>
						<td class="options">
                        <div class="dropdown dropdown-options">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                            <div class="dropdown-menu">
                                <h5>Select an option</h5>
                                <label>
                                <input type="radio" value="option1" name="options_1" checked>Medium <span>+ Rs. 3.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option2" name="options_1" >Large <span>+ Rs. 5.30</span>
                                </label>
                                <label>
                                <input type="radio" value="option3" name="options_1" >Extra Large <span>+ Rs. 8.30</span>
                                </label>
                                <h5>Add ingredients</h5>
                                <label>
                                <input type="checkbox" value="">Extra Tomato <span>+ Rs. 4.30</span>
                                </label>
                                <label>
                                <input type="checkbox" value="">Extra Peppers <span>+ Rs. 2.50</span>
                                </label>
                                <a href="#0" class="add_to_basket">Add to cart</a>
                            </div>
                        </div>
                    </td>
					</tr>
                                            <?php } ?>
					</tbody>
					</table>
				</div><!-- End box_style_1 -->
			</div><!-- End col-md-6 -->
            
			<div class="col-md-3" id="sidebar">
            <div class="theiaStickySidebar">
				<div id="cart_box" >
					<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
					<table class="table table_summary">
					<tbody>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> Enchiladas
						</td>
						<td>
							<strong class="pull-right">Rs. 11</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> Burrito
						</td>
						<td>
							<strong class="pull-right">Rs. 14</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> Chicken
						</td>
						<td>
							<strong class="pull-right">Rs. 20</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> Corona Beer
						</td>
						<td>
							<strong class="pull-right">Rs. 9</strong>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#0" class="remove_item"><i class="icon_plus_alt"></i></a> <strong>1x</strong> <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> Cheese Cake
						</td>
						<td>
							<strong class="pull-right">Rs. 12</strong>
						</td>
					</tr>
					</tbody>
					</table>
					<hr>
					<div class="row" id="options_2">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><input type="radio" value="" checked name="option_2" class="icheck">Delivery</label>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><input type="radio" value="" name="option_2" class="icheck">Take Away</label>
						</div>
					</div><!-- Edn options 2 -->
                    
					<hr>
					<table class="table table_summary">
					<tbody>
					<tr>
						<td>
							 Subtotal <span class="pull-right">Rs. 56</span>
						</td>
					</tr>
					<tr>
						<td>
							 Delivery fee <span class="pull-right">Rs. 10</span>
						</td>
					</tr>
					<tr>
						<td class="total">
							 TOTAL <span class="pull-right">Rs. 66</span>
						</td>
					</tr>
					</tbody>
					</table>
					<hr>
					<a class="btn_full" href="cart.php">Order now</a>
				</div><!-- End cart_box -->
                </div><!-- End theiaStickySidebar -->
			</div><!-- End col-md-3 -->
            
		</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
    <footer>
        <?php include_once 'footer.php';?>
    </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->
    
<!-- Login modal -->   
<div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<form action="#" class="popup-form" id="myLogin">
                	<div class="login_icon"><i class="icon_lock_alt"></i></div>
					<input type="text" class="form-control form-white" placeholder="Username">
					<input type="text" class="form-control form-white" placeholder="Password">
					<div class="text-left">
						<a href="#">Forgot Password?</a>
					</div>
					<button type="submit" class="btn btn-submit">Submit</button>
				</form>
			</div>
		</div>
	</div><!-- End modal -->   
    
<!-- Register modal -->   
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<form action="#" class="popup-form" id="myRegister">
                	<div class="login_icon"><i class="icon_lock_alt"></i></div>
					<input type="text" class="form-control form-white" placeholder="Name">
					<input type="text" class="form-control form-white" placeholder="Last Name">
                    <input type="email" class="form-control form-white" placeholder="Email">
                    <input type="text" class="form-control form-white" placeholder="Password"  id="password1">
                    <input type="text" class="form-control form-white" placeholder="Confirm password"  id="password2">
                    <div id="pass-info" class="clearfix"></div>
					<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="accept_2" id="check_2" name="check_2" />
							<label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
						</div>
					</div>
					<button type="submit" class="btn btn-submit">Register</button>
				</form>
			</div>
		</div>
	</div><!-- End Register modal -->
    
    <!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>
	</div>
	<!-- End Search Menu -->
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script  src="js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<script>
$('#cat_nav a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top - 70
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});
</script>

</body>
</html>