<aside class="col-md-12">
					
					<div class="box_style_1 expose">
						<h3 class="inner">- Booking -</h3>

                        <?php
                            if($_SESSION['CART_TEMP_RANDOM'] == "") {
                                $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
                            }
                            $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
                            if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
                                $user_session_id = $_SESSION['user_login_session_id'];
                                $cartItems1 = "SELECT * FROM services_cart WHERE user_id = '$user_session_id' OR session_cart_id='$session_cart_id' ";
                                $cartItems = $conn->query($cartItems1);
                            } else {                                       
                                $cartItems = getAllDataWhere('services_cart','session_cart_id',$session_cart_id);
                            } 
                        ?>
                        <?php if($cartItems->num_rows > 0) { ?>
						
						<table class="table table_summary">
                            <thead>
                                <tr>
                                    <th>Particular</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
							<tbody> 
                                    <?php                                     
                                    $cartTotal = 0;  
                                    while ($getCartItems = $cartItems->fetch_assoc()) { 
                                    ?>
                                    <tr>
                                        <?php $getSerName= getIndividualDetails('services_group_service_names','id',$getCartItems['service_id']); ?>
                                        <td><?php echo $getSerName['group_service_name']; ?></td>
                                        <?php if($getSerName['service_price_type_id'] == 1) {
                                             $cartTotal += $getSerName['service_price'];
                                         ?>
                                            <td>Rs. <?php echo $getSerName['service_price']; ?></td>
                                        <?php } elseif($getSerName['price_after_visit_type_id'] == 1) { ?>
                                            <td><?php echo $getSerName['price_after_visiting']; ?></td>
                                        <?php } else { ?>
                                            <td><?php echo $getSerName['service_min_price']; ?> - <?php echo $getSerName['service_max_price']; ?></td>
                                        <?php } ?>
                                        <td><a class="delete_cart_item" data-cart-id ="<?php echo $getCartItems['id']; ?>" ><i class="icon-minus-circled"></i></a></td>
                                    </tr>
                                    <?php } ?>                               
                                                                       
								</tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Amount<span style="font-size: 11px;font-weight: normal"><br>(*Min visiting charges applicable.)</span></th>
                                        <th  colspan="2">Rs. <?php echo $cartTotal; ?>/-</th>
                                    </tr>
                                </tfoot>
						</table>
                        <a class="btn_full" href="cart.php">Book now</a>
						<a class="btn_full_outline" href="index.php">Continue</a>
                        <?php } else { ?>
                            <p style="text-align:center; color:#fe6003">No Services In Your Cart</p>
                        <?php } ?>
					</div>
					<!--/box_style_1 -->

					

				</aside>
                
                <script type="text/javascript">
                $(".delete_cart_item").click(function(){
                    var element = $(this);
                    var del_id = element.attr("data-cart-id");                               
                    var info = 'cart_id=' + del_id;
                    if(confirm('Are You Sure You Want to Delete ?', 'You Want to Delete Cart Item', function(input){var str = input === true ? 'Ok' : 'Cancel'; 
                        if(str == 'Ok') {
                            $.ajax({
                               type: "POST",
                               url: "delete_cart_items.php",
                               data: info,
                               success: function(result){
                                if(result == 1) {
                                    //alert('Cart Item Deleted Successfully');
                                    //setTimeout(function() {
                                        location.reload();
                                    //}, 600);
                                   
                                } else {
                                    alert('Cart Item Not Deleted');
                                    return false;                            
                                }
                             }
                            });
                        }
                    }))  
                    return false;
                });
                </script>