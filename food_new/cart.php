<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html style="overflow-x:hidden">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include_once './meta_fav.php';?>
    
    <!-- GOOGLE WEB FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>

    <!-- BASE CSS -->
    <link href="css/base.css" rel="stylesheet">
    
    <!-- Radio and check inputs -->
    <link href="css/skins/square/grey.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>
	.btn-group button {
    background-color:  #fe6003;
    border: 1px solid  #fe6003;
    color: white;
    padding: 10px 24px; 
    cursor: pointer;
    float: left;
}

.btn-group:after {
    content: "";
    clear: both;
    display: table;
}

.btn-group button:not(:last-child) {
    border-right: none; 
}
.radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.radio input {
    position: absolute;
    opacity: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #eee; 
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radio:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.radio input:checked ~ .checkmark {
    background-color: #fe6003;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.radio input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.radio .checkmark:after {
    left: 5px;
    top: 5px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
	background: white;
}
th{
	font-size:14px;
}
td{
	font-size:14px;
}

@media only screen and (max-width: 480px) {
	.rw_wdth h5{
		margin-left:0px !important;
	
	}
	
}
</style>
</head>

<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	

    <!-- Header ================================================== -->
    <header>
        <?php include_once 'header.php';?>
    </header>
    <!-- End Header =============================================== -->

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
		<div id="sub_content">
		 <h1>Place your order</h1>
		 </div>
	</div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#0">Cart</a></li>                
            </ul>
            
        </div>
    </div><!-- Position -->
<?php
    if($_SESSION['CART_TEMP_RANDOM'] == "") {
        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
    }
    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
        $user_session_id = $_SESSION['user_login_session_id'];
        $cartItems1 = "SELECT * FROM food_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND item_quantity!='0'";
        $cartItems = $conn->query($cartItems1);
    } else {
        //$cartItems = getAllDataWhere('food_cart','session_cart_id',$session_cart_id);
      $cartItems1 = "SELECT * FROM food_cart WHERE  item_quantity!='0' AND session_cart_id='$session_cart_id' ";
      $cartItems = $conn->query($cartItems1);
    } 
