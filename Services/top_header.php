<?php
include_once('../admin_includes/common_functions.php');
$getAvailableLocations = getIndividualDetails('lkp_cities','id',$_SESSION['lkp_city_id']);
if($_SESSION['lkp_city_id'] != '') {
	$city_name = $getAvailableLocations['city_name'];
} else {
	$city_name = "Vijayawada";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div id="top_line">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-3">
					<ul id="top_links">

					 <li><span class="icon-location" id="city" style="cursor:pointer"><?php echo $city_name; ?></span></li>

					 <li><form>
					 <select class="language" style="cursor:pointer">
			            <option value="" style="color:black">English</option>
			            <option value="" style="color:black">Hindi</option>
			            <option value="" style="color:black">Telugu</option>
			        </select>
					</form></li>
					</ul>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
					</div>
					<div class="col-md-5 col-sm-5 col-xs-5">
						<ul id="top_links">
						<i class="icon-phone"></i><a href="Tel:<?php echo $getSiteSettingsData['mobile']; ?>"><?php echo $getSiteSettingsData['mobile']; ?></a>
							<li>
								<?php if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') { ?>
									<a href="my_account.php"><?php echo $_SESSION['user_login_session_name']; ?> </a> &nbsp;|&nbsp;<a href="logout.php"> Logout </a>
								<?php } else { ?>
					                <a href="login.php" >Sign in</a>
					        </li>
                            <li><a href="login.php" id="access_link">Register</a></li>
								<?php } ?>
						</ul>
					</div>
					<div class="col-md-1 col-sm-1 col-xs-1">
					</div>
				</div>
				<!-- End row -->
			</div>
			<!-- End container-->
		</div>
		
		
<script type="text/javascript">
	$('#city').on('click', function(){
	 	window.location = "index.php?key=<?php echo $_SESSION['lkp_city_id'] ?>";
	}); 
</script>
<script type="text/javascript">
$(".language").change(function(){
	window.location = "index.php";   
});
</script>