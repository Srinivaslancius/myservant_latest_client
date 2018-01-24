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
								<a href="#" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">Shop Cart</a>
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<?php
		    if($_SESSION['CART_TEMP_RANDOM'] == "") {
		        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
		    }
		    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
		    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
		        $user_session_id = $_SESSION['user_login_session_id'];
		        $cartItems1 = "SELECT * FROM grocery_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND product_quantity!='0'";
		        $cartItems = $conn->query($cartItems1);
		    } else {
		      $cartItems1 = "SELECT * FROM grocery_cart WHERE  product_quantity!='0' AND session_cart_id='$session_cart_id' ";
		      $cartItems = $conn->query($cartItems1);
		    } 
		?>
		<?php if($cartItems->num_rows > 0) { ?>
		<section class="flat-shop-cart">
			<div class="container cart">
				<div class="row">
					<div class="col-lg-12">
						<div class="flat-row-title style1">
							<h3>Shopping Cart</h3>
						</div>
						<div class="table-cart">
							<table>
								<thead>
									<tr>
										<th>Product</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php $cartTotal = 0;
								while ($getCartItems = $cartItems->fetch_assoc()) { 
								$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
								$cartTotal = $getCartItems['product_price']*$getCartItems['product_quantity'];
								$subTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];

								$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getCartItems['product_id']);
								$getProductWeight = getIndividualDetails('grocery_product_bind_weight_prices','id',$getCartItems['product_weight_type']);
								?>
									<tr>
										<td>
										
											<div class="img-product">
												<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="">
											</div>
											
											<div class="name-product">
												<?php echo wordwrap($getProductName['product_name'],20,"<br>\n"); ?>
											</div>
											
												<div class="weight">
													<?php echo $getProductWeight['weight_type']; ?>
												</div>
											<!-- <div class="quanlity-box">
											<div class="colors">
											<select onchange="get_price(this.value,'na10');">
											<option value="96">500 - Rs : 80</option>
																				  
												</select>
											</div>
									
											</div> -->
											
											<div class="price">
												 Rs . <?php echo $getCartItems['product_price']; ?>
											</div>
											
											<div class="clearfix"></div>
										</td>
										<td>
											<div class="quanlity">
                                				<span class="btn-down" onclick="remove_cart_item1(<?php echo $getCartItems['id']; ?>)"></span>
                                				<input type="text" readonly name="number" id="number" value="<?php echo $getCartItems['product_quantity']; ?>" min="0" placeholder="Quantity">
                                				<span class="btn-up" onclick="add_cart_item1(<?php echo $getCartItems['id']; ?>)"></span>
                                    		</div>
										</td>
										<td>
											<div class="total">
												 Rs . <?php echo $cartTotal; ?>
											</div>
										</td>
										<td>
											<a href="#" title="" onclick="deleteCartItem(<?php echo $getCartItems['id']; ?>);">
												<img src="images/icons/delete.png" alt="">
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div><!-- /.table-cart -->
					</div><!-- /.col-lg-8 -->
					<div class="col-lg-7">
					</div>
					<div class="col-lg-5">
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                            <form action="#" method="get" accept-charset="utf-8">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="subtotal" id="subtotal">Rs . <?php echo $subTotal; ?></td>
                                        </tr>
                                        <tr>
                                            <td>GST(<?php echo $getSiteSettingsData1['service_tax']; ?>%)</td>
                                            <?php $service_tax += ($getSiteSettingsData1['service_tax']/100)*$subTotal; ?>
                                            <td class="subtotal" id="serviceTax1">Rs . <?php echo $service_tax; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Charges</td>
                                            <td class="subtotal">Rs . <?php echo $getSiteSettingsData1['delivery_charges']; ?></td>
                                        </tr>
                                        <input type="hidden" name="service_tax" id="service_tax" value="<?php echo $getSiteSettingsData1['service_tax']; ?>">
                                        <input type="hidden" name="delivery_charges" id="delivery_charges" value="<?php echo $getSiteSettingsData1['delivery_charges']; ?>">
                                        <!-- <tr>
                                            <td>GST</td>
                                            <td class="btn-radio">
                                                <div class="radio-info">
                                                    <input type="radio" id="flat-rate" checked name="radio-flat-rate">
                                                    <label for="flat-rate">Flat Rate: <span> â‚¹3.00</span></label>
                                                </div>
                                                <div class="radio-info">
                                                    <input type="radio" id="free-shipping" name="radio-flat-rate">
                                                    <label for="free-shipping">Free Shipping</label>
                                                </div>
                                                <div class="btn-shipping">
                                                    <a href="#" title="">Calculate Shipping</a>
                                                </div>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td>Total</td>
                                            <td class="price-total" id="ordertotal">Rs. <?php echo round($subTotal+$service_tax+$getSiteSettingsData1['delivery_charges']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    <a href="delete_cart.php" class="update" title="">Clear Cart</a>
                                    <?php if(!isset($_SESSION['user_login_session_id'])) { ?>
                                    	<a href="login.php?cart_id=<?php echo encryptPassword(1);?>" class="update" style="background-color:#2d2d2d !important;">Proceed To Checkout</a>
                                    <?php } else { ?>
                                    	<a href="shop_checkout.php" class="update" style="background-color:#2d2d2d !important;">Proceed To Checkout</a>
                                    <?php } ?>
                                    <a href="index.php" class="checkout" title="">Continue Shopping</a>
                                </div><!-- /.btn-cart-totals -->
                            </form><!-- /form -->
                        </div><!-- /.cart-totals -->
                    </div>
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-shop-cart -->
		<?php } else { ?>
		<center><img src="images/cart.png"></center>
			<p style="text-align:center;font-size:20px;margin-top:10px">Your shopping cart is currently empty</p>			
			<p style="text-align:center;margin:15px">Please click on the 'Continue Shopping' button below for items</p>
    		<center><a href="index.php"><button type="submit" class="contact" style="background-color:#FE6003">Continue Shopping</button></a></center>
		<?php } ?>

		<section class="flat-row flat-iconbox style3">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Free Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/order.png" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/payment.png" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/return.png" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->
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
		// Select your input element.