?>
<input type="hidden" id="session_cart_id" value="<?php echo $_SESSION['CART_TEMP_RANDOM']; ?>">
<!-- Content ================================================== -->
	<div class="container margin_60_35 cart">
		<div class="row">     
		<?php if($cartItems->num_rows > 0) { ?>  			
			<div class="col-md-12">
				<div class="box_style_2" id="main_menu">                  
					<table class="table table-striped cart-list">
					<thead>
						<tr>
							<th style="width:320px">ITEM</th>							
							<th>PRICE</th>
							<th>ADDON</th>
							<th>QUANTITY</th>
							<th>TOTAL</th>
							<th>REMOVE</th>
						</tr>
					</thead>
					<tbody>
					<?php $cartTotal = 0; $service_tax = 0;
                while ($getCartItems = $cartItems->fetch_assoc()) {
          ?>

					<tr id="get_inc_id_<?php echo $getCartItems['id']; ?>">
						<td class="rw_wdth">
						<div class="row">
						<div class="col-sm-2 col-xs-12">
							<?php $getProductDetails= getIndividualDetails('food_products','id',$getCartItems['food_item_id']); ?>
                        	<figure class="thumb_menu_list"><img src="<?php echo $base_url . 'uploads/food_product_images/'.$getProductDetails['product_image']; ?>" alt="<?php echo $getProductDetails['product_name']; ?>"></figure>
							</div> 
					<div class="col-sm-8 col-xs-12">							
							<h5 style="margin-left:15px"><?php echo $getProductDetails['product_name']; ?></h5>
              <?php 
                $getAddons = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '".$getCartItems['food_item_id']."' AND cart_id='".$getCartItems['id']."' AND session_cart_id = '$session_cart_id'";
                $getAddonData = $conn->query($getAddons);
                while($getadcartItems = $getAddonData->fetch_assoc() ) {
               ?>  <div class="alert alert-dismissable" style="margin-bottom:-20px">
					     <a class="close1" ><i class="icon-trash" style="color:#fe6003" onclick="removeIngItem(<?php echo $getadcartItems['id']; ?>);"></i></a>
                  <p id="dis_add_on_<?php echo $getCartItems['id']; ?>" style="font-size:12px"><?php echo $getadcartItems['item_ingredient_name'] .":". $getadcartItems['item_ingredient_price']; ?> </p>
				  </div>		
                <?php } ?>		
				</div>
				</div>
						</td>
						<td>Rs. <?php echo $getCartItems['item_price']; ?></td>
						<td>

						<?php $getIngredenats = getAllDataWhere('food_product_ingredient_prices','product_id',$getCartItems['food_item_id']); ?>
            <?php
              $getAddOnsPrice = "SELECT * FROM food_update_cart_ingredients WHERE food_item_id = '".$getCartItems['food_item_id']."' AND cart_id='".$getCartItems['id']."' AND session_cart_id = '$session_cart_id'";
              $getAddontotal = $conn->query($getAddOnsPrice);
              $getAdstotalPrice = 0;
              while($getAdTotal = $getAddontotal->fetch_assoc()) {
                  $getAdstotalPrice += $getAdTotal['item_ingredient_price'];
              }
              ?>

               <a href="#" data-toggle="modal" data-target="#<?php echo $getCartItems['id']; ?>"> <i class="icon_plus_alt2" style="font-size:20px;margin-left:10px;color:#fe6003;"></i></a>
							<div class="modal fade" id="<?php echo $getCartItems['id']; ?>" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">

										<?php if($getIngredenats->num_rows > 0) { ?>
                    <input type="hidden" id="item_id_<?php echo $getCartItems['id']; ?>" name="item_id" value="<?php echo $getCartItems['food_item_id']; ?>">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											  <div class="row">
												  <div class="col-sm-8 col-xs-6">
												  <h4 class="modal-title" style="font-size:15px"><small>Add On's:</small><br><?php echo $getProductDetails['product_name']; ?></h4>
												  </div>
												   <div class="col-sm-4 col-xs-6">
													<div class="btn-group">
													  <!-- <button style="background-color:#f5f5f5;border-color:#f5f5f5;color:black">Total:₹ <span id="tot_item_price_<?php echo $getCartItems['id']; ?>"><?php echo $getCartItems['item_price']*$getCartItems['item_quantity']+$getAdstotalPrice; ?></span></button> -->
													  <button class="update_cart_item" onclick="updateCartItem(<?php echo $getCartItems['id']; ?>);">Update Cart</button>					  
													</div>
												   </div>
											  </div>
										</div>
										

										<input type="hidden" name="product_tot_price_ind" value="<?php echo $getCartItems['item_price']*$getCartItems['item_quantity']+$getAdstotalPrice; ?>" id="product_tot_price_ind_<?php echo $getCartItems['id']; ?>" class="pro_tot_price">

										<div class="modal-body">
                         <div class="row">
                             <div class="col-sm-1">
                             </div>
                             <div class="col-sm-10  col-xs-12">
                             	<?php while ($getIngProdItems = $getIngredenats->fetch_assoc()) { ?>
                             	<?php $getInDet= getIndividualDetails('food_ingredients','id',$getIngProdItems['ingredient_name_id']); ?>
                              <?php $getIngredenatsIdsData = getAllDataWhere('food_update_cart_ingredients','food_item_id',$getCartItems['food_item_id']);
                             ?>

                              <?php 
                                $getAddons1 = "SELECT * FROM food_update_cart_ingredients WHERE session_cart_id = '$session_cart_id' AND cart_id = ".$getCartItems['id']." AND item_ingredient_id = ".$getIngProdItems['ingredient_name_id']." ";  
                                  $getAddonData1 = $conn->query($getAddons1);
                                  $getAddData = $getAddonData1->fetch_assoc();
                                  $ingId = $getAddData['item_ingredient_id'];
                                  
                              ?> 

                             	 <input type="hidden" class="ing_price" id="ing_price" value="<?php echo $getIngProdItems['admin_price']; ?>">
                                 <label class="radio" style="margin-bottom:20px">
                                     <h4 style="font-size:15px"><?php echo $getInDet['ingredient_name']; ?><span style="padding-left:50px">Rs:<?php echo $getIngProdItems['admin_price']; ?></span></h4>
                                     <input type="checkbox"  <?php if($ingId == $getInDet['id']) { echo 'checked="checked"'; } ?> class="check_valid_add_on" value="<?php echo $getIngProdItems['admin_price']; ?>" id="check_valid_add_on_<?php echo $getCartItems['id']; ?>" data-key="<?php echo $getCartItems['id']; ?>" data-ing-name="<?php echo $getInDet['ingredient_name']; ?>" data-ing-id="<?php echo $getInDet['id']; ?>" data-ing-price="<?php echo $getIngProdItems['admin_price']; ?>" name="checkbox_<?php echo $getCartItems['id']; ?>">
                                     <span class="checkmark"></span>
                                 </label>
                              <?php } ?>
                             </div>
                             <div class="col-sm-1">
                             </div>
                         </div>
                      </div>
										
										<?php } else { ?>
                      No Add on's
                    <?php } ?>
										
										<div class="modal-footer">
										  <!-- <button type="button" class="btn btn-default close" data-dismiss="modal" data-key="<?php echo $getCartItems['id']; ?>">Close</button> -->
										</div>
									</div>
								</div>
							</div>                        
						</td>

						<td>
						<a href="#0" class="remove_item"><i class="icon_plus_alt inc_cart_quan" onclick="add_cart_item1(<?php echo $getCartItems['id']; ?>)"></i></a> <strong id="ind_quan_<?php echo $getCartItems['id']; ?>"><?php echo $getCartItems['item_quantity']; ?></strong> <a href="#0" class="remove_item"><i class="icon_minus_alt" onclick="remove_cart_item1(<?php echo $getCartItems['id']; ?>)"></i></a>

            <input type="hidden" id="cart_ind_price_<?php echo $getCartItems['id']; ?>" value="<?php echo $getCartItems['item_price']*$getCartItems['item_quantity']+$getAdstotalPrice; ?>">

              </td>
					<!--<td style="padding-left:30px;padding-right:30px"> <?php echo $getCartItems['item_quantity']; ?></td>-->
						<td id="item_inc_price_<?php echo $getCartItems['id']; ?>">Rs. <?php echo $getCartItems['item_price']*$getCartItems['item_quantity']+$getAdstotalPrice; ?> /-</td>
						<?php $cartTotal += $getCartItems['item_price']*$getCartItems['item_quantity']; ?>
						<td> <i class="icon-trash" onclick="deleteCartItem(<?php echo $getCartItems['id']; ?>);" style="font-size:20px;color:#fe6003;margin-left:10px"></li></td>
					</tr>
                     <?php } ?>
					</tbody>
					</table>
					
				</div>
			</div>
            <div class="col-md-9 col-sm-8"></div>
			<div class="col-md-3 col-sm-4">
				<div class="theiaStickySidebar">
					<div id="cart_box" >
						<table class="table table_summary">
						<tbody>
						<tr>
							<td>Subtotal <span class="pull-right sub_total">Rs. <?php echo $cartTotal; ?></span></td>
              <input type="hidden" id="sub_total" value="<?php echo $cartTotal; ?>">
						</tr>						
						<?php $service_tax += ($getFoodSiteSettingsData['service_tax']/100)*$cartTotal; ?>
						<tr>
							<td>GST <span class="pull-right gst">Rs. <?php echo $service_tax; ?>(<?php echo $getFoodSiteSettingsData['service_tax'] ; ?>%)</span></td>
              <input type="hidden" id="service_tax" value="<?php echo $service_tax; ?>"> 
						</tr>
            <input type="hidden" id="tx_site_per" value="<?php echo $getFoodSiteSettingsData['service_tax']; ?>">

              <?php
              $getAddOnsPrice = "SELECT * FROM food_update_cart_ingredients WHERE session_cart_id = '$session_cart_id'";
              $getAddontotal = $conn->query($getAddOnsPrice);
              $getAdstotal = 0;
              while($getAdTotal = $getAddontotal->fetch_assoc()) {
                  $getAdstotal += $getAdTotal['item_ingredient_price'];
              }
              ?>
              <?php if($getAdstotal!=0) { ?>
              <tr>
                  <td>Extra Add On's Price <span class="pull-right">Rs. <?php echo $getAdstotal; ?></span></td>
              </tr>
						  <?php } ?>
              <input type="hidden" value="<?php echo $getAdstotal; ?>" id="add_ons_extra">

              <?php 
                $getDeliveryCharge = getIndividualDetails('food_vendors','id',$_SESSION['session_restaurant_id']);
                $DeliveryCharges = $getDeliveryCharge['delivery_charges'];
                if($DeliveryCharges!=0) {
                  $deliveryCharges = $getDeliveryCharge['delivery_charges'];
                } else {
                  $deliveryCharges = 0;
                }
              ?>
              <input type="hidden" value="<?php echo $deliveryCharges; ?>" id="delivery_charges">
						 <tr>
							<td>Delivery Charges <span class="pull-right">Rs. <?php echo $deliveryCharges; ?></span> </td>
						</tr>
						<tr>
							<td style="color:#fe6003">TOTAL <span class="pull-right total_price">Rs. <?php echo round($cartTotal+$service_tax+$getAdstotal+$deliveryCharges); ?></span></td>
						</tr>
						</tbody>
						</table>
						<hr>
            <?php if(!isset($_SESSION['user_login_session_id'])) { ?>
						  <a class="btn_full" href="login.php?cart_id=<?php echo encryptPassword(1);?>">Order now</a>
            <?php } else { ?>
              <a class="btn_full" href="checkout.php">Order now</a>
            <?php } ?>
						<a class="btn_full_outline" href="index.php"><i class="icon-right"></i> Continue</a>
					</div>
				</div>
			</div>
			<?php }  else { ?>
    			<p style="text-align:center; color:#f26226">No Items In Your Cart</p>
    			<center><a href="index.php" style="color:#f26226">Click here for Items</a></center>
    		<?php } ?>
            
		</div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

