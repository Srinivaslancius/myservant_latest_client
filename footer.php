<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>
<?php 
if(isset($_POST['refer_friend']) && !empty($_POST['refer_friend'])) {
	//echo "<pre>"; print_r($_POST); die;
	$refer_email = $_POST['refer_email'];
	$user_id = $_SESSION['user_login_session_id'];
	$string2 = str_shuffle('1234567890');
	$referal_code = substr($string2,0,5);
	$getEmail1 = "SELECT * FROM users WHERE user_email LIKE '$refer_email'";
	$getEmail = $conn->query($getEmail1);
	$getEmailDeatils = $getEmail->fetch_assoc();
	$created_at = date('Y-m-d H:i:s');
	if($getEmail->num_rows == 0) {
		$sql = "INSERT INTO grocery_refer_a_friend (`refered_user_id`,`refer_email_id`,`created_at`,`referal_code`) VALUES ('$user_id','$refer_email','$created_at','$referal_code')";
  		$result = $conn->query($sql);
  		if($result === TRUE) {
			$to = $refer_email;
			$subject = "Myservent - Refer a Friend";
			$message = '';		
			$message .= '<body>
				<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
				<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
				 <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
				</header>
				<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
				  	<h1 style="color:#fe6003">Welcome To Myservant</h1>
			  		<p>A very special welcome to you <span style="color:#fe6003;">'.$refer_email.'</span></p>
			  		<p>Your Friend <span style="color:#fe6003;">'.$getEmailDeatils['user_full_name'].' has reffered.</span></p>
			  		<p>Your Referal code <span style="color:#fe6003;">'.$referal_code.'.</span></p>
					<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
					<p>Warm Regards,<br>The Myservant Team </p>
				</article>
				<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
				</div>

				</body>';

			//echo $message; die;
			$name = "My Servant - Grocery";
			$from = $getSiteSettingsData1["from_email"];
			$resultEmail = sendEmail($to,$subject,$message,$from,$name);
			echo "<script>alert('Thank You. Your recommendation has been sent to $refer_email.');</script>";
		} else {
			echo "<script>alert('Sorry! There was a problem sending your recommendation.');</script>";
		}
	} else {
		echo "<script>alert('Sorry! You Cant refered this Mail.');</script>";
	}
}
?>
<div class="container">
	<div class="row" style="padding-bottom:30px">
		<div class="col-lg-3 col-md-3">
			<div class="widget-ft widget-categories-ft">
				<div class="widget-title">
					<h3>Myservant</h3>
				</div>
				<ul class="cat-list-ft">
					<li>
						<?php if($_SESSION['user_login_session_id'] =='') { ?>
							<a href="login.php" title="">Refer a friend</a>
						<?php } else { ?>
							<a href="javascript:void(0)" title="" id="myBtn">Refer a friend</a>
						<?php } ?>
					</li>
					<li>
						<a href="about.php" title="">About us</a>
					</li>
					<li>
						<a href="products.php" title="">Products</a>
					</li>
					<li>
						<a href="newarraivals.php" title="">New Arraivals</a>
					</li>
					<li>
						<a href="offerzone.php" title="">Offerzone</a>
					</li>
					<!-- <li>
						<a href="faq.php" title="">FAQ</a>
					</li> -->
					<li>
						<a href="contact.php" title="">Contact Us</a>
					</li>
					
				</ul><!-- /.cat-list-ft -->
			</div><!-- /.widget-categories-ft -->
		</div><!-- /.col-lg-3 col-md-6 -->
		
		<div class="col-lg-3 col-md-3">
			<div class="widget-ft widget-menu">
				<div class="widget-title">
					<h3>Customer Care</h3>
				</div>
				<ul>
					<li>
						<?php if($_SESSION['user_login_session_id'] =='') { ?>
							<a href="login.php" title="">
								My Account
							</a>
						<?php } else { ?>
							<a href="my_account.php" title="">
								My Account
							</a>
						<?php } ?>
					</li>
					<!-- <li>
						<a href="trackorder.php" title="">
							Track Order
						</a>
					</li> -->
					<li>
						<a href="faq.php" title="">
							Help Center
						</a>
					</li>
					<li>
						<a href="delivery_areas.php" title="">
							Delivery Areas
						</a>
					</li>
					<li>
						<a href="terms&conditions.php" title="">
						Terms & Conditions
						</a>
					</li>
					<li>
						<a href="return_policy.php" title="">
							Return Policy
						</a>
					</li>
				</ul>
			</div><!-- /.widget-menu -->
		</div><!-- /.col-lg-2 col-md-6 -->
		
		<div class="col-lg-3 col-md-3">
			<div class="widget-ft widget-menu">
				<div class="widget-title">
					<h3>Download Our App</h3>
				</div><br>
				<a href="<?php echo $getSiteSettingsData1['android_app_link'] ?>" target="_blank" title=""><img class="ftr_img" src="images/product/googleplay.png"style="margin-bottom:10px"></a>
				<a href="<?php echo $getSiteSettingsData1['apple_app_link'] ?>" target="_blank" title=""><img src="images/product/applestore.png" class="img-responsive"></a>
			</div><!-- /.widget-apps -->
		</div><!-- /.col-lg-4 col-md-6 -->
		<div class="col-lg-3 col-md-3">
			<div class="widget-ft widget-about">
				
					<div class="widget-title">
					<h3>Get Social With Us</h3>
				</div>
				
				<ul class="social-list">
					<li>
						<a href="<?php echo $getSiteSettingsData1['fb_link'] ?>" target="_blank" title="">
							<i class="fa fa-facebook" aria-hidden="true"style="font-size:20px;"></i>
						</a>
					</li>
					<li>
						<a href="<?php echo $getSiteSettingsData1['twitter_link'] ?>" target="_blank">
							<i class="fa fa-twitter" aria-hidden="true"style="font-size:20px;"></i>
						</a>
					</li>
					<li>
						<a href="<?php echo $getSiteSettingsData1['inst_link'] ?>" target="_blank">
							<i class="fa fa-instagram" aria-hidden="true"style="font-size:20px;"></i>
						</a>
					</li>
					<!--<li>
						<a href="#" title="">
							<i class="fa fa-pinterest" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="#" title="">
							<i class="fa fa-dribbble" aria-hidden="true"></i>
						</a>
					</li>-->
					<li>
						<a href="<?php echo $getSiteSettingsData1['gplus_link'] ?>" target="_blank">
							<i class="fa fa-google" aria-hidden="true" style="font-size:20px;"></i>
						</a>
					</li>
				</ul><!-- /.social-list -->
			</div><!-- /.widget-about -->
		</div><!-- /.col-lg-3 col-md-6 -->
	</div>
	<div class="txt_brdr" style="border-top:1px dotted #ccc">
		<?php 
		if($_SESSION['city_name'] == '') {
            $lkp_city_id = 1;
        } else {
            $getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_SESSION['city_name']);
			$lkp_city_id = $getCities1['id'];
        }
		$getCategories1 = "SELECT * FROM grocery_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_category_id FROM grocery_sub_category WHERE lkp_status_id = 0 AND id IN (SELECT grocery_sub_category_id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
		$getCategories = $conn->query($getCategories1); ?>
		<ul class="prdct_lst1">
			<div class="row">
				<div class="col-sm-2">
					<li style="color:#fe6003">POPULAR CATEGORIES :</li>
				</div>
				<div class="col-sm-10">
					<?php while($getCategoriesData = $getCategories->fetch_assoc()) { ?>
						<li><a href="results.php?cat_id=<?php echo $getCategoriesData['id']; ?>"><?php echo $getCategoriesData['category_name']; ?></a>,</li>
					<?php } ?>
				</div>
			</div>
		</ul>
		<?php								
		$getBrnds = "SELECT * FROM grocery_brands WHERE lkp_status_id = 0 AND id IN (SELECT brand_id FROM grocery_product_bind_brands WHERE product_id IN (SELECT id FROM grocery_products WHERE lkp_status_id = 0 AND id in (SELECT product_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0 AND lkp_city_id = $lkp_city_id))) ORDER BY id DESC";
		$getAllBrands = $conn->query($getBrnds);
    	?>
		<ul class="prdct_lst1">
			<div class="row">
				<div class="col-sm-2">
					<li style="color:#fe6003">POPULAR BRANDS :</li>
				</div>
				<div class="col-sm-10">
					<?php while($getAllBrandsNames = $getAllBrands->fetch_assoc() ) { ?>
						<li><a href="results.php?brand_id=<?php echo $getAllBrandsNames['id']; ?>"><?php echo $getAllBrandsNames['brand_name']; ?></a>,</li>
					<?php } ?>
				</div>
			</div>
		</ul>
		<ul class="prdct_lst1">
			<div class="row">
				<div class="col-sm-2">
					<li style="color:#fe6003">CITIES WE SERVE :</li>
				</div>
				<?php $getCities = getAllDataWhere('grocery_lkp_cities','lkp_status_id',0); ?>
				<div class="col-sm-10">
					<?php while ($row = $getCities->fetch_assoc()) { $city .= $row['city_name'].','; } ?>
					<li><?php echo rtrim(wordwrap($city,40,"<br />\n"),",");?></li>
				</div>
			</div>
		</ul>
		<ul class="prdct_lst">
			<div class="row">
				<div class="col-sm-2">
					<li style="color:#fe6003">PAYMENT OPTIONS :</li>
				</div>
				<div class="col-sm-10">
					<li>CASH ON<br>DELIVERY</li>
					<li><img src="images/product/visa.jpg" class="img-responsive"></li>
					<li><img src="images/product/mastercard.png" class="img-responsive" style="height:40px"></li>
					<li><img src="images/product/payumny.png" class="img-responsive" style="height:40px"></li>
					<li><img src="images/product/paytm.jpg" class="img-responsive" style="height:40px"></li>
					<li><img src="images/product/mobikwik.png" class="img-responsive" style="height:40px"></li>
					<li><img src="images/product/2.jpg" class="img-responsive"></li>
				</div>
			</div>
		</ul>
	</div>
