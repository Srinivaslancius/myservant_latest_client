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
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								Reward Points
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
     		<?php
     		$user_id = $_SESSION['user_login_session_id'];
     		$getRewards1 = "SELECT * FROM grocery_reward_transactions WHERE user_id = '$user_id' ";
     		$getRewards = $conn->query($getRewards1);
     		while ($getRewards1 = $getRewards->fetch_assoc()) {
     			$credit_reward_points += $getRewards1['credit_reward_points'];
     			$debit_reward_points += $getRewards1['debit_reward_points'];
     		}
     		$totalRewards = $credit_reward_points - $debit_reward_points;
     		$getRewardAmount = getIndividualDetails('grocery_reward_points','id',1);
     		?>
          	<div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="nomargin_top" style="color:#fe6003;">Reward Points</h3>
                </div>
              	<div class="panel-body">
				  	<div class="row" style="padding:10px 60px 50px 60px">
						<div class="col-sm-4">
							<h4 style="margin-left:10px;color:#fe6003">Rewards</h4><br>
							<a href="" class="notif"><span class="badge1"><?php echo round($totalRewards); ?></span></a>
						</div>
						<div class="col-sm-4">
							<h4 style="color:#fe6003;color:#fe6003">For Rewards</h4><br>
							<a href="" class="notif1"><span class="badge1"><?php echo $getRewardAmount['for_reward_points']; ?></span></a>
						</div>
						<div class="col-sm-4">
							<h4 style="margin-left:20px;color:#fe6003">Total</h4><br>
							<a href="" class="notif2"><span class="badge1"><?php echo $getRewardAmount['amount_credits']; ?></span></a>
						</div>
                 	</div>
                 	<div class="row">
					<div class="col-sm-4">
					</div>
					<?php if($totalRewards > 0) { ?>
					<div class="col-sm-4">
						<a href="convert_reward_points.php"><button class="button1" type="submit" name="" title="" style="padding: 2px 20px;">Convert Rewards into Amount</button></a>
					</div>
					<?php } ?>
					<div class="col-sm-4">
					</div>                 		
                 	</div>
            		<!-- <div class="table-responsive">						
    					<table class="table" style="border:1px solid #ddd;width:100%">					
        					<thead>
        		  				<tr>
        							<th>ORDER ID</th>
        							<th>PRODUCTS</th>
			            			<th>SOMTHING</th>
			            			<th>REWARD GAME</th>						
        		  				</tr>
        					</thead>
        					<tbody>
        		  				<tr>
			            			<td>Somthing</td>
			            			<td>Somthing</td>
			            			<td>Somthing</td>
			            			<td>Somthing</td>
        		  				</tr>
        					</tbody>
    	     			</table>
    	  			</div> -->
              	</div>
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
<?php include "search_js_script.php"; ?>
</body>	
</html>