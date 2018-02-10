<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Cosmos</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
        <?php include_once './main_header.php';?>
    </div>
    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
            <?php include_once './side_menu.php';?>
        </div>
      </div>
      <div class="site-right-sidebar">
        <?php include_once './right_slide_toggle.php';?>
      </div>
      <?php $product_id = $_GET['product_id'];
      $pid = $_GET['pid']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  {   

            $lkp_city_id = $_POST['lkp_city_id'];  
            $selling_price1 = $_POST['selling_price'];  
            $weight_type =  $_POST['weight_type'];
            $mrp_price =    $_POST['mrp_price'];
            $selling_price = $_POST['selling_price'];                   
            $offer_type = $_POST['select_opt'];
            if($offer_type == 0) {
                $offer_percentage = 0;
            } else {
                $offer_percentage = $_POST['offer_percentage'];
            } 
            //echo "<pre>"; print_r($_POST); die;
            $updatePrice = "UPDATE `grocery_product_bind_weight_prices` SET lkp_city_id = '$lkp_city_id',weight_type = '$weight_type', mrp_price = '$mrp_price', selling_price = '$selling_price', offer_type = '$offer_type', offer_percentage = '$offer_percentage' WHERE id = '$product_id' ";
            $result = $conn->query($updatePrice);
            echo "<script type='text/javascript'>window.location='update_price.php?pid=".$pid."'</script>";
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Update Price</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getPrices = getIndividualDetails('grocery_product_bind_weight_prices','id',$product_id); ?>
                        <form class="form-horizontal" method="post" autocomplete="off">
                        <?php $getProductNames = getIndividualDetails('grocery_product_name_bind_languages','product_id',$pid); ?>
                            <div class="form-group" style="margin-right:50px;margin-left:50px">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Product Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" readonly class="form-control" name="product_name" value="<?php echo $getProductNames['product_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group" style="margin-right:50px;margin-left:50px">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select City</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_city_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select City --</option>
                                        <?php $getCities = getAllDataWithStatus('grocery_lkp_cities','0');?>
                                        <?php while($row = $getCities->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $getPrices['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['city_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="clear_fix"></div>

                            <div class="input_fields_container" >
							
                                <div style="border:1px solid #ddd;padding-top:20px;margin-left:60px;margin-right:60px">
                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer</label>
                                        <!-- <div class="btn-group col-sm-6 col-md-4" >
                                             <label class="btn btn-outline-primary">
                                                <input type="radio" name="buttonRadios_1[]" required onclick="check_offer(1)" value='1' > Yes
                                            </label>
                                            <label class="btn btn-outline-primary">
                                                <input type="radio" name="buttonRadios_1[]" required onclick="check_offer(0)" value='0' > No &nbsp;
                                            </label>
                                        </div> -->
                                        <div class="btn-group col-sm-6 col-md-4" >
                                            <select onChange="check_offer(this.value)" class="form-control offer_type" name="select_opt">
                                                <option value="">Select</option>
                                                <option <?php if($getPrices['offer_type'] == 1) { echo "Selected"; } ?> value="1">Yes</option>
                                                <option <?php if($getPrices['offer_type'] == 0) { echo "Selected"; } ?> value="0">No</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <input type="hidden" id="setRaioVal">
                                    <div class="form-group offer_price" style="display:none">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Percentage</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control valid_mobile_num" name="offer_percentage" onChange="calculatePrice()" value="<?php echo $getPrices['offer_percentage']; ?>" id="offer_per" placeholder="Offer Percentage (%)" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Weight (Ex: 100 Gms etc..)</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control" name="weight_type" value="<?php echo $getPrices['weight_type']; ?>" id="form-control-3" placeholder="Weights (Ex: 100 Gms etc..)" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">MRP</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control valid_mobile_num" name="mrp_price" id="mrp_price" placeholder="Enter MRP" value="<?php echo $getPrices['mrp_price']; ?>" onkeyup="getPrice(this.value);" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Selling Price</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control valid_mobile_num" value="<?php echo $getPrices['selling_price']; ?>" name="selling_price" id="selling_price" placeholder="Enter Selling Price" onkeyup="changePrice(this.value);" required>
                                        </div>
                                       
                                    </div>
                                </div>
								 <div class="col-sm-8 col-md-8">
								 </div>
                            </div>

                            <br />
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>

    <script type="text/javascript">
    function check_offer(getRadioVal) {
        if(getRadioVal == 1 ){
            $('.offer_price').css("display", "block");
            $('#mrp_price, #selling_price,#offer_per').val('');
        } else {
            $('.offer_price').css("display", "none");
            $('#mrp_price, #selling_price,#offer_per').val('');         
        }      
        $('#setRaioVal').val(getRadioVal);
    }
    var RadioVal = $('.offer_type').val();
    if ($('.offer_type').val() == 1) {
        $('.offer_price').css("display", "block");
        $('#setRaioVal').val(RadioVal);
    }
    </script>

    <script type="text/javascript">
    function getPrice(Price) {
        if($('#setRaioVal').val()!='') {
            if($('#setRaioVal').val() == 0){
                $('#selling_price').val(Price);        
            } else {
                return false;
            }
        } else {
            $('#mrp_price, #selling_price').val('');
            alert("Please select offer type ");
            return false;
        }
    }
    function changePrice() {
        var Price = $('#mrp_price').val();
        var SellingPrice = $('#selling_price').val();

        if(SellingPrice!='' && Price!='') {
            var OfferPer = ((Price-SellingPrice)/Price)*100;
            $('#offer_per').val(OfferPer);
        } else {
            //alert("Please enter MRP Price");
            $('#mrp_price, #selling_price').val('');
        }

        if(parseFloat(SellingPrice) > parseFloat(Price)) {
            alert("Selling Price should be less than MRP");
            $('#mrp_price,#selling_price,#offer_per').val('');
        }
    }
    </script>

  </body>
</html>