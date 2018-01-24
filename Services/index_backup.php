
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include_once 'meta.php';?>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

	<!-- CSS -->
	<link href="css/base.css" rel="stylesheet">

	<!-- CSS -->
	<!-- SPECIFIC CSS -->
	<link href="css/shop.css" rel="stylesheet">

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="css/date_time_picker.css" rel="stylesheet">
	<!-- Range slider -->
	<link href="css/ion.rangeSlider.css" rel="stylesheet">
	<link href="css/ion.rangeSlider.skinFlat.css" rel="stylesheet">

	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	
	<!-- End Preload -->

<header id="plain">
		<?php include_once './top_header.php';?>
		<!-- End top line-->

		<div class="container">
                    <?php include_once './menu.php';?>
		</div>
		<!-- container -->
                
        </header>
	<!-- Header================================================== -->
	
	<!-- End Header -->

	

	<main>
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
            <div class="container-fluid page-title">
			<?php  
				  if(!empty($getPartnersBanner['image'])) { ?> 	
					<div class="row">
						<img src="<?php echo $base_url . 'uploads/services_content_pages_images/'.$getPartnersBanner['image'] ?>" alt="<?php echo $getPartnersBanner['title'];?>" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php } else { ?>
					<div class="row">
						<img src="img/slides/slide_1.jpg" class="img-responsive" style="width:100%; height:400px;">
					</div>
				<?php }?>
    	</div>
		<div id="position">
			<div class="container">
				<ul>
					<li><a href="#">Home</a>
					</li>
					<li><a href="#">Category</a>
					</li>
					<li>Page active</li>
				</ul>
			</div>
		</div>
		<!-- End position -->

		<div class="container margin_60">
			<div class="row">
                            <div class="col-md-9">
                            <?php for($k=0; $k<5; $k++) {?>
				<div class="col-md-12 back_white mtop10 padd0">
                                    <div class="col-md-12 padd0">
                                        <div class="col-md-6"><h4>Personal Services </h4></div>
                                        <div class="col-md-3"><h4>Select Date </h4></div>
                                        <div class="col-md-3"><h4>Select Time </h4></div>
                                    </div>
                                    <div class="col-md-12 padd0">
                                        <div class="col-md-6">
                                            <p>*Select Same date and time for all the same category orders</p>
                                        </div>
                                                    <div class="col-md-3">
                                                        <input class="date-pick form-control" type="text" name="service_visit_date[]" data-cart-id="<?php echo $getCartItems['id'];?>"  value="<?php echo $service_selected_date1; ?>">
                                                    </div>
                                        <div class="col-md-3">
                                                        <input class="time-pick form-control cart_update_value" type="text" name="service_visit_time[]" data-cart-id="<?php echo $getCartItems['id'];?>"  value="<?php echo $service_visit_time1; ?>">
                                                    </div>
                                    </div>
                                        
					<table class="table table-striped cart-list add_bottom_30">
						<thead>
							<tr>
								<th>
									Particulars
								</th>
								<th>
									Price
								</th>
								<th>
									Date
								</th>
								<th>
									Time
								</th>
								<th>
									Quantity
								</th>
                                                                <th>
									Total
								</th>
                                                                <th>
									Remove
								</th>
							</tr>
						</thead>
						<tbody>
                                                    <?php for($i=0; $i<5; $i++) {?>
							<tr>
                                                            <td>Life Insuranace</td>
                                                            <td>Price After Visit</td>
                                                            <td><input class="date-pick form-control" type="text" name="service_visit_date[]" data-cart-id="<?php echo $getCartItems['id'];?>"  value="<?php echo $service_selected_date1; ?>"></td>
                                                             <td><input class="time-pick form-control cart_update_value" type="text" name="service_visit_time[]" data-cart-id="<?php echo $getCartItems['id'];?>"  value="<?php echo $service_visit_time1; ?>"></td>
                                                             <td>10</td>
                                                             <td>Rs. 10000</td>
								<td class="options">
									<a href="#"><i class=" icon-trash"></i></a></a>
								</td>
							</tr>
                                                    <?php } ?>
						
						</tbody>
					</table>
					
					<div class="add_bottom_15"><small>* Prices for person.</small>
					</div>
				</div>
				<!-- End col-md-8 -->
                            <?php } ?>
                            </div>
                                <aside class="col-md-3">
					<div class="box_style_1">
						<h3 class="inner">- Your Order Total -</h3>
						<table class="table table_summary">
							<tbody>
								<tr>
									<td>
										Sub Total
									</td>
									<td class="text-right">
										10000
									</td>
								</tr>
								<tr>
									<td>
										GST(20%)
									</td>
									<td class="text-right">
										2000
									</td>
								</tr>
								
								<tr class="total">
									<td>
										Total cost
									</td>
									<td class="text-right">
										Rs. 12000
									</td>
								</tr>
							</tbody>
						</table>
						<a class="btn_full" href="#">Proceed To Check out</a>
						<a class="btn_full_outline" href="#"><i class="icon-right"></i> Continue shopping</a>
					</div>
					
				</aside>
				<!-- End aside -->

			</div>
			<!--End row -->
		</div>
		<!--End container -->
	</main>
	<!-- End main -->

	<footer>
            <?php include_once 'footer.php';?>
        </footer>

	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon_set_1_icon-78"></i>
			</button>
		</form>
	</div><!-- End Search Menu -->

	<!-- Jquery -->
	<script data-cfasync="false" src="/cdn-cgi/scripts/af2821b0/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="js/functions.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
        <script>
		$('input.date-pick').datepicker({minDate: 0, maxDate: "+2M"});
		$('input.time-pick').timepicker({
			'step': 15,
			showInpunts: false
		})
	</script>

	<script>
		if ($('.prod-tabs .tab-btn').length) {
			$('.prod-tabs .tab-btn').on('click', function (e) {
				e.preventDefault();
				var target = $($(this).attr('href'));
				$('.prod-tabs .tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				$('.prod-tabs .tab').fadeOut(0);
				$('.prod-tabs .tab').removeClass('active-tab');
				$(target).fadeIn(500);
				$(target).addClass('active-tab');
			});

		}
	</script>
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
        <script type="text/javascript">
	        

 		//Price calculations for cart items
		$('.service_quantity').on('keyup', function () {
			var priceTypeId = $(this).attr("data-price-type-id");
			var serviceCurrentQuantity = $(this).val();	
			var field_clause = 'quantity';   
			var cartId = $(this).attr("data-cart-id");  	
			if(serviceCurrentQuantity != 0) {
				if(priceTypeId == 1) {									
			    	var servicePrice = $(this).attr("data-service-get-price");		    	
			    	var final_service_price = parseInt(serviceCurrentQuantity*servicePrice);	    	
			    	$('.changePrice_'+cartId).text(final_service_price);
			    	$('#get_total_class_'+cartId).val(final_service_price);	
			    	calcTotal();
			    } 
			} else {
				$(this).val('1');
				alert("Please enter valid quantity!");
				return false;
			}
			//Auto ssave db in quantity
			$.ajax({
			    type:"post",
			    url:"update_cart.php",		    
			    data: {
		            cartId:cartId,service_quantity:serviceCurrentQuantity,field_clause:field_clause,
		        },
			    success:function(result){
			    	//alert(result);
			    }
			});
	    	
		});
		function calcTotal() {
	    var subTotal = 0
	    $(".get_total_class").each(function() {
	      subTotal += $(this).val() != "" ? parseInt($(this).val()) : 0;
	      $('#cart_total').html(subTotal);
	      $('.get_cart_total').val(subTotal);
	      var cartTotal = $('.get_cart_total').val();
	      var serviceTax = $('#service_tax').val();
	      grandTotal = (parseInt(cartTotal));	     
	    })
 		  $('.grand_total').html(grandTotal);
	  }

	  //cart auto update using ajax	   
     $('.date-pick').on('change', function () {
     	    var element = $(this).val();
            var cartId = $(this).attr("data-cart-id");      
            var field_clause = 'date';     
            $.ajax({
		    type:"post",
		    url:"update_cart.php",		    
		    data: {
	            cartId:cartId,filed_value:element,field_clause:field_clause,
	        },
		    success:function(result){	
		    	
		    }
		  }); 
     });
     $('.time-pick').on('change', function () {
     	    var element = $(this).val();
            var cartId = $(this).attr("data-cart-id");      
            var field_clause = 'time';     
            $.ajax({
		    type:"post",
		    url:"update_cart.php",		    
		    data: {
	            cartId:cartId,service_visit_time:element,field_clause:field_clause,
	        },
		    success:function(result){	
		    //alert(result);	    	
		    }
		  }); 
     });
    </script>

</body>

</html>