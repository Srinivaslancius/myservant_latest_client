<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

if (isset($_POST['cart_id'])){

if($_SESSION['CART_TEMP_RANDOM'] == "") {
    $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
}
$cartId = $_POST['cart_id'];
$session_cart_id = $_SESSION['CART_TEMP_RANDOM'];

if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
    $user_session_id = $_SESSION['user_login_session_id'];
    $cartItems1 = "SELECT * FROM grocery_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND product_quantity!='0'";
    $cartItems = $conn->query($cartItems1);
} else {
  $cartItems1 = "SELECT * FROM grocery_cart WHERE  product_quantity!='0' AND session_cart_id='$session_cart_id' ";
  $cartItems = $conn->query($cartItems1);
}
$cartTotal = 0;
$cart_count = $cartItems->num_rows; 

echo '<a href="#" title="">
		<div class="icon-cart">
			<img src="images/icons/cart.png" alt="">
			<span>'.$cart_count.'</span>
		</div>
	</a>
	<div class="dropdown-box">';
		if($cart_count > 0) {
		echo'<ul>';
		while ($getCartItems = $cartItems->fetch_assoc()) { 
		$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
		$cartTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];

		$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getCartItems['product_id']);
		$img = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image'];
			echo'<li>
				<div class="img-product">
					<img src="'.$img.'" alt="">
				</div>
				<div class="info-product">
					<div class="name">
						'.$getProductName['product_name'].'
					</div>
					<div class="price">
						<span>'.$getCartItems['product_quantity'].' x</span>
						<span>Rs.'.$getCartItems['product_price'].'</span>
					</div>
				</div>
				<div class="clearfix"></div>
				<span class="delete"onclick="deleteCartItem('.$getCartItems['id'].');"><img src="images/icons/delete.png" alt=""></span>
			</li>';
			}
		echo'</ul>
		<div class="total">
			<span>Subtotal:</span>
			<span class="price">Rs . '.$cartTotal.'</span>
		</div>
		<div class="btn-cart">
			<a href="shop_cart.php" class="view-cart" title="">View Cart</a>';
			if(!isset($_SESSION['user_login_session_id'])) { 
			echo'<a href="login.php?cart_id='.encryptPassword(1).'" class="check-out" title="">Checkout</a>';
			} else { 
			echo'<a href="shop_checkout.php" class="check-out" title="">Checkout</a>';
			}
		echo'</div>';
		} else {
		echo'<center><img src="images/cart.png" style="width:120px;height:80px"></center>
			<p style="text-align:center; color:#f26226">Your shopping cart is currently empty
			</p>';
		}
	echo'</div>
</div>';
}