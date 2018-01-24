
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div id="logo" class="logo">
								<a href="index.php" title="">
									<img src="images/logos/logo1.png" alt="">
								</a>
							</div><!-- /#logo -->
						</div><!-- /.col-md-3 -->
						<div class="col-md-7">
							<div class="top-search">
								<form action="single_product.php" method="post" class="form-search" accept-charset="utf-8"  autocomplete="off">
									
									<div class="box-search">
										<input type="text" name="searchKey" placeholder="Search Your Products..." id="search-box">
										<div id="suggesstion-box"></div>
										<span class="btn-search">
											<button type="submit" class="waves-effect"><img src="images/icons/search.png" alt=""></button>
										</span>
										
									</div><!-- /.box-search -->
								</form><!-- /.form-search -->
							</div><!-- /.top-search -->
						</div><!-- /.col-md-6 -->
						<div class="col-md-2">
							<div class="box-cart">
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
							    $cart_count = $cartItems->num_rows; 
							?>
								<div class="inner-box header_cart">
									<a href="#" title="">
										<div class="icon-cart">
											<img src="images/icons/cart.png" alt="">
											<span><?php echo $cart_count; ?></span>
										</div>
										<!-- <div class="price">
											₹0.00
										</div> -->
									</a>
									<div class="dropdown-box">
										<?php if($cart_count > 0) { ?>
										<ul>
											<?php $cartTotal = 0;
											while ($getCartItems = $cartItems->fetch_assoc()) { 
											$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
											$cartTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];

											$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getCartItems['product_id']);
											?>
											<li>
												<div class="img-product">
													<img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image']; ?>" alt="">
												</div>
												<div class="info-product">
													<div class="name">
														<?php echo $getProductName['product_name']; ?>
													</div>
													<div class="price">
														<span><?php echo $getCartItems['product_quantity']; ?> x</span>
														<span>Rs.<?php echo $getCartItems['product_price']; ?></span>
													</div>
												</div>
												<div class="clearfix"></div>
												<span class="delete"onclick="deleteCartItem(<?php echo $getCartItems['id']; ?>);"><img src="images/icons/delete.png" alt=""></span>
											</li>
											<?php } ?>
										</ul>
										<div class="total">
											<span>Subtotal:</span>
											<span class="price">Rs . <?php echo $cartTotal; ?></span>
										</div>
										<div class="btn-cart">
											<a href="shop_cart.php" class="view-cart" title="">View Cart</a>
											<?php if(!isset($_SESSION['user_login_session_id'])) { ?>
											<a href="login.php?cart_id=<?php echo encryptPassword(1);?>" class="check-out" title="">Checkout</a>
											<?php } else { ?>
											<a href="shop_checkout.php" class="check-out" title="">Checkout</a>
											<?php } ?>
										</div>
										<?php } else { ?>
										<center><img src="images/cart.png" style="width:120px;height:80px"></center>
											<p style="text-align:center; color:#f26226">Your shopping cart is currently empty

</p>
										<?php } ?>
									</div>
								</div><!-- /.inner-box -->
							</div><!-- /.box-cart -->
						</div><!-- /.col-md-3 -->
					</div><!-- /.row -->
				</div><!-- /.container -->

<script type="text/javascript">
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