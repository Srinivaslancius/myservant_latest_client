<?php 
include "admin_includes/config.php";
include "admin_includes/common_functions.php";

if (isset($_POST['cart_id'])){

$cartId = $_POST['cart_id'];
$delivery_charges = $_POST['delivery_charges'];

$getCartQuantity = getIndividualDetails('grocery_cart','id',$cartId);
$itemPrevQuan = $getCartQuantity['product_quantity'];

$itemPrevQuantity = $itemPrevQuan-1;

if($itemPrevQuantity == 0){
    $sql3 = "DELETE FROM grocery_cart WHERE id ='$cartId' ";
    $conn->query($sql3);
}
    
$updateItems = "UPDATE grocery_cart SET product_quantity = '$itemPrevQuantity' WHERE id = '$cartId' ";
$upCart = $conn->query($updateItems);

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

$cartTotal = 0;
if($cartItems->num_rows > 0) {
echo'<div class="row">
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
				<tbody>';
				while ($getCartItems = $cartItems->fetch_assoc()) { 
					$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
					$cartTotal = $getCartItems['product_price']*$getCartItems['product_quantity'];
					$subTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];
					$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getCartItems['product_id']);
					$getProductWeight = getIndividualDetails('grocery_product_bind_weight_prices','id',$getCartItems['product_weight_type']);
					$img = $base_url . 'grocery_admin/uploads/product_images/'.$getProductImage['image'];
					echo'<tr>
						<td>
						
							<div class="img-product">
								<img src="'.$img.'" alt="">
							</div>
							
							<div class="name-product">
								'.wordwrap($getProductName['product_name'],20,"<br>\n").'
							</div>
							
								<div class="weight">
									'.$getProductWeight['weight_type'].'
								</div>
							
							<div class="price">
								 Rs . '.$getCartItems['product_price'].'
							</div>
							
							<div class="clearfix"></div>
						</td>
						<td>
							<div class="quanlity">
		        				<span class="btn-down" onclick="remove_cart_item1('.$getCartItems['id'].')"></span>
		        				<input type="text" readonly name="number" id="number" value="'.$getCartItems['product_quantity'].'" min="0" placeholder="Quantity">
		        				<span class="btn-up" onclick="add_cart_item1('.$getCartItems['id'].')"></span>
		            		</div>
						</td>
						<td>
							<div class="total">
								 Rs . '.$cartTotal.'
							</div>
						</td>
						<td>
							<a href="#" title="" onclick="deleteCartItem('.$getCartItems['id'].');">
								<img src="images/icons/delete.png" alt="">
							</a>
						</td>
					</tr>';
				}
				echo'</tbody>
			</table>
		</div>
	</div>
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
	                        <td class="subtotal" id="subtotal">Rs . '.$subTotal.'</td>
	                    </tr>
	                    <tr>
	                        <td>GST('.$_POST['service_tax'].'%)</td>';
	                        $service_tax += ($_POST['service_tax']/100)*$subTotal;
	                        $orderTotal = $subTotal+$service_tax+$_POST['delivery_charges'];
	                        echo'<td class="subtotal" id="serviceTax1">Rs . '.$service_tax.'</td>
	                    </tr>
	                    <tr>
	                        <td>Delivery Charges</td>
	                        <td class="subtotal">Rs . '.$_POST['delivery_charges'].'</td>
	                    </tr>
	                    <input type="hidden" name="service_tax" id="service_tax" value="'.$_POST['service_tax'].'">
	                    <input type="hidden" name="delivery_charges" id="delivery_charges" value="'.$_POST['delivery_charges'].'">
	                    <tr>
	                        <td>Total</td>
	                        <td class="price-total" id="ordertotal">Rs. '.round($orderTotal).'</td>
	                    </tr>
	                </tbody>
	            </table>
	            <div class="btn-cart-totals">
	                <a href="delete_cart.php" class="update" title="">Clear Cart</a>';
	                if(!isset($_SESSION['user_login_session_id'])) {
	                	echo'<a href="login.php?cart_id='.encryptPassword(1).'" class="update" style="background-color:#2d2d2d !important;">Proceed To Checkout</a>';
	                } else {
	                	echo'<a href="shop_checkout.php" class="update" style="background-color:#2d2d2d !important;">Proceed To Checkout</a>';
	                } 
	                echo'<a href="index.php" class="checkout" title="">Continue Shopping</a>
	            </div>
	        </form>
	    </div>
    </div>
</div>';
} else { 
	echo'<center><img src="images/cart.png"></center>
	<p style="text-align:center;font-size:20px;margin-top:10px">Your shopping cart is currently empty</p>			
	<p style="text-align:center;margin:15px">please click on the Continue Shopping button below for items</p>
    <center><a href="index.php"><button type="submit" class="contact" style="background-color:#FE6003">Continue Shopping</button></a></center>';
}
echo'<input type="hidden" id="cart_cnt" value="'.$cartCount.'">';
}