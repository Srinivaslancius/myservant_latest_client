<?php include_once 'meta.php';?>
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
								<a href="terms&conditions.php" title="">My Addresses</a>
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<section class="flat-term-conditions">
			<div class="container">
				<div class="row">
    
    <div class="col-md-3 col-sm-3" id="sidebar">
    <aside>
           <div class="box_style_cat">
       		<?php include_once 'dashboard_strip.php';?>
            </div>
        </aside>   
     </div><!-- End col-md-3 -->
        
        <div class="col-sm-9">       	 
         
       	 
         <div class="panel-group">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="nomargin_top">My Addresses</h3>
                    </div>
					<!---start-->
                      <div class="panel-body one">
					  <div class="row">
					  <div class="col-sm-3">
					  </div>
					  <div class="col-sm-6">
						<center><img src="images/myaddress.png">
						<h4>No Addresses found in your account!</h4>
						<p>Add a delivery address.</p>
						<button class="button1">ADD ADDRESS</button></center>
						</div>
						<div class="col-sm-3">
					  </div>
					</div>
                      </div>
					  <!---end-->
					  <!---start-->
                      <div class="panel-body two">
					      <form method="post">
                  <div class="col-md-12">				 
				  <div class="col-md-9">
				  <div class="row">
				  <div class="col-sm-6">
					<div class="form-group">
						<label for="first-name">Name</label>
						<input type="text" class="form-control"  name="user_full_name" placeholder="Name" required>
					</div>
					</div>
					 <div class="col-sm-6">
					<div class="form-group">
						<label for="mobile">Mobile</label>
						<input type="text" class="form-control valid_mobile_num" name="user_mobile" placeholder="Mobile"required>
					<span id="input_status1" style="color: red;"></span>
					</div>
					</div>
					 <div class="col-sm-6">
					<div class="form-group">
						<label for="pincode">Pincode</label>
						<input type="text" class="form-control"  name="user_full_name" placeholder="pincode" required>
					</div>
					</div>
					 <div class="col-sm-6">
						<div class="form-group">
						<label for="locality">Locality</label>
						<input type="text" class="form-control"  name="user_full_name" placeholder="locality" required>
					</div>
					</div>
					 <div class="col-sm-12">
					<div class="form-group">
						 <label for="address">Address</label>
							<textarea class="form-control" rows="5" id="comment" style="border-radius:30px;height:48px"></textarea>
					</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
						<label for="City/District/Town">City/District/Town</label>
						<input type="text" class="form-control"  name="user_full_name" placeholder="locality" required>
					</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
						<label for="sel1">Select State</label>
					  <select class="form-control" id="sel1" style="border-radius:30px">
						<option>Select State</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					  </select></label>
					</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Landmark">Landmark</label>
						<input type="text" class="form-control"  name="user_full_name" placeholder="Landmark" required>
					</div>
					</div>
					 <div class="col-sm-6">
					<div class="form-group">
						<label for="mobile">Alternate Mobile</label>
						<input type="text" class="form-control valid_mobile_num" name="user_mobile" placeholder="Alternate Mobile"required>
					<span id="input_status1" style="color: red;"></span>
					</div>
					</div>
					</div>
					
					<div class="form-group">
						<button class="button1" type="submit" name="save" style="width:100px;font-size:18px">Save</button> 					
					</div>						
                  </div>
				  <div class="col-md-3">
				  </div>
                               
                   </div>        
          </form>
                      </div>
					  <!---end-->
                  </div>
                  
                </div><!-- End panel-group -->
            
        </div><!-- End col-md-9 -->
    </div><!-- End row -->
			</div><!-- /.container -->
		</section><!-- /.flat-term-conditions -->
<footer>
			<?php include_once 'footer.php';?>
		</footer><!-- /footer -->

		<section class="footer-bottom">
			<?php include_once 'footer_bottom.php';?>
		</section><!-- /.footer-bottom -->
	</div><!-- /.boxed -->

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
<script>
$(document).ready(function(){
	 $(".two").hide();
    $(".one").click(function(){
        $(".one").hide();
		$(".two").show();
    });
});
</script>
</body>	
</html>