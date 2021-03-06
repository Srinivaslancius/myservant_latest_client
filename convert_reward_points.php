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
     		<?php $user_id = $_SESSION['user_login_session_id'];
     		$getRewards1 = "SELECT * FROM grocery_reward_transactions WHERE user_id = '$user_id' ";
     		$getRewards = $conn->query($getRewards1);
     		while ($getRewards1 = $getRewards->fetch_assoc()) {
     			$credit_reward_points += $getRewards1['credit_reward_points'];
     			$debit_reward_points += $getRewards1['debit_reward_points'];
     		}
     		$totalRewards = $credit_reward_points - $debit_reward_points;
     		$getRewardAmount = getIndividualDetails('grocery_reward_points','id',1);
     		$conversionAmount = ($getRewardAmount['amount_credits']*round($totalRewards))/$getRewardAmount['for_reward_points'];
     		?>
     		<input type="hidden" id="conversion_amount" value="<?php echo $conversionAmount; ?>">
     		<input type="hidden" id="reward_points" value="<?php echo round($totalRewards); ?>">
          	<div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="nomargin_top" style="color:#fe6003;">Grocery Orders</h3>
                </div>
              	<div class="panel-body">
            		<div class="row">
					<div class="col-sm-4">
					</div>
						<div class="col-sm-6">
						<div class="row">
					<div class="col-sm-8">
					Total Reward Points
					</div>
					<div class="col-sm-4">
							<?php echo round($totalRewards); ?>
						</div>
							
							</div>
						</div>
						
					<div class="col-sm-2">
					</div>						
					</div>
					<div class="row">
					<div class="col-sm-4">
					</div>
						<div class="col-sm-6">
						<div class="row">
					<div class="col-sm-8">
						Conversion Amount
					</div>
						<div class="col-sm-4">
							Rs. <?php echo $conversionAmount; ?>
						</div>
						</div>
					</div>	
					<div class="col-sm-2">
					</div>							
					</div><br>
					<center><button class="button1" type="submit" name="convert" title="" style="padding: 2px 25px;">Add To Wallet</button></center>
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

		<script type="text/javascript">
        $(".button1").click(function(){
        	var conversionAmount = $("#conversion_amount").val();
        	var reward_points = $("#reward_points").val();
            if(confirm('Are You Sure You Want to Add in Your Wallet?', 'Message', function(input){var str = input === true ? 'Ok' : 'Cancel'; 
    if(str == 'Ok') {
                    $.ajax({
                       type: "POST",
                       url: "conver_amount.php",
                       data: {
				            conversionAmount:conversionAmount,reward_points:reward_points,
				        },
                       success: function(result){
                        if(result == 1) {	
                            alert('Amount Credited In Your Wallet');
                            window.location.href = "rewards.php";
                        } else {
                            alert('Amount not Credited In Your Wallet');
                            return false;
                        }
                     }
                    });
                }
            }))  
            return false;
        });
        </script>
        <?php include "search_js_script.php"; ?>
</body>	
</html>