<!-- Footer ================================================== -->
    <footer>
        <?php include_once 'footer.php';?>
    </footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->
  
    
<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts_min.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script  src="js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>
<script src="js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<script>
$('#cat_nav a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top - 70
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});
</script>

<script type="text/javascript">
$('.check_valid_add_on').on('change', function (e) {

	var updateTotalPrice =0;
  var cartId = $(this).attr("data-key");    	
	var totalIndPrice = parseInt($('#product_tot_price_ind_'+cartId).val());	
	$('input:checkbox[name=checkbox_'+cartId+']:checked').each(function(){ // iterate through each checked element.
      if ($(this).prop('checked')==true){ 
        updateTotalPrice += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());  
      }
    	  
    });     
  	//alert(updateTotalPrice);
  	var getTotalVal = updateTotalPrice+totalIndPrice;
	$('#tot_item_price_'+cartId).html(getTotalVal);
});

//
function updateCartItem(cartId) {

    if($('[type="checkbox"]').is(":checked")){ 
      var productId = $('#item_id_'+cartId).val();   
      var cartSessionId = $('#session_cart_id').val();
      var cb = [],
      post_cb = []
      $.each($('input:checkbox[name=checkbox_'+cartId+']:checked'), function(){
          var ingId = $(this).attr('data-ing-id'),
              ingName = $(this).attr('data-ing-name'),
              ingPrice = $(this).attr('data-ing-price')

          cb.push(ingId + ' -> ' + ingName + ' -> ' + ingPrice);
          post_cb.push({
              'ingId': ingId,
              'ingName': ingName,
              'ingPrice': ingPrice,
          });
      });
      
      $.ajax({
        type:'post',
        url:'update_cart_ingredient.php',
        data:{
           cartId : cartId,
           productId : productId, 
           cartSessionId : cartSessionId,  
           cb: post_cb      
        },
        success:function(response) {
           //alert();
           $(".modal .close").click();
           location.reload();
          }
      });
        

    } else {
        alert("Please select any extra Add On's");
        return false;
    }
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

function removeIngItem(ingUniqId) {
 
  $.ajax({
      type:'post',
      url:'delete_cart_ingredants.php',
      data:{
         ingUniqId : ingUniqId,        
      },
      success:function(response) {
        location.reload();
      }
    });

}
</script>

<script type="text/javascript">

function add_cart_item1(cartId) {
  
 $.ajax({
  type:'post',
  url:'cart_page_inc.php',
  data:{
     cart_id:cartId,       
  },
  success:function(data) {
    //alert(data);
    $('.cart').html(data);
    $('#cart_cnt').html($('#get_cart_cnt').val());
  }
 });

}

function remove_cart_item1(cartId) {

 $.ajax({
  type:'post',
  url:'cart_page_dec.php',
  data:{
     cart_id:cartId,       
  },
  success:function(data) { 
    //alert(data);
    $('.cart').html(data);
    $('#cart_cnt').html($('#get_cart_cnt').val());
  }

 });

}

</script>

<?php include "search_js_script.php"; ?>
</body>
</html>