</div><!-- /.container -->
<?php include "search_js_script.php"; ?>
<script type="text/javascript">
function addWishList(productId) {

	//alert(productId);
	var weightType= $('#get_pr_price_'+productId).val();	
	//alert(weightType);
	var split = weightType.split(",");				
	var productWeightType = split[0];			
	//alert(productWeightType);
	$.ajax({
	  type:'post',
	  url:'save_wish_list.php',
	  data:{
	     product_id:productId,productWeightType:productWeightType,       
	  },
	  success:function(data) {
	    if(data == 1) {
	    	alert("Item Added to your Wishlist");
	    	$('#change_wishlist_img_'+productId).attr('src', "images/icons/1.png");
	    	$('#change_wishlist_img1_'+productId).attr('src', "images/icons/1.png");
	    	
	    } else {
	    	alert("Item Removed from your Wishlist");
	    	$('#change_wishlist_img_'+productId).attr('src', "images/icons/wishlist.png");
	    	$('#change_wishlist_img1_'+productId).attr('src', "images/icons/wishlist.png");
	    }
	  }
	});

}
function addWishList1(ProductId) {

	//alert(ProductId);
	var weightType= $('#get_pr_price1_'+ProductId).val();	
	//alert(weightType);
	var split = weightType.split(",");				
	var productWeightType = split[0];			
	//alert(productWeightType);
	$.ajax({
	  type:'post',
	  url:'save_wish_list.php',
	  data:{
	     product_id:ProductId,productWeightType:productWeightType,       
	  },
	  success:function(data) {
	    if(data == 1) {
	    	alert("Item Added to your Wishlist");
	    	$('#change_wishlist_img1_'+ProductId).attr('src', "images/icons/1.png");
	    	
	    } else {
	    	alert("Item Removed from your Wishlist");
	    	$('#change_wishlist_img1_'+ProductId).attr('src', "images/icons/wishlist.png");
	    }
	  }
	});

}
</script>

<script>
	//Custom alert 
	modernAlert();
</script>

<script type="text/javascript" src="javascript/check_number_validations.js"></script>
<script type="text/javascript">
$(document).ready(function () {      
    $("#myBtn").click(function(){
         $('#myModal').modal('show');
    });
});
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<form method="POST">
	        <div class="modal-content">
	            <div class="modal-header">			                
	                 <h4 class="modal-title" id="myModalLabel">Refer a friend</h4>
	            </div>
	            <div class="modal-body">
            		<input type="email" name="refer_email" placeholder="please enter email" required>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="submit" name="refer_friend" value="refer_friend" class="btn btn-primary">Refer</button>
	            </div>
	        </div>
	    </form>
    </div>
</div>