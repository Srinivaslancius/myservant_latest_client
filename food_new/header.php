<?php
if($_SESSION['CART_TEMP_RANDOM'] == "") {
    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
    $user_session_id = $_SESSION['user_login_session_id'];
    $cartItems1 = "SELECT * FROM food_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND item_quantity!='0' ";
    $cartItems = $conn->query($cartItems1);
} else {                                       
    //$cartItems = getAllDataWhere('food_cart','session_cart_id',$session_cart_id);
    $cartItems1 = "SELECT * FROM food_cart WHERE session_cart_id='$session_cart_id' AND item_quantity!='0' ";
    $cartItems = $conn->query($cartItems1);
} 
?>

<div class="container-fluid">
    <div class="row myservant_topheader">
            <div class="col-md-12">
              <div class="col-md-1">
			</div>			  
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <p><span style="margin-right:10px"><i class="icon-location"></i>Vijayawada </span>
					<span> <select style="background-color:transparent;color:white">
					<option style="color:black">English</option>
					<option style="color:black">Hindi</option>
					<option style="color:black">Telugu</option>
					</select> </span></p>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <p>
					<span class="icon-phone"> <?php echo $getFoodSiteSettingsData['mobile'];?></span>
                        <?php if($_SESSION['user_login_session_id'] =='') { ?>
                            <a href="login.php"><span class="icon-lock"></span> Login</a>
                            <a href="login.php"><span class="icon-user"> Register</span> </a>

                        <?php } else { ?>
                          <span class="icon-user"></span><a href="myaccount.php"><?php echo $_SESSION['user_login_session_name']; ?></a>
                        | <span class="icon-logout"></span><a href="logout.php">Logout</a>
						
                        <?php } ?>
						
                    </p>
                </div>

                
            </div> 
        </div>
        <div class="row myseranr_header">
            <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:-6px">
                <?php  
                if(!empty($getFoodSiteSettingsData['logo'])) { ?>
                <a href="index.php" id="logo">
                <img src="<?php echo $base_url . 'uploads/food_logo/'.$getFoodSiteSettingsData['logo'] ?>" alt="<?php echo $getFoodSiteSettingsData['admin_title']; ?>" data-retina="true" class="myservanrlogo">
                <?php } else { ?>
                <center><img src="img/logo-mobile.png"  alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm"></center>
                <?php }?>
                </a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-9">
                <form method="post" action="list.php" autocomplete="off">
                    <div id="custom-search-input">
                        <div class="input-group">
						<!--<span class="icon-search">
                            <input type="submit" class="btn_search1">
                            </span>-->
							<input type="text" class=" search-query" placeholder="Your Address or postal code" required name="searchKey" id="search-box">	
                            <div id="suggesstion-box"></div>
                            <span class="input-group-btn">
                            <input type="submit" class="btn_search" value="SHOW RESTAURANTS" name="searchFood">
                            </span>
                        </div>
                    </div>
                </form>
            </div>

             <div class="col-md-2 col-sm-2">
             </div>

            <div class="col-md-1 col-sm-1 col-xs-3" style="margin-top:3px">
                <a href="cart.php"><button type="button" class="btn btn-danger c_pad" style="background-color:transparent;border-color:white"><span class=" icon-cart" style="font-size:18px"></span> <span class="badge" style="font-size:10px" id="cart_cnt">(<?php echo $cartItems->num_rows; ?>)</span></button></a>

            </div>
        </div><!-- End row -->
    </div><!-- End container -->