var number = document.getElementById('number');

// Listen for input event on numInput.
number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}
		</script>
<script type="text/javascript">

function add_cart_item1(cartId) {
 var service_tax = $('#service_tax').val();
 var delivery_charges = $('#delivery_charges').val();
 $.ajax({
  type:'post',
  url:'cart_page_inc.php',
  data:{
     cart_id:cartId,service_tax:service_tax,delivery_charges:delivery_charges,      
  },
  success:function(data) {
    //alert(data);
    $('.cart').html(data);
  }
 });
 $.ajax({
  type:'post',
  url:'header_cart_page_inc.php',
  data:{
     cart_id:cartId,service_tax:service_tax,delivery_charges:delivery_charges,      
  },
  success:function(data) {
    //alert(data);
    $('.header_cart').html(data);
  }
 });

}

function remove_cart_item1(cartId) {
 var service_tax = $('#service_tax').val();
 var delivery_charges = $('#delivery_charges').val();
 $.ajax({
  type:'post',
  url:'cart_page_dec.php',
  data:{
     cart_id:cartId,service_tax:service_tax,delivery_charges:delivery_charges,      
  },
  success:function(data) {
    $('.cart').html(data);
  }

 });
 $.ajax({
  type:'post',
  url:'header_cart_page_dec.php',
  data:{
     cart_id:cartId,service_tax:service_tax,delivery_charges:delivery_charges,      
  },
  success:function(data) {
    $('.header_cart').html(data);
  }

 });

}

function deleteCartItem(cartId) {
  //Display Add On's
  var x = confirm("Are you sure you want to delete?");
    if(x) {
        $.ajax({
          type:'post',
          url:'delete_cart_tem.php',
          data:{
             cartId : cartId,                                
          },
          success:function(response) {            
             if(response == 1) {
                alert("Item Deleted!");
                location.reload();
             } else {
               alert("Item Delete Failed!");
               return false;
             }
            }
        });
      }
}

</script>
		

</body>	
